$(document).ready(function(){


  $('#selectAllBoxes').click(function(){
        if(this.checked){
            
              $('.checkBoxes').each(function(){
            
            this.checked=true;
            
        });
        }else{
            
            
              $('.checkBoxes').each(function(){
            
            this.checked=false;
                   });
        }
        
      
    });

	
});

function changePayment(value){

    var res = 'search_payment='+value+'&';
    $('#payment_t').val(res);
    changeForm();
    
}
function changeProcess(value){

    var res = 'search_process='+value+'&';
    $('#process_t').val(res);
    changeForm();
    
}
function changeType(value){

    var res = 'type_keyword='+value+'&';
    $('#type_t').val(res);
    changeForm();
    
}
function changeKeywords(value){

    var res = 'keywords='+value+'&';
    $('#keywords_t').val(res);
    changeForm();
    
}
function changeForm(){
  var value_a = 'modules/order/order.php?';
  var value_b = $('#payment_t').val() + $('#process_t').val() + $('#type_t').val() + $('#keywords_t').val();
  document.getElementById('formMain').action = value_a + value_b;
}


function changeType_P(value){

    var res = 'cat_id='+value+'&';
    $('#type_t').val(res);
    changeForm_P();
    
}
function changeKeywords_P(value){

    var res = 'keywords='+value+'&';
    $('#keywords_t').val(res);
    changeForm_P();
    
}
function changeForm_P(){
  var value_a = 'modules/products/products.php?mod=products&';
  var value_b = $('#type_t').val() + $('#keywords_t').val();
  document.getElementById('formMain').action = value_a + value_b;
}


