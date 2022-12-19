
			   	<table id="page_manager5" class="uk-table">     
                        @foreach($options as $optionss)
                        	<tr id="{!!$optionss->fldOptionsID.'_'.$optionss->fldOptionsPosition!!}">
                            	<td style="padding: 5px 3px;"> <input type="checkbox" class="check-select" name="options[]" value="{!! $optionss->fldOptionsID !!}" onclick="displayOptionsAssets({!! $optionss->fldOptionsID !!},this.checked,0)" {!! DB::table('tblProductOptions')->where('fldProductOptionsOptionsID','=',$optionss->fldOptionsID)->where('fldProductOptionsProductID','=',$product_id)->count()>=1 ? "checked='checked'" : "" !!}/></td>
                                <td style="padding: 5px 3px;width:150px;">{{ $optionss->fldOptionsName }}</td>
                                <td style="padding: 5px 3px;">
                                	{!! Html::image('_admin/assets/images/icons/updown.png') !!}                        			
                            		<span style="border:1px #fff solid; padding:5px 10px;">{!! $optionss->fldOptionsPosition !!}</span>
                                </td>
                                <td style="padding: 5px 3px;">
                                		 <a href="javascript:void(0)" onClick="editOptions({{$optionss->fldOptionsID}})"><img src="{!!url('_admin/assets/images/icons/page_modify.png')!!}"></a>                                               
                                         <a href="javascript:void(0)" onClick="deleteOptions({{$optionss->fldOptionsID}})"><img src="{!!url('_admin/assets/images/icons/page_delete.png')!!}"></a>

                            </tr>                            
                        @endforeach    
                </table>        
                		<? /*	
                        <div style="margin-bottom:15px; margin-left:55px;padding: 5px 3px;">
                        	<button type="button" name="button" onClick="addOptions()">Add New Options</button>
                         </div>
                         */ ?>
                   
                   
          {!! Html::script('_admin/assets/js/jquery.tablednd.js','') !!}
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