    <div class="control-group"  style="">
        <label class="control-label">Card Holder's Name</label>
        <div class="uk-grid controls">
            <div class="uk-width-large-1-4 uk-width-medium-1-3 uk-width-small-1-2 uk-margin-top">
            {!! Form::text('card_firstname','',array('pattern'=>'\w+.*','required','placeholder'=>'First name','title'=>'Fill your First name','class'=>'form-control')) !!}
            </div>
            <div class="uk-width-large-1-4 uk-width-medium-1-3 uk-width-small-1-2 uk-margin-top">
            {!! Form::text('card_lastname','',array('pattern'=>'\w+.*','required','placeholder'=>'Last name','title'=>'Fill your Last name', 'class'=>'form-control')) !!}                        
           </div>
        </div>
    </div><!--control-group -->
    <div class="control-group">	
        <label class="control-label">Card Number</label>
        <div class="controls">
            <div class="uk-grid">
                <div class="uk-width-large-1-4 uk-width-medium-1-2 uk-width-small-1-2 uk-margin-top">
                     {!! Form::text('card_no1','',array('id'=>'card_no1','pattern'=>'\d{4}','required','class'=>'form-control','title'=>'First four digits','rel'=>'1','autocomplete'=>'off','maxlength'=>'4')) !!}                                                                                                             
                </div>
                <div class="uk-width-large-1-4 uk-width-medium-1-2 uk-width-small-1-2 uk-margin-top">
                    {!! Form::text('card_no2','',array('id'=>'card_no2','pattern'=>'\d{4}','required','class'=>'form-control','title'=>'Second four digits','rel'=>'1','autocomplete'=>'off','maxlength'=>'4')) !!}
                                                                      
                </div>
                <div class="uk-width-large-1-4 uk-width-medium-1-2 uk-width-small-1-2 uk-margin-top">
                    {!! Form::text('card_no3','',array('id'=>'card_no3','pattern'=>'\d{4}','required','class'=>'form-control','title'=>'Third four digits','rel'=>'1','autocomplete'=>'off','maxlength'=>'4')) !!}
                                                                       
                </div>
                <div class="uk-width-large-1-4 uk-width-medium-1-2 uk-width-small-1-2 uk-margin-top">
                    {!! Form::text('card_no4','',array('id'=>'card_no4','pattern'=>'\d{4}','required','class'=>'form-control','title'=>'Fourth four digits','rel'=>'1','autocomplete'=>'off','maxlength'=>'4')) !!}
                                                                      
                </div>
            </div>
        </div>
    </div>
    <div class="control-group">
    	<div class="uk-grid">
        	<div class="uk-width-large-1-1 uk-width-medium-1-1 uk-width-small-1-1 uk-margin-top">
            <label class="control-label">Card Expiry Date</label>
                <div class="uk-grid">
                    <div class="uk-width-large-1-4 uk-width-medium-1-3 uk-width-small-1-2 uk-margin-top">
                         {!! Form::select('card_month',array('0' => 'Select one')+App\Models\Country::displayExpirationMonth(),date('m'),array('id'=>'card_month', 'class'=>'form-control', 'onchange'=>'focusYear()')) !!}
                    </div>
                    <div class="uk-width-large-1-4 uk-width-medium-1-3 uk-width-small-1-2 uk-margin-top">
                        {!! Form::select('card_year',array('0' => 'Select one')+App\Models\Country::displayExpirationYear(),date('Y'),array('id'=>'card_year','class'=>'form-control', 'onchange'=>'focusCVV()')) !!}
                    </div>
            	</div>
            </div>
            <div class="uk-width-large-1-1 uk-width-medium-1-1 uk-width-small-1-1 uk-margin-top">
            <label class="control-label">Card CVV</label>
            	<div class="uk-grid">    	
                    <div class="uk-width-large-1-4 uk-width-medium-1-4 uk-width-small-1-2 uk-margin-top">
                    
                    {!! Form::text('card_cvv','',array('id'=>'card_cvv','required','class'=>'form-control','title'=>'Three or Four digits at back of your card','autocomplete'=>'off','maxlength'=>'4')) !!}
                    </div>
                    <div class="uk-width-large-1-4 uk-width-medium-1-4 uk-width-small-1-2 uk-margin-top">
                    	{!! Html::image('_front/assets/images/card-details.png') !!}
                    </div>
            	</div>
            </div>
        </div>
    </div>
    
<script>
	$('#card_no1,#card_no2,#card_no3,#card_no4').keyup(function(e){			
			
			if($(this).val().length==$(this).attr('maxlength'))
				if($(this).attr('id')=="card_no1") {
					cardFocus = "#card_no2";					
				} else if($(this).attr('id')=="card_no2") {
					cardFocus = "#card_no3";					
				} else if($(this).attr('id')=="card_no3") {
					cardFocus = "#card_no4";				
				} else if($(this).attr('id')=="card_no4") {		
					cardFocus = "#card_month";
				}
				$(cardFocus).focus();
				
		})
		
			

   
   function focusCVV() {
	   $('#card_cvv').focus();
   }
   
   function focusYear() {
	   $('#card_year').focus();
   }
</script>                                