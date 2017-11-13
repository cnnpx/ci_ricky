// lưu các thông tin lọc khi sử dụng bộ lọc
var data_filter = {
    itemFilters: [],
    filterId: 0,
    tagFilters: []
};
$(document).ready(function () {
    var siteName = $('input#siteName').val();
    if (siteName != '') {
        siteName = $('title').text() + ' - ' + siteName;
        $('title').text(siteName);
        $('input#siteName').val(siteName);
    }
    if ($('select.select2').length > 0) $('select.select2').select2();
    if ($('input.itemTableCheck').length > 0) {
        $('input.itemTableCheck').iCheck({
            checkboxClass: 'icheckbox_square-blue',
            radioClass: 'iradio_square-blue',
            increaseArea: '20%'
        });
    }
    if ($('div.divTable').length > 0) {
        if ($(window).width() > 760) $('div.divTable').removeClass('table-responsive');
        else $('div.divTable').addClass('table-responsive');
        $(window).resize(function () {
            if ($(window).width() > 760) $('div.divTable').removeClass('table-responsive');
            else $('div.divTable').addClass('table-responsive');
        });
    }
    $(document).ajaxStart(function () {
        Pace.restart();
    });

    //admin menu
    if ($('.sidebar-menu').length > 0) {
        var curentPathName = window.location.pathname;
        var rootPath = $('#roorPath').val();
        curentPathName = curentPathName.replace(rootPath, '');
        var hostname = window.location.hostname;
        $('.sidebar-menu li a').each(function () {
            var pageLink = $(this).attr('href');
            if (pageLink != undefined) {
                pageLink = pageLink.replace('https://', '');
                pageLink = pageLink.replace('http://', '');
                pageLink = pageLink.replace(hostname, '');
                pageLink = pageLink.replace(rootPath, '');
                if (pageLink == curentPathName) {
                    $(this).parent('li').addClass('active');
                    var ul = $(this).parent('li').parent('ul').parent('li').parent('ul');
                    if (ul.length > 0) {
                        $(this).parent('li').parent('ul').css('display', 'block');
                        $(this).parent('li').parent('ul').parent('li').addClass('active');
                        ul.css('display', 'block');
                        ul.parent('li').addClass('active');

                    }
                    else $(this).parent('li').parent('ul').parent('li').addClass('active');
                    return false;
                }
            }
        });
        if(localStorage.getItem('ricky_menu_collapsed') == '1') $('body').addClass('sidebar-collapse');
        else $('body').removeClass('sidebar-collapse');
        $('.sidebar-toggle').click(function (e) {
            e.preventDefault();
            if(localStorage.getItem('ricky_menu_collapsed') == '1') localStorage.setItem('ricky_menu_collapsed', '0');
            else localStorage.setItem('ricky_menu_collapsed', '1');
        });
    }
});

function replaceCost(cost, isInt) {
    cost = cost.replace(/\,/g, '');
    if (cost == '') cost = 0;
    if (isInt) return parseInt(cost);
    else  return parseFloat(cost);
}

function formatDecimal(value) {
    value = value.replace(/\,/g, '');
    while (value.length > 1 && value[0] == '0' && value[1] != '.') value = value.substring(1);
    if (value != '' && value != '0') {
        if (value[value.length - 1] != '.') {
            if (value.indexOf('.00') > 0) value = value.substring(0, value.length - 3);
            value = addCommas(value);
            return value;
        }
        else return value;
    }
    else return 0;
}

function addCommas(nStr) {
    nStr += '';
    var x = nStr.split('.');
    var x1 = x[0];
    var x2 = x.length > 1 ? '.' + x[1] : '';
    var rgx = /(\d+)(\d{3})/;
    while (rgx.test(x1)) {
        x1 = x1.replace(rgx, '$1' + ',' + '$2');
    }
    return x1 + x2;
}

/* type = 1 - success
 other - error
 */
function showNotification(msg, type) {
    var typeText = 'error';
    if (type == 1) typeText = 'success';
    var notice = new PNotify({
        title: 'Thông báo',
        text: msg,
        type: typeText,
        delay: 2000,
        addclass: 'stack-bottomright',
        stack: {"dir1": "up", "dir2": "left", "firstpos1": 15, "firstpos2": 15}
    });
}

function redirect(reload, url) {
    if (reload) {
        window.setTimeout(function () {
            window.location.reload(true);
        }, 2000);
    }
    else {
        window.setTimeout(function () {
            window.location.href = url;
        }, 2000);
    }
}

function scrollTo(eleId) {
    $('html, body').animate({
        scrollTop: $(eleId).offset().top - 200
    }, 1000);
    $(eleId).focus();
}

//validate
function validateEmpty(container) {
    var flag = true;
    $(container + ' .hmdrequired').each(function () {
        if ($(this).val().trim() == '') {
            showNotification($(this).attr('data-field') + ' không được bỏ trống', 0);
            $(this).focus();
            flag = false;
            return false;
        }
    });
    return flag;
}

function validateNumber(container, isInt) {
    var flag = true;
    var value = 0;
    $(container + ' .hmdrequiredNumber').each(function () {
        value = replaceCost($(this).val(), isInt);
        if (value <= 0) {
            showNotification($(this).attr('data-field') + ' không được bé hơn 0', 0);
            $(this).focus();
            flag = false;
            return false;
        }
    });
    return flag;
}

function checkEmptyEditor(text) {
    text = text.replace(/\&nbsp;/g, '').replace(/\<p>/g, '').replace(/\<\/p>/g, '').trim();
    return text.length > 0;
}

function makeSlug(str) {
    var slug = str.trim().toLowerCase();
    // change vietnam character
    slug = slug.replace(/á|à|ả|ạ|ã|ă|ắ|ằ|ẳ|ẵ|ặ|â|ấ|ầ|ẩ|ẫ|ậ/gi, 'a');
    slug = slug.replace(/é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ/gi, 'e');
    slug = slug.replace(/i|í|ì|ỉ|ĩ|ị/gi, 'i');
    slug = slug.replace(/ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ/gi, 'o');
    slug = slug.replace(/ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự/gi, 'u');
    slug = slug.replace(/ý|ỳ|ỷ|ỹ|ỵ/gi, 'y');
    slug = slug.replace(/đ/gi, 'd');
    // remove special character
    slug = slug.replace(/\`|\~|\!|\@|\#|\||\$|\%|\^|\&|\*|\(|\)|\+|\=|\,|\.|\/|\?|\>|\<|\'|\"|\:|\;|_/gi, '');
    // change space to -
    slug = slug.replace(/ /gi, "-");
    slug = slug.replace(/\-\-\-\-\-/gi, '-');
    slug = slug.replace(/\-\-\-\-/gi, '-');
    slug = slug.replace(/\-\-\-/gi, '-');
    slug = slug.replace(/\-\-/gi, '-');
    slug = '@' + slug + '@';
    slug = slug.replace(/\@\-|\-\@|\@/gi, '');
    return slug;
}

//pagging
function pagging(pageId) {
    $('input#pageId').val(pageId);
    $('input#submit').trigger('click');
}

//Common function

function province() {
    if ($('select#provinceId').length > 0) {
        $('select#districtId option').hide();
        var provinceId = $('select#provinceId').val();
        if (provinceId != '0') $('select#districtId option[data-id="' + provinceId + '"]').show();
        else $('select#districtId option[value="0"]').show();
        $('select#provinceId').change(function () {
            $('select#districtId option').hide();
            provinceId = $(this).val();
            if (provinceId != '0') $('select#districtId option[data-id="' + provinceId + '"]').show();
            else $('select#districtId option[value="0"]').show();
        });
    }
}

function actionItemAndSearch(config) {
    $('input.iCheckTable').iCheck({
        checkboxClass: 'icheckbox_square-blue',
        radioClass: 'iradio_square-blue',
        increaseArea: '20%'
    });
    /*$('#ulFilter').on('click', 'a', function () {
        console.log($(this).attr('data-id'))
    });*/
    $('body').on('ifToggled', 'input#checkAll', function (e) {
        if (e.currentTarget.checked) {
            $('input.iCheckItem').iCheck('check');
            $('#h3Title').hide();
            $('#selectAction').show();
        }
        else {
            $('input.iCheckItem').iCheck('uncheck');
            $('#selectAction').hide();
            $('#h3Title').show();
        }
    });
    $('body').on('ifToggled', 'input.iCheckItem', function (e) {
        if (e.currentTarget.checked) {
            $('#h3Title').hide();
            $('#selectAction').show();
        } else {
            var iCheckItems = document.querySelectorAll('.checked input.iCheckItem');
            if (iCheckItems.length == 1) {
                $('input#checkAll').iCheck('uncheck');
                $('#h3Title').show();
                $('#selectAction').hide();
            }
        }
    });
    var tags = [];
    if ($('input#tags').length > 0) {
        $('input#tags').tagsInput({
            'width': '100%',
            'height': '100px',
            'interactive': true,
            'defaultText': '',
            'onAddTag': function (tag) {
                tags.push(tag);
            },
            'onRemoveTag': function (tag) {
                var index = tags.indexOf(tag);
                if (index >= 0) tags.splice(index, 1);
            },
            'delimiter': [',', ';'],
            'removeWithBackspace': true,
            'minChars': 0,
            'maxChars': 0
        });
    }
    $('#selectAction').change(function () {
        var actionCode = $(this).val();
        if (actionCode != '') {
            var itemIds = [];
            $('input.iCheckItem').each(function () {
                if ($(this).parent('div.icheckbox_square-blue').hasClass('checked')) itemIds.push(parseInt($(this).val()));
            });
            if (itemIds.length > 0) {
                if (actionCode == 'delete_item') {
                    if (confirm('Bạn có thực sự muốn xóa ?')) {
                        $.ajax({
                            type: "POST",
                            url: $('input#deleteItemUrl').val(),
                            data: {
                                ItemIds: JSON.stringify(itemIds)
                            },
                            success: function (response) {
                                var json = $.parseJSON(response);
                                showNotification(json.message, json.code);
                                if (json.code == 1) {
                                    for (var i = 0; i < itemIds.length; i++) $('#trItem_' + itemIds[i]).remove();
                                }
                            },
                            error: function (response) {
                                showNotification('Có lỗi xảy ra trong quá trình thực hiện', 0);
                            }
                        });
                    }
                }
                else if (actionCode == 'add_tags') {
                    $('.spanItemName').text(config.ItemName);
                    $('input#changeTagTypeId').val('1');
                    $('input#itemTagIds').val(JSON.stringify(itemIds));
                    $('#tags').importTags('');
                    tags = [];
                    $('#modalEditTags').modal('show');
                }
                else if (actionCode == 'delete_tags') {
                    $('.spanItemName').text(config.ItemName);
                    $('input#changeTagTypeId').val('2');
                    $('input#itemTagIds').val(JSON.stringify(itemIds));
                    $('#tags').importTags('');
                    tags = [];
                    $('#modalEditTags').modal('show');
                }
                else if (actionCode.indexOf('change_status-') >= 0) {
                    actionCode = actionCode.split('-');
                    if (actionCode.length == 2) {
                        var statusId = parseInt(actionCode[1]);
                        if (confirm('Bạn có thực sự muốn thay đổi ?')) {
                            $.ajax({
                                type: "POST",
                                url: $('input#changeItemStatusUrl').val(),
                                data: {
                                    ItemIds: JSON.stringify(itemIds),
                                    StatusId: statusId
                                },
                                success: function (response) {
                                    var json = $.parseJSON(response);
                                    showNotification(json.message, json.code);
                                    if (json.code == 1) {
                                        var i;
                                        if (statusId == 0) {
                                            for (i = 0; i < itemIds.length; i++) $('#trItem_' + itemIds[i]).remove();
                                        }
                                        else {
                                            for (i = 0; i < itemIds.length; i++) $('td#statusName_' + itemIds[i]).html(json.data);
                                        }
                                    }
                                },
                                error: function (response) {
                                    showNotification('Có lỗi xảy ra trong quá trình thực hiện', 0);
                                }
                            });
                        }

                    }
                }
                else config.extendFunction(itemIds, actionCode);
            }
            else showNotification('Vui lòng chọn ' + config.ItemName, 0);
        }
        $('#selectAction').val('');
    });
    $('#btnChangeTags').click(function () {
        if (tags.length > 0 && $('input#itemTagIds').val() != '') {
            $('#btnChangeTags').prop('disabled', true);
            $('#modalEditTags .imgLoading').show();
            $.ajax({
                type: "POST",
                url: $('input#updateItemTagsUrl').val(),
                data: {
                    ItemIds: $('input#itemTagIds').val(),
                    TagNames: JSON.stringify(tags),
                    ItemTypeId: $('input#itemTypeId').val(),
                    ChangeTagTypeId: $('input#changeTagTypeId').val()
                },
                success: function (response) {
                    var json = $.parseJSON(response);
                    showNotification(json.message, json.code);
                    if (json.code == 1) {
                        $('input#itemTagIds').val('');
                        $('#modalEditTags').modal('hide');
                        $('input.iCheckItem').iCheck('uncheck');
                    }
                    $('#btnChangeTags').prop('disabled', false);
                    $('#modalEditTags .imgLoading').hide();
                },
                error: function (response) {
                    showNotification('Có lỗi xảy ra trong quá trình thực hiện', 0);
                    $('#btnChangeTags').prop('disabled', false);
                    $('#modalEditTags .imgLoading').hide();
                }
            });
        }
        else showNotification('Vui lòng chọn nhãn', 0);
    });


    /*--------------------------------Thiết kế bộ lọc-------------------------------------------*/

    /*
     *hàm filter
     *input : string,object
     *output : json
     *itemFilters có dạng
     * [
     *      {filed_name : price ,conds : [=,1000]},
     *      {filed_name : name ,conds : [like,thanh]},
     *      {filed_name : name ,conds : [is,thanh]},
     *      {filed_name : create_at ,conds : [between,01-01-2017,31-01-2017]}
     *
     * ]
     */

    function updateStatusBtnSaveFilter() {
        if ($('#container-filters').text().length == 0) {
            $('#btn-popup-filter').attr("disabled", true);
            if ($('#btn-popup-filter').hasClass('btn-default')) {
                $('#btn-popup-filter').removeClass('btn-default');
            }
            if ($('#btn-popup-filter').hasClass('btn-flat')) {
                $('#btn-popup-filter').removeClass('btn-flat');
            }
            if (!$('#btn-popup-filter').hasClass('btn-disable')) {
                $('#btn-popup-filter').addClass('btn-disable');
            }

        } else {
            $('#btn-popup-filter').attr("disabled", false);
            if (!$('#btn-popup-filter').hasClass('btn-default')) {
                $('#btn-popup-filter').addClass('btn-default');
            }
            if (!$('#btn-popup-filter').hasClass('btn-flat')) {
                $('#btn-popup-filter').addClass('btn-flat');
            }
            if ($('#btn-popup-filter').hasClass('btn-disable')) {
                $('#btn-popup-filter').removeClass('btn-disable');
            }
        }
    }

    function updateStatusBtnRemoFilter() {
        if (data_filter.filterId == 0) {
            $('#remove-filter').attr('disabled', true);
            if ($('#remove-filter').hasClass('btn-default')) {
                $('#remove-filter').removeClass('btn-default');
            }
            if ($('#remove-filter').hasClass('btn-flat')) {
                $('#remove-filter').removeClass('btn-flat');
            }
            if (!$('#remove-filter').hasClass('btn-disable')) {
                $('#remove-filter').addClass('btn-disable');
            }

        } else {
            $('#remove-filter').attr('disabled', false);
            if (!$('#remove-filter').hasClass('btn-default')) {
                $('#remove-filter').addClass('btn-default');
            }
            if (!$('#remove-filter').hasClass('btn-flat')) {
                $('#remove-filter').addClass('btn-flat');
            }
            if ($('#remove-filter').hasClass('btn-disable')) {
                $('#remove-filter').removeClass('btn-disable');
            }
        }
    }

    function searchAjax(searchOb) {
        var data = {
            itemFilters : data_filter.itemFilters ,
            searchText :$('#itemSearchName').val().trim()
        };
        console.log(data);
        var url = $('#btn-filter').data('href');
        $.ajax({
            type: "POST",
            url: url,
            async: false,
            data: data,
            success: function (response) {
                response = $.parseJSON(response);
                //render  table
                render(response.callBackTable, response.dataTables);

                //render nhãn lọc
                render(response.callBackTagFilter, data_filter.tagFilters);
                updateStatusBtnSaveFilter();
                updateStatusBtnRemoFilter();

                //render paginate
                $('#table-data').Paginate({
                    page: response.page,
                    pageSize: response.pageSize,
                    totalRow: response.totalRow
                });
            },
            error: function (response) {

            }
        });
    }

    function resetIndex() {
        $('#container-filters').find('.item').each(function (key, val) {
            $(this).attr('data-index', key + 1);
        });
    }

    // Đăng ký sự kiện khi remove nhãn lọc
    $('#container-filters').on('click', '.item  button.remove', function () {
        //lấy đối tượng li
        var parent_item = $(this).parents('.item');
        var index = $(parent_item).data('index');
        data_filter.itemFilters.splice(index - 1, 1);
        data_filter.tagFilters.splice(index - 1, 1);
        resetIndex();
        searchAjax();

    });
    if($('input.datepicker').length > 0){
        $('.datepicker').datepicker({
            format: 'dd/mm/yyyy',
            autoclose: true
        });
    }
    /*$('#timeStart').datepicker({
        showOn: 'focus',
        dateFormat: 'yy-mm-dd',
        timeFormat: 'hh:mm:ss',
        changeMonth: true,
        changeYear: true,
        onSelect: function(dateText,inst) {
            $('#timeEnd').datepicker('option','minDate',dateText);
        }
    });
    $('#timeEnd').datepicker({
        showOn: 'focus',
        dateFormat: 'yy-mm-dd',
        timeFormat: 'hh:mm:ss',
        changeMonth: true,
        changeYear: true
    });*/
    // sự kiện thay đổi field select ẩn tất cả các trường không tương ứng đi và show các trường tương úng lên
    $('#field_select').change(function () {
        var field = $(this).val();
        $('input.'+field).val('');
        $(this).find('option').each(function (keyO, valO) {
            var elementClass = '.' + $(valO).val();
            if (elementClass != '.') {
                if (!$(elementClass).hasClass('none-display')) {
                    $(elementClass).addClass('none-display');
                }
                if ($(elementClass).hasClass('block-display')) {
                    $(elementClass).removeClass('block-display');
                }
            }
        });

        $('.' + field).removeClass('none-display');
        $('.' + field).addClass('block-display');

    });

    $('select.group_date').change(function () {
        if ($(this).val() == 'between') {
            $('#timeStart').attr('placeholder', 'Nhập thời gian bắt đầu');
            $('#timeEnd').attr('placeholder', 'Nhập thời gian kết thúc');
            if ($('#timeEnd').hasClass('none-display')) {
                $('#timeEnd').removeClass('none-display');
            }
            $('#timeEnd').addClass('block-display');
        } else {
            $('#timeStart').attr('placeholder', 'Nhập thời gian');
            if ($('#timeEnd').hasClass('block-display')) {
                $('#timeEnd').removeClass('block-display');
            }
            $('#timeEnd').addClass('none-display');
        }

    });

    // đăng ký sự kiện khi thêm bộ lọc
    $('#btn-filter').click(function () {
        // tạo biến gen code html cho field
        //khởi tạo 1 đối tượng item filer
        var filter_ob = {};

        // lấy nhãn lọc
        var filed_name = $('#field_select').val();
        var text_field_name = $('#field_select').find('option:selected').text();

        // lấy tất cả các điều kiện lọc và giá trị của điều kiện lọc theo nhãn này
        var conds = [];

        //text_opertor  ví dụ : là ,trong khoảng ,trước, sau bằng ,.....
        var text_operator = '';
        var ob_text_operator = $('.' + filed_name).find('.text_opertor');

        if (typeof ob_text_operator != 'undefined ' && ob_text_operator.length > 0) {
            text_operator = " " + $(ob_text_operator).text();
        }
        //giá trị của value_operator khi có text operator ví dụ : là tương úng với is,= | trong khoảng tương ứng với betweet , in tùy ý rồi sang bên server xử lý sau
        var ob_value_operator = $('.' + filed_name).find('.value_operator');
        if (typeof ob_value_operator != 'undefined ' && ob_value_operator.length > 0) {
            var value_operator = $(ob_value_operator).val();
            conds.push(value_operator);
        }

        var text_cond_name = '';
        //push điều kiện lọc và giá trị vào mảng đồng thơi gen html cho nhãn lọc
        $('.' + filed_name).each(function (key, val) {
            //gen html cho filed
            if (val.tagName == 'INPUT') {
                conds.push($(val).val());
                text_cond_name += " " + $(val).val();
            } else if (val.tagName == 'SELECT') {
                conds.push($(val).val());
                text_cond_name += " " + $(val).find('option:selected').text();
            }

        });
        console.log(conds);
        //gắn các thuộc tính vào đối tượng item filter
        filter_ob.field_name = filed_name;
        filter_ob.conds = conds;
        filter_ob.tag = text_field_name + text_operator + text_cond_name;


        var replace = false;
        var matches = true;
        var val;
        var key;
        //kiểm tra item lọc này có trùng nhau không
        if (data_filter.itemFilters != null) {
            for (var i = 0; i < data_filter.itemFilters.length; i++) {
                val = data_filter.itemFilters[i];
                //nếu 2 nhãn lọc giống nhau
                if (filter_ob.field_name == val.field_name) {
                    var cond_matches = 0;
                    for (var cond = 0; cond < val.conds.length; cond++) {
                        if (val.conds[cond] == filter_ob.conds[cond]) {
                            cond_matches++
                        } else {
                            break;
                        }

                    }
                    if (cond_matches == val.conds.length) {
                        alert('Điều kiện lọc đã có');
                        return;
                    }

                    // nếu điều kiện lọc mà giống nhau thì nhãn này sẽ bị thay thế
                    if (val.conds[0] == filter_ob.conds[0]) {
                        replace = true;
                        key = i;
                    }
                }
            }

            if (replace) {
                for (var i = 1; i < val.conds.length; i++)
                    //thay thế đối tượng tronmang itemFilters
                    data_filter.itemFilters[key].conds[i] = filter_ob.conds[i];
                data_filter.tagFilters[key] = filter_ob.tag;
                searchAjax();

            } else {
                //thêm 1 đối item filter vào itemFilters
                data_filter.itemFilters.push(filter_ob);
                data_filter.tagFilters.push(filter_ob.tag);
                searchAjax();
            }
        }
    });


    //-------------------------------------------- Thiết kế việc lưu  bộ lọc --------------------------------///
    $.fn.ModalSaveFilter = function () {
        var root = this;
        var state = {
            name_new: true
        };

        var actions = {
            init: function () {
            },
            save: function () {
            }
        };
        actions.init = function () {
            $(root).on('click', '#ra-save-new-filter', function () {
                var input_name_new = $(root).find('#input-name-new');
                var input_name_exit = $(root).find('#input-name-exits');
                if ($(input_name_new).hasClass('none-display')) {
                    $(input_name_new).removeClass('none-display');
                }
                $(input_name_new).addClass('block-display');

                if ($(input_name_exit).hasClass('block-display')) {
                    $(input_name_exit).removeClass('block-display');
                }
                $(input_name_exit).addClass('none-display');
                state.name_new = true;
            });

            $(root).on('click', '#ra-save-exits-filter', function () {
                var input_name_new = $(root).find('#input-name-new');
                var input_name_exit = $(root).find('#input-name-exits');
                if ($(input_name_new).hasClass('block-display')) {
                    $(input_name_new).removeClass('block-display');
                }
                $(input_name_new).addClass('none-display');

                if ($(input_name_exit).hasClass('none-display')) {
                    $(input_name_exit).removeClass('none-display');
                }
                $(input_name_exit).addClass('block-display');
                state.name_new = false;
            });
            $(root).find('#btn-save-filter').click(function () {
                actions.save();
            });
        };

        actions.save = function () {
            var filter_id_or_name = '';
            var option = '';
            if (state.name_new) {
                filter_id_or_name = $(root).find('#new-save-name').val();
                option = 'new';
                if (filter_id_or_name.length == 0) {
                    alert('Vui lòng nhập tên');
                    return;
                }
            } else {
                filter_id_or_name = $(root).find('#filter_list_name').val();
                option = 'exits';
                if (filter_id_or_name.length == '') {
                    alert('Vui lòng chọn tên muốn ghi đè');
                    return;
                }
            }
            $.ajax({
                type: "POST",
                url: $(root).find('#btn-save-filter').data('url'),
                async: false,
                data: {
                    itemFilters: JSON.stringify(data_filter.itemFilters),
                    tagFilters: JSON.stringify(data_filter.tagFilters),
                    itemType: $(root).find('#item-type').val(),
                    filterIdOrName: filter_id_or_name,
                    option: option
                },
                success: function (response) {
                    response = JSON.parse(response);
                    if (response.status == 'er') {
                        alert('Có lỗi xảy ra');
                        return;
                    }
                    alert('Lưu thành công !');
                    document.location.href = $('#urlIndex').val();
                },
                error: function (response) {

                }
            });

        };
        actions.init();
        return root;
    };

    $('#save-filter').ModalSaveFilter();
    //--------------------------------- Thiết kế xóa bộ lọc --------------------------//

    function deleteFilter() {
        $.ajax({
            type: "POST",
            url: 'filter/delete',
            async: false,
            data: {
                filterId: data_filter.filterId
            },
            success: function (response) {
                response = $.parseJSON(response);
                if (response.status == 'er') {
                    alert('Xóa bộ lọc không thành công !');
                    return;
                }
                alert('Xóa bộ lọc thành công !');
                document.location.href = $('#urlindex');
            },
            error: function (response) {

            }
        });
    }

    $('#remove-filter').click(function () {
        var del = confirm('Bạn có chắc muốn xóa bộ lọc này !');
        if (del)
            deleteFilter();
    });


    //--------------- Thiết kế data chuyển tab bộ lọc -------------------------------//
    function loadTabAjax() {
        //xóa tab search đi nếu có
        var tab_search = $('#ulFilter').find('li#tab_search');
        if(tab_search.length > 0){
            $(tab_search).remove();
        }
        $('#itemSearchName').val('');
        $.ajax({
            type: "POST",
            url: $('#urlLoadTab').val(),
            async: false,
            data: {
                filterId: data_filter.filterId
            },
            success: function (response) {
                response = $.parseJSON(response);
                console.log(response);
                //render  table
                render(response.callBackTable, response.dataTables);

                //render nhãn lọc
                data_filter.itemFilters = response.itemFilters == null ? [] : response.itemFilters;
                data_filter.tagFilters = response.tagFilters == null ? [] : response.tagFilters;
                render(response.callBackTagFilter, data_filter.tagFilters);
                updateStatusBtnSaveFilter();
                updateStatusBtnRemoFilter();
                //render paginate
                $('#table-data').Paginate({
                    page: response.page,
                    pageSize: response.pageSize,
                    totalRow: response.totalRow
                });
            },
            error: function (response) {

            }
        });
    }

    $('#ulFilter').find('li a').click(function () {
        var filterId = $(this).data('id');
        data_filter.filterId = filterId;
        data_filter.tagFilters = [];
        data_filter.itemFilters = [];
        loadTabAjax();
    });
    // --------------------------- Thiết kế search ------------------------------- //
    var statusSearch = null;
    $('#itemSearchName').keydown(function () {

        var tab_search = $('#ulFilter').find('li#tab_search');
        //thêm tab search khi thực hiện việc search nếu chưa có thì thêm mới vào
        if(tab_search.length == 0){
            $('#ulFilter').find('li.active').removeClass('active');
            data_filter.itemFilters = [];
            data_filter.tagFilters = [];
            var html= '<li id="tab_search" class="active"><a href="javascript:;" data-id="-1" data-toggle="tab" aria-expanded="true">Tùy chọn</li>';
            $('#ulFilter').append(html);
        }

        if (statusSearch != null) {
            clearTimeout(statusSearch);
            statusSearch = null;
        }

    });

    $('#itemSearchName').keyup(function () {
        if (statusSearch == null) {
            statusSearch = setTimeout(function () {
                searchAjax();
            }, 500);
        }
    });


//vì mỗi table lại có kiểu gen html khác nhau nên không thể gôp chung lại được
//call_back là 1 tên của funtion thực hiện việc render html cho table bằng dữ liệu data_table
//call_back được gửi xuống từ server khi thực hiện ajax nên call_back phải được định nghĩa global bên js trước khi server trả xuống

}

//data table paginate
$.fn.Paginate = function (opt) {
    var root = this;
    var conf = $.extend({pageShow: 11, page: 1, pageSize: 1, totalRow: 11}, opt);
    var actions = {
        init: function () {

        },
        render: function () {
        },
        event: function () {
        }
    };

    actions.init = function () {
        conf.page = parseInt(conf.page);
        conf.pageShow = parseInt(conf.pageShow);
        conf.pageSize = parseInt(conf.pageSize);
        conf.totalRow = parseInt(conf.totalRow);
    };

    actions.render = function () {
        if (conf.pageSize == 1) {
            $(root).find('.paginate_table').html('');
            return false;
        }
        var html = "{total_rows}{first_page}{prev_page}{pages}{next_page}{last_page}";
        var total_rows = '<li class="total-row"><strong> ' + conf.totalRow + '</strong> Bản ghi </li>';
        var first_page = '<li><a class="{option} first-page" data-page="1" href="javascript:;"> «« </a></li>';
        var last_page = '<li><a class="{option} last-page" data-page="' + conf.pageSize + '" href="javascript:;"> »» </a></li>';
        var prev_page = '<li><a class="{option}" data-page="' + (conf.page - 1 > 0 ? conf.page - 1 : 1 ) + '" href="javascript:;"> « </a></li>';
        var next_page = '<li><a class="{option}" data-page="' + (conf.page + 1 < conf.pageSize ? conf.page + 1 : conf.pageSize ) + '" href="javascript:;"> » </a></li>';
        var start_page = 1;
        var end_page = 1;
        var offset = Math.floor(conf.pageShow / 2);

        if (conf.pageSize <= conf.pageShow) {
            start_page = 1;
            end_page = conf.pageSize;

            html = html.replace(/\{[a-z_]{6,}\}|/img, '');

        } else {

            // page ở khoảng giữa
            if (conf.page > offset && conf.pageSize > conf.page + offset) {
                start_page = conf.page - offset;
                end_page = conf.page + offset;

                // page ở cuối
            } else if (conf.page == conf.pageSize) {

                start_page = conf.pageSize - conf.pageShow + 1;
                end_page = conf.pageSize;

                next_page = next_page.replace('{option}', ' disable');
                last_page = last_page.replace('{option}', ' disable');
                //page ở đầu
            } else if (conf.page === 1) {
                start_page = 1;
                end_page = conf.pageShow;

                first_page = first_page.replace('{option}', ' disable');
                prev_page = prev_page.replace('{option}', ' disable');

                //page nhỏ hơn số hiển thị
            } else if (conf.page <= conf.pageShow) {
                start_page = 1;
                end_page = conf.pageShow;

                //page lớn hơn số hiển thị conf.page > conf.pageShow
            } else {
                start_page = conf.pageSize - conf.pageShow + 1;
                end_page = conf.pageSize;
            }


            next_page = next_page.replace('{option}', '');
            last_page = last_page.replace('{option}', '');
            prev_page = prev_page.replace('{option}', '');
            first_page = first_page.replace('{option}', '');

        }
        var pages = "";
        for (var page = start_page; page <= end_page; page++) {
            var row = '<li>';
            row += '<a class="{option}" data-page="' + page + '" href="javascript:;">' + page + '</a>'
            row += '</li>';
            if (page == conf.page)
                row = row.replace('{option}', 'active disable none-event');
            else
                row = row.replace('{option}', '');
            pages += row;
        }
        console.log(html);
        html = '<ul>' + html;
        html = html.replace('{total_rows}', total_rows).replace('{pages}', pages).replace('{first_page}', first_page).replace('{prev_page}', prev_page).replace('{next_page}', next_page).replace('{last_page}', last_page);
        html += '</ul>';
        $(root).find('.paginate_table').html(html);
    };
    actions.event = function () {
        // bắt sự kiện chuyển trang của table khi phân trang
        $(root).on('click', '.paginate_table a', function (e) {
            var data ={
                itemFilters : data_filter.itemFilters,
                page : data_filter.page,
                searchText : $('#itemSearchName').val().trim()
            };
            var active_event = $(this).attr('class').indexOf('disable') > -1 ? false : true;
            if (active_event) {
                var url = $('#btn-filter').data('href');
                var page = $(this).data('page');
                data_filter.page = page;
                $.ajax({
                    type: "POST",
                    url: url,
                    async: false,
                    data: data,
                    success: function (response) {
                        console.log(data_filter.itemFilters);
                        response = $.parseJSON(response);
                        //render  table
                        render(response.callBackTable, response.dataTables);


                        //render paginate table
                        conf.page = parseInt(response.page);
                        conf.pageSize = parseInt(response.pageSize);
                        conf.totalRow = parseInt(response.totalRow);
                        actions.render();
                    },
                    error: function (response) {

                    }
                });
            }
        });

    };
    actions.init();
    actions.render();
    actions.event();

    return root;
};

function formatNumber(number) {
    number = number.split('').reverse().join('');
    number = number.replace(/(\d{3})/igm, '$1,');
    if (number[number.length - 1] == ',') number = number.substr(0, number.length - 1);
    return number.split('').reverse().join('');
}

function wordLimit(content, limit) {
    limit = parseInt(limit) > 0 ? limit : 20;

    content = content.replace('/\s+/igm', ' ').trim(' ');
    var words = content.split(' ');
    return words.length > limit ? words.slice(0, limit).join(' ') + "..." : content;

}

function renderTagFilter(data) {
    var html = '';
    for (var i = 0; i < data.length; i++) {
        var html_field = '<li class="item" data-index="' + (i + 1) + '">'
            + '<button class="btn btn-field">' + data[i] + '</button>'
            + '<button class="btn remove">'
            + '<i class="fa fa-times font-size-12px type-subdued "></i>'
            + '</button >'
            + '</li>';
        html += html_field;
    }
    $('#container-filters').html(html);

}
function render(call_back, data) {
    window[call_back](data);
}