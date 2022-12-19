

<h3 class="text-uppercase">Choose Your Glazing & Backing</h3>
<label class="small uk-form-label light full-width grey">Price is Based on Your Image Size</label>


<div class="uk-grid w100 uk-margin-remove uk-text-large">
@if(isset($graphikGlazingAPI))
  @foreach($graphikGlazingAPI->finish as $fk => $finishkit)

  <div class=" uk-display-inline form-radio-buttons  uk-width-1-1 uk-padding-remove">
    <label class="light full-width" for="options{{$fk}}">
      <input type="radio" class="uk-margin-medium-right finish-kit-rdo" id="options{{$fk}}" name="options4[]" value="{{$finishkit->sku}}" {{Input::old('finishkit') == $finishkit->sku ? "checked" : ""}}>
      <small class="fsize-12 light grey" id="{{'fk-name-'.$finishkit->sku}}">{{$finishkit->shortDescription}}</small>

      <div class="uk-float-right">                        
          ${{ number_format($finishkit->priceData->markUpPrice, 2) }}
          <i class="uk-icon-question fsize-12 tooltip light-grey uk-icon-justify"  data-uk-tooltip title="This versatile photo paper is the ultimate foundation for all kinds of decor-quality photo and poster prints."></i>                       
      </div>

    </label>
  </div>
  <div class="uk-width-divider-blank uk-margin-small"></div>
  @endforeach
@endif
  <!-- NO GLAZING -->
  <div class=" uk-display-inline form-radio-buttons  uk-width-1-1 uk-padding-remove">
    <label class="light full-width" for="options-0">
      <input type="radio" class="uk-margin-medium-right finish-kit-rdo" id="options-0" name="options4[]" value="0">
      <small class="fsize-12 light grey">No Glazing or Backing</small>

      <div class="uk-float-right">                        
          $0.00
          <i class="uk-icon-question fsize-12 tooltip light-grey uk-icon-justify"  data-uk-tooltip title="No Glazing or Backing"></i>                       
      </div>

    </label>
  </div>

</div>

<script type="text/javascript">
    $(document).ready(function () {
        $('#finishkitDetails').hide();
        $('.finish-kit-rdo').change(function() {
            val = $(this).val();       

            //show finish kit in summary purchase
            if(val == 0){
              $('#finishkitDetails').hide();
              $('#hdn-finishkit').val("");
              $('#hdn-finishkit_desc').val("");
              getPackagePrice();
            }else{
              var text = $('#fk-name-'+val).text();
              var desc = val +';'+text;
              $('#finishkitDetails').show();
              $('#hdn-finishkit').val(val);
              $('#hdn-finishkit_desc').val(desc);
              
              // get the package price
              getPackagePrice();
            }

        });
    });

</script>
