<? 
	$shipping = App\Models\GraphikDimension::displayShippingMethod($value);
  //print_r($shipping);die();
  // $arr_shippings = array();
  // foreach($shipping->shippingData->shippingCostDatas as $shippingCost) {
  //    //echo $shippingCost->methodName . ' ' . $shippingCost->price . "<br>";
  //    $arr_shippings[] = array($shippingCost->methodName => $shippingCost->price);
  // }


  // print_r($arr_shippings);
//die();
	// foreach($shipping->shippingData->['shippingCostDatas'] as $shippingCost) {
 //    echo $shippingCost['methodName'] . ' ' . $shippingCost['price'] . "<br>";
 //  }
  
?>


	    <div class="uk-accordion" data-uk-accordion>
	    	<h3 class="uk-accordion-title"></h3>

    		<div class="uk-accordion-content">
			
					    <table border="0" width="auto" class="uk-table shippingRate">
						           @foreach($shipping->shippingData->shippingCostDatas as $shippingCost) 
                            <tr>
                                <td><input type="radio" value="{{ $shippingCost->methodName }};{{ $shippingCost->price }}" name="shipping_rate_value" id="shipping_rate_value"> {{ $shippingCost->methodName }}</td>
                                <td>${{ number_format($shippingCost->price,2) }}</td>
                            </tr>   
                       @endforeach    
             </table>
                       
    
  			</div>
  	</div>