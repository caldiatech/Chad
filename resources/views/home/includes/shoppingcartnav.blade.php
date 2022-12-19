 <div class="uk-width-1-1 uk-margin-large  uk-margin-large-top"> 
             <div class="uk-container uk-container-center uk-margin-medium-bottom">
                <article id="main" role="main">
                    <div class="uk-grid">   
                        <div class="uk-width-1-3 uk-text-center @if($pages->fldPagesSlug == 'shopping-cart') uk-active @endif uk-panel-circle">               
                           <div class="uk-border-circle uk-container-center">01</div>
                           <h1 class="uk-h3 uk-container-center">Shopping Cart</h1>   
                        </div>
                        <div class="uk-width-1-3 uk-text-center @if($pages->fldPagesSlug == 'checkout') uk-active @endif uk-panel-circle">               
                           <div class="uk-border-circle uk-container-center">02</div>
                           <h1 class="uk-h3 uk-container-center">Checkout</h1>   
                        </div>
                        <div class="uk-width-1-3 uk-text-center @if($pages->fldPagesSlug == 'order-complete') uk-active @endif uk-panel-circle">               
                           <div class="uk-border-circle uk-container-center">03</div>
                           <h1 class="uk-h3 uk-container-center">Order Complete</h1>   
                        </div>
                    </div>  
                </article>
            </div><!--container -->
      </div><!--width-1-1- -->