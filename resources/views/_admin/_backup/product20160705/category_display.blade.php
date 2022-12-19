
			   	<table id="page_manager1" style="width:239px !important; border:none; margin-top:-5px">     
                        @foreach($category as $categories)
                        	<tr id="{{$categories->fldCategoryID.'_'.$categories->fldCategoryPosition}}">
                            	<td style="padding: 5px 3px;"> <input type="checkbox" required="required"  name="category[]" value="{{ $categories->fldCategoryID }}" {!! DB::table('tblProductCategory')->where('fldProductCategoryCategoryID','=',$categories->fldCategoryID)->where('fldProductCategoryProductID','=',$product_id)->count()==1 ? "checked='checked'" : "" !!} /></td>
                                <td style="padding: 5px 3px;">{{ $categories->fldCategoryName }} </td>
                                <td style="padding: 5px 3px;">
                                	{!! Html::image('_admin/assets/images/icons/updown.png') !!}                        			
                            		<span style="border:1px #999999 solid; padding:5px 10px;">{!! $categories->fldCategoryPosition !!}</span>
                                </td>
                                <td style="padding: 5px 3px;">
                                		
                                		<a href="javascript:void(0)" onClick="editSubCategory({!!$categories->fldCategoryID!!},{!!$product_id!!})"><img src="{!!url('_admin/assets/images/icons/page_modify.png')!!}"></a>                                               
                                    	<a href="javascript:void(0)" onClick="deleteSubCategory({!!$categories->fldCategoryID!!},{!!$category_id!!})"><img src="{!!url('_admin/assets/images/icons/page_delete.png')!!}"></a>
                            </tr>                            
                        @endforeach    
                </table>        
                        <div style="margin-bottom:15px; margin-left:55px;padding: 5px 3px;">
                        	<button type="button" name="button" onClick="addSubCategory({!! $category_id !!},{!! $product_id !!})">Add New Sub Category</button>
                         </div>
                   
                   
          {!! Html::script('_admin/assets/js/jquery.tablednd.js','') !!}
          <script>
		  	
			
			$('#page_manager1').tableDnD({
					onDrop: function(table, row) {						
						$.ajax({			
					
							type: "get",
							url: mypath+"/dnradmin/category/update-position-sub",
							data: $.tableDnD.serialize(),
							cache: false,
							success: function(data){
								$('#subcategory').load(mypath+'/dnradmin/sub-category/{!! $category_id !!}/0');							
							}
							
						});	
					}
			});
			
			$(function(){
				var chbxs = $(':checkbox[required]');
				
				var namedChbxs = {};
				chbxs.each(function(){
					var name = $(this).attr('name');
					namedChbxs[name] = (namedChbxs[name] || $()).add(this);
					var cbx = namedChbxs[name];
					if(cbx.filter(':checked').length>0){
						cbx.removeAttr('required');
					}else{
						cbx.attr('required','required');
					}
				});
					
					
				chbxs.change(function(){
					var name = $(this).attr('name');
					var cbx = namedChbxs[name];
					if(cbx.filter(':checked').length>0){
						cbx.removeAttr('required');
					}else{
						cbx.attr('required','required');
					}
				});
			});
		  </script>                                            