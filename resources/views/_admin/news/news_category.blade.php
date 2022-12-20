			   	<table id="page_manager" style="width:225px !important; border:none; margin-top:-5px">     
                        @foreach($category as $categories)
                        	<tr id="{!!$categories->fldNewsCategoryID.'_'.$categories->fldNewsCategoryPosition!!}">
                            	<td> <input type="radio" name="category_id" value="{!! $categories->fldNewsCategoryID !!}" {!! $category_id==$categories->fldNewsCategoryID ? "checked='checked'" : "" !!} /></td>
                                <td>{!! $categories->fldNewsCategoryName !!}</td>
                                <td>
                                	{!! Html::image('_admin/assets/images/icons/updown.png') !!}                        			
                            		<span style="border:1px #999999 solid; padding:5px 10px;">{!! $categories->fldNewsCategoryPosition !!}</span>
                                </td>   
                                <td>                             
                                   <a href="javascript:void(0)" onClick="editCategory( {{ $categories->fldNewsCategoryID }} )"><img src="{{url('_admin/assets/images/icons/page_modify.png')}}"></a>
                                </td>
                            </tr>                            
                        @endforeach    
                </table>        
                        <div style="margin-bottom:15px; margin-left:55px">
                        	<button type="button" name="button" onClick="addCategory()">Add New Category</button>
                         </div>
                   
                   
          {!! Html::script('_admin/assets/js/jquery.tablednd.js') !!}
          <script>
		  	 $('#page_manager').tableDnD({
					onDrop: function(table, row) {						
						$.ajax({	
							type: "get",
							url: "{!! url('dnradmin/news-category/update-position') !!}",
							data: $.tableDnD.serialize(),
							cache: false,
							success: function(data){								
								$('#news_category').load(mypath+'/dnradmin/news-category');
							}
							
						});	
					}
			});
		  </script>         
                   