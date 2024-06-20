@extends('layouts._admin.base')

@section('content')
   <article>
    <div id="page_control">
      <div class="col2">
         {!! Html::link('/dnradmin/orders',ORDERS) !!} <i class="pe-7s-angle-right"></i> {{ $data->bFirstname . ' ' . $data->bLastname }}
        </div>
    </div>

    <div style="clear:both"></div>
    <div class="uk-margin-large-top uk-container-center uk-width-medium-1-2">
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
                <td>
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

                <td>
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
        </table>

         <table class="uk-table">
            <tr>
                <td class="uk-text-bold">PRODUCT NAME</td>
                <td class="uk-text-bold">OPTIONS</td>
                <td class="uk-text-bold">AMOUNT</td>
                <td class="uk-text-bold">QTY</td>
                <td class="uk-text-bold">TOTAL</td>
            </tr>

            <?php $shipping_cost = 0; ?>
            @foreach($cart as $carts)
                <tr>
                    <td>
                      <img src="{{ App\Models\Cart::getReturnFrameImage($data->order_code ,$carts->fldProductSlug,$carts->image) }}">
                      <h3 class="dark-me">{{ $carts->product_name }}</h3>
                      {{--  <strong>Graphik Shipping Status: </strong>{{$carts->gd_status}}<br />
                      <strong>Graphik Shipping ID: </strong>{{$carts->gd_orderId }}<br />  --}}
                    </td>
                    <td>

                      <!-- @if($carts->fldCartFrameDesc)
                        <strong>FRAME:</strong> {{$carts->fldCartFrameDesc}} <br/>
                      @endif
                      -->
                      <!-- @if($carts->fldCartLinerDesc)
                        <strong>LINER:</strong> {{$carts->fldCartLinerDesc}} <br/>
                      @endif -->
                     
                      @if($carts->fldCartImageSize)
                        <strong>Photo Size:</strong> {{$carts->fldCartImageSize}} <br/>
                      @endif
          @if($carts->printName)
                        <strong>Print Name:</strong> {{$carts->printName}} <br/>
                      @endif
          @if($carts->printTotal && $carts->printTotal != 0.00)
                        <strong>Print Total:</strong> {{$carts->printTotal}} <br/>
                      @endif



                    </td>
                    <td>$ {{ number_format($carts->product_price,2) }}</td>
                    <td>{{ $carts->quantity }}</td>
                    <td>$ {{ number_format($carts->total,2) }}</td>
                </tr>
                <?php
                // Removed add all shipping
                // $shipping_cost += $carts->fldCartShippingPrice;
                $shippingAll[] = $carts->fldCartShippingPrice;
                ?>
            @endforeach

            <?php
                // Get shipping based from sequence, shipping price should now all the same
                $shipping_cost = max($shippingAll);
            ?>

                <tr>
                   <td colspan="1">&nbsp;</td>
                   <td colspan="2" class="uk-text-right uk-text-bold">SUB-TOTAL : </td>
                   <td colspan="2">$ {{ number_format($cart[0]->subtotal,2) }}</td>
                </tr>
                {{-- */$total = $cart[0]->subtotal + $data->fldCartTax;/* --}}
                <tr>
                   <td colspan="1">&nbsp;</td>
                   <td colspan="2" class="uk-text-right uk-text-bold">TAX : </td>
                   <td colspan="2">$ {{ number_format($data->fldCartTax,2) }}</td>
                </tr>

                @if ($shipping_cost > 0)
                @php
                $total += $shipping_cost;
                @endphp
                <tr>
                   <td colspan="1">&nbsp;</td>
                   <td colspan="2" class="uk-text-right uk-text-bold">Shipping : </td>
                   <td colspan="2">$ {{ number_format($shipping_cost,2) }}</td>
                </tr>
                @endif

                @if($data->fldCartCouponCodeCouponCode != "")
                      {{-- */$total = $total - $data->fldCartCouponCodeCouponPrice;/* --}}
                      <tr>
                         <td colspan="1">&nbsp;</td>
                         <td colspan="2" class="uk-text-right uk-text-bold">DISCOUNT CODE ( {{ $data->fldCartCouponCodeCouponCode }} ) : </td>
                         <td colspan="2">$ ( - {{ number_format($data->fldCartCouponCodeCouponPrice,2) }} )</td>
                      </tr>
                @endif
@php
$total = $cart[0]->subtotal + $data->fldCartTax + $shipping_cost - $data->fldCartCouponCodeCouponPrice;
@endphp
                 <tr>
                   <td colspan="1">&nbsp;</td>
                   <td colspan="2" class="uk-text-right uk-text-bold">GRAND TOTAL: </td>
                   <td colspan="2">$ {{ number_format($total,2) }}</td>
                </tr>

         </table>

    </div>
    <div class="clear"><!-- Clear Section --></div>

  </article>


@stop

@section('headercodes')

@stop

@section('extracodes')
    {!! Html::script('_admin/assets/js/jquery-latest.min.js') !!}
@stop
