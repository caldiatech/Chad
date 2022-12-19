
			   	<table id="page_manager5" style="width:225px !important; border:none; margin-top:-5px">     
                        @foreach($options as $optionss)
                        	<tr id="{{$optionss->id.'_'.$optionss->position}}">
                            	<td style="padding: 5px 3px;"> <input type="checkbox" name="options[]" value="{{ $optionss->id }}" onclick="displayOptionsAssets({{ $optionss->id }},this.checked,0)" {{ DB::table('products_options')->where('option_id','=',$optionss->id)->where('product_id','=',$product_id)->count()>=1 ? "checked='checked'" : "" }}/></td>
                                <td style="padding: 5px 3px;">{{ $optionss->name }}</td>
                                <td style="padding: 5px 3px;">
                                	{{ HTML::image('_admin/assets/images/icons/updown.png') }}                        			
                            		<span style="border:1px #999999 solid; padding:5px 10px;">{{ $optionss->position }}</span>
                                </td>
                                <td style="padding: 5px 3px;">{{ HTML::image_link('#','_admin/assets/images/icons/page_modify.png','',' Modify Page',array("onClick"=>"editOptions( $optionss->id)")) }}                                    {{ HTML::image_link('#','_admin/assets/images/icons/page_delete.png','',' Delete Page',array("onClick"=>"deleteOptions( $optionss->id)")) }}</td>
                            </tr>                            
                        @endforeach    
                </table>        
                        <div style="margin-bottom:15px; margin-left:55px;padding: 5px 3px;">
                        	<button type="button" name="button" onClick="addOptions()">Add New Options</button>
                         </div>
                   
                   
          {{ HTML::script('_admin/assets/js/jquery.tablednd.js','') }}
          <script>
		  	
			
			$('#page_manager5').tableDnD({
					onDrop: function(table, row) {						
						$.ajax({			
					
							type: "get",
							url: mypath+"/dnradmin/product_options/update-position",
							data: $.tableDnD.serialize(),
							cache: false,
							success: function(data){
								$('#product_options').load(mypath+'/dnradmin/product_options');							
							}
							
						});	
					}
			});
		  </script>                                            