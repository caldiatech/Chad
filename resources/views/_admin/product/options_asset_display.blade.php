<style>
    #top-page {
        all:unset;
        position: fixed;
        right: 20px;
        bottom: 20px;
        padding:5px 5px;
        cursor: pointer;
        color:#fff;
        background-color:#666;
        display: none;
    }
#admincontent article form li:first-child{
margin-bottom:20px;
}
    .alert-primary {
        color: #004085 !important;
        background-color: #cce5ff;
        border-color: #b8daff;
    }
    .alert {
        position: relative;
        padding: .75rem 1.25rem;
        margin-bottom: 1rem;
        border: 1px solid transparent;
        border-radius: .25rem;
    }



.uk-table td {
vertical-align: middle;
}

#admincontent article form li div input{
width: 70%;
}

.dragHandle img, .dragHandle span {
display: inline-block;
vertical-align: middle;
}


.dragHandle span {
padding: 5px !important;
}
#admincontent article form li div input[type=checkbox]:checked {
background: #f7cd63;
color: #fff;
}
#admincontent article form li div input[type=checkbox] {
height: 20px !important;
width: 20px !important;
padding: 3px !important;
margin: 0 !important;
}
.uk-form input[type=checkbox]:checked:before, .uk-form input[type=checkbox]:indeterminate:before{
font-size: 15px;
}

</style>
<div style="background-color: #a3a3a3;padding: 10px 10px;">
<table>
    <tr><th>
        <div class="alert alert-primary" role="alert">
            Selected option assets list
            <br>
            <em style="font-weight:300; color: #004085 !important;">Note: please click modify if you want to move or update the selected option assets for this product</em>
          </div>
    </th></tr>
</table>
<table style="color:#fff;">
                       
    <thead>
        <tr>
            <th style="padding: 5px 3px;"  width="25%">Sizes</th>
            <th style="padding: 5px 3px; text-align:center;"  width="30%">Framed</th>
            <th style="padding: 5px 3px; text-align:center;"  width="30%">Print Only</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        @foreach($options as $optionss)
            <?php 
                $c_size_class = 'horizontal';
                $fldOptionsAssetsWidth = $optionss->fldOptionsAssetsWidth;
                $fldOptionsAssetsHeight = $optionss->fldOptionsAssetsHeight;
                if($fldOptionsAssetsWidth < $fldOptionsAssetsHeight){
                    $c_size_class = 'vertical';
                }

                if (in_array($optionss->fldOptionsAssetsID, $product_options_array)) {
                    $checked = 'checked="checked"';
                } else {
                    $checked = '';
                }
            ?>
            @if(in_array($optionss->fldOptionsAssetsID, $product_options_array))
                <tr >
                    <td style="padding: 5px 3px;"  width="25%">
                        {{  $optionss->fldOptionsAssetsWidth }} {{ \App\Models\ProductOptions::frameFraction($optionss->fldOptionsAssetsWidthFraction)}} x {{  $optionss->fldOptionsAssetsHeight }} 
                        {{ \App\Models\ProductOptions::frameFraction($optionss->fldOptionsAssetsHeightFraction) }}
                    </td>
                    <td style="padding: 5px 3px; text-align:center;"  width="30%">
                        <!-- $ {!! DB::table('tblProductOptions')->where('fldProductOptionsAssetsID','=',$optionss->fldOptionsAssetsID)->where('fldProductOptionsProductID','=',$product_id)->pluck('fldProductOptionsPrice'); !!} -->
                    $ 0
                    </td>
                    <td style="padding: 5px 3px; text-align:center;"  width="30%">
                    @php 
                     $printVal = str_replace( array( '[', '"',']'), '',DB::table('tblProductOptions')->where('fldProductOptionsAssetsID','=',$optionss->fldOptionsAssetsID)->where('fldProductOptionsProductID','=',$product_id)->pluck('fldProductOptionsPrice'));
                     @endphp
                        $ {{$printVal}}
                    </td>
                    <td style="padding: 5px 3px;"  width="9%">
                        <a class="clickSize uk-button uk-button-success" data-id="{{$optionss->fldOptionsAssetsID.'_'.$optionss->fldOptionsAssetsPosition}}"  style="color:#fff !important;">Modify</a>
                    </td>
                </tr>   

                
                
            @endif
        @endforeach
    </tbody>
</table>

</div>

<table id="page_manager{!!$option_id!!}1" style="margin-top:-5px" class="uk-table" width="100%">  
                    
    <thead>
        <tr>
            <th>Opts</th>
            <th>Sizes</th>
            <th>Framed</th>
            <th>Print Only</th>
        </tr>
    </thead>
    <tbody>

        @foreach($options as $optionss)
            <?php 
            
                $c_size_class = 'horizontal';
                $fldOptionsAssetsWidth = $optionss->fldOptionsAssetsWidth;
                $fldOptionsAssetsHeight = $optionss->fldOptionsAssetsHeight;
            if($fldOptionsAssetsWidth < $fldOptionsAssetsHeight){
                $c_size_class = 'vertical';
            }

            if (in_array($optionss->fldOptionsAssetsID, $product_options_array)) {
                $checked = 'checked="checked"';
            } else {
                $checked = '';
            }
            ?>

            <tr id="{{$optionss->fldOptionsAssetsID.'_'.$optionss->fldOptionsAssetsPosition}}">
                <td style="padding: 5px 3px;" width="5%"> 
                    <input type="checkbox" class="check-select" name="options_assets[]" 
                        value="{!! $optionss->fldOptionsAssetsID !!}" 
                        onclick="displayAssetsPrice({!! $optionss->fldOptionsAssetsID !!},this.checked)" 
                        {!! $checked !!} />
                </td>
                <td style="padding: 5px 3px;"  width="20%">
                    {{  $optionss->fldOptionsAssetsWidth }} {{ \App\Models\ProductOptions::frameFraction($optionss->fldOptionsAssetsWidthFraction)}} x {{  $optionss->fldOptionsAssetsHeight }} 
                    {{ \App\Models\ProductOptions::frameFraction($optionss->fldOptionsAssetsHeightFraction)}}
                </td>
                <td style="padding: 5px 3px;"  width="30%">
                    <div id="assets{!!$optionss->fldOptionsID!!}">
                        <div colspan="4" style="padding:5px 5px;"> 
                        @php 
                        $priceVal = DB::table('tblProductOptions')->where('fldProductOptionsAssetsID','=',$optionss->fldOptionsAssetsID)->where('fldProductOptionsProductID','=',$product_id)->pluck('fldProductOptionsPrice');
                        if(count($priceVal) == 0)
                        {
                            $priceVal = 0;
                        } else {
                            $priceVal = str_replace( array( '[', '"',']'), '',$priceVal);
                        }
                        @endphp
                        $
                            <input type="text" name="assets_price[{!!$optionss->fldOptionsAssetsID!!}]" value="{!! $priceVal !!}" placeholder="New Price" readonly/>
                            <?php 
                                $is_sale = false; $sale_checked = '';
                                $sale_price = 0;                       
                            ?>                                    
                            <input type="hidden" name="assets_id[]" value="{!!$optionss->fldOptionsID!!}" />
                        </div>
                    </div>  
                </td>
                <td style="padding: 5px 3px;"  width="30%">
                    <div id="assets_print{!!$optionss->fldOptionsID!!}">

                        <div colspan="4" style="padding:5px 5px;"> 
                        @php 
                        $mainPriceVal = DB::table('tblProductOptions')->where('fldProductOptionsAssetsID','=',$optionss->fldOptionsAssetsID)->where('fldProductOptionsProductID','=',$product_id)->pluck('fldProductOptionsPrice');
                        if(count($mainPriceVal) == 0)
                        {
                            $mainPriceVal = 0;
                        } else {
                            $mainPriceVal = str_replace( array( '[', '"',']'), '',$mainPriceVal);
                        }
                        @endphp
                        $
                            <input type="text" name="assets_price_print[{!!$optionss->fldOptionsAssetsID!!}]" value="{!! $mainPriceVal !!}" placeholder="New Price" readonly/>
                            <?php 
                                $is_sale = false; $sale_checked = '';
                                $sale_price = 0;                                 
                            ?>                                    
                            <input type="hidden" name="assets_print_id[]" value="{!!$optionss->fldOptionsID!!}" />
                        </div>
                        
                    </div>  
                </td>
                <td style="padding: 5px 3px;" class="dragHandle"  width="9%">
                    {!! Html::image('_admin/assets/images/icons/updown.png') !!}                        			
                    <span style="border:1px #fff solid; padding:5px 10px;">{{ $optionss->fldOptionsAssetsPosition }}</span>
                </td>
                <td style="padding: 5px 3px;"  width="10%">
                    <a href="javascript:void(0)" onClick="editAssetsOptions({{$optionss->fldOptionsAssetsID}},{{$option_id}},{{ $product_id }})"><img src="{!!url('_admin/assets/images/icons/page_modify.png')!!}"></a>                                               
                    <a href="javascript:void(0)" onClick="deleteAssetsOptions({{$optionss->fldOptionsAssetsID}},{{ $product_id }})"><img src="{!!url('_admin/assets/images/icons/page_delete.png')!!}"></a>
                </td>
            </tr>
        @endforeach 
    </tbody>

</table>        
<div style="margin-bottom:15px; margin-left:55px;padding: 5px 3px;">
<button type="button" name="button" class="uk-button uk-button-success" onClick="addAssetsOptions({!!$option_id!!},{!!$product_id!!})">Add New Options Assets</button>
</div>


{!! Html::script('_admin/assets/js/jquery.tablednd.js') !!}
<script>


$('#page_manager{!!$option_id!!}1').tableDnD({
onDrop: function(table, row) {						
    $.ajax({			

        type: "get",
        url: mypath+"/dnradmin/product_options_assets/update-position/{!!$option_id!!}",
        data: $.tableDnD.serialize(),
        cache: false,
        success: function(data){
            location.reload();
            //$('#product_options_assets{!!$option_id!!}').load(mypath+'/dnradmin/product_options_assets/display/{!!$option_id!!}');							
        }
        
    });	
},
dragHandle: '.dragHandle'
});
</script>                                            
<script>
   
    $(".clickSize").click( function  (){
        var id = $(this).attr('data-id');
        $("#"+id).attr('style','background-color: #a3a3a3 !important; color:#fff !important; transition: background-color 2s;');
        $('html, body').animate({
            scrollTop: $("#"+id).offset().top - $(window).height()/2
        }, 1500);
        setTimeout(function(){
            $("#"+id).css({backgroundColor: ''});
            $("#"+id).css({color: '#666'});
        },5000);
    });

    // Get The Id
    var topPage = document.getElementById("top-page")

    // On Click, Scroll to the Top of Page
    topPage.onclick = () => window.scrollTo({ top: 800, behavior: 'smooth'}) // Remove behavior: 'smooth' if you don't want smooth scrolling

    // On scroll, Show/Hide the button
    window.onscroll = () => {
    window.scrollY > 800 // You can change the value if you want
        ? (topPage.style.display = "block")
        : (topPage.style.display = "none")
    }
</script>
<a id="top-page">Top</a>