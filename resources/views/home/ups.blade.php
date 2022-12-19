<? 
	$value  = "";
	require_once("public/shipping/ups/src_ups_rates.class.php"); 
		$shippingInfo = App\Models\UPS::getInfo();		
	    $ups_xml_access_key = $shippingInfo->fldUPSXmlAccessKey;
		$ups_userid = $shippingInfo->fldUPSUserID;
		$ups_password= $shippingInfo->fldUPSPassword;
		
		$shipper_city = $shippingInfo->fldUPSCity;
		$shipper_state = $shippingInfo->fldUPSState;
		$shipper_zip = $shippingInfo->fldUPSZip;
		$shipper_country = "US";
		
		$ship4om_city = $shippingInfo->fldUPSCity;
		$ship4om_state = $shippingInfo->fldUPSState;
		$ship4om_zip = $shippingInfo->fldUPSZip;
		$ship4om_country = "US";
		
		$tocity = $values['city'];
		$tostate = $values['state'];
		$tozip = $values['zip'];
		$tocountry = $values['country'];
		
		
		
        $MyUPS= new ups();
        $MyUPS->setCurlVerifyCert(false); 			#Do not use SSL Certificates
        $MyUPS->SetAccountInfo($ups_xml_access_key,$ups_userid,$ups_password);
        $MyUPS->SetPickupType(01); 				#Set daily-pickup
        $MyUPS->SetShipper($shipper_city,
                           $shipper_state,
                           $shipper_zip,
                           $shipper_country);
    
        $MyUPS->SetShipFrom(
                           $ship4om_city,
                           $ship4om_state,
                           $ship4om_zip,
                           $ship4om_country);

        $MyUPS->SetShipTo(  addslashes(trim($tocity)),
                            addslashes(trim($tostate)),
                            addslashes(trim($tozip)),
                            addslashes(trim($tocountry)),
                            $residental = true);
		
	$weight = $values['weight'];
	$price  = $values['total'];

	$added_handling_price = 10;
	
        $MyUPS->AddPackage('02','My Sample Package',$weight,$price,'LBS','USD');
        $MyUPS->ModeRateShop();
		
        if($tocountry == "US") { 
	        $MyUPS->SetRateListLimit('01','02','12','03');
		} else {
			$MyUPS->SetRateListLimit('11','07','08','65');
		}
		
        $MyUPS->GetRateListShort($added_handling_price);  # + 10$
		
		if($tocountry == "US") { 
			$arr_shippings = array(                           #Result Array
			'Next Day Air' => $MyUPS->ModeGetRate('01'),
			'2nd Day Air'  => $MyUPS->ModeGetRate('02'),
			'3-Day Select'  => $MyUPS->ModeGetRate('12'),			
			'Ground'       => $MyUPS->ModeGetRate('03'));
		} else {
		        $arr_shippings = array(                           #Result Array
				'Standard'  => $MyUPS->ModeGetRate('11'),
				'Worldwide Express'  => $MyUPS->ModeGetRate('07'),
				'Worldwide Expendited'  => $MyUPS->ModeGetRate('08'),
				'Express Saver'  => $MyUPS->ModeGetRate('65'));
		}
        $connecterr = 0 ;                     
        $ratesselect = false;
        if($ratesselect == false){$connecterr = 1;}   #ERROR CONNECTING TO UPS SERVICE
				
?>


	    <div class="uk-accordion" data-uk-accordion>
	    	<h3 class="uk-accordion-title">UPS</h3>

    		<div class="uk-accordion-content">
			
					    <table border="0" width="auto" class="uk-table shippingRate">
						  <? foreach($arr_shippings as $key => $val) { 
                                $shipping_name_value = $key;
                                $shipping_price_value = $val;
                          ?>
                            <tr>
                                <td><input type="radio" value="<?=$key?>;<?=$val?>" name="shipping_rate_value" id="shipping_rate_value"> <?=$key?></td>
                                <td>$<?=number_format($val,2)?></td>
                            </tr>   
                         <? } ?>   
                        </table>
                       
    
  			</div>
  	</div>