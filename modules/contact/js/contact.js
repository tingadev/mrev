

/* Init */
$(document).ready(function () {
    $(".view_map").click(function () {
        $('html, body').animate({
            scrollTop: $("#viewmap").offset().top - 200,
        }, 1000);
    });
});

function sendMail_Contact(){

    var name = $("#name").val();
    if(name == ""){
    	$("#name").focus();
    	$.alert({
                        icon: 'fas fa-warning',
                        title: 'Thông báo',
                        content: 'Vui lòng nhập họ tên',
                        buttons:{
                            OK:{
                                btnClass: 'btn-blue',
                            }
                            
                        }

                    });

    	return false;
    	
    }
    var femail = $("#email").val();
    if (femail == '') {
            $("#femail").focus();
            $.alert({
                icon: 'fas fa-warning',
                title: 'Thông báo',
                content: 'Vui lòng nhập email',
            });
            
            ok_send = 0;
            return false;

        }
    var reg = /^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/;
  	if (reg.test(femail) == false){
  		$("#femail").focus();
  		$.alert({
                icon: 'fal fa-exclamation-triangle',
                title: 'Thông báo',
                content: 'Email không hợp lệ',
            });
         	ok_send = 0;
            return false;
  	} 
    var address = $("#address").val();
    var phone = $("#phone").val();
    if (phone == '') {
            $("#phone").focus();
            $.alert({
                icon: 'fas fa-warning',
                title: 'Thông báo',
                content: 'Vui lòng nhập số điện thoại',
            });
            
			ok_send = 0;
            return false;

        }
    var content = $("#content").val()
    var title = $("#title").val();

    var ok_send = 1;
    var before = $.alert({
                    icon: 'fa fa-spinner fa-spin',
                    title: 'Sending',
                    content: 'Thư của bạn đang được xử lý, xin đợi trong giây lát!',
                    buttons:{
                            OK:{
                                isHidden: true,
                            }
                            
                    },
                    lazyOpen: true,
                });
    if (ok_send){
        var mydata =  "email="+femail+"&name="+name+"&address="+address+"&phone="+phone+"&content="+content+"&title="+title;
        $.ajax({
            async: true,
            dataType: 'json',
            url : "sendMail.php",  
            type: 'POST',
            data: mydata ,
            headers: {
            'X-Requested-With': 'XMLHttpRequest'
            },
            beforeSend: function(){
                before.open();
            },
            success: function (response) {
                before.close();
                if(response.ok == 1){
                    $.alert({
                        icon: 'fa fa-check',
                        title: 'Thông báo',
                        content: response.success,
                        buttons:{
                            OK:{
                                btnClass: 'btn-blue',
                            }
                            
                        }
                    });
                }
                else{
                    $.alert({
                        icon: 'fa fa-exclamation-triangle',
                        title: 'Thông báo',
                        content: response.err,
                        buttons:{
                            OK:{
                                btnClass: 'btn-red',
                            }
                            
                        }
                    });
                }
            
            }
        }) ;
    }
                return false;                             
}
                                  