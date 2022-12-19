<div class="uk-accordion" data-uk-accordion>
     @foreach($category as $categories) 
        <h3 class="uk-accordion-title">{{ $categories->fldCategoryName }}</h3>
        <div class="uk-accordion-content">
            <ul>
                    {{-- */                                     
                    $subcategory = App\Models\Category::where('fldCategoryMainID','=',$categories->fldCategoryID)->get();                                    
                    /* --}}
                    @foreach($subcategory as $subcategories)
                        <li>{!! HTML::link('/products/display/'.$subcategories->fldCategorySlug,$subcategories->fldCategoryName) !!}</li>
                    @endforeach
                </ul> 
        </div>
     @endforeach   
</div>
            
        