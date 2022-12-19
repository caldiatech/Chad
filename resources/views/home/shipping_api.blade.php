<? 
    $shipping = App\Models\GraphikDimension::displayShippingMethod($value);
    // echo '<pre>';
    // print_r($value);
    // $arr_shippings = array();
    // foreach($shipping->shippingData->shippingCostDatas as $shippingCost) {
    //    //echo $shippingCost->methodName . ' ' . $shippingCost->price . "<br>";
    //    $arr_shippings[] = array($shippingCost->methodName => $shippingCost->price);
    // }


    // print_r($arr_shippings);
    // die();
    // foreach($shipping->shippingData->['shippingCostDatas'] as $shippingCost) {
    //    echo $shippingCost['methodName'] . ' ' . $shippingCost['price'] . "<br>";
    //  }
  
?>


	    <div class="uk-accordion" data-uk-accordion>
	    	<h3 class="uk-accordion-title"></h3>

    		<div class="uk-accordion-content">
			
		    <table border="0" width="auto" class="uk-table shippingRate">
			@foreach($shipping->shippingData->shippingCostDatas as $s_key => $shippingCost) 
                <?
                if (isset($shippingCost->methodName)) { 
                    // echo 'multiple rates <br>'; 
                    ?>
                    <tr>
                        <td><input type="radio" value="{{ $shippingCost->methodName }};{{ $shippingCost->price }}" 
                                name="shipping_rate_value" id="shipping_rate_value{{$s_key}}"> 
                            <label for="shipping_rate_value{{$s_key}}">{{ $shippingCost->methodName }}</label></td>
                        <td>${{ number_format($shippingCost->price,2) }}</td>
                    </tr>   
                    <?
                } else {
                    // echo 'single rate <br>'; 
                    // echo '<pre>';
                    // print_r($shipping->shippingData->shippingCostDatas->methodCode);
                    ?>
                    <tr>
                        <td><input type="radio" value="{{ $shipping->shippingData->shippingCostDatas->methodName }};{{ $shipping->shippingData->shippingCostDatas->price }}" 
                                name="shipping_rate_value" id="shipping_rate_value0"> 
                            <label for="shipping_rate_value0">{{ $shipping->shippingData->shippingCostDatas->methodName }}</label></td>
                        <td>${{ number_format($shipping->shippingData->shippingCostDatas->price,2) }}</td>
                    </tr>   
                    <?
                    break;
                    // echo '<pre>';
                    // print_r($shippingCost);
                    // echo '<br>---------<br>';
                }
                // echo 'key: '.$s_key.' | cost: '.$shippingCost.'<br>';
                ?>


           @endforeach    
            </table>
                       
    
  			</div>
  	</div>