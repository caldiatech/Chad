<div class="uk-display-inline form-radio-buttons">
                <label for="print_on_paper" class="uk-margin-medium-right uk-margin-small-left"> <input type="radio" id="print_on_paper" name="print_on" class=" custom-toggle" data-custom-toggle="print_on_paper_toggler"  checked> Print On Paper</label>
                <label for="print_on_canvas" class="uk-margin-small-left "> <input type="radio" class="uk-margin-medium-left custom-toggle" data-custom-toggle="print_on_canvas_toggler"  id="print_on_canvas" name="print_on" onChange="return confirm_print_on_canvas()"> Print On Canvas</label>
              </div>
                     

                <div class="print_on_toggler  uk-margin-large-top " >
                  <div class="switcher-content toggle-me  toggle-paper content-paper print_on_paper_toggler" id="print_on_paper_toggler" >                    
                    <h3 class="text-uppercase">Choose Your Art or Photo Paper</h3>
                    <label class="small uk-form-label light full-width grey">Price is Based on Your Image Size</label>
                    <div class="uk-grid w100 uk-margin-remove uk-text-large">
                      <div class="uk-display-inline form-radio-buttons uk-width-1-1 uk-padding-remove">
                        <label class="light full-width" for="photo_paper1">
                          <input type="radio" class="uk-margin-medium-right" id="photo_paper1" name="photo_paper">Economy photo / poster paper <i class="uk-icon-question fsize-12 tooltip light-grey uk-icon-justify"  data-uk-tooltip title="This versatile photo paper is the ultimate foundation for all kinds of decor-quality photo and poster prints."></i>
                          <div class="uk-float-right">$11.15</div>
                        </label>
                      </div>
                      <div class="uk-width-divider-blank uk-margin-small"></div>
                      <div class="uk-display-inline form-radio-buttons uk-width-1-1 uk-padding-remove">
                        <label class="light full-width" for="photo_paper1"><input type="radio" class="uk-margin-medium-right" id="photo_paper1" name="photo_paper">Premium Archival Matte Photo Paper <i class="uk-icon-question fsize-12 tooltip light-grey uk-icon-justify"  data-uk-tooltip title="This versatile photo paper is the ultimate foundation for all kinds of decor-quality photo and poster prints."></i>
                          <div class="uk-float-right">$12.50</div>
                        </label>
                      </div>
                      <div class="uk-width-divider-blank uk-margin-small"></div>
                      <div class=" uk-width-1-1 uk-padding-remove checkbox-wrapper">
              {!! Form::checkbox('white_border', 1, false, ['id'=>"white_border"]); !!}
              <label for="white_border" class="lbl light"><span class="checkbox-style"></span> Add White Border</label>
            </div>
                      <div class="uk-width-divider-blank uk-margin-small"></div>


                    </div>
                  </div> <!-- print_on_paper_toggler -->
                  <div class="switcher-content toggle-me  toggle-paper uk-hidden content-canvas print_on_canvas_toggler" id="print_on_canvas_toggler">
                                        
                    <h3 class="text-uppercase">Choose Your Canvas Options</h3>
                    <label class="small uk-form-label bold full-width grey">Canvas Type</label>
                    <div class="uk-grid w100 uk-margin-remove uk-text-large">
                      <div class="uk-display-inline form-radio-buttons  uk-width-1-1 uk-padding-remove">
                        <label class="light full-width" for="photo_paper1">
                          <input type="radio" class="uk-margin-medium-right" id="photo_canvas1" name="photo_canvas">Gallery Grade Satin Canvas <span class="yellow bold">New</span>  <i class="uk-icon-question uk-float-right fsize-12 tooltip light-grey uk-icon-justify"  data-uk-tooltip title="This versatile photo paper is the ultimate foundation for all kinds of decor-quality photo and poster prints."></i>
                          <div class="uk-float-right">$11.15</div>
                        </label>
                      </div>
                      <div class="uk-width-divider-blank uk-margin-small"></div>
                      <div class="uk-display-inline form-radio-buttons  uk-width-1-1 uk-padding-remove">
                        <label class="light full-width" for="photo_canvas3">
                          <input type="radio" class="uk-margin-medium-right" id="photo_canvas3" name="photo_canvas">Gallery Grade Satin Canvas <span class="yellow bold">New</span>  <i class="uk-icon-question uk-float-right fsize-12 tooltip light-grey uk-icon-justify"  data-uk-tooltip title="This versatile photo paper is the ultimate foundation for all kinds of decor-quality photo and poster prints."></i>
                          <div class="uk-float-right">$12.50</div>
                        </label>
                      </div>
                      <div class="uk-width-divider-blank uk-margin-small"></div>
                      <div class="uk-width-large-3-10  line-height-select uk-width-1-1 uk-padding-remove checkbox-wrapper">
                        <label class="light full-width" for="gallery_wrap">
                            <input type="radio" class="uk-margin-medium-right" id="gallery_wrap" name="wrap_options">Gallery Wrap 
                        </label>
                      </div>

                      <div class="uk-width-large-7-10  uk-width-1-1 uk-padding-remove">
                          <div class="uk-grid">
                            <div class="uk-width-4-10 line-height-select">
                              <label class=" light uk-margin-small-right" for="border_options">Border Type:</label>  
                            </div> 
                            <div class="uk-width-6-10">
                              <div class="select-wrapper input-append spinner">
                                <select id="border_options" id="border_options"><option>Mirrored image</option><option>Black</option><option>White</option></select>
                                <div class="add-on"> 
                                  <a href="javascript:;" class="spin-up" data-spin="up"><i class="uk-icon-sort-up"></i></a>
                                  <a href="javascript:;" class="spin-down" data-spin="down"><i class="uk-icon-sort-down"></i></a>
                                </div>
                              </div>
                            </div>
                          </div>
                      </div>

                      <div class="uk-width-1-1 uk-margin-small">
                        <label class="light full-width" for="gallery_wrp_option1">
                          <input type="radio" class="uk-margin-medium-right" id="gallery_wrp_option1" name="gallery_wrp_options[]">1" Slender Canvas Depth – Floater Frame Options Available
                        </label>
                      </div>
                      <div class="uk-width-1-1">
                          <label class="light full-width" for="gallery_wrp_option2">
                            <input type="radio" class="uk-margin-medium-right" id="gallery_wrp_option2" name="gallery_wrp_options[]">1 1/2" Classic Canvas Depth – Floater Frame Options Available
                        </label>
                      </div>


                      <div class=" uk-width-1-1 uk-padding-remove">
                        <label class=" light full-width" for="border_type">
                            <input type="radio" class="uk-margin-medium-right" id="border_type" name="wrap_options">Framed Stretched Canvas - Best Choice for the Greatest Frame Selection
                        </label>
                      </div>
                      <div class="uk-width-divider-blank uk-margin-small"></div>
                    </div>

                  </div><!-- print_on_canvas_toggler -->
                  <div class="uk-width-divider-blank uk-margin-small"></div>
          <h3 class="text-uppercase full-width uk-padding-remove">Pro Options</h3>
          <div class="uk-width-1-1 uk-padding-remove checkbox-wrapper">
            {!! Form::checkbox('prop_options[]', 1, false, ['id'=>"prop_option_stamp"]) !!}
            <label for="prop_option_stamp" class="lbl light"><span class="checkbox-style"></span>Stamp this Print as a Printer's Proof (Print Only)</label>
            <span class="uk-float-right">$0.50</span>
          </div>
          <div class=" uk-width-1-1 uk-padding-remove checkbox-wrapper">
            {!! Form::checkbox('prop_options[]', 2, false, array('id'=>"prop_option_cert")) !!}
            <label for="prop_option_cert" class="lbl light"><span class="checkbox-style"></span> Add a Certificate of Authenticity</label>
            <span class="uk-float-right">$1.00</span>
          </div>
            </div> <!-- print_on_toggler -->