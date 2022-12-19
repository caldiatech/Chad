<?php
 
namespace App\Models;

use Illuminate\Database\Eloquent\Model as Eloquent;

use View;
use Input;
use Hash;
use Redirect;
use Session;
use Validator;
use SoapClient;


class GraphikDimension extends Eloquent
{
     

	public static function displayAll($type=0) //display all records
    {       
			
		$wsdl = "https://ifs.graphikservices.com/services/catalogService?wsdl";
		$options = array(
		  "userId" => "1000502576",
		  "detailLevel" => 1,
		  "trace"=>true
		);
		$client = new SoapClient($wsdl, $options);
		if($type==0):
			$response = $client->__soapCall("getAllProducts", array($options));
		elseif ($type==1): //display all frames
			$response = $client->__soapCall("getAllFrames", array($options));
		elseif ($type==2): //display all mats
			$response = $client->__soapCall("getAllMats", array($options));			
		elseif ($type==3): //display all glazing
			$response = $client->__soapCall("getAllGlazings", array($options));
                elseif ($type==4):
			$response = $client->__soapCall("getAllPapers", array($options));
		elseif ($type==5):
			$response = $client->__soapCall("getAllCanvases", array($options));				
		endif;	
	
		return $response;
    }

	
public static function getFramePricing($imageName, $imageURL,$height,$width,$paper,$frame,$finishKit,$mat1,$topBorder,$bottomBorder,$rightBorder,$leftBorder,$mat2,$offset) {

    	$height = $height == 0 ? 25.62 : $height;
    	$width = $width == 0 ? 15.62 : $width;
    	$paper = $paper == "" ? "PAPER7" : $paper;
    	$frame = $frame == "" ? "HP4" : $frame;
    	$finishKit = $finishKit == "" ? "CAHF" : $finishKit;
    	$mat1 = $mat1 == "" ? "PM918" : $mat1;
    	$topBorder = $topBorder == 0 ? 2 : $topBorder;
    	$bottomBorder = $bottomBorder == 0 ? 2 : $bottomBorder;
    	$rightBorder = $rightBorder == 0 ? 2 : $rightBorder;
    	$leftBorder = $leftBorder == 0 ? 2 : $leftBorder;
    	$mat2 = $mat2 == 0 ? 2 : $mat2;
    	$offset = $offset == 0 ? 2 : $offset;


    			
		$wsdl = "https://ifs.graphikservices.com/services/pricingService?wsdl";
		$options = array(
		  "userId" => "1000502576",
		  "pricingGroupRequest xsi:type='ns1:printAndFramePackage'" =>array( //printAndFramePackage or canvasWrapPackage
				  "image"=> array(
				  	"height"=>25.62,
				  	"width"=>15.62,
				  	"imageName"=>$imageName,
				  	"imageUrl"=>$imageURL		  	
				  ),
				  // "substrate xsi:type='ns1:paper'"=>array(
				  // 	"sku"=>PAPER7
				  // ),

				  "frame"=>array(
				  	"sku"=>$frame
				  ),

				  // "finishKit"=>array(
				  // 	"sku"=>CAHF
				  // ),
				  // "mat1"=>array(
				  // 	"sku"=>"PM918",
				  // 	"topBorder"=>2,
				  // 	"bottomBorder"=>2,
				  // 	"rightBorder"=>2,
				  // 	"leftBorder"=>2
				  // ),
				  // "mat2"=>array(
				  // 	"sku"=>"PM989",
				  // 	"offset"=>2.5
				  // )
		  )
		  
		);
		echo "ok ok";
		$client = new SoapClient($wsdl);
		$response = $client->__soapCall("getProductPriceBySku", array($options));
		try {
 			
			 echo $client->__getLastResponse();
		}
		catch (Exception $e) {
			  $error_xml =  $client->__getLastRequest();
			  echo $error_xml;
			  echo "\n\n".$e->getMessage();
		}
		var_dump($response);die();
		
		
		return $response;
    }

   public static function displayAllSearchBySKU($graphikAPI,$sku) {
    	$notFound = 1;
	//echo $sku;
    	 foreach($graphikAPI as $index=>$graphikAPIs) {	
    		if($graphikAPIs->sku == $sku) {
    	 		$notFound=0;
    	 	} 
    	 	if($notFound == 1) {				
				unset($graphikAPI[$index]);  
			} 
    	 	$notFound=1;
    	 } 	
	return $graphikAPI;
    }
	

   public static function displayAllSearch($graphikAPI,$color,$width,$style,$material) {
    	$frameWidth = "";
		$notFound = $color == "0" ? 0 : 1;
		$colorFound = $color == 0 ? 0 : 1;

		//echo $notFound . "<br>";

    	 foreach($graphikAPI as $index=>$graphikAPIs) {		
			if($color != "0" || $width != "0" || $style != "0" || $material != "0") {
	    	 	if(isset($graphikAPIs->colors)) {	
			           if(is_array($graphikAPIs->colors)) {
			           		foreach($graphikAPIs->colors as $colors) {
							
								if($color==$colors->value) {
									//echo $graphikAPIs->id;die();
									//echo $graphikAPIs->id . "<br>";
					    				$notFound  = 0;  
									    $colorFound =0;
	    			
								} 
								//echo $color . "==" . $colors->value. " " . $notFound   . "<br>";
			           		}

			           } else {
							if($graphikAPIs->colors->value == $color) {
								$notFound  = 0; $colorFound =0; 
							}
							//echo $color . "==" . $graphikAPIs->colors->value. " " . $notFound   ."<br>";


			           }
			    } 

			    //search for styles
			    if(isset($graphikAPIs->styles)) {	
			    	//echo $color . ' ' . $style . ' ' . $graphikAPIs->styles->value . ' ' . $colorFound . ' ' . $notFound . "<br>";
					if($graphikAPIs->styles->value== $style && $style !="0" && $colorFound==0 && $notFound==0) {
					   	$notFound=0;
					}
					
			    }

			     //search for width
			    if(isset($graphikAPIs->width)) {	
			    	
				if($graphikAPIs->width == $width && $width !="0") {	
				      	$notFound=0;
				}
					
			    }

			    //for materials
			    if(isset($graphikAPIs->material)) {	
			    	
				if($graphikAPIs->material == $material && $material !="0") {	
				       	$notFound=0;
				}
					
			    }	  



			} else {
				
				$notFound =0;	
			}
			//echo $notFound . "<br>";
			if($notFound == 1) {
				
				unset($graphikAPI[$index]);  
			} 
				$notFound = $color == "0" ? 0 : 1;
				$colorFound = $color == 0 ? 0 : 1;

	    }

	
		
		return $graphikAPI;
    }	

    public static function getGraphikAttribute($graphikAPI) {	 
    	 $colorValue = array();
	 $styleValue = array();
	$widthValue = array();
    	 $materialValue = array();
	$sku = "";
	$frameWidth = "";
        $framePrice = "";
	$frameDesc = "";
    	 foreach($graphikAPI as $graphikAPIs) {
	  	$filterValue = "";
		if($sku=="" && $graphikAPIs->sku != "") {
    	 		$sku = $graphikAPIs->sku;
    	 	}
		//get the default framewidth
    	 	if($frameWidth=="") {
    	 		foreach($graphikAPIs->externalProductAttributes as $attributes) {
    	 			if($attributes->type == "MOLD_WDTH") {
    	 				$frameWidth = $attributes->value;
    	 			}
    	 		}	
    	 		
    	 	}

                if($framePrice =="") {
    	 		$framePrice = $graphikAPIs->priceData->markUpPrice;
    	 	}

		if($frameDesc =="") {
    	 		$frameDesc = $graphikAPIs->shortDescription;
    	 	}



    	   if(isset($graphikAPIs->colors)) {	
		           if(is_array($graphikAPIs->colors)) {
		           		foreach($graphikAPIs->colors as $colors) {
						if(!in_array($colors->value,$colorValue)) {
			           			$colorValue[] = $colors->value;
							$filterValue .= $colors->value . ",";
						} else {
							$filterValue .= $colors->value . ",";

						}
		           		}

		           } else {
					if(!in_array($graphikAPIs->colors->value,$colorValue)) {
			           		$colorValue[] = $graphikAPIs->colors->value;
						$filterValue .= $graphikAPIs->colors->value . ",";
					} else {
						$filterValue .= $graphikAPIs->colors->value . ",";
					}
		           }
		    }  

	    //for styles
		    if(isset($graphikAPIs->styles)) {	
		    	if(!in_array($graphikAPIs->styles->value,$styleValue)) {
						if($graphikAPIs->styles->value!= "") {
				           		$styleValue[] = $graphikAPIs->styles->value;
							$filterValue .= $graphikAPIs->styles->value . ",";
						}
					}
		    }	
	   //for width
		    if(isset($graphikAPIs->width)) {	
		    	if(!in_array($graphikAPIs->width,$widthValue)) {
						if($graphikAPIs->width != "") {	
				           		$widthValue[] = $graphikAPIs->width;
							$filterValue .= $graphikAPIs->width . ",";
						}
					}
		    }

		    //for materials
		    if(isset($graphikAPIs->material)) {	
		    	if(!in_array($graphikAPIs->material,$materialValue)) {
						if($graphikAPIs->material != "") {	
				           		$materialValue[] = $graphikAPIs->material;
							$filterValue .= $graphikAPIs->material . ",";
						}
					}
		    }	  

		 //get the frame width of each frame
		 	foreach($graphikAPIs->externalProductAttributes as $attributes) {
    	 			if($attributes->type == "MOLD_WDTH") {
    	 				$frameWidthValue = $attributes->value;
    	 			}
    	 	}	
		$graphikAPIs->frameWidthValue = $frameWidthValue;
		$graphikAPIs->filterValue = substr($filterValue, 0,strlen($filterValue)-1);
   
         }

	
	
	//sort color in asc order	  
	 $colorValue= array_sort($colorValue, function($value) {
   			 return sprintf('%s', $value[0]);
	});

	$styleValue= array_sort($styleValue, function($value) {
   			 return sprintf('%s', $value[0]);
	 });
	$widthValue= array_sort($widthValue, function($value) {
   			 return sprintf('%s', $value[0]);
	 });

	if(count($materialValue)>1) {
		 $materialValue= array_sort($materialValue, function($value) {
	   			 return sprintf('%s', $value[0]);
		 });
         }	
	//print_r($styleValue);die();
       return [$frameDesc,$frameWidth,$sku,$graphikAPI,$colorValue,$styleValue,$widthValue,$materialValue,$framePrice];
    }


    	
}


?>