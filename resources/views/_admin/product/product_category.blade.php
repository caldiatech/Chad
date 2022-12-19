			   	<table id="page_manager" class="uk-table">     
                        @foreach($category as $categories)
                        	<tr id="{!!$categories->fldCategoryID.'_'.$categories->fldCategoryPosition!!}">
                            	<td style="text-indent: 2px !important;"> <input type="checkbox" class="check-select"  name="category[]"  value="{!! $categories->fldCategoryID !!}" {!! DB::table('tblProductCategory')->where('fldProductCategoryCategoryID','=',$categories->fldCategoryID)->where('fldProductCategoryProductID','=',$product_id)->count()==1 ? "checked='checked'" : "" !!} /></td>
                                <td style="text-indent: 2px !important;width:150px" >{!! $categories->fldCategoryName !!}</td>
                                <td style="text-indent: 2px !important;" class="dragHandle">
                                	{!! Html::image('_admin/assets/images/icons/updown.png') !!}                        			
                            		<span style="border:1px #999999 solid; padding:5px 8px;">{!! $categories->fldCategoryPosition !!}</span>
                                </td>
                                <td style="text-indent: 2px !important;">
                                	<a href="javascript:void(0)" onClick="editCategory({!!$categories->fldCategoryID!!})"><img src="{!!url('_admin/assets/images/icons/page_modify.png')!!}"></a>                                               
                                    <a href="javascript:void(0)" onClick="deleteCategory({!!$categories->fldCategoryID!!})"><img src="{!!url('_admin/assets/images/icons/page_delete.png')!!}"></a>
                                		                     
                        @endforeach    
                </table>        
                        <div style="margin-bottom:15px; margin-left:55px">
                        	<button type="button" class="uk-button uk-button-success" name="button" onClick="addCategory(0)">Add Category</button>
                         </div>
                   
                   
          {!! Html::script('_admin/assets/js/jquery.tablednd.js','') !!}
          <script>
		  	
			
			$('#page_manager').tableDnD({
					onDrop: function(table, row) {						
						$.ajax({			
					
							type: "get",
							url: mypath+"/dnradmin/category/update-position",
							data: $.tableDnD.serialize(),
							cache: false,
							success: function(data){
								$('#category').load(mypath+'/dnradmin/category/display');							
							}
							
						});	
					},
					dragHandle: ".dragHandle"
			});
		  </script>         
                   