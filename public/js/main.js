$(document).ready(function(){
    $(".select").selectpicker();
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    search_ts();
    search_baocao();
    $('.select').click(function(){
        search_ts();
    });


});

function search_ts(){
    var text=$('#search').val();
    var seleted = $('#loaits option:selected').val();
    $.ajax({
        
        url:'/search',
        method:"post",
        data:{
            text:text,
            seleted:seleted,
        },
        success: function(data){
            $('#list_taisan').html(data);
        }
    });
}


//check input rỗng
function check(id) {
    var lop = '';
    var end = id.search("_lb");
    if (end > 0) {
        var t = id.slice(end + 1);

    } else {
        var t = id.slice(1);
    }

    if (end == -1) {

        var dk = id.slice(1);
        lop = id;

    } else {

        var dk = id.slice(1, end);
        lop = id.slice(0, end);
    }
    var val = $(id).text();
    val = val.toLowerCase().replaceAll(":", "");
    switch (t) {
        case 'lb': text = 'nhập ' + val;
            break;
        case 'file_temp': text = 'chọn file';
            break;
        case 'name': text ='nhập tên đăng nhập';
            break;
        case 'pass': text ='nhập mật khẩu';
            break;

    }

    if ($(lop).val() == "") {
        $(lop).addClass('error_input');
        $("." + dk + "_icon").css("display", "block");
        $(".error_" + dk).text("Vui lòng  " + text);
        $(".error_" + dk).css("display", "block");
        return "false";
    } else {
        $(lop).removeClass('error_input');
        $("." + dk + "_icon").css("display", "none");
        $(".error_" + dk).css("display", "none");
        return "true";
    }
}

// kiểm tra file
function readURL(input, id_img) {
    var file = input.files;
    var id = id_img.slice(1);
    var match = ["application/vnd.openxmlformats-officedocument.wordprocessingml.document"];  
    if (file.length > 0 && file != "") {
        var files = $(id_img).prop('files')[0];
        var type = files.type;
        $('.text_name_file').text(files.name);
        if (type == match[0] || type == match[1] ) {
            $('.'+id+"_icon").css('display','none');
            $(".error_" + id).text('');
        } else {
            $(".error_" + id).text('Không phải file word');
            $('.'+id+"_icon").css('display','block');
        }
    } else {
        $(".error_" + id).text('Vui lòng chọn file');
        $(".error_" + id).css("display", 'block');
        $('.text_name_file').text('');
        $('.'+id+"_icon").css('display','block');
    }

}

function check_insertFile(){
    check('.mota_lb');
    if(check('.title_lb') =='true' && check('#file_temp')=='true' && check('.mota_lb')=='true')
        return true;
    return false;
}

function search_baocao(){
    var text = $("#search_baocao").val();
    $.ajax({
        url:'/maubaocao/search',
        method: 'post',
        data:{text:text},
        success: function(data){
            $('#list_baocao').html(data);
        }
    });
}

function checklogin(){
    var name = $('#name').val();
    var pass = $('.pass').val();
    var kq = false;
    if(check('#name')=='true' &&check('.pass')=='true'){
        ;
        $.ajax({
            url:'/check',
            method: 'post',
            data:{name:name,pass:pass},
            dataType: 'json',
            async: false,
            success:function(data){
                if(data[0]=='false'){
                    $(".error_name").text('Tên đăng nhập không tồn tại');
                    $(".error_name").css("display", 'block');
                    $(".name_icon").css('display','block');
                }else{
                    $(".error_name").text('');
                    $(".error_name").css("display", 'none');
                    $(".name_icon").css('display','none');
                }
                if(data[1]=='false'){
                    $(".error_pass").text('Mật khẩu không đúng');
                    $(".error_pass").css("display", 'block');
                    $(".pass_icon").css('display','block');
                }else{
                    $(".error_pass").text('');
                    $(".error_pass").css("display", 'none');
                    $(".pass_icon").css('display','none');
                }
                if(data[0]=='true'&& data[1]=='true'){
                    kq= true;
                }
                
            }
        });
    }else{
        check('#name');
        check('.pass');
    }
    return kq;
}