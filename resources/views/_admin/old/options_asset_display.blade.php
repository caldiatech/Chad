
			   	<table id="page_manager{{$option_id}}" style="width:225px !important; border:none; margin-top:-5px">
                        @foreach($options as $optionss)
                        	<tr id="{{$optionss->id.'_'.$optionss->position}}">
                            	<td style="padding: 5px 3px;"> <input type="checkbox" name="options_assets[]" value="{{ $optionss->id }}" onclick="displayAssetsPrice({{ $optionss->id }},this.checked)" {{ DB::table('products_options')->where('option_assets_id','=',$optionss->id)->where('product_id','=',$product_id)->count()>=1 ? "checked='checked'" : "" }}/></td>
                                <td style="padding: 5px 3px;">{{ $optionss->name }}</td>
                                <td style="padding: 5px 3px;">
                                	{{ HTML::image('_admin/assets/images/icons/updown.png') }}
                            		<span style="border:1px #999999 solid; padding:5px 10px;">{{ $optionss->position }}</span>
                                </td>
                                <td style="padding: 5px 3px;">{{ HTML::image_link('#','_admin/assets/images/icons/page_modify.png','',' Modify Page',array("onClick"=>"editAssetsOptions($optionss->id,$option_id)")) }}                                    {{ HTML::image_link('#','_admin/assets/images/icons/page_delete.png','',' Delete Page',array("onClick"=>"deleteAssetsOptions($optionss->id,$option_id)")) }}</td>
                            </tr>
                            <tr id="assets{{$optionss->id}}" style="{{DB::table('products_options')->where('option_assets_id','=',$optionss->id)->where('product_id','=',$product_id)->count()>=1 ? '' : 'display:none' }}" >
                            	<td colspan="4" style="padding:5px 5px;"> $


                                	<input type="text" name="assets_price[{{$optionss->id}}]" value="{{ DB::table('products_options')->where('option_assets_id','=',$optionss->id)->where('product_id','=',$product_id)->pluck('option_price'); }}" placeholder="Additional Price" />
                                	<input type="hidden" name="assets_id[]" value="{{$optionss->id}}" />
                                </td>

                            </tr>
                        @endforeach
                </table>
                        <div style="margin-bottom:15px; margin-left:55px;padding: 5px 3px;">
                        	<button type="button" name="button" onClick="addAssetsOptions({{$option_id}})">Add New Options Assets</button>
                         </div>


          {{ HTML::script('_admin/assets/js/jquery.tablednd.js') }}
          <script>


			$('#page_manager{{$option_id}}').tableDnD({
					onDrop: function(table, row) {
						$.ajax({

							type: "get",
							url: mypath+"/dnradmin/product_options_assets/update-position/{{$option_id}}",
							data: $.tableDnD.serialize(),
							cache: false,
							success: function(data){
								$('#product_options_assets{{$option_id}}').load(mypath+'/dnradmin/product_options_assets/display/{{$option_id}}');
							}

						});
					}
			});
		  </script>
