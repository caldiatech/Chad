@extends('layouts._front.dashboard_manager')

@section('content')
 <section id="sale-commissions" class="section">
    	<h2 class="section-header uk-h2"><i class="uk-icon-lock ion ion-ios-locked uk-icon-justify icon-stack-parent white "><i class="uk-icon-check-circle-o icon-small-append icon-bottom icon-right"></i></i> <span class="title-text">2016 Year to Date Commissions <span class="total-commissions-text">$980.90</span></span></h2>
    	<div class="section-content uk-table uk-padding-remove" id="sale-commissions-panel">
            <!-- Start First Quarter Sample -->
                  <div class="full-width  uk-padding-v-small"></div>
                  <div class="uk-grid uk-panel uk-panel-box normal uk-margin-remove uk-text-center uk-padding-remove uk-table-row">
                        <div class="uk-width-small-2-10 uk-width-1-1 uk-padding-v-normal uk-th uk-visible-large">                              
                              <label  class="table-text">Q1</label>
                        </div>
                        <div class="uk-width-small-2-10 uk-width-1-1  uk-padding-v-normal uk-th uk-visible-large">                              
                              <label  class="table-text">User Account</label>
                        </div>
                        <div class="uk-width-small-2-10 uk-width-1-1  uk-padding-v-normal uk-th uk-visible-large">                              
                              <label  class="table-text">Items Sold</label>
                        </div>
                        <div class="uk-width-small-2-10 uk-width-1-1  uk-padding-v-normal uk-th uk-visible-large">                              
                              <label  class="table-text">Sales</label>
                        </div>
                        <div class="uk-width-small-2-10 uk-width-1-1  uk-padding-v-normal uk-th uk-visible-large">                              
                              <label  class="table-text">Commission</label>
                        </div>
                  </div>
                  <?php 
                        $sales_commission_array = array(
                                                            array(
                                                                  'q1'=>'January',
                                                                  'user_account'=>8, 
                                                                  'items_sold'=>6, 
                                                                  'sales'=>190.05,
                                                                  'commission'=>20.00),
                                                            array(
                                                                  'q1'=>'February',
                                                                  'user_account'=>5, 
                                                                  'items_sold'=>1, 
                                                                  'sales'=>100.00,
                                                                  'commission'=>10.50),
                                                            array(
                                                                  'q1'=>'March',
                                                                  'user_account'=>0, 
                                                                  'items_sold'=>5, 
                                                                  'sales'=>5,100.00,
                                                                  'commission'=>500.50)

                                                            );
                        



                        $sales_commission_array_item_ctr = 0; $sales_commsion_item_hidden = '';
                  ?>
                  @foreach($sales_commission_array as $sales_commission_item)
                  <?php settype($sales_commission_item, 'object'); $sales_commission_array_item_ctr++;  ?>
                  
                  <div class="uk-grid uk-text-center uk-panel uk-panel-box normal uk-margin-remove uk-padding-remove uk-table-row cursor-pointer"  data-uk-toggle="{target:'#sale-commission-for-item-{{$sales_commission_array_item_ctr}}'}"  >
                        <div class="uk-width-medium-2-10  uk-width-1-3 uk-width-smallest-1-2  uk-padding-v-normal uk-td">                              
                              <label  class="table-text light"><span class="mobile-label uk-hidden-large">Q1</span>{!!$sales_commission_item->q1!!}</label>
                        </div>
                        <div class="uk-width-medium-2-10  uk-width-1-3 uk-width-smallest-1-2 uk-padding-v-normal uk-td">                              
                              <label  class="table-text light"><span class="mobile-label uk-hidden-large"><i class="uk-icon-user"></i> Account</span>{!!$sales_commission_item->user_account!!}</label>
                        </div>
                        <div class="uk-width-medium-2-10  uk-width-1-3  uk-width-smallest-1-2  uk-padding-v-normal uk-td">                              
                              <label  class="table-text light"><span class="mobile-label uk-hidden-large"><i class="uk-icon-shopping-bag"></i> Sold</span>{!!$sales_commission_item->items_sold!!}</label>
                        </div>
                        <div class="uk-width-medium-2-10  uk-width-1-3  uk-width-smallest-1-2  uk-padding-v-normal uk-td">                              
                              <label  class="table-text light"><span class="mobile-label uk-hidden-large"><i class="uk-icon-money"></i> Sales</span>${!!number_format($sales_commission_item->sales, 2)!!}</label>
                        </div>
                        <div class="uk-width-medium-2-10  uk-width-1-3  uk-padding-v-normal uk-td">                              
                              <label  class="table-text light"><span class="mobile-label uk-hidden-large">Commission</span>${!!number_format($sales_commission_item->commission, 2)!!}</label>
                        </div>
                  </div>
                  <div class="bg-grey {{$sales_commsion_item_hidden}}" id="sale-commission-for-item-{{$sales_commission_array_item_ctr}}">
      			<div class="uk-grid uk-panel uk-panel-box normal uk-margin-remove uk-padding-remove">


                              <div class="uk-width-large-1-10 uk-width-3-10 uk-padding-v-normal uk-th uk-visible-large">                              
                                    <label  class="table-text">Date</label>
                              </div>
                              <div class="uk-width-large-1-10 uk-width-3-10 uk-padding-v-normal uk-th uk-visible-large">                              
                                    <label  class="table-text">Payments</label>
                              </div>
                              <div class="uk-width-large-1-10 uk-width-3-10 uk-padding-v-normal uk-th uk-visible-large">                              
                                    <label  class="table-text">Commission</label>
                              </div>
                              <div class="uk-width-large-1-10 uk-width-3-10 uk-padding-v-normal uk-th uk-visible-large">                              
                                    <label  class="table-text">From </label>
                              </div>
                              <div class="uk-width-large-1-10 uk-width-3-10 uk-padding-v-normal uk-th uk-visible-large">                              
                                    <label  class="table-text">Transaction ID </label>
                              </div>
                              <div class="uk-width-large-4-10 uk-width-3-10 uk-padding-v-normal uk-th uk-visible-large">                              
                                    <label  class="table-text">Item Details</label>
                              </div>
                              <div class="uk-width-large-1-10 uk-width-3-10 uk-padding-v-normal uk-th uk-visible-large">                              
                                    <label  class="table-text">Image</label>
                              </div>
                              <div class="full-width  uk-padding-v-small"></div>
                              <?php   $sales_commsion_item_hidden = 'uk-hidden';
                              $history_array = array(
                                                array(
                                                      'date'=>'03/02/2016', 
                                                      'payments'=>92.04, 
                                                      'delivery_status'=>92.04, 
                                                      'from'=>'John D.',
                                                      'transaction_id'=>'CLKN-71239AB-9NC', 
                                                      'item_details'=>'Seaside Mountain View - Classic - 15x25 - Stife Dark Beige - Michael Kenna',
                                                      'image'=>'thumb1.jpg'),
                                                
                                                array(
                                                      'date'=>'02/29/2016', 
                                                      'payments'=>192.04, 
                                                      'delivery_status'=>92.04, 
                                                      'from'=>'John D.',
                                                      'transaction_id'=>'CLKN-012FJT25-51Q', 
                                                      'item_details'=>'Hilltop View - Landscape - 15x25 - White Dashed - Michael Kenna',
                                                      'image'=>'thumb2.jpg'),
                                                
                                                array(
                                                      'date'=>'02/29/2016', 
                                                      'payments'=>192.04, 
                                                      'delivery_status'=>92.04, 
                                                      'from'=>'John D.',
                                                      'transaction_id'=>'CLKN-71239AB-9NC', 
                                                      'item_details'=>'Lake View - Portrait - 4x9 - White Dashed - - Michael Kenna',
                                                      'image'=>'thumb3.jpg'),
                                                
                                                array(
                                                      'date'=>'02/29/2016', 
                                                      'payments'=>192.04, 
                                                      'delivery_status'=>92.04, 
                                                      'from'=>'John D.',
                                                      'transaction_id'=>'CLKN-71239AB-9NC', 
                                                      'item_details'=>'Rivers & Waterfalls View - Landscape - 15x25 - Wood Brown Checkered - - Michael Kenna',
                                                      'image'=>'thumb4.jpg'),
                                                
                                                array(
                                                      'date'=>'02/29/2016', 
                                                      'payments'=>192.04, 
                                                      'delivery_status'=>92.04, 
                                                      'from'=>'John D.',
                                                      'transaction_id'=>'CLKN-71239AB-9NC', 
                                                      'item_details'=>'Seascape - Landscape - 25x15 - Polished Black -- Michael Kenna',
                                                      'image'=>'thumb5.jpg'),
                                                
                                                array(
                                                      'date'=>'02/29/2016', 
                                                      'payments'=>192.04, 
                                                      'delivery_status'=>92.04, 
                                                      'from'=>'John D.',
                                                      'transaction_id'=>'CLKN-71239AB-9NC', 
                                                      'item_details'=>'Seaside Mountain View - Landscape - 15x25 - White Dashed - Michael Kenna',
                                                      'image'=>'thumb6.jpg')

                                                );


                                    ?>
                                    @foreach($history_array as $history_item)
                                          <?php settype($history_item, 'object');  ?>
                                          <div class="uk-width-large-1-10  uk-width-small-1-2  uk-width-1-1 uk-padding-v-normal uk-td">                           
                                                <label  class="table-text light"><span class="mobile-label uk-hidden-large">Date</span>{!!$history_item->date!!}</label>
                                          </div>
                                          <div class="uk-width-large-1-10  uk-width-small-1-2   uk-width-1-1  uk-padding-v-normal uk-td">                         
                                                <label  class="table-text light"><span class="mobile-label uk-hidden-large">Payments</span>${!!number_format($history_item->payments,2)!!}</label>
                                          </div>
                                          <div class="uk-width-large-1-10  uk-width-small-1-2   uk-width-1-1  uk-padding-v-normal uk-td">                         
                                                <label  class="table-text light"><span class="mobile-label uk-hidden-large">Commission</span>${!!number_format($history_item->delivery_status,2)!!}</label>
                                          </div>
                                          <div class="uk-width-large-1-10  uk-width-small-1-2   uk-width-1-1  uk-padding-v-normal uk-td">                         
                                                <label  class="table-text light"><span class="mobile-label uk-hidden-large">From</span>{!!$history_item->from!!}</label>
                                          </div>
                                          <div class="uk-width-large-1-10 uk-width-small-1-2   uk-width-1-1  uk-padding-v-normal uk-td">                          
                                                <label  class="table-text light"><span class="mobile-label uk-hidden-large">Transaction ID</span>{!!$history_item->transaction_id!!}</label>
                                          </div>
                                          <div class="uk-width-large-4-10  uk-width-small-1-2   uk-width-1-1  uk-padding-v-normal uk-td">                         
                                                <label  class="table-text light"><span class="mobile-label uk-hidden-large">Item Details</span>{!!$history_item->item_details!!}</label>
                                          </div>
                                          <div class="uk-width-large-1-10  uk-width-small-1-2   uk-width-1-1  uk-padding-v-normal uk-td">                         
                                                <span class="mobile-label uk-hidden-large">Image</span><img src="{!!url('uploads/products/product-name/'.$history_item->image)!!}" alt="Produc t Name" width="39" height="39" />
                                          </div>
                                          <div class="uk-vertical-divider full-width "></div>
                                     @endforeach

                              </div>
                        </div>
          
                        	
                  @endforeach
                  <!-- END First Quarter Sample -->
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
	</script>
@stop
