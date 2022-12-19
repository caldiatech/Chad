@extends('layouts._admin.base')

@section('content')
    <article>
    <div id="page_control" class="col1">
                    
        <img src={{asset("_admin/assets/images/icons/icon_add.png")}}> {{ HTML::link('/dnradmin/pages/new', 'Add Page') }}
      
    </div>
    
    <h2 class="line">Page Management</h2>
    
    <br style="clear:both;" />
        
    <table id="page_manager">
      <thead>
        <tr class="headers">
          <td width="70"> ID </td>            
          <td width="450">Page Name</td>
        
          <td width="150" align="center">Action</td>
        </tr>
      </thead>
      
      <tbody id="Searchresult">     
          			 @foreach ($posts as $post)
                        <h2>{{ $post->id }}</h2>
                        <p>{{ $post->name }}</p>
                    @endforeach
                    <tr>
                       <td>1</td>  
                       <td>About us</td>
                                 
                       <td>
                          {{ HTML::link('/dnradmin/pages/edit/{1}', 'Add Page') }}          
                         <a href="#"  title="Modify Page"><img src={{asset("_admin/assets/images/icons/page_modify.png")}} width="14" height="16" alt="mod" /></a>
                         <a href="#" title="Delete Page"><img src={{asset("_admin/assets/images/icons/page_delete.gif")}} width="16" height="16" alt="del" /></a>
                       </td>
                    </tr>
      </tbody>
      
      <tfoot>
        <th colspan="4" align="right" height="30">
          <div id="Pagination" class="pagination"></div>        
        </th>
      </tfoot>
    </table>
  </article>
  

@stop

@section('headercodes')    
  {{ HTML::style('_admin/assets/css/pagination.css') }}  
@stop

@section('extracodes')

    {{ HTML::script('_admin/manager/tinymce/tiny_mce.js','') }}
    {{ HTML::script('_admin/assets/js/cufon_avantgarde.js','') }}
    {{ HTML::script('_admin/assets/js/jquery-latest.min.js','') }}
    {{ HTML::script('_admin/assets/js/assets/js/jquery.pagination.js','') }}
    {{ HTML::script('_admin/manager/tinymce/styles/mods2.js','') }}
       
    
@stop