@extends('layouts._admin.base')

@section('content')	
		<?
        //$queries = DB::getQueryLog();
		
		//print_r($queries);
		//die();
		?>
       
    <article>
    <div id="page_control" class="col1">      
      
       <a href="{!!url('dnradmin/category/view/'.$mainid->fldCategoryMainID)!!}">&laquo; Back to Category</a>
       <a href="{!!url('dnradmin/products/new')!!}"><img src="{!!url('_admin/assets/images/icons/icon_add.png')!!}"> Add Products</a>

    </div>
    
    <h2 class="line">Products</h2>
    
    <br style="clear:both;" />
      <input type='hidden' id='current_page' />  
	  <input type='hidden' id='show_per_page' />  
      <input type='hidden' id='number_of_items' />   		
	  <label for="search">Search:</label> <input type="text" id="search" value="" style="height:20px;"/>	
   
    {!! Form::open(array('url' => '/dnradmin/products/', 'method' => 'post', 'id' => 'pageform', 'files' => true)); !!}
         
    <table id="page_manager">
      <thead>
        <tr class="headers nodrag">
          <th width="70" data-sort="int"> <span class="id">ID</span> <div class="sort"></div> </th>  
          <th width="150">  </th>            
          <th width="400" data-sort="string"><span class="id">Product Name</span> <div class="sort"></div></th>
		  <th width="150" data-sort="int"><span class="id">Price</span> <div class="sort"></div></th>
          <th width="120" data-sort="int"><span class="id">Position</span> <div class="sort"></div></th>
        
          <th width="150" align="right">Action</th>
        </tr>
      </thead>
      
      <tbody id="Searchresult">
      				@if ($product->isEmpty()) 
                    	<tr>
                        	<td class="error" colspan="6" align="center"> No Record Found</td>
                        </tr>
                    @endif 
                    
                        @foreach ($product as $products)
                          
                        <tr id="{!!$products->fldProductID.'_'.$products->fldProductPosition!!}">
                           <td>{!! $products->fldProductID !!}</td>  
                           <td>
                           		@if($products->fldProductImage != "")
	                           		{!! Html::image('upload/products/'.$products->fldProductID.'/_75_'.$products->fldProductImage) !!}
                                @else
                                	 {!! Html::image('http://placehold.it/75') !!}
                                @endif    
                            </td>  
                           <td>{!! $products->fldProductName!!} </td>
                           <td>{!! '$'.number_format($products->fldProductPrice,2)!!} </td>
                           <td>
                                  {!! Html::image('_admin/assets/images/icons/updown.png') !!}                        			
                                  <span style="border:1px #999999 solid; padding:5px 10px;">{!! $products->fldProductPosition !!}</span>	
                           </td>
                                     
                           <td align="right">                                        
                              <a href="{!!url('dnradmin/products/edit/'.$products->fldProductID)!!}"><img src="{!!url('_admin/assets/images/icons/page_modify.png')!!}"></a>                                               
                              <a href="{!!url('dnradmin/products/delete/'.$products->fldProductID.'/'.$category_id)!!}" alt="Delete Products" onClick="return confirm(&quot;Are you sure you want to remove this Product?\n\nPress OK to delete.\nPress Cancel to go back without deleting the Product.\n&quot;)"><img src="{!!url('_admin/assets/images/icons/page_delete.png')!!}"></a>
                             
                           </td>
                        </tr>
                          
                        @endforeach
                   
      </tbody>
      @if (!$product->isEmpty()) 
      <tfoot>
        <th colspan="6" align="right" height="30">

          	 <div id='page_navigation' class="pagination"></div>    
        </th>
        
      </tfoot>
     @endif 
    </table>
     {!! Form::close() !!}
  </article>
  

@stop

@section('headercodes')    
  {!! Html::style('_admin/assets/css/pagination.css') !!}  
@stop

@section('extracodes')

    {!! Html::script('_admin/manager/tinymce/tiny_mce.js','') !!}
    {!! Html::script('_admin/assets/js/cufon_avantgarde.js','') !!}
    {!! Html::script('_admin/assets/js/jquery-latest.min.js','') !!}
    {!! Html::script('_admin/assets/js/FilterPagination/filter.js','') !!}
    {!! Html::script('_admin/manager/tinymce/styles/mods2.js','') !!}
    {!! Html::script('_admin/assets/js/jquery.tablednd.js','') !!}
    {!! Html::script('_admin/assets/js/stupidtable.min.js','') !!}
    {!! Html::script('_admin/assets/js/sorted.js','') !!}

    <script>
		showPagination(20,$('#page_manager tbody>tr').size(),$('#page_manager tbody>tr'));
		
			$('#page_manager').tableDnD({
					onDrop: function(table, row) {						
						$.ajax({	
							type: "get",
							url: "{!! url('dnradmin/products/update-position') !!}",
							data: $.tableDnD.serialize(),
							cache: false,
							success: function(data){
								location.href = "{!! url('dnradmin/products/view/'.$category_id) !!}";																					
							}
							
						});	
					}
			});
	</script>   
    
@stop