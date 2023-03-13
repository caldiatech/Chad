
			   	<table id="page_manager5" class="uk-table"  width="100%">
                        @foreach($options as $optionss)
                        	<tr id="{!!$optionss->fldOptionsID.'_'.$optionss->fldOptionsPosition!!}">
                            	<td style="padding: 5px 3px;" width="10%"> <input type="checkbox" class="check-select" name="options[]" value="{!! $optionss->fldOptionsID !!}" onclick="displayOptionsAssets({!! $optionss->fldOptionsID !!},this.checked,0)" {!! DB::table('tblProductOptions')->where('fldProductOptionsOptionsID','=',$optionss->fldOptionsID)->where('fldProductOptionsProductID','=',$product_id)->count()>=1 ? "checked='checked'" : "" !!}/></td>
                                <td style="padding: 5px 3px;" width="50%">{{ $optionss->fldOptionsName }}</td>
                                <td style="padding: 5px 3px;" width="20%">
                                	{!! Html::image('_admin/assets/images/icons/updown.png') !!}                        			
                            		<span style="border:1px #fff solid; padding:5px 10px;">{!! $optionss->fldOptionsPosition !!}</span>
                                </td>
                                <td style="padding: 5px 3px;" width="20%">
                                		 <a href="javascript:void(0)" onClick="editOptions({{$optionss->fldOptionsID}})"><img src="{!!url('_admin/assets/images/icons/page_modify.png')!!}"></a>                                               
                                         <a href="javascript:void(0)" onClick="deleteOptions({{$optionss->fldOptionsID}})"><img src="{!!url('_admin/assets/images/icons/page_delete.png')!!}"></a>

                            </tr>                            
                        @endforeach    
                </table>        
                	
                   
                   
          {!! Html::script('_admin/assets/js/jquery.tablednd.js') !!}
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