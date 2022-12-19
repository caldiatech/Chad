@extends('layouts._admin.base')

@section('content')
   <article>
  	<div id=page_control>
    	<div class="col1">
	       {!! Html::link('/dnradmin/orders','Orders') !!} &raquo; {{ $data->bFirstname . ' ' . $data->bLastname }}    
        </div>   
    </div>
    
  	
       
      
      <table border="0" cellpadding="0" cellspacing="0" width="100%" style="font-family:sans-serif;text-shadow:1px 1px 1px rgba(0,0,0,0.15);margin:0;">
      <tr>
        <td >
          <div align="center" style="width:650px;margin:auto;border-bottom:solid 1px #a0a0a0;box-shadow:0 1px 0 0 #f0f0f0;">
            <table border="0" cellpadding="0" cellspacing="0" width="650" style="font-size:12px;">
              <tr>
                <td colspan="2" align="center" width="100%"> <a href="#"> <img src="{{ url('_front/assets/images/hdr-logo.jpg')}} " width="170" height="110" alt="Dog and Rooster"> </a> </td>
              </tr>
              <tr>
                <td width="50%" style="background:rgba(0,0,0,0.10);font-weight:600;color:#555;text-align:left;padding:10px;"> Order No : {{ $data->order_code }} </td>
                <td width="50%" style="background:rgba(0,0,0,0.10);font-weight:600;color:#555;text-align:right;padding:10px;"> Order Date : {{ date('F d, Y',strtotime($data->order_date)) }} </td>
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
                  {{ $data->bFirstname . ' ' . $data->bLastname }} <br>
                  {{ $data->bAddress . ' ' . $data->bAddress1 . ' ' . $data->bCity . ' ' . $data->bSTate . ' ' . $data->bZip }} <br>
                  <a href="mailto:{{ $data->bEmail }}" style="color:#666;text-decoration:none;border-bottom:dotted 1px #333;"> {{ $data->bEmail }}</a> <br>
                  {{ $data->bPhone }} <br /><br /><br />
                </td>
                <td style="font:300 13px sans-serif;color:#555;text-shadow:none;line-height:18px;padding:10px 20px;">
                  {{ $data->sFirstname . ' ' . $data->sLastname }} <br>
                  {{ $data->sAddress . ' ' . $data->sAddress1 . ' ' . $data->sCity . ' ' . $data->sState . ' ' . $data->sZip }} <br>
                  <a href="mailto: {{ $data->sEmail }}" style="color:#666;text-decoration:none;border-bottom:dotted 1px #333;"> {{  $data->sEmail }}</a> <br>
                 {{ $data->sPhone }} <br /><br />				 
                </td>
              </tr>
              
            </table> 
            </div>
            <div align='center' style='width:650px;margin:auto;padding:10px 0;'>
           			<table border='0' cellpadding='2' cellspacing='2' width='650' style='background:rgba(0,0,0,0.10);'>
                    	<tr>
                        	<th width='60%' style='background:rgba(0,0,0,0.10);font:600 13px sans-serif;color:#555;text-align:left;text-transform:uppercase;text-shadow:none;padding:10px;'> Product Name </th>
                            <th width='10%' style='background:rgba(0,0,0,0.10);font:600 13px sans-serif;color:#555;text-align:left;text-transform:uppercase;text-shadow:none;padding:10px;'> Amount </th>
                            <th widht='10%' style='background:rgba(0,0,0,0.10);font:600 13px sans-serif;color:#555;text-align:left;text-transform:uppercase;text-shadow:none;padding:10px;'> QTY </th>
                            <th width='20%' style='background:rgba(0,0,0,0.10);font:600 13px sans-serif;color:#555;text-align:left;text-transform:uppercase;text-shadow:none;padding:10px;'> Total </th>
                        </tr>
                                                
                              @foreach($cart as $carts)                               
                                    <tr>
                                        <td style='font:400 13px sans-serif;color:#555;text-align:left;text-transform:uppercase;text-shadow:none;padding:10px;'>
                                         {!! Html::image('upload/products/'.$carts->product_id.'/_75_'.$carts->image) !!}<br /><br />{{ $carts->product_name }} 
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
			  		{{-- */$total = $cart[0]->subtotal + $data->tax;/* --}} 
			  		<tr>
                    		<td colspan='3' style='font:600 13px sans-serif;color:#555;text-align:right;text-transform:uppercase;text-shadow:none;padding:5px 10px;'>TAX:</td>
                            <td style='font:400 12px sans-serif;color:#555;text-align:left;text-transform:uppercase;text-shadow:none;padding:5px 10px;'>$ {{ number_format($data->tax,2) }}</td>
                 	</tr>
                    {{-- */$total = $total + $data->shipping_amount;/* --}} 
			  		<tr>
                    	<td colspan='3' style='font:600 13px sans-serif;color:#555;text-align:right;text-transform:uppercase;text-shadow:none;padding:5px 10px;'>Shipping (  {{ $data->shipping_name }}  ) :</td>
                        <td style='font:400 12px sans-serif;color:#555;text-align:left;text-transform:uppercase;text-shadow:none;padding:5px 10px;'>$ {{ number_format($data->shipping_amount,2) }} </td>
                   </tr>
					@if($data->coupon_code != "")
                    	{{-- */$total = $total - $data->coupon_price;/* --}} 
					<tr>
                    	<td colspan='3' style='font:600 13px sans-serif;color:#555;text-align:right;text-transform:uppercase;text-shadow:none;padding:5px 10px;'>DISCOUNT CODE ( {{ $data->coupon_code }} ) :</td>
                        <td style='font:400 12px sans-serif;color:#555;text-align:left;text-transform:uppercase;text-shadow:none;padding:5px 10px;'>$ ( {{ number_format($data->coupon_price,2) }} ) 
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
      
            
      
      
     
            

      <div class=clear><!-- Clear Section --></div>   
      
  </article>
  

@stop

@section('headercodes')    
  {!! Html::style('_admin/assets/css/pagination.css') !!}  
@stop

@section('extracodes')

    {!! Html::script('_admin/manager/tinymce/tiny_mce.js','') !!}
    {!! Html::script('_admin/assets/js/cufon_avantgarde.js','') !!}
    {!! Html::script('_admin/assets/js/jquery-latest.min.js','') !!}
    {!! Html::script('_admin/assets/js/customValidation.js','') !!}
    {!! Html::script('_admin/manager/tinymce/styles/mods2.js','') !!}
 
@stop