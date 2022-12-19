@extends('layouts._front.dashboard_manager')

@section('content')
    @if (Session::has('error'))
            <div class="uk-alert uk-alert-danger uk-margin-large-top">{!!Session::get('error')!!}</div>
    @endif

  <div class="button-container button-container-top">
      <a href="{{ url('dashboard/sales/sales-rep/new') }}" class="uk-button  uk-form-help-inline text-uppercase uk-text-bold uk-button-primary" ><i class="uk-icon-save uk-icon-justify"></i> New Sales Rep</a>      
    </div>  


 <section id="order-history" class="section">
    	<h2 class="section-header uk-h2"><i class="uk-icon-user uk-icon-button uk-icon-button-small uk-icon-justify"></i> <span class="title-text">Sales Rep</span><a href="javascript:void(0)" class=" white uk-float-right light" data-uk-toggle="{target:'#order-history-panel'}"  class="icon-button-wrapper white uk-float-right light"><i class="uk-icon-justify uk-margin-small-left white uk-icon-angle-up"></i></a></h2>
    	<div class="section-content uk-padding-remove uk-table" id="order-history-panel">
			<div class="uk-grid uk-panel uk-panel-box normal uk-margin-remove uk-padding-remove">
            	<div class="uk-width-large-1-6 uk-width-3-10 uk-padding-v-normal uk-th uk-visible-large">	                		
            		<label  class="table-text">Name</label>
            	</div>
            	<div class="uk-width-large-1-6 uk-width-3-10 uk-padding-v-normal uk-th uk-visible-large">	                		
            		<label  class="table-text">Email</label>
            	</div>
            	<div class="uk-width-large-1-6 uk-width-3-10 uk-padding-v-normal uk-th uk-visible-large">	                		
            		<label  class="table-text">Phone</label>
            	</div>
            	<div class="uk-width-large-1-6 uk-width-3-10 uk-padding-v-normal uk-th uk-visible-large">	                		
            		<label  class="table-text">Status</label>
            	</div>
            	<div class="uk-width-large-1-6 uk-width-3-10 uk-padding-v-normal uk-th uk-visible-large">	                		
            		<label  class="table-text">YTD Commission</label>
            	</div>
                <div class="uk-width-large-1-6 uk-width-3-10 uk-padding-v-normal uk-th uk-visible-large">                          
                    <label  class="table-text">Action</label>
                </div>
            	
            </div>
            	@if($salesrep->isEmpty())
	               <div class="uk-alert uk-alert-danger" style="color:#d85030">No Records Found</div>
        	@endif
            	@foreach($salesrep as $salesreps)
            	
            	<div class="uk-grid uk-panel uk-panel-box normal uk-margin-remove uk-padding-remove uk-table-row history-item-0">
	            	<div class="uk-width-large-1-6  uk-width-small-1-2 uk-width-1-1 uk-padding-v-normal uk-td uk-row-0">	                		
	            		<label  class="table-text light"><span class="mobile-label uk-hidden-large">Name</span>{{ $salesreps->fldManagerFirstname . ' ' . $salesreps->fldManagerLastname }}</label>
	            	</div>
	            	<div class="uk-width-large-1-6  uk-width-small-1-2 uk-width-1-1  uk-padding-v-normal uk-td uk-row-1">	                		
	            		<label  class="table-text light"><span class="mobile-label uk-hidden-large">Email</span>{{$salesreps->fldManagerEmail}}</label>
	            	</div>
	            	<div class="uk-width-large-1-6  uk-width-small-1-2 uk-width-1-1  uk-padding-v-normal uk-td uk-row-2">	                		
	            		<label  class="table-text light"><span class="mobile-label uk-hidden-large">Phone</span>{{ $salesreps->fldManagerPhoneNo }}</label>
	            	</div>
	            	<div class="uk-width-large-1-6  uk-width-small-1-2 uk-width-1-1  uk-padding-v-normal uk-td uk-row-3">	                		
	            		<label  class="table-text light"><span class="mobile-label uk-hidden-large">Status</span>{{$salesreps->fldManagerStatus == 2 ? "Active" : "Pending"}}</label>
	            	</div>
	            	<div class="uk-width-large-1-6 uk-width-small-1-2 uk-width-1-1  uk-padding-v-normal uk-td uk-row-4}">	                		
	            		<label  class="table-text light"><span class="mobile-label uk-hidden-large">YTD Commission</span>0.00</label>
	            	</div>
                    <div class="uk-width-large-1-6 uk-width-small-1-2 uk-width-1-1  uk-padding-v-normal uk-td uk-row-5}">   
                        <label  class="table-text light"><span class="mobile-label uk-hidden-large">Action</span>
                            <a href="{{ url('dashboard/sales/sales-rep/edit/'.$salesreps->fldManagerID) }}" title="Edit"><i class="uk-icon uk-icon-pencil"></i></a> &nbsp;&nbsp;
                            <a href="{{ url('dashboard/sales/sales-rep/delete/'.$salesreps->fldManagerID) }}" title="Delete" onClick="return confirm(&quot;Are you sure you want to remove this Sales Rep?\n\nPress OK to delete.\nPress Cancel to go back without deleting the Sales Rep.\n&quot;)"><i class="uk-icon uk-icon-trash"></i> </a> 
                        </label>                       
                       
                    </div>
	            
                        
                        

            	</div>
            	@endforeach

	        </div>
              
	    </div>
	</section>
@stop


@section('headercodes')
 
@stop

 
@section('extracodes')  
 {{-- */ /* */ /* --}}
@stop
