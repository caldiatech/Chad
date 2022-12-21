<!-- Author : Don Pablo -->
@extends('layouts._admin.base')

@section('content')
<style>
    .classWidth {
        width: 50px !important;
    }
    ul.prints {
        list-style-type:none;
    }

    ul.pagination li{
        display:inline!important;
    }
    
    ul.pagination li span {
    
    }


    ul.pagination li {
        margin: 20px 20px 30px 0;
    }
    input[type="text"]{
        outline: 0 !important;
        height: 40px;
        border: 1px solid #ddd;
        width: 200px;
    }
    select{
        outline: 0 !important;
        height: 40px;
        border: 1px solid #ddd;
        width: 150px;
    }

    .alert-primary {
        color: #004085;
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
</style>

<br>
<br>

<ul id="prints_container" class="prints">
    <li class="boxfields">

        <div class="print_list_container">
            <table id="page_manager" class="parennt-table uk-table-hover">
                <thead>
                    <tr>
                        <td style="text-indent: 2px !important;width:50px"><b>Print Name</b></td>
                        <td style="text-indent: 2px !important;width:50px; display:none;"><b>Base Price</b></td>
                        <td style="text-indent: 2px !important;width:50px; display:none;"><b>Frame Low Cost</b></td>
                        <td style="text-indent: 2px !important;width:50px; display:none;"><b>Frame High Cost</b></td>
                        <td style="text-indent: 2px !important;width:25px text-align:center;"><b>Action</b></td>
                    </tr>
                </thead>
                <tbody>
                @foreach(App\Models\Prints::get() as $print)
                    <tr>
                        <td style="text-indent: 2px !important;width:50px">
                            <input type="radio" id="namePrint{{$print->id}}" name="print_id" class="getFramePrints" data-id = "{{$print->id}}" value="{{$print->id}}" {{ isset($_GET['print_id']) && !empty($_GET['print_id']) && $_GET['print_id'] == $print->id ? 'checked' : '' }}>
                            {{$print->name}}
                        </td>
                        <td style="text-indent: 2px !important;width:50px; display:none;">${{$print->price}}</td>
                        <td style="text-indent: 2px !important;width:50px; display:none;">${{$print->low_cost}}</td>
                        <td style="text-indent: 2px !important;width:50px; display:none;">${{$print->hi_cost}}</td>
                        <td style="text-indent: 2px !important;width:25px; text-align:left;" class="edit_print">
                            <a href="javascript:void(0)" data-print_name="{{$print->name}}" data-low_cost="{{$print->low_cost}}" data-hi_cost="{{$print->hi_cost}}" data-print_price="{{$print->price}}" data-print_id="{{$print->id}}">
                                {{--  <img src="{{url('_admin/assets/images/icons/page_modify.png')}}">  --}}
                                <i class="pe-7s-pen action-icon"></i>
                            </a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>

        <div class="print_container" style="display: none;">
            <form method="POST" action="{{url('/dnradmin/edit_print')}}" accept-charset="UTF-8" id="form_print" style="clear: both;border: 1px solid #eee;background: #fff;position: relative;top: 10px;margin-bottom: 50px;padding: 40px 30px;">
                <table class="parennt-table uk-table-hover">
                    <tbody>
                    <tr>
                        <td style="padding:5px 5px;">
                            Name:&nbsp;
                            <input type="text" name="print_name" style="width:150px;" id="print_name">
                            <input type="hidden" name="print_id" style="width:150px;" id="print_id">
                        </td>
                    </tr>
                    <tr style="display:none!important;">
                        <td style="padding:5px 5px;">
                            Price:&nbsp;
                            <input type="text" name="print_price" class= "decimal" style="width:150px;" id="print_price">
                        </td>
                    </tr>

                    <tr style="display:none!important;">
                        <td style="padding:5px 5px;">
                            Frame Low Cost:&nbsp;
                            <input type="text" name="print_low_cost" class= "decimal" value="80" style="width:150px;" id="print_low_cost">
                        </td>
                    </tr>

                    <tr style="display:none!important;">
                        <td style="padding:5px 5px;">
                            Frame High Cost:&nbsp;
                            <input type="text" name="print_hi_cost" class= "decimal" value="80" style="width:150px;" id="print_hi_cost">
                        </td>
                    </tr>

                    <tr>
                        <td style="padding:5px 5px">
                            <button type="button" class="uk-button uk-button-success update_print">Update Print</button>
                            <button type="button" class="uk-button uk-button-dark cancel_print">Cancel</button>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </form>
        </div>
    </li>


    <li class="boxfields">

            <div class="container printcontent" style="display:none; margin-top: 5em;">
                <?php
                    if (isset($_GET['print_id']) || !empty($_GET['print_id'])) {
                        $print_id = $_GET['print_id'];
                        $sizelist = App\Models\SizeListModel::where('print_id',$print_id)->where('deleted',0)->paginate(10);
                        $sizetitle = App\Models\Prints::where('id',$print_id)->get();
                    } else {
                        $print_id = 0;
                        $sizelist = 0;
                        $sizetitle = 0;
                    }
                ?>
                    @if($print_id != 0)
            
                    <div class="print_list_container" >
                        <div >
                            <div id="page_control">      
                                <div class="">                      
                                <h3 style="color: #777;">Prints Size & Price : {{ $sizetitle[0]->name }}</h3>
                                
                            </div>
                            </div>
                            <br>
                            <br>
                        
                        
                            <br>
                        </div>
            
                        
                        <table class="parennt-table uk-table-hover">
            
                            <tbody>
            
            
                                
                                @if(count($sizelist))
                                    @foreach($sizelist as $field)
                                        <?php
                                            
                                            $sizedesc = $field->width. " " .\App\Models\SizeListModel::frameFraction($field->fractionWidth). " x " .$field->height." ".\App\Models\SizeListModel::frameFraction($field->fractionHeight)
                                        ?>
                                        <tr id="rowSize{{$field->id}}">
                                            <td style="">
                                                <span id="spansizedescription{{$field->id}}">{{ $sizedesc }}</span>
                                            </td>
                                            <td style="">
            
                                                {{--  <span style="display:none !important;" id="spansizewidth{{$field->id}}">{{$field->width}}</span>  --}}
                                                <input type="text" style="display:none;" class="classWidth" value="{{$field->width}}" name="sizewidth{{$field->id}}" id="sizewidth{{$field->id}}">
            
                                            </td>
            
            
                                            <td style="">
            
                                                {{--  <span style="display:none !important;" id="spansizefractionwidth{{$field->id}}">{{\App\Models\SizeListModel::frameFraction($field->fractionWidth)}}</span>  --}}
                                                <select class="classWidth" name="sizefractionwidth{{$field->id}}" style="display:none;" id="sizefractionwidth{{$field->id}}">
                                                        <option value=".0" selected="'selected'">0</option>
                                                        <option value=".125">1/8</option>
                                                        <option value=".25">1/4</option>
                                                        <option value=".375">3/8</option>
                                                        <option value=".5">1/2</option>
                                                        <option value=".625">5/8</option>
                                                        <option value=".75">3/4</option>
                                                        <option value=".875">7/8</option>  
                                                </select>
                                            </td>
            
            
                                            <td style="">
            
                                                {{--  <span style="display:none !important;" id="spansizeheight{{$field->id}}">{{$field->height}}</span>  --}}
                                                <input type="text" class="classWidth" style="display:none;" value="{{$field->height}}" name="sizeheight{{$field->id}}" id="sizeheight{{$field->id}}">
            
                                            </td>
            
                                            <td style="">
            
                                                {{--  <span style="display:none !important;" id="spansizefractionheight{{$field->id}}">{{\App\Models\SizeListModel::frameFraction($field->fractionHeight)}}</span>  --}}
                                                <select class="classWidth" name="sizefractionheight{{$field->id}}" style="display:none;" id="sizefractionheight{{$field->id}}">
                                                        <option value=".0" selected="'selected'">0</option>
                                                        <option value=".125">1/8</option>
                                                        <option value=".25">1/4</option>
                                                        <option value=".375">3/8</option>
                                                        <option value=".5">1/2</option>
                                                        <option value=".625">5/8</option>
                                                        <option value=".75">3/4</option>
                                                        <option value=".875">7/8</option>  
                                                </select>
                                                
                                            </td>
            
            
                                            <td style="">
            
                                                $<span id="spansizeprice{{$field->id}}">{{$field->price}}</span>
                                                <input class="classWidth" type="text" style="display:none;" value="{{$field->price}}" class="decimal" name="sizeprice{{$field->id}}" id="sizeprice{{$field->id}}">
            
                                            </td>
                                            <td>
                                                <button type="button" data-id="{{$field->id}}" class="uk-button uk-button-primary uk-button-small updateSize updateSize{{$field->id}}" style="display:none;">Update</button>
                                                <button type="button" data-id="{{$field->id}}" class="uk-button uk-button-default uk-button-small cancelSize cancelSize{{$field->id}}" style="display:none;">Cancel</button>
                                                <a class="editSize" id="editSize{{$field->id}}" data-id="{{$field->id}}">
                                                    {{--  <img src="{{url('_admin/assets/images/icons/page_modify.png')}}">  --}}
                                                    <i class="pe-7s-pen action-icon"></i>
                                                </a>
            
                                                <a class="deleteSize" data-id="{{$field->id}}">
                                                    {{--  <img src="{{url('_admin/assets/images/icons/page_delete.png')}}">  --}}
                                                    <i class="pe-7s-trash action-icon del"></i>
                                                </a>
                                            </td>
                                        </tr>
            
                                    @endforeach
                            
                                @endif
            
                            </tbody>
                        </table>
                                @if(count($sizelist) <= 0)
                                    <em>No Records Found, Click Add New Size.</em>
                                @endif
                            
                        
                    @endif
            
                    @if(count($sizelist) != 0)
                    {{--  {!!  $sizelist->appends(request()->except('page'))->render() !!}  --}}
                    @endif
                    </div>
            </div>
            <br><br>
            <a href="#" class="uk-button uk-button-dark btnAddsize"><img src="{{ asset('_admin/assets/images/icons/icon_add.png') }}"> Add Products</a>  
            
            
            
            
            <ul class="prints" style="margin:0 auto; margin-top:2em;">
                <li class="boxfields">
                    <div class="container addsizediv" style="display:none;">
                        <div class="alert alert-primary" role="alert" style="width: 200px;">
                            Note: Add new size here
                            </div>
                        <ul class="prints">

                            <li>
                                Height : <br><input type="text" name="size_height" style="width:150px;" id="sizeheight" placeholder="e g 30">
                            </li>
                            <li>&nbsp;</li>

                            <li>
                                Frction Height : <br><select name="sizefractionheight" id="sizefractionheight">
                                                <option value=".0">0</option>
                                                <option value=".125">1/8</option>
                                                <option value=".25" selected="'selected'">1/4</option>
                                                <option value=".375">3/8</option>
                                                <option value=".5">1/2</option>
                                                <option value=".625">5/8</option>
                                                <option value=".75">3/4</option>
                                                <option value=".875">7/8</option>  
                                        </select>
                            </li>
                            <li>&nbsp;</li>


                            <li>
                                Width : <br><input type="text" name="size_width" style="width:150px;" id="sizewidth" placeholder="e g 30">
                            </li>
                            <li>&nbsp;</li>


                            <li>
                                Fraction Width : <br><select name="sizefractionwidth" id="sizefractionwidth">
                                                <option value=".0" selected="'selected'">0</option>
                                                <option value=".125">1/8</option>
                                                <option value=".25">1/4</option>
                                                <option value=".375">3/8</option>
                                                <option value=".5">1/2</option>
                                                <option value=".625">5/8</option>
                                                <option value=".75">3/4</option>
                                                <option value=".875">7/8</option>  
                                        </select>
                            </li>
                            <li>&nbsp;</li>

                        
                            
                            <li>
                                Price : <br><input type="text" class="decimal" name="size_price" style="width:150px;" placeholder="e g 1000.00" id="size_price">
                            </li>
                            <li>&nbsp;</li>
                            <li>Category : <br>
                                <select id="print_size_id" name="print_size_id">
                                    @if(count(App\Models\Prints::get()))
                                        @foreach(App\Models\Prints::get() as $print_list)
                                            <option value="{{$print_list->id}}">{!! $print_list->name!!}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </li>
                            <li>&nbsp;</li>
                            <li>&nbsp;</li>
                            <li>
                                <button type="button" class="uk-button uk-button-dark btnAddsizesave" style="background: #1d8acb; color: #fff;">Save</button>
                                <button type="button" class="uk-button uk-button-dark btnAddsizecancel">Cancel</button>
                            </li>
                        </ul>
                        
                    </div>
                </li>
            </ul>


    </li>
</ul>


@stop

@section('headercodes')    
  {!! Html::style('_admin/plugins/jasny/css/jasny-bootstrap.min.css') !!}    
  <style type="text/css">   
  </style>    
@stop

@section('extracodes')

    {!! Html::script('_admin/manager/tinymce/tiny_mce.js') !!}
    {!! Html::script('_admin/assets/js/jquery-latest.min.js') !!}
    {!! Html::script('_admin/assets/js/customValidation.js') !!}
    {!! Html::script('_admin/manager/tinymce/styles/mods5.js') !!}
    {!! Html::script('_admin/assets/js/count_char.js') !!}
    {!! Html::script('_admin/plugins/jasny/js/jasny-bootstrap.min.js') !!} 	     
    <script>
        $(document).ready(function() {
            // Base URL for Ajax Request
            //var url_print = 'http://localhost/clarkin123/dnradmin/edit_print';
            //var url_size = 'http://localhost/clarkin123/dnradmin/product_show_prints/add_size_list';
            //var url_updatesize = 'http://localhost/clarkin123/dnradmin/product_show_prints/edit_size_list';
            //var url_deletesize = 'http://localhost/clarkin123/dnradmin/product_show_prints/delete_size_list';
            
            
            //var url_print = 'http://54.68.88.28/clarkin123/dnradmin/edit_print';
            //var url_size = 'http://54.68.88.28/clarkin123/dnradmin/product_show_prints/add_size_list';
            //var url_updatesize = 'http://54.68.88.28/clarkin123/dnradmin/product_show_prints/edit_size_list';
            //var url_deletesize = 'http://54.68.88.28/clarkin123/dnradmin/product_show_prints/delete_size_list';

            var url_print = 'http://44.238.169.246/clarkin123/dnradmin/edit_print';
            var url_size = 'http://44.238.169.246/clarkin123/dnradmin/product_show_prints/add_size_list';
            var url_updatesize = 'http://44.238.169.246/clarkin123/dnradmin/product_show_prints/edit_size_list';
            var url_deletesize = 'http://44.238.169.246/clarkin123/dnradmin/product_show_prints/delete_size_list';


            //Show Print Content if Print ID Exists
            var print_id = "{{$print_id}}";
            if ( print_id != 0 ) {
                $(".printcontent").show();
            }

            function frameFraction(fraction) {
                var fraction_result = '';
                if(fraction == ".0") {
                    fraction_result = "0";
                } else if(fraction == ".125") {
                    fraction_result = "1 / 8";
                } else if(fraction == ".25") {
                    fraction_result = "1 / 4";
                } else if(fraction == ".375") {
                    fraction_result = "3 / 8";
                } else if(fraction == ".5") {
                    fraction_result = "1 / 2";
                } else if(fraction == ".625") {
                    fraction_result = "5 / 8";
                } else if(fraction == ".75") {
                    fraction_result = "3 / 4";
                } else if(fraction == ".875") {
                    fraction_result = "7 / 8";
                }
                return fraction_result;
            }
            
            //Front End & Ajax Request
            $(".edit_print a").click(function(evt) {
                evt.preventDefault();

                var name = $(this).data('print_name');
                var price = $(this).data('print_price');
                var low_cost = $(this).data('low_cost');
                var hi_cost = $(this).data('hi_cost');
                var id = $(this).data('print_id');

                $('#print_name').val(name);
                $('#print_price').val(price);
                $('#print_low_cost').val(low_cost);
                $('#print_hi_cost').val(hi_cost);
                $('#print_id').val(id);

                $('.print_container').show();
                $('.print_list_container').hide();
            });

            $(".cancel_print").on('click',function(){
                $('.print_container').hide();
                $('.print_list_container').show();
            });

            $('.update_print').on('click',function(){

                $.ajax({
                    type: 'POST',
                    url: url_print,
                    data: {

                        _token: '<?php echo e(csrf_token()); ?>',
                        name:  $('#print_name').val(),
                        price: $('#print_price').val(),
                        low_cost: $('#print_low_cost').val(),
                        hi_cost: $('#print_hi_cost').val(),
                        id: $('#print_id').val()
                    },
                    success: function () {
                        location.reload();
                    }
                });

            });


            $(".getFramePrints").on('click',function(){
                var id = $(this).attr('data-id');
                $(".printcontent").show();
                location.href="{{ url('dnradmin/product_show_prints') }}"+"?print_id="+id;
            });


            $(".btnAddsize").on('click',function(){
                $(".addsizediv").show();
            });
            
            
            $(".btnAddsizecancel").on('click',function(){
                $(".addsizediv").hide();
            });

            $(".btnAddsizesave").on('click',function(){
                //var size_title = $('#size_title').val();
                var size_height = $('#sizeheight').val();
                var size_fraction_height = $('#sizefractionheight').val();
                var size_width = $('#sizewidth').val();
                var size_fraction_width = $('#sizefractionwidth').val();


                var size_price = $('#size_price').val();
                var print_size_id = $('#print_size_id').val();

                if ( size_price == "" ) {
                    alert("Price is required!");
                } else {
                    $.ajax({
                        type: 'POST',
                        url: url_size,
                        data: {
                            _token: '<?php echo e(csrf_token()); ?>',
                            size_height:size_height,
                            size_fraction_height:size_fraction_height,
                            size_width:size_width,
                            size_fraction_width:size_fraction_width,

                            price:size_price,
                            print_size_id:print_size_id
                        },
                        success: function (data) {
                            alert("Successfully saved!");
                            location.href="{{ url('dnradmin/product_show_prints') }}"+"?print_id="+print_size_id;
                        }
                    });
                }
            });

            $(".editSize").on('click',function(){
                var id = $(this).attr('data-id');
    
                //$("#sizetitle"+id).show();

                //$("#spansizedescription"+id).hide();

                $("#sizeheight"+id).show();
                $("#sizefractionheight"+id).show();
                $("#sizewidth"+id).show();
                $("#sizefractionwidth"+id).show();



                $("#sizeprice"+id).show();
                $(".updateSize"+id).show();
                $(".cancelSize"+id).show();
    
                //$("#spansizetitle"+id).hide();

                $("#spansizeheight"+id).hide();
                $("#spansizefractionheight"+id).hide();
                $("#spansizewidth"+id).hide();
                $("#spansizefractionwidth"+id).hide();
                
                $("#spansizeprice"+id).hide();
                $("#editSize"+id).hide();

                $("#rowSize"+id).attr("style","background-color:#a2a2a2; color:#fff;");
            });
    
            $(".cancelSize").on('click',function(){
                var id = $(this).attr('data-id');
    
                //$("#sizetitle"+id).hide();
                //$("#spansizedescription"+id).show();

                $("#sizeheight"+id).hide();
                $("#sizefractionheight"+id).hide();
                $("#sizewidth"+id).hide();
                $("#sizefractionwidth"+id).hide();
                
                
                $("#sizeprice"+id).hide();
                $(".updateSize"+id).hide();
                $(".cancelSize"+id).hide();
    
                //$("#spansizetitle"+id).show();

                $("#spansizeheight"+id).show();
                $("#spansizefractionheight"+id).show();
                $("#spansizewidth"+id).show();
                $("#spansizefractionwidth"+id).show();

                $("#spansizeprice"+id).show();
    
                $("#editSize"+id).show();
                $("#rowSize"+id).attr("style","background-color:none; color:#000000;");
            });
    
            $(".updateSize").on('click',function(){
                var id = $(this).attr('data-id');
                //var title = $("#sizetitle"+id).val();
                
                var size_height = $("#sizeheight"+id).val();
                var size_fraction_height = $("#sizefractionheight"+id).val();
                var size_width = $("#sizewidth"+id).val();
                var size_fraction_width = $("#sizefractionwidth"+id).val();

                var spansizedescription = size_height+" "+frameFraction(size_fraction_height)+" x "+size_width+" "+frameFraction(size_fraction_width);

                var price = $("#sizeprice"+id).val();
    
    
                $.ajax({
                    type: 'POST',
                    url: url_updatesize,
                    data: {
                        _token: '<?php echo e(csrf_token()); ?>',
                        id:id,
                        size_height:size_height,
                        size_fraction_height:size_fraction_height,
                        size_width:size_width,
                        size_fraction_width:size_fraction_width,
                        price: price
                    },
                    success: function (data) {
                        //$("#spansizetitle"+id).html(title);

                        $("#spansizedescription"+id).html(spansizedescription);
                        $("#spansizeheight"+id).html(size_height);
                        $("#spansizefractionheight"+id).html(frameFraction(size_fraction_height));
                        $("#spansizewidth"+id).html(size_width);
                        $("#spansizefractionwidth"+id).html(frameFraction(size_fraction_width));
                       

                        $("#spansizeprice"+id).html(price);


                        //$("#sizetitle"+id).val(title);
                        $("#sizeheight"+id).html(size_height);
                        //$("#sizefractionheight"+id).html(size_fraction_height);
                        $("#sizewidth"+id).html(size_width);
                        //$("#sizefractionwidth"+id).html(size_fraction_width);

                        $("#sizeprice"+id).val(price);
                        //location.href="{{ url('dnradmin/product_show_prints') }}"+"?print_id="+id;
                        location.reload();
                        alert("Successfully Updated!");
                    }
                });
                
            });
    
            $(".deleteSize").on('click',function(){
                var id = $(this).attr('data-id');
                $.ajax({
                    type: 'POST',
                    url: url_deletesize,
                    data: {
                        _token: '<?php echo e(csrf_token()); ?>',
                        id:id
                    },
                    success: function (data) {
                        $("#rowSize"+id).hide();
                        alert("Successfully deleted!");
                    }
                });
            });

            //Validation
            $('.decimal').keypress(function(evt){
                return (/^[0-9]*\.?[0-9]*$/).test($(this).val()+evt.key);
            });


        });

        
    </script>

@stop



