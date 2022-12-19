<div class="panel-group" id="accordion">
    {{-- */$ctr=0;/* --}}
    @foreach($category as $categories) 
    {{-- */$ctr=$ctr+1;/* --}}
    <div class="panel panel-default">
        <div class="panel-heading">
          <h4 class="panel-title">
            <a data-toggle="collapse" data-parent="#accordion" href="#collapse{{ $ctr }}">
              {{ $categories->name }}
            </a>
          </h4>
        </div><!--panel-heading -->
    <div id="collapse{{ $ctr }}" class="panel-collapse collapse {{ $ctr==1 ? 'in' : '' }}">
      <div class="panel-body">
            <ul>
                {{-- */                                    	
                $subcategory = CategoryManagement::where('main_id','=',$categories->id)->get();                                    
                /* --}}
                @foreach($subcategory as $subcategories)
                    <li>{{ HTML::link('/products/display/'.$subcategories->slug,$subcategories->name) }}</li>
                @endforeach
            </ul>                            
      </div><!--panel-body -->
    </div><!--collapse -->
    </div><!--panel panel-default -->
   @endforeach   
</div><!--panel-group -->