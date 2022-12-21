			   	<table id="page_manager" style="width:225px !important; border:none; margin-top:-5px">
                        @foreach($category as $categories)
                        	<tr id="{{$categories->id.'_'.$categories->position}}">
                            	<td> <input type="radio" name="maincategory" required="required" value="{{ $categories->id }}" onclick="displaySubCategory({{ $categories->id }})" {{ $category_id==$categories->id ? "checked='checked'" : "" }} /></td>
                                <td>{{ $categories->name }}</td>
                                <td>
                                	{{ HTML::image('_admin/assets/images/icons/updown.png') }}
                            		<span style="border:1px #999999 solid; padding:5px 10px;">{{ $categories->position }}</span>
                                </td>
                                <td>{{ HTML::image_link('#','_admin/assets/images/icons/page_modify.png','',' Modify Page',array("onClick"=>"editCategory( $categories->id )")) }}                                    {{ HTML::image_link('#','_admin/assets/images/icons/page_delete.png','',' Delete Page',array("onClick"=>"deleteCategory( $categories->id )")) }}</td>
                            </tr>
                        @endforeach
                </table>
                        <div style="margin-bottom:15px; margin-left:55px">
                        	<button type="button" name="button" onClick="addCategory(0)">Add New Category</button>
                         </div>


          {{ HTML::script('_admin/assets/js/jquery.tablednd.js') }}
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
					}
			});
		  </script>
