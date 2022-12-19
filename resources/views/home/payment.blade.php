
@if(count($payment)==1)
	@foreach($payment as $payments)
	@if(!empty($payments) && (isset($payments)))
		@if($payments->fldPaymentName == "Authorize.net")
    		@include('home.payment_authorize')
            
        @else
           Paypal 
            
	    @endif
@endif
    @endforeach    
@else
	@foreach($payment as $payments)
	@if(!empty($payments) && (isset($payments)))
    	<div><input type="radio" name="payment" value="{{ $payments->fldPaymentName }}" {{ $payments->fldPaymentName=="Authorize.net" ? "onclick='displayPayment()'" : "onclick='removePayment()'" }}> {{ $payments->fldPaymentName }}</div>
@endif
    @endforeach
@endif
@if(!empty($payments) && (isset($payments)))
<input type="hidden" name="payment" id="payment" value="{{ $payments->fldPaymentName=='Authorize.net' ? 'authorize' : 'paypal' }}">
<div id="paymentDesc" style="display:none"></div>
<script>
	function displayPayment() {
		$("#paymentDesc").show();
		$("#paymentDesc").load('authorize-display');
		$("#payment").val('authorize');
	}
	
	function removePayment() {
		$("#paymentDesc").hide();
		$("#payment").val('paypal');
	}
</script>
@endif