<div class="panel-group">
{{--  @if(count($shipping)==1) 
 	@if($shipping->fldShippingName=="UPS") 
       @include('home.ups')    	        
   @elseif($shipping->fldShippingName=="Fedex") 
       @include('home.fedex')    	
   @elseif($shipping->fldShippingName=="USPS")                          
       @include('home.usps')
   @endif 
 @else 
     @foreach($shipping as $shippings) 	
        @if($shippings->fldShippingName=="UPS") 
            @include('home.ups')    	        
        @endif    
        @if($shippings->fldShippingName=="Fedex") 
            @include('home.fedex')    	
        @endif    
        @if($shippings->fldShippingName=="USPS") 
            @include('home.usps')
        @endif    
      @endforeach  	
 @endif       --}}

 @include('home.shipping_api')
</div>


<script language="javascript">
 $(document).ready(function() {
	$('input:radio[name=shipping_rate_value]').click(function() {
		  var val = $('input:radio[name=shipping_rate_value]:checked').val();
		  $("#shipping_rate_val").val(val);
		  shippingValue = val.split(';');
		  $("#shipping_name_value").html(shippingValue[0]).text();
		  $("#shipping_price_value").text("$ "+parseFloat(shippingValue[1]).toFixed(2));
		  shipping_amount = Number(shippingValue[1]);
		  total = Number($("#total").val());		 
		  grandtotal = shipping_amount + total;
		  $("#Grandtotal").text("$ "+Number(parseFloat(grandtotal).toFixed(2)).toLocaleString('en'));		  		  		  
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