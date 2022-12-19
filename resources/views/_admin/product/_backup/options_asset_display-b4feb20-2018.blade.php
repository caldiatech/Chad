
			   	<table id="page_manager{!!$option_id!!}1" style="margin-top:-5px" class="uk-table">     
                        @foreach($options as $optionss)

                        	<tr id="{{$optionss->fldOptionsAssetsID.'_'.$optionss->fldOptionsAssetsPosition}}">
                            	<td style="padding: 5px 3px;"> <input type="checkbox" class="check-select" name="options_assets[]" value="{!! $optionss->fldOptionsAssetsID !!}" onclick="displayAssetsPrice({!! $optionss->fldOptionsAssetsID !!},this.checked)" {!! DB::table('tblProductOptions')->where('fldProductOptionsAssetsID','=',$optionss->fldOptionsAssetsID)->where('fldProductOptionsProductID','=',$product_id)->count()>=1 ? "checked='checked'" : "" !!}/></td>
                                <td style="padding: 5px 3px; width:150px;">{{  $optionss->fldOptionsAssetsWidth }} {{ \App\Models\ProductOptions::frameFraction($optionss->fldOptionsAssetsWidthFraction)}} x {{  $optionss->fldOptionsAssetsHeight }} {{ \App\Models\ProductOptions::frameFraction($optionss->fldOptionsAssetsHeightFraction)}}</td>
                                <td style="padding: 5px 3px;" class="dragHandle">
                                	{!! Html::image('_admin/assets/images/icons/updown.png') !!}                        			
                            		<span style="border:1px #fff solid; padding:5px 10px;">{{ $optionss->fldOptionsAssetsPosition }}</span>
                                </td>
                                <td style="padding: 5px 3px;">
                                                        <a href="javascript:void(0)" onClick="editAssetsOptions({{$optionss->fldOptionsAssetsID}},{{$option_id}},{{ $product_id }})"><img src="{!!url('_admin/assets/images/icons/page_modify.png')!!}"></a>                                               
                                                        <a href="javascript:void(0)" onClick="deleteAssetsOptions({{$optionss->fldOptionsAssetsID}},{{$option_id}})"><img src="{!!url('_admin/assets/images/icons/page_delete.png')!!}"></a>


                                </td>
                            </tr>   
			  
                           <? /* <tr id="assets{!!$optionss->fldOptionsID!!}" style="{!!DB::table('tblProductOptions')->where('fldProductOptionsAssetsID','=',$optionss->fldOptionsAssetsID)->where('fldProductOptionsProductID','=',$product_id)->count()>=1 ? '' : 'display:none' !!}" > */ ?>
			   <tr id="assets{!!$optionss->fldOptionsID!!}">

                            	<td colspan="4" style="padding:5px 5px;"> $
                                	
                                   
                                	<input type="text" name="assets_price[{!!$optionss->fldOptionsAssetsID!!}]" value="{!! DB::table('tblProductOptions')->where('fldProductOptionsAssetsID','=',$optionss->fldOptionsAssetsID)->where('fldProductOptionsProductID','=',$product_id)->pluck('fldProductOptionsPrice'); !!}" placeholder="New Price" />
                                	<input type="hidden" name="assets_id[]" value="{!!$optionss->fldOptionsID!!}" />
                                </td>
                                
                            </tr>                         
                        @endforeach    
                </table>        
                        <div style="margin-bottom:15px; margin-left:55px;padding: 5px 3px;">
                        	<button type="button" name="button" class="uk-button uk-button-success" onClick="addAssetsOptions({!!$option_id!!},{!!$product_id!!})">Add New Options Assets</button>
                         </div>
                   
                   
          {!! Html::script('_admin/assets/js/jquery.tablednd.js','') !!}
          <script>
		  	
			
			$('#page_manager{!!$option_id!!}1').tableDnD({
					onDrop: function(table, row) {						
						$.ajax({			
					
							type: "get",
							url: mypath+"/dnradmin/product_options_assets/update-position/{!!$option_id!!}",
							data: $.tableDnD.serialize(),
							cache: false,
							success: function(data){
								$('#product_options_assets{!!$option_id!!}').load(mypath+'/dnradmin/product_options_assets/display/{!!$option_id!!}');							
							}
							
						});	
					},
                    dragHandle: '.dragHandle'
			});
		  </script>                                            