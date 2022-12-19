<div class="panel-group">
    @include('home.shipping_api')
</div>


<script language="javascript">
 $(document).ready(function() {
 	sub_total = $("#total").val();  
    grand_total = $("#grand_total").val();    
    
    discount_amount = 0;            
    if($('#coupon_price').val() != ''){
      discount_amount = parseFloat($('#coupon_price').val()); 
    }
    discounted_total = parseFloat(sub_total) - discount_amount;  
    tax_total = parseFloat($("#taxvalue").val());    
    console.log('tax_total');
    console.log(tax_total);

	$('input:radio[name=shipping_rate_value]').click(function() {
		  var val = $('input:radio[name=shipping_rate_value]:checked').val();
		  $("#shipping_rate_val").val(val);
		  shippingValue = val.split(';');
		  $("#shipping_name_value").html(shippingValue[0]).text();
		  $("#shipping_price_value").text("$ "+parseFloat(shippingValue[1]).toFixed(2));
		  shipping_amount = Number(shippingValue[1]);
		  	
            /*grand_total =  P * (1 - d/100) + Tax total + s*/
            grand_total =  discounted_total + tax_total + shipping_amount;
            console.log('grand_total =  discounted_total + tax_total + shipping_amount');
            console.log(grand_total);
            grand_total = parseFloat(grand_total).toFixed(2);
            $("#Grandtotal").text("$ "+Number(grand_total).toLocaleString('en'));            
            $("#grand_total").val(grand_total);
		});
		
		$('#submit_bill').click(function(){
        // at the beginning, set IsSelected to false
        var isSelected = false;
        var value = '';

						
        if($('input[name="shipping_rate_value"]:checked').val())
          {
            isSelected = true;
            value = $(this).attr('value');
						
          }                        

					
          if(!isSelected) {
						 alert('Please select your shipping rate')
						 return false;
					} else {
						return true;
					}


                    //prevent form from submiting
                    
     })
				
			
			
		
	
});	
	
</script>