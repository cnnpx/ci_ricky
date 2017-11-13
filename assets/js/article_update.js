$(document).ready(function () {
    CKEDITOR.replace('ArticleContent', {
        language: 'vi',
        height: 450
    });
    CKEDITOR.replace('ArticleLead', {
        language: 'vi',
        toolbar : 'ShortToolbar',
        height: 150
    });

    $('.datepicker').datepicker({
        format: 'dd/mm/yyyy',
        autoclose: true
    });
    $('input.timepicker').timepicker({
        showInputs: false
    });
    $('#articleForm').on('focusout', 'input#articleTitle', function(){
        $('input#articleSlug').val(makeSlug($(this).val()));
    });
    $('#btnUpImage').click(function(){
        var finder = new CKFinder();
        finder.resourceType = 'Images';
        finder.selectActionFunction = function(fileUrl) {
            $('img#articleImage').attr('src', fileUrl).show();
        };
        finder.popup();
    });

    var tags = [];
    //https://github.com/xoxco/jQuery-Tags-Input
    $('input#tags').tagsInput({
        'width': '100%',
        'interactive': true,
        'defaultText': '',
        'onAddTag': function(tag){
            tags.push(tag);
        },
        'onRemoveTag': function(tag){
            var index = tags.indexOf(tag);
            if(index >= 0) tags.splice(index, 1);
        },
        /*'onChange': function(tag){
            console.log('change ' + JSON.stringify(tag));
        },*/
        'delimiter': [',', ';'],
        'removeWithBackspace': true,
        'minChars': 0,
        'maxChars': 0
    });

    var articleId = parseInt($('input#articleId').val());
    if(articleId > 0){
        $('input.tagName').each(function(){
            $('input#tags').addTag($(this).val());
        });
    }

    $('.submit').click(function(){
        if(validateEmpty('#articleForm')) {
            var form = $('#articleForm');
            var articleContent = CKEDITOR.instances['ArticleContent'].getData();
            if(!checkEmptyEditor(articleContent)){
                showNotification('Nội dung không được bỏ trống', 0);
                return false;
            }
            var categoryIds = JSON.stringify($('select#categoryId').val());
            if(categoryIds == null || categoryIds== 'null') categoryIds = '[]';
            $.ajax({
                type: "POST",
                url: form.attr('action'),
                data: {
                    ArticleId: articleId,
                    ArticleTitle: $('input#articleTitle').val().trim(),
                    ArticleSlug: $('input#articleSlug').val().trim(),
                    ArticleLead: CKEDITOR.instances['ArticleLead'].getData(),
                    ArticleContent: articleContent,
                    ArticleTypeId: $('input#articleTypeId').val(),
                    ArticleStatusId: $('select#articleStatusId').val(),
                    ArticleImage: $('img#articleImage').attr('src'),
                    PublishDateTime: getPublishDateTime(),

                    TagNames: JSON.stringify(tags),
                    CategoryIds: categoryIds
                },
                success: function (response) {
                    var json = $.parseJSON(response);
                    showNotification(json.message, json.code);
                    if(json.code == 1 && articleId == 0) redirect(false, $('a#articleListUrl').attr('href'));
                },
                error: function (response) {
                    showNotification('Có lỗi xảy ra trong quá trình thực hiện', 0);
                }
            });
        }
        return false;
    });
});

function getPublishDateTime(){
    var retVal = '';
    var articleDates = $('input#articleDate').val().trim().split('/');
    if(articleDates.length == 3){
        retVal = articleDates[2] + '-' + articleDates[1] + '-' + articleDates[0];
        var articleTimes = $('input#articleTime').val().trim().split(' ');
        if(articleTimes.length == 2){
            var hour = 0;
            var minute = '00';
            var times = articleTimes[0].split(':');
            if(times.length == 2){
                hour = parseInt(times[0]);
                minute = times[1];
            }
            if(articleTimes[1] == 'PM') hour += 12;
            if(hour < 10) hour = '0' + hour;
            retVal += ' ' + hour + ':' + minute + ':00';
        }
        else retVal += ' 00:00:00';
    }
    return retVal;
}