
			   	<table id="page_manager1" style="width:239px !important; border:none; margin-top:-5px">
                        @foreach($category as $categories)
                        	<tr id="{{$categories->id.'_'.$categories->position}}">
                            	<td style="padding: 5px 3px;"> <input type="checkbox" required="required"  name="category[]" value="{{ $categories->id }}" {{ DB::table('products_category')->where('category_id','=',$categories->id)->where('product_id','=',$product_id)->count()==1 ? "checked='checked'" : "" }} /></td>
                                <td style="padding: 5px 3px;">{{ $categories->name }} </td>
                                <td style="padding: 5px 3px;">
                                	{{ HTML::image('_admin/assets/images/icons/updown.png') }}
                            		<span style="border:1px #999999 solid; padding:5px 10px;">{{ $categories->position }}</span>
                                </td>
                                <td style="padding: 5px 3px;">{{ HTML::image_link('#','_admin/assets/images/icons/page_modify.png','',' Modify Page',array("onClick"=>"editSubCategory( $categories->id,$product_id )")) }}                                    {{ HTML::image_link('#','_admin/assets/images/icons/page_delete.png','',' Delete Page',array("onClick"=>"deleteSubCategory( $categories->id,$category_id )")) }}</td>
                            </tr>
                        @endforeach
                </table>
                        <div style="margin-bottom:15px; margin-left:55px;padding: 5px 3px;">
                        	<button type="button" name="button" onClick="addSubCategory({{ $category_id }},{{ $product_id }})">Add New Category</button>
                         </div>


          {{ HTML::script('_admin/assets/js/jquery.tablednd.js') }}
          <script>


			$('#page_manager1').tableDnD({
					onDrop: function(table, row) {
						$.ajax({

							type: "get",
							url: mypath+"/dnradmin/category/update-position-sub",
							data: $.tableDnD.serialize(),
							cache: false,
							success: function(data){
								$('#subcategory').load(mypath+'/dnradmin/sub-category/{{ $category_id }}/0');
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
