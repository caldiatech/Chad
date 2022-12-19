<div class="uk-offcanvas" id="toggle-pice-details2">
    <div class="uk-offcanvas-bar" mode="slide">
        <div class="uk-panel">
    <? /*<div class="full-width padding-small border-bottom">Approximate Outside Dimensions: (20" x 18 1/4")</div>*/ ?>
    <div class="full-width padding-small border-bottom">
      <span class="bold text-uppercase">Image</span><br/>
      <span class="light ">{{ $product->fldProductName }} (<span id="descImageWidth">{{ $product->fldProductImageWidth }}</span> x <span id="descImageHeight">{{ $product->fldProductImageHeight }}</span>)</span>
      <span class="uk-float-right ">$<span id="descImagePrice">{{ isset($product->fldProductImagePrice) ? number_format($fldProductImagePrice,2) : number_format($fldProductPrice,2)  }}</span></span>
        
    </div>

    <div class="full-width padding-small border-bottom" id="paperInfo">
      <span class="bold text-uppercase">Paper</span><br/>
      <span class="light ">
          <span id="paperSKU">PAPER7</span>
          <span id="paperDESC">Premium Archival Matte Photo Paper</span>
      </span>
      <span class="uk-float-right ">
          $<span id="paperPrice">8.10</span>
      </span>
      <br/>

      <span class="light canvasStretcher"  style="display:none">
          <span id="stretcherSKU"></span>
      </span>
      <span class="uk-float-right canvasStretcher" style="display:none">
          $<span id="stretcherPrice"></span>
      </span>

    </div>

    <? /*
    <div class="uk-width-divider-blank uk-margin-small"></div>
    <div class="full-width padding-small bg-white  border-bottom" id="matDetails1">
        <span class="bold text-uppercase">Mat</span><br/>
        <span class="light" id="matDetails1_Title"></span>
        <span class="uk-float-right ">$<span id="matDetails1_Price"></span></span>
        <div class="full-width padding-small bg-white">
            <div id="matDetails1_Borders"></div>
            <span id="matDetails1_Details"  class="full-width"></span>
        </div>
    </div>
    */ ?>   

    <div class="uk-width-divider-blank uk-margin-small"></div>
    <div class="full-width padding-small bg-white  border-bottom" id="frameDetails">
        <span class="bold text-uppercase">Frame</span><br/>
        <span class="light " id="frameName"></span>
        <span class="uk-float-right ">$<span id="framePrice"></span></span>
        <div class="full-width padding-small bg-white">
            <span class="light" id="frameSize">{{ $product->fldProductImageWidth }} x {{ $product->fldProductImageHeight }}</span>
        </div>
    </div>

    <? /*
    <div class="uk-width-divider-blank uk-margin-small"></div>
    <div class="full-width padding-small bg-white border-bottom" id="finishkitDetails">
        <span class="bold text-uppercase">Finish Kit</span><br/>
        <span class="light " id="FKName"></span>
        <span class="uk-float-right ">$<span id="FKPrice"></span></span>
        <div class="full-width padding-small bg-white">
            <span class="light" id="frameSize"></span>
        </div>
    </div>
    */ ?>

    <div class="uk-width-divider-blank uk-margin-small"></div>
    <div class="full-width padding-small bg-white  border-bottom">
        <span class="bold text-uppercase">Merchandise Total</span><br/>
        <?php $merchandiseTotal = $feeTotal = $promotionTotal = $discountTotal = 0; ?>
        <span class="uk-float-right ">$<span id="merchandiseTotal">{{ number_format($merchandiseTotal + $fldProductImagePrice, 2) }}</span></span>
    </div>

    <div class="full-width padding-small bg-white  border-bottom">
        <span class="bold text-uppercase">Fee</span><br/>
        <span class="uk-float-right ">$<span id="feeTotal">{{ number_format($feeTotal, 2) }}</span></span>
    </div>

    <div class="full-width padding-small bg-white  border-bottom">
        <span class="bold text-uppercase">Promotional Discount</span><br/>
        <span class="uk-float-right ">- $<span id="promotionTotal">{{ number_format($promotionTotal, 2) }}</span></span>
    </div>

    <div class="full-width padding-small bg-white  border-bottom">
        <span class="bold text-uppercase">Grand Total</span><br/>
        <span class="uk-float-right uk-text-bold">$<span id="grandTotalL">{{ number_format($discountTotal + $fldProductImagePrice, 2) }}</span></span>
    </div>

    <div class="uk-width-divider-blank uk-margin-small"></div>
        </div>
    </div>
</div> <!-- toggle-pice-details -->

