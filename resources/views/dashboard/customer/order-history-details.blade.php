@extends('layouts._front.dashboard')

@section('content')
 <section id="order-history" class="section">
    	<div class="uk-margin-large-top uk-container-center uk-width-medium-7-10">
        <table class="uk-table">
             <tr style="background:#000">
                <td colspan="2" align="center">
                    <a href="{{ url('/') }}"> 
                        <img src="{{ url('_front/assets/images/logo.png')}} " width="170" height="110" alt="Clarkin">
                    </a>
                </td>  
             </tr> 
             <tr>
                  <td class="uk-text-bold">Order No : {{ $data->order_code }}</td>
                  <td class="uk-text-right uk-text-bold">Order Date : {{ date('F d, Y',strtotime($data->order_date)) }}</td>
             </tr> 
             <tr>
                <td colspan="2"><hr></td>
             </tr> 
             <tr>
                <td style="margin-top:15px;margin-bottom:15px;">
                    <div class="uk-grid">
                        <div class="uk-width-large-1-1 uk-text-bold">
                            BILLING INFORMATION
                        </div>
                    </div>
                    <div class="uk-grid">
                        <div class="uk-width-large-1-1">
                            <span class="uk-text-left">
                            {{ $data->bFirstname . ' ' . $data->bLastname }} <br>
                            {{ $data->bAddress . ' ' . $data->bAddress1 . ' ' . $data->bCity . ' ' . $data->bSTate . ' ' . $data->bCountry . ' ' . $data->bZip }} <br>
                            <a href="mailto:{{ $data->bEmail }}" style="color:#666;text-decoration:none;border-bottom:dotted 1px #333;"> {{ $data->bEmail }}</a> <br>
                            {{ $data->bPhone }}
                          </span>
                        </div>  
                    </div>  
                </td>
                
                <td class="uk-text-left" style="margin-top:15px;margin-bottom:15px;">
                    <div class="uk-grid">
                        <div class="uk-width-large-1-1 uk-text-bold">
                            SHIPPING INFORMATION
                        </div>  
                    </div>
                    <div class="uk-grid">
                        <div class="uk-width-large-1-1 uk-text-left">
                             {{ $data->sFirstname . ' ' . $data->sLastname }} <br>
                              {{ str_replace(";", " ", $data->fldCartShippingAddress) }} <br>
                              <a href="mailto: {{ $data->sEmail }}" style="color:#666;text-decoration:none;border-bottom:dotted 1px #333;"> {{  $data->sEmail }}</a> <br>
                             {{ $data->sPhone }}
                        </div>  
                    </div>
                </td>
                
             </tr>     
              <tr>
                <td colspan="2"><hr></td>
             </tr>         
        </table>
        
         <table class="uk-table">
            <tr>
                <td class="uk-text-bold">PRODUCT NAME</td>
                <td class="uk-text-bold">OPTIONS</td>
                <td class="uk-text-bold">AMOUNT</td>
                <td class="uk-text-bold uk-width-1-10">QTY</td>
                <td class="uk-text-bold">TOTAL</td>
            </tr>  
            @foreach($cart as $carts)
                <tr>
                    <td>
                      <img src="{{ App\Models\Cart::getReturnFrameImage($data->order_code ,$carts->fldProductSlug,$carts->image) }}">
                      </br>{{ $carts->product_name }} 
                     

                    </td>
                    <td>

                      <!-- @if($carts->fldCartFrameDesc)
                        <strong>Frame:</strong> {{$carts->fldCartFrameDesc}} <br/>
                      @endif -->

                      @if($carts->fldCartImageSize)
                        <strong>Size:</strong> {{$carts->fldCartImageSize}} <br/>
                      @endif

                      <!-- @if($carts->fldCartLinerDesc)
                        <strong>Liner:</strong> {{$carts->fldCartLinerDesc}} <br/>
                      @endif -->

                      

         @if($carts->printName != "" && $carts->printTotal != "")
      <strong>Print Name:</strong>  {{ $carts->printName }}<br/>

        @endif
              
      @if($carts->printTotal != 0.00)
      <strong>Print Total:</strong>  {{ $carts->printTotal }}<br/>
      @endif
                      
                    </td>
                    <td>$ {{ number_format($carts->product_price,2) }}</td>
                    <td>{{ $carts->quantity }}</td>
                    <td>$ {{ number_format($carts->total,2) }}</td>
                </tr>
            @endforeach
                 <tr>
                    <td colspan="5"><hr></td>
                 </tr> 
                <tr>                   
                   <td colspan="3" class="uk-text-right uk-text-bold">SUB-TOTAL : </td>
                   <td colspan="2">$ {{ number_format($cart[0]->subtotal,2) }}</td>                  
                </tr> 

                {{-- */$total = $cart[0]->subtotal + $data->fldCartTax;/* --}} 

                @if($data->fldCartCouponCodeCouponCode != "")
                  {{-- */$total = $total - $data->fldCartCouponCodeCouponPrice;/* --}} 
                  <tr>
                     <td colspan="3" class="uk-text-right uk-text-bold">DISCOUNT CODE ( {{ $data->fldCartCouponCodeCouponCode }} ) : </td>
                     <td colspan="2">$ ( - {{ number_format($data->fldCartCouponCodeCouponPrice,2) }} )</td>                  
                  </tr>
                @endif      

                <tr>
                   <td colspan="3" class="uk-text-right uk-text-bold">TAX : </td>
                   <td colspan="2">$ {{ number_format($data->fldCartTax,2) }}</td>                  
                </tr> 

                @if($data->fldCartShippingPrice != "")
                 {{-- */$total = $total + $data->fldCartShippingPrice;/* --}} 
                 <tr>
                   <td colspan="3" class="uk-text-right uk-text-bold">Shipping (  {{ $data->fldCartShippingCode }}  ) : </td>
                   <td  colspan="2">$ {{ number_format($data->fldCartShippingPrice,2) }}</td>                  
                </tr> 
                @endif

                 <tr>
                   <td colspan="3" class="uk-text-right uk-text-bold">GRAND TOTAL: </td>
                   @php
                   $total = $cart[0]->subtotal + $data->fldCartTax + $data->fldCartShippingPrice; 
                   @endphp
                   <td colspan="2">${{number_format($total,2)}} </td>                  
                </tr> 

         </table> 
      
    </div>  
	</section>
@stop


@section('headercodes')
 
@stop

 
@section('extracodes')  
 {{-- */ /* */ /* --}}
	<script>
		$(document).ready(function(){
		});
            function delete_me(deleting_id){
                  var confirmdelete = UIkit.modal.confirm('Are you sure?', function(){    
                        $('.history-item-'+deleting_id).addClass('bg-red');
                        //delete query here
                        /* $(ajax) */
                        setTimeout(function(){
                              // hide
                              $('.history-item-'+deleting_id).fadeOut();
                        },300);
                        return true; 
                  }, function(){
                        return false; 
                  }
                  );

            }

            function orderRecords(orderNo) {                  
                  $.get( "{{ url('dashboard/customer/orderInfo/') }}/"+orderNo, function( data ) {
                       console.log(data);
                         $("#productCode").html(data.fldCartOrderNo);
                         $("#productDESC").html(data.fldProductDescription);
                        $("#productImage").attr('src',data.imageFrame);
                         $("#productDate").html(data.fldCartOrderDate);
                        $("#productPrice").html(data.fldCartProductPrice);
                        $("#orderShipping").html(data.fldAddress);
                         $("#orderTranID").html(data.fldCartOrderNo);
                         $("#orderItemDetails").html(data.orderDetails);
                  });
            }
	</script>
@stop
