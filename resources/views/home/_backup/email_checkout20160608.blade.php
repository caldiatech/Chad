    <table border="0" cellpadding="0" cellspacing="0" width="100%" style="font-family:sans-serif;text-shadow:1px 1px 1px rgba(0,0,0,0.15);margin:0;">
      <tr>
        <td >
          <div align="center" style="width:650px;margin:auto;border-bottom:solid 1px #a0a0a0;box-shadow:0 1px 0 0 #f0f0f0;">
            <table border="0" cellpadding="0" cellspacing="0" width="650" style="font-size:12px;">
              <tr>
                <td align="center" width="150%"> <a href="{{ url('/') }}"> <img src="{{ url('_front/assets/images/logo.png')}} " width="170"  alt="Clarkin" style="padding:10px;"> </a> </td>
              </tr>
              <tr>
                <td width="50%" style="background:rgba(0,0,0,0.10);font-weight:600;color:#555;text-align:left;padding:10px;"> Order No : {{ $order_code }} </td>
                <td width="50%" style="background:rgba(0,0,0,0.10);font-weight:600;color:#555;text-align:right;padding:10px;"> Order Date : {{ date('F d, Y',strtotime($order_date)) }} </td>
              </tr>
            </table>
          </div>
          <!-- HEADER PANEL -->

          <div align="center" style="background:rgba(0,0,0,0.10);width:650px;margin:auto;padding:10px 0;border-bottom:solid 1px #a0a0a0;box-shadow:0 1px 0 0 #f0f0f0;">
            <table border="0" cellpadding="0" cellspacing="0" width="650">
              <tr>
                <td width="50%" style="font:600 13px sans-serif;color:#555;text-transform:uppercase;text-shadow:none;padding:10px 20px;"> Billing Information </td>
                <td width="50%" style="font:600 13px sans-serif;color:#555;text-transform:uppercase;text-shadow:none;padding:10px 20px;"> Shipping Information </td>
              </tr>
              <tr>
                <td style="font:300 13px sans-serif;color:#555;text-shadow:none;line-height:18px;padding:10px 20px;">
                  {{ $bFirstname . ' ' . $bLastname }} <br>
                  {{ $bAddress . ' ' . $bAddress1 . ' ' . $bCity . ' ' . $bSTate . ' ' . $bZip }} <br>
                  <a href="mailto:{{ $bEmail }}" style="color:#666;text-decoration:none;border-bottom:dotted 1px #333;"> {{ $bEmail }}</a> <br>
                  {{ $bPhone }} <br /><br /><br />
                </td>
                <td style="font:300 13px sans-serif;color:#555;text-shadow:none;line-height:18px;padding:10px 20px;">
                  {{ $sFirstname . ' ' . $sLastname }} <br>
                  {{ $sAddress . ' ' . $sAddress1 . ' ' . $sCity . ' ' . $sState . ' ' . $sZip }} <br>
                  <a href="mailto: {{ $sEmail }}" style="color:#666;text-decoration:none;border-bottom:dotted 1px #333;"> {{  $sEmail }}</a> <br>
                 {{ $sPhone }} <br /><br />				 
                </td>
              </tr>
              
            </table>
          </div>
          <!-- INFO PANEL -->

           <div align='center' style='width:650px;margin:auto;padding:10px 0;'>
           			<table border='0' cellpadding='2' cellspacing='2' width='650' style='background:rgba(0,0,0,0.10);'>
                    	<tr>
                        	<th width='60%' style='background:rgba(0,0,0,0.10);font:600 13px sans-serif;color:#555;text-align:left;text-transform:uppercase;text-shadow:none;padding:10px;'> Product Name </th>
                            <th width='10%' style='background:rgba(0,0,0,0.10);font:600 13px sans-serif;color:#555;text-align:left;text-transform:uppercase;text-shadow:none;padding:10px;'> Amount </th>
                            <th widht='10%' style='background:rgba(0,0,0,0.10);font:600 13px sans-serif;color:#555;text-align:left;text-transform:uppercase;text-shadow:none;padding:10px;'> QTY </th>
                            <th width='20%' style='background:rgba(0,0,0,0.10);font:600 13px sans-serif;color:#555;text-align:left;text-transform:uppercase;text-shadow:none;padding:10px;'> Total </th>
                        </tr>
                        
                         {{-- */                         	
                         	$cart = App\Models\Cart::displayCart($order_code)
                         /* --}}	
                              @foreach($cart as $carts)
                                                                         
                                    <tr>
                                        <td style='font:400 13px sans-serif;color:#555;text-align:left;text-transform:uppercase;text-shadow:none;padding:10px;'>

                                         {!! Html::image('https://pod.cloud.graphikservices.com/renderEMF/render?imgUrl='.url(PRODUCT_IMAGE_PATH.$carts->fldProductSlug.'/'.SMALL_IMAGE.$carts->image).'&imgHI='.$carts->image_height.'&imgWI='.$carts->image_width.'&maxW=225&maxH=225&t='.$carts->fldCartMatBorderSize.'&r='.$carts->fldCartMatBorderSize.'&b='.$carts->fldCartMatBorderSize.'&l='.$carts->fldCartMatBorderSize.'&sku='.$carts->fldCartFrameInfo.'&frameW='.$carts->frame_size.$carts->matParams) !!}
                                         
                                          @foreach($carts->cart_options as $cart_options) 
                                                <br />
                                                @if($cart_options != "")
                                                    &nbsp;&nbsp;{{ $cart_options }}
                                                @endif   
                                          @endforeach 
                                         </td>
                                          
                                          <td style='font:400 13px sans-serif;color:#555;text-align:left;text-transform:uppercase;text-shadow:none;padding:10px;'>$ {{ number_format($carts->product_price,2) }}</td>
                                          <td style='font:400 13px sans-serif;color:#555;text-align:left;text-transform:uppercase;text-shadow:none;padding:10px;'>
                                          {{ $carts->quantity }} </td>
                                          <td style='font:400 13px sans-serif;color:#555;text-align:left;text-transform:uppercase;text-shadow:none;padding:10px;'>$ {{ number_format($carts->total,2) }}</td>
                                     </tr>
						 @endforeach
                         
						<tr>
                        	<td colspan='4'><hr></td></tr><tr><td colspan='3' style='font:600 13px sans-serif;color:#555;text-align:right;text-transform:uppercase;text-shadow:none;padding:5px 10px;'>Sub-Total:</td>
                            <td style='font:400 12px sans-serif;color:#555;text-align:left;text-transform:uppercase;text-shadow:none;padding:5px 10px;'>$ {{ number_format($cart[0]->subtotal,2) }}</td>
                      </tr>
			  		{{-- */$total = $cart[0]->subtotal + $tax;/* --}} 
			  		<tr>
                    		<td colspan='3' style='font:600 13px sans-serif;color:#555;text-align:right;text-transform:uppercase;text-shadow:none;padding:5px 10px;'>TAX:</td>
                            <td style='font:400 12px sans-serif;color:#555;text-align:left;text-transform:uppercase;text-shadow:none;padding:5px 10px;'>$ {{ number_format($tax,2) }}</td>
                 	</tr>
                    {{-- */$total = $total + $shipping_amount;/* --}} 
			  		<tr>
                    	<td colspan='3' style='font:600 13px sans-serif;color:#555;text-align:right;text-transform:uppercase;text-shadow:none;padding:5px 10px;'>Shipping: (  {{ $shipping_name }}  )</td>
                        <td style='font:400 12px sans-serif;color:#555;text-align:left;text-transform:uppercase;text-shadow:none;padding:5px 10px;'>$ {{ number_format($shipping_amount,2) }} </td>
                   </tr>
					@if($coupon_code != "")
                    	{{-- */$total = $total - $coupon_price;/* --}} 
					<tr>
                    	<td colspan='3' style='font:600 13px sans-serif;color:#555;text-align:right;text-transform:uppercase;text-shadow:none;padding:5px 10px;'>DISCOUNT CODE: {{ $coupon_code }}</td>
                        <td style='font:400 12px sans-serif;color:#555;text-align:left;text-transform:uppercase;text-shadow:none;padding:5px 10px;'>$ ( {{ $coupon_price }} ) 
                    	</td>
                    </tr>
                    @endif
                   
                   
					<tr>
                    	<td colspan='3' style='background:rgba(0,0,0,0.10);font:600 16px sans-serif;color:#555;text-align:right;text-transform:uppercase;text-shadow:none;padding:15px 10px;'>GRAND TOTAL:</td>
                        <td style='background:rgba(0,0,0,0.10);font:400 14px sans-serif;color:#555;text-align:left;text-transform:uppercase;text-shadow:none;padding:15px 10px;'>$ {{ number_format($total,2) }}</td>
                    </tr>
             </table>
             </div>	
          <!-- ORDERS PANEL -->
        </td>
      </tr>
    </table>