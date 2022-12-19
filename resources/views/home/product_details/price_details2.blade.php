<div class="full-width bg-grey uk-margin uk-margin-top uk-hidden uk-scrollable-text" id="toggle-pice-details">
    <? /*<div class="full-width padding-small border-bottom">Approximate Outside Dimensions: (20" x 18 1/4")</div>*/ ?>
    <div class="full-width padding-small border-bottom">
      <span class="bold text-uppercase">Image</span><br/>
      <span class="light ">{{ $product->fldProductName }} (<span id="descImageWidth">{{ $product->fldProductImageWidth }}</span> x <span id="descImageHeight">{{ $product->fldProductImageHeight }}</span>)</span>
      <span class="uk-float-right ">$<span id="descImagePrice">{{ isset($product->fldProductImagePrice) ? number_format($product->fldProductImagePrice,2) : number_format($product->fldProductPrice,2)  }}</span></span>
        {!! Form::hidden('image_price',isset($product->fldProductImagePrice) ? number_format($product->fldProductImagePrice,2) : number_format($product->fldProductPrice,2),['id'=>'image_price']) !!}
        {!! Form::hidden('image_size_id',$product->fldProductImageID,['id'=>'image_size_id']) !!}
        {!! Form::hidden('frame_info', null, ['id'=>'frame_info']) !!}
        {!! Form::hidden('frame_price',$framePrice,['id'=>'frame_price']) !!}
        {!! Form::hidden('frame_desc', '',['id'=>'frame_desc']) !!}
        {!! Form::hidden('paper_info', null, ['id'=>'paper_info']) !!}
        {!! Form::hidden('mat1_info','',['id'=>'mat1_info']) !!}
        {!! Form::hidden('mat2_info','',['id'=>'mat2_info']) !!}
        {!! Form::hidden('mat3_info','',['id'=>'mat3_info']) !!}
        {!! Form::hidden('mat1_options','',['id'=>'mat1_options']) !!}
        {!! Form::hidden('mat2_options','',['id'=>'mat2_options']) !!}
        {!! Form::hidden('mat3_options','',['id'=>'mat3_options']) !!}
        {!! Form::hidden('finishkit','',['id'=>'hdn-finishkit']) !!}
        {!! Form::hidden('finishkit_desc','',['id'=>'hdn-finishkit_desc']) !!}
        {!! Form::hidden('product_id1',$product->fldProductID,['id'=>'product_id']) !!}
        {!! Form::hidden('total_price',number_format($product->fldProductImagePrice,2),['id'=>'total_price']) !!}
    </div>

    <div class="full-width padding-small border-bottom" id="paperInfo">
      <span class="bold text-uppercase">Paper</span><br/>
      <span class="light ">
          <span id="paperSKU">PAPER7</span>
          <span id="paperDESC">Premium Archival Matte Photo Paper</span>
      </span>
      <span class="uk-float-right ">
          $<span id="paperPrice">{{ number_format($packagePrice['substrate']['priceData']['wholesalePrice'], 2) }}</span>
      </span>
      <br/>

      <span class="light canvasStretcher"  style="display:none">
          <span id="stretcherSKU"></span>
      </span>
      <span class="uk-float-right canvasStretcher" style="display:none">
          $<span id="stretcherPrice"></span>
      </span>

    </div>
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
    <div class="uk-width-divider-blank uk-margin-small"></div>
    <div class="full-width padding-small border-bottom" id="matDetails2">
      <span class="bold text-uppercase">Mat</span><br/>
      <span class="light " id="matDetails2_Title"></span>
      <span class="uk-float-right ">$<span id="matDetails2_Price"></span></span>
      <div class="full-width padding-small bg-white">
           <div id="matDetails2_Borders"></div>
           <span id="matDetails2_Details" class="full-width"></span>
      </div>
    </div>
    <div class="uk-width-divider-blank uk-margin-small"></div>
    <div class="full-width padding-small border-bottom" id="matDetails3">
      <span class="bold text-uppercase">Mat</span><br/>
      <span class="light " id="matDetails3_Title"></span>
      <span class="uk-float-right ">$<span id="matDetails3_Price"></span></span>
       <div class="full-width padding-small bg-white" id="matDetails3_Details">
          <div id="matDetails3_Borders"></div>
           <span id="matDetails3_Details" class="full-width"></span>
      </div>
    </div>

    <div class="uk-width-divider-blank uk-margin-small"></div>

    <div class="full-width padding-small bg-white  border-bottom" id="frameDetails">
        <span class="bold text-uppercase">Frame</span><br/>
        <span class="light " id="frameName"></span>
        <span class="uk-float-right ">$<span id="framePrice"></span></span>
        <div class="full-width padding-small bg-white">                        
            <span class="light" id="frameSize">{{ $product->fldProductImageWidth }} x {{ $product->fldProductImageHeight }}</span>
        </div>
    </div>

    <div class="uk-width-divider-blank uk-margin-small"></div>
    
    <div class="full-width padding-small bg-white border-bottom" id="finishkitDetails">
        <span class="bold text-uppercase">Finish Kit</span><br/>
        <span class="light " id="FKName"></span>
        <span class="uk-float-right ">$<span id="FKPrice"></span></span>
        <div class="full-width padding-small bg-white">                        
            <span class="light" id="frameSize"></span>
        </div>
    </div>

    <div class="uk-width-divider-blank uk-margin-small"></div>
    
    <div class="full-width padding-small bg-white  border-bottom">
        <span class="bold text-uppercase">Merchandise Total</span><br/>
        <span class="uk-float-right ">$<span id="merchandiseTotal">{{ number_format($packagePrice['packagePriceData']['merchandiseTotal'] + $product->fldProductImagePrice, 2) }}</span></span>
    </div>

    <div class="full-width padding-small bg-white  border-bottom">
        <span class="bold text-uppercase">Fee</span><br/>
        <span class="uk-float-right ">$<span id="feeTotal">{{ number_format($packagePrice['packagePriceData']['feeTotal'], 2) }}</span></span>
    </div>

    <div class="full-width padding-small bg-white  border-bottom">
        <span class="bold text-uppercase">Promotional Discount</span><br/>
        <span class="uk-float-right ">- $<span id="promotionTotal">{{ number_format($packagePrice['packagePriceData']['promotionTotal'], 2) }}</span></span>
    </div>

    <div class="full-width padding-small bg-white  border-bottom">
        <span class="bold text-uppercase">Grand Total</span><br/>
        <span class="uk-float-right uk-text-bold">$<span id="grandTotalL">{{ number_format($packagePrice['packagePriceData']['discountTotal'] + $product->fldProductImagePrice, 2) }}</span></span>
    </div>

    <div class="uk-width-divider-blank uk-margin-small"></div>
</div> <!-- toggle-pice-details -->

