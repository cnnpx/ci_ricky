/* eslint-env node */
/* eslint-disable no-console */
'use strict';
const EventEmitter = require('events');
const express = require('express');
const bodyParser = require('express/node_modules/body-parser');
var mysql = require('./mysql');

const app = express();
var server = require('websocket').server;
var http = require('http');

//---------------------------
var WebSocketServer = require("ws").Server;

var wss = new WebSocketServer({port:1338});

wss.on('connection', function connection(eventSource) {
    eventSource.on('message', function(message) {
      //nhan message tu client
	  console.log(message);
	  
	  
    });

});

//broadcast message nhan dc tu facebook den tat ca client dang connect den websocket
wss.broadcast = function broadcast(msg) {
   wss.clients.forEach(function each(client) {
       client.send(JSON.stringify(msg));
    });
};

//---------------------------


/*
var socket = new server({
    httpServer: http.createServer().listen(1338)
});
socket.on('request', function(request) {
    var connection = request.accept(null, request.origin);

    connection.on('message', function(message) {
        console.log(message.utf8Data);
		connection.sendUTF(message);
        setTimeout(function() {
            
        }, 1000);
    });

    connection.on('close', function(connection) {
        console.log('connection closed');
    });
});

*/

// parse application/x-www-form-urlencoded
app.use(bodyParser.urlencoded({extended: false}))

// parse application/json
app.use(bodyParser.json())


app.set('ip', process.env.OPENSHIFT_NODEJS_IP || process.env.IP || "127.0.0.1");

app.get('/', (req, res) => {
  res.send('server dang chay!');
});

app.get('/webhook', (req, res) => {
	console.log(req);
  if (req.query['hub.verify_token'] == 'testtoken') {
    console.log('[server.js] Validating webhook!');

    res.status(200).send(req.query['hub.challenge']);
  } else {
    console.log('[server.js] Error. Make sure the validation tokens match.');
    res.sendStatus(403);
  }
});



app.post('/webhook', (req, res) => {
  const data = req.body;
	//console.log(req.body);
  if (data.object === 'page') {
   
   //thong tin tin nhan nhan dc tu webhook
	if(data.entry[0].messaging && data.entry[0].messaging[0].message){
		insertMessage(data.entry[0]);
		wss.broadcast( data.entry[0]);
		res.sendStatus(200);
		return;
	}
	//thông tin comment nhận đc từ webhook
  if(data.entry[0].changes && data.entry[0].changes[0].field == 'feed' && data.entry[0].changes[0].value !=null && data.entry[0].changes[0].value !=undefined && data.entry[0].changes[0].value.item =='comment'){
	  insertComment(data.entry[0]);
	
	  wss.broadcast(data.entry[0] );
	  res.sendStatus(200);
	  return;
  }
  
  //Thay đổi trong cuộc hội thoại `conversations` đc fb thông báo khi có tin nhắn mới gửi đến
   if(data.entry[0].changes && data.entry[0].changes[0].field == 'conversations' && data.entry[0].changes[0].value !=null && data.entry[0].changes[0].value !=undefined && data.entry[0].changes[0].value.thread_id  ){
	   
	   //Kiem tra xem cuoc hoi thoai da dc thiet lap tu truoc do hay chua de quyet dinh co insert hay update thong tin conversation hay ko
	  checkConversation(data );
	
	  wss.broadcast(data.entry[0] );
	  res.sendStatus(200);
	  return;
  }
  
    res.sendStatus(200);
  }
});



app.all('/*', (req, res) => {
  res.json({
    status: 404,
    message: `Không tồn tại đường dẫn ${req.originalUrl}`
  });
});



//insert khi co tin nhan gui den page
function insertMessage(data){

var con = mysql.createConnection({
		  host: "localhost",
		  user: "root",
		  password: "",
		  database: "ci_ricky"
		});
con.connect(function(err) {
  if (err) return false;
  	var dataInsert = [
	  data.messaging[0].message.mid,
	  data.messaging[0].sender.id,
	  data.messaging[0].recipient.id,
	  data.messaging[0].message.text,
	  data.time,
	  data.messaging[0].timestamp,
	  data.id
	  ];
  var sql = "INSERT INTO message(id_message, from_people, to_people, message, create_date, timestamp, object) values (?)";
  con.query(sql, [dataInsert], function (err, result) {
    if (err) {
		console.log('Insert message failed');
		return false;}
    console.log("insert Message Success");
  });
});
}

//insert comment khi co thay doi tren page
function insertComment(data){

var con = mysql.createConnection({
		  host: "localhost",
		  user: "root",
		  password: "",
		  database: "ci_ricky"
		});
	con.connect(function(err) {
  if (err) return false;
  var dataInsert = [
	data.changes[0].value.comment_id,
	data.changes[0].value.parent_id, 
	0,
	false, 
	true, 
	data.changes[0].value.message, 
	data.changes[0].value.sender_id, 
	data.id, 
	data.changes[0].value.item, 
	data.time,
	data.changes[0].value.post_id,
	data.changes[0].value.post_id
	];
	console.log(dataInsert);
	var sql = "INSERT INTO comments(id, id_parent, message_count, is_hidden, can_reply, message, from_sender, to_sender, name, create_date, link,post_id) values ( ? )";
  con.query(sql, [dataInsert], function (err, result) {
    if (err) {
		console.log('insert comment failed '+ err)
		return false;
	}
    console.log("insert Comment Success");
  });
});
	
}


//insert thay doi tren conversations khi co thay doi tren page
function insertConversation(data){

var con = mysql.createConnection({
		  host: "localhost",
		  user: "root",
		  password: "",
		  database: "ci_ricky"
		});
con.connect(function(err) {
  if (err) {
	  console.log('cannot connect to db');
	  return false;
  }
   var timeMiliSec = Number(data.time) * 1000;
  var dataInsert = [
	data.id,
	data.changes[0].value.thread_id, 
	data.changes[0].value.thread_key,
	timeMiliSec,
	];
	console.log(dataInsert);
	var sql = "INSERT INTO conversations(id, thread_id, thread_key, time) VALUES (?)";
  con.query(sql, [dataInsert], function (err, result) {
    if (err) {
		console.log('insert conversation failed :' + err)
		return false;
	}
    console.log("insert conversation Success");
  });
});
	
}

//cap nhat ngay thang cho cuoc hoi thoai co event nhan dc tu webhook
	function updateConversation(thread_id,time){
		
	var con = mysql.createConnection({
		  host: "localhost",
		  user: "root",
		  password: "",
		  database: "ci_ricky"
		});
		
		
		con.connect(function(err) {
		  if (err) return false;
		  var timeMiliSec = Number(time) * 1000;
		  var dataUpdate = [{
		  time: timeMiliSec } ,{
			thread_id : thread_id
		  }];
			console.log(dataUpdate);
			var sql = "UPDATE conversations set ? where ?";
		  con.query(sql, dataUpdate, function (err, result) {
			if (err) {
				console.log('update failed'+ err)
				return false;
			}
			console.log("update success");
		  });
		});
		
	}

	//Check cuoc hoi thoai da dc khoi tao hay chua
	function checkConversation(data){

	var con = mysql.createConnection({
		  host: "localhost",
		  user: "root",
		  password: "",
		  database: "ci_ricky"
		});
		
		con.connect(function(err) {
		  if (err){
			  throw err;
			  
			  }
			var sql = "select count(*) as number_row from conversations where thread_id = ?";
		  con.query(sql, [data.entry[0].changes[0].value.thread_id], function (err, result) {
			if (err) {
				console.log('Query failed');
				return false;
			}else{
				console.log('total count _ : '+JSON.stringify(result));
				if(result[0].number_row > 0){
					updateConversation(data.entry[0].changes[0].value.thread_id, data.entry[0].time);
				}else{
					insertConversation(data.entry[0]);
						}
			}
			
		  });
		});
	}
	

	function getListComment(fromResult, toResult){
		var con = mysql.createConnection({
		  host: "localhost",
		  user: "root",
		  password: "",
		  database: "ci_ricky"
		});
		
		con.connect(function(err) {
		  if (err){
			  console.log('cannot connect to db');
			  }
			var sql = "SELECT id, id_parent, message_count, is_hidden, can_reply, message, from_sender, to_sender, name, create_date, link, post_id FROM comments order by create_date desc limit ? ";
		  con.query(sql, [data.entry[0].changes[0].value.thread_id], function (err, result) {
			if (err) {
				console.log('Query failed');
				return [];
			}else{
				console.log('result _ : '+JSON.stringify(result));
				return result;
				}
		  });
		});
		
	}
	
	
app.listen(5000);
