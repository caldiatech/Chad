		<div class="uk-panel uk-panel-box">
    			<h3 class="uk-panel-title">Category</h3>
    			<ul class="uk-nav uk-nav-side">
	    			@foreach($news_category as $news_categories)
	                    <li {{ $news_category_id==$news_categories->fldNewsCategoryID ? "class='active'" : "" }}>{!! Html::link("news/category/".$news_categories->fldNewsCategorySlug, $news_categories->fldNewsCategoryName) !!}</li>
	                @endforeach 
    			</ul>
		</div>
            