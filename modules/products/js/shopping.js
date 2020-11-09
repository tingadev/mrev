
function checkForm(mess,type_method='normal')
{
    ok_send = 1;
    var name = $("#name").val();
    if(name == ""){
        $("#name").focus();
        $.alert({
                        icon: 'fal fa-exclamation-triangle',
                        title: js_lang['annouce'],
                        content: js_lang['info_name_empty'],
                        buttons:{
                            OK:{
                                btnClass: 'btn-blue',
                            }
                            
                        }

                    });
        ok_send = 0;
        return false;
        
    }
    var phone = $("#phone").val();
    if (phone == '') {
            $("#phone").focus();
            $.alert({
                icon: 'fal fa-exclamation-triangle',
                title: js_lang['annouce'],
                content: js_lang['info_phone_empty'],
            });
            
            ok_send = 0;
            return false;

        }
    var femail = $("#email").val();
    if (femail == '') {
            $("#femail").focus();
            $.alert({
                icon: 'fal fa-exclamation-triangle',
                title: js_lang['annouce'],
                content: js_lang['info_mail_empty'],
            });
            
            ok_send = 0;
            return false;

        }
    var reg = /^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/;
    if (reg.test(femail) == false){
        $("#femail").focus();
        $.alert({
                icon: 'fal fa-exclamation-triangle',
                title: js_lang['annouce'],
                content: js_lang['info_mail_err'],
            });
            ok_send = 0;
            return false;
    } 
    var address = $("#address").val();
    if (address == '') {
            $("#address").focus();
            $.alert({
                icon: 'fal fa-exclamation-triangle',
                title: js_lang['annouce'],
                content: js_lang['info_address_empty'],
            });
            
            ok_send = 0;
            return false;

        }
        if(type_method == 'normal'){
            if(ok_send==1){
                processing_bill(mess);
            }
        }
        
    $('#val_paypal').val(1)
                 .trigger('change');
    return true;
}

function changeQuantity(obj,type,id_cart,price,lang)
    {
        
        var cur_quantity    =   parseInt( $("#"+obj).val() );

        if( type=="decrease" ) {
            if(cur_quantity>1){
                $("#"+obj).val(cur_quantity-1);
            }
        }else{
            $("#"+obj).val(cur_quantity+1);
        }

        if(id_cart>0){
            updateQuantity(id_cart,price,lang);
        }
    }

function updateQuantity(id,price,lang)
{
    var quantity    =   parseInt( $("#quantity_"+id).val() );
    if( $.isNumeric( quantity ) ) {
        
        if(quantity < 1){
            $("#quantity_"+id).val(1);
        }
        
        else{
            var mydata = 'id='+id+'&quantity='+quantity+'&price='+price+'&lang='+lang;
            $.ajax({
                async: true,
                dataType: 'json',
                url : "ajax_html.php?ajax=update_cart",
                type: 'POST',
                data: mydata ,
                success: function (data) {
                    $("#ext_total_"+id).html(data.price_this);
                    $("#ext_total_price").html(data.totals);
                    $("#ext_numcart").html(data.quantity);

                    

                }
            });
        }

    }
    else{

            $("#quantity_"+id).val(1);
        
    }
}
function deleteItem(id,size,color)
{

            var mydata = 'id='+id+'&size='+size+'&color='+color;
            $.ajax({
                async: true,
                dataType: 'json',
                url : "ajax_html.php?ajax=delete_cart",
                type: 'POST',
                data: mydata ,
                success: function (data) {
                    if(data.ok == 1){
                        location.reload();
                    }

                }
            });
        
    
}
function cityChange(city_value,state)
{
    var mydata =  "city="+city_value+"&state_name="+state ;
    $.ajax({
        async: true,
        dataType: 'text',
        url : "ajax_html.php?ajax=option_state",
        type: 'POST',
        data: mydata ,
        success: function (html) {
            $("#district").html(html) ;
        }
    });
}
function stateChange(city_value,name)
{
    var state = $("#country").val();
    var mydata =  "city="+state+"&state_name="+name+"&state="+city_value ;
    $.ajax({
        async: true,
        dataType: 'text',
        url : "ajax_html.php?ajax=option_ward",
        type: 'POST',
        data: mydata ,
        success: function (html) {
            $("#ward").html(html) ;
        }
    });
}
function processing_bill(mess){
    $.alert({
                icon: 'fa fa-spinner fa-spin',
                title: 'Processing',
                content: mess,
                buttons:{
                        OK:{
                            isHidden: true,
                        }
                        
                }
                
            });
}

function addShippingFee(ele){
    $('.wraspMethod .form-group .checkShip').checked = false
    ele.checked = true;
    old_total = parseFloat($('#non_ship_total').val())
    if(ele.checked){
        fee = parseFloat(ele.value)
        new_total = old_total + fee
        $('input[name=totals_price_sum]').val(new_total)
        $('#total_en').html(new_total)
        $('#shipping_fee_js').html(fee+ ' USD')
        js_lang['amountTotal'] = new_total
    }
}