<table border="0" cellpadding="0" cellspacing="0" width="100%" style="font-family:sans-serif;text-shadow:1px 1px 1px rgba(0,0,0,0.15);margin:0;">
  <tr>
    <td >
      <div align="center" style="width:650px;margin:auto;border-bottom:solid 1px #a0a0a0;box-shadow:0 1px 0 0 #f0f0f0; background: #000;">
        <table border="0" cellpadding="0" cellspacing="0" width="650" style="font-size:12px;">
          <tr>
             <td align="center" width="150%"> <a href="{{ url('/') }}"> <img src="{{ url('_front/assets/images/logo.png')}} " width="170"  alt="Clarkin" style="padding:10px;"> </a> </td>
          </tr>
         
        </table>
      </div>
      <!-- HEADER PANEL -->

      <div align="center" style="background:rgba(0,0,0,0.10);width:650px;margin:auto;padding:10px 0;border-bottom:solid 1px #a0a0a0;box-shadow:0 1px 0 0 #f0f0f0;">
        <table border="0" cellpadding="0" cellspacing="0" width="650" style="font-size:12px;">             
          <tr>
            <td width="50%" style="background:rgba(0,0,0,0.10);font-weight:600;color:#555;text-align:left;padding:10px;"> Order No : {{ $order_code }} </td>
            <td width="50%" style="background:rgba(0,0,0,0.10);font-weight:600;color:#555;text-align:right;padding:10px;"> Order Date : {{ date('F d, Y',strtotime($order_date)) }} </td>
          </tr>
        </table>
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
                        <th width='15%' style='background:rgba(0,0,0,0.10);font:600 13px sans-serif;color:#555;text-align:left;text-transform:uppercase;text-shadow:none;padding:10px;'> Amount </th>
                        <th widht='10%' style='background:rgba(0,0,0,0.10);font:600 13px sans-serif;color:#555;text-align:left;text-transform:uppercase;text-shadow:none;padding:10px;'> QTY </th>
                        <th width='15%' style='background:rgba(0,0,0,0.10);font:600 13px sans-serif;color:#555;text-align:left;text-transform:uppercase;text-shadow:none;padding:10px;'> Total </th>
                    </tr>
                   
                      @php                     	
                       $cart = App\Models\Cart::displayCart($order_code)
                     @endphp

                    <?php $shipping_total = $shipping_per_item = $without_shipping_total = $grandtotal = 0; ?>
                    @foreach($cart as $carts)

                        <?php 
                        $subtotal_per_item = $carts->total;
                        $shipping_per_item = $carts->fldCartShippingPrice * $carts->quantity;
                        // $subtotal_per_item_without_shipping = $subtotal_per_item - $shipping_per_item;
                        $subtotal_per_item_without_shipping = $subtotal_per_item;
                        // print_r($carts); 
                        // echo $subtotal_per_item.'<br>';
                        // echo $shipping_per_item.'<br>';
                        // echo $subtotal_per_item_without_shipping;
                        // echo '<hr>';
                        // $shipping_total += $shipping_per_item;
                        $without_shipping_total += $subtotal_per_item_without_shipping;
                        ?>

                        <tr>
                            <td style='font:400 13px sans-serif;color:#555;text-align:left;text-shadow:none;padding:10px;'>
                              <?php 
                                $img_width = 70; $img_height = 24;
                                $imgW = "225px;";
                                $imgH = "88px";
                                if($carts->fldProductIsVertical == 1){
                                 $img_width = 24; $img_height = 70;
                                  $imgH = "225px;";
                                  $imgW = "88px";
                                }
                              ?>
                             @if($carts->fldCartFrameInfo != "")
                                {!! Html::image('https://pod.cloud.graphikservices.com/renderEMF/render?imgUrl=https://clarkincollection.com/new/'.PRODUCT_IMAGE_PATH.$carts->fldProductSlug.'/'.MEDIUM_IMAGE.$carts->image.'&imgHI='.$img_height.'&imgWI='.$img_width.'&maxW=225&maxH=225&sku='.$carts->fldCartFrameInfo.'&sku2='.$carts->fldCartLinerSku.'&frameW='.$carts->fldCartMatBorderSize) !!}
                             @else
                                 {!! Html::image(url(PRODUCT_IMAGE_PATH.$carts->fldProductSlug.'/'.MEDIUM_IMAGE.$carts->image), 'alt', array( 'width' => $imgW, 'height' => $imgH )) !!}
                             @endif   
                             <br />
                             <strong>{{ strtoupper($carts->product_name) }}</strong> <br>
                             {{ $carts->fldCartImageSize }} <br>
    <!-- @if($carts->fldCartFrameDesc)
                             <strong>Frame:</strong> {{ $carts->fldCartFrameDesc }} <br>
    @endif
    @if($carts->fldCartLinerDesc)
                             <strong>Liner:</strong> {{ $carts->fldCartLinerDesc }} <br>
    @endif -->
    @if($carts->printName != "" && $carts->printTotal)
      <strong>Print Name:</strong> {{ $carts->printName }} <br>
    @endif
    @if ($carts->printTotal != 0.00)
    <strong>Print Total:</strong> {{ $carts->printTotal }} <br>
    @endif
                             </td>                                          
                              <td style='font:400 13px sans-serif;color:#555;text-align:right;text-transform:uppercase;text-shadow:none;padding:10px;'>$ {{ is_numeric($carts->product_price) ? number_format($carts->product_price,2) : $carts->product_price }}</td>
                              <td style='font:400 13px sans-serif;color:#555;text-align:right;text-transform:uppercase;text-shadow:none;padding:10px;'>
                              {{ $carts->quantity }} </td>
                              <td style='font:400 13px sans-serif;color:#555;text-align:right;text-transform:uppercase;text-shadow:none;padding:10px;'>$ {!! is_numeric($subtotal_per_item_without_shipping) ? number_format($subtotal_per_item_without_shipping,2) : $subtotal_per_item_without_shipping !!}</td>
                            <hr>
                         </tr>
            @endforeach
                    
        <tr>
                      <td colspan='4'><hr></td></tr><tr><td colspan='3' style='font:600 13px sans-serif;color:#555;text-align:right;text-transform:uppercase;text-shadow:none;padding:5px 10px;'>Sub-Total <sup>*</sup>:</td>
                        <td style='font:400 12px sans-serif;color:#555;text-align:right;text-transform:uppercase;text-shadow:none;padding:5px 10px;'>$ {{ is_numeric($without_shipping_total) ? number_format($without_shipping_total,2) : $without_shipping_total }}</td>
                  </tr>
               
      @if($coupon_code != "")
      <tr>
                  <td colspan='3' style='font:600 13px sans-serif;color:#555;text-align:right;text-shadow:none;padding:5px 10px;'>DISCOUNT CODE: {{ $coupon_code }}</td>
                    <td style='font:400 12px sans-serif;color:#555;text-align:right;text-transform:uppercase;text-shadow:none;padding:5px 10px;'>- $ {{ is_numeric($coupon_price) ? number_format($coupon_price,2) : $coupon_price }} </td>
                </tr>
                @endif
               
                <tr>
                    <td colspan='3' style='font:600 13px sans-serif;color:#555;text-align:right;text-transform:uppercase;text-shadow:none;padding:5px 10px;'>Shipping {{$shipping_code}}: </td>
                    <td style='font:400 12px sans-serif;color:#555;text-align:right;text-transform:uppercase;text-shadow:none;padding:5px 10px;'>$ {{ is_numeric($shipping_amount) ? number_format($shipping_amount,2) : $shipping_amount }} </td>
                </tr>

                <tr>
                        <td colspan='3' style='font:600 13px sans-serif;color:#555;text-align:right;text-transform:uppercase;text-shadow:none;padding:5px 10px;'>TAX:</td>
                        <td style='font:400 12px sans-serif;color:#555;text-align:right;text-transform:uppercase;text-shadow:none;padding:5px 10px;'>$ {{ is_numeric($tax) ? number_format($tax,2) : $tax }}</td>
                </tr>

                <?php $grandtotal = $without_shipping_total + $shipping_amount + $tax - $coupon_price; ?>
      <tr>
                  <td colspan='3' style='background:rgba(0,0,0,0.10);font:600 16px sans-serif;color:#555;text-align:right;text-transform:uppercase;text-shadow:none;padding:15px 10px;'>GRAND TOTAL:</td>
                    <td style='background:rgba(0,0,0,0.10);font:400 14px sans-serif;color:#555;text-align:right;text-transform:uppercase;text-shadow:none;padding:15px 10px;'>$ {{ is_numeric($grandtotal) ? number_format($grandtotal,2) : $grandtotal }}</td>
                </tr>
         </table>
         </div>	
      <!-- ORDERS PANEL -->
    </td>
  </tr>
</table>