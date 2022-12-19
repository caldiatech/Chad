<div class="product-settings">
                  <h3 class="text-uppercase">Select Size:</h3>                
                  <div class="uk-grid w100 uk-margin-remove uk-text-large">
                    <div class="uk-width-large-1-2  uk-width-small-1-2  uk-width-1-1 uk-padding-remove">
                      <label class="uk-form-label light full-width" for="width">Width:</label>                  
                      <div class="uk-grid uk-padding-small-top w100 uk-margin-remove">
                        <div class="uk-width-large-1-2 uk-width-mdlg-1-1 uk-width-small-1-2  uk-width-1-1 uk-padding-remove">
                            <div class="input-append spinner" data-trigger="spinner" id="customize-spinner">
                              <input type="text" value="0" data-max="1000" data-min="1" data-step="1">
                              <div class="add-on"> 
                                <a href="javascript:;" class="spin-up" data-spin="up"><i class="uk-icon-sort-up"></i></a>
                                <a href="javascript:;" class="spin-down" data-spin="down"><i class="uk-icon-sort-down"></i></a>
                              </div>
                            </div>
                        </div>
                        <div class="uk-width-large-1-2 uk-width-mdlg-1-1  uk-width-small-1-2  uk-width-1-1 uk-padding-remove">
                            <div class="select-wrapper input-append spinner">
                              <select><option>---</option><option>Inch</option><option>CM</option></select>
                              <div class="add-on"> 
                                <a href="javascript:;" class="spin-up" data-spin="up"><i class="uk-icon-sort-up"></i></a>
                                <a href="javascript:;" class="spin-down" data-spin="down"><i class="uk-icon-sort-down"></i></a>
                              </div>
                            </div>
                        </div>
                      </div>
                    </div>
                    <div class="uk-width-large-1-2  uk-width-small-1-2  uk-width-1-1 uk-padding-remove">
                      <label class="uk-form-label light full-width" for="width">Height:</label>                  
                      <div class="uk-grid uk-padding-small-top w100 uk-margin-remove">
                        <div class="uk-width-large-1-2 uk-width-mdlg-1-1 uk-width-small-1-2 uk-width-1-1 uk-padding-remove">
                            <div class="input-append spinner" data-trigger="spinner" id="customize-spinner">
                              <input type="text" value="0" data-max="1000" data-min="1" data-step="1">
                              <div class="add-on"> 
                                <a href="javascript:;" class="spin-up" data-spin="up"><i class="uk-icon-sort-up"></i></a>
                                <a href="javascript:;" class="spin-down" data-spin="down"><i class="uk-icon-sort-down"></i></a>
                              </div>
                            </div>
                        </div>
                        <div class="uk-width-large-1-2 uk-width-mdlg-1-1 uk-width-small-1-2 uk-width-1-1 uk-padding-remove">
                            <div class="select-wrapper input-append spinner">
                              <select><option>---</option><option>Inch</option><option>CM</option></select>
                              <div class="add-on"> 
                                <a href="javascript:;" class="spin-up" data-spin="up"><i class="uk-icon-sort-up"></i></a>
                                <a href="javascript:;" class="spin-down" data-spin="down"><i class="uk-icon-sort-down"></i></a>
                              </div>
                            </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="uk-divider full-width uk-margin-large"></div>
                  <h3 class="text-uppercase">Choose Your Frame:</h3>                
                  <div class="uk-grid w100 uk-margin-remove uk-text-large" id="graphikAttribute">
                    <div class="uk-width-1-1 uk-padding-remove">
                      <label class="uk-form-label light full-width" for="width">Browse Frame Choices:</label>                  
                      <div class="uk-grid uk-padding-small-top w100 uk-margin-remove">
                        <div class="uk-width-large-1-4 uk-width-medium-1-2  uk-width-small-1-4  uk-width-1-1 uk-padding-remove">
                            <div class="select-wrapper uk-md-large input-append spinner">
                             <select name="color" id="frameColor" onChange="loadColors(this.value)">
                                  <option data-uk-filter="" value="0">Color</option>
                                  @foreach($color as $colors)
                                       <option value="{{ $colors }}" data-uk-filter="{{ $colors }}">{{ $colors }}</option>
                                  @endforeach
                                  
                              </select>                             <div class="add-on"> 
                                <a href="javascript:;" class="spin-up" data-spin="up"><i class="uk-icon-sort-up"></i></a>
                                <a href="javascript:;" class="spin-down" data-spin="down"><i class="uk-icon-sort-down"></i></a>
                              </div>
                            </div>
                        </div>
                        <div class="uk-width-large-1-4 uk-width-medium-1-2  uk-width-small-1-4  uk-width-1-1 uk-padding-remove">
                             <div class="select-wrapper uk-md-large input-append spinner">
                              <select name="width" id="frameWidth"  onChange="loadWidth(this.value)">
                                    <option value="0">Width</option>
                                    @foreach($widthValue as $widthValues)
                                       <option value="{{ $widthValues }}">{{ $widthValues }}</option>
                                    @endforeach
                              </select>                              <div class="add-on"> 
                                <a href="javascript:;" class="spin-up" data-spin="up"><i class="uk-icon-sort-up"></i></a>
                                <a href="javascript:;" class="spin-down" data-spin="down"><i class="uk-icon-sort-down"></i></a>
                              </div>
                            </div>
                        </div>
                        <div class="uk-width-large-1-4 uk-width-medium-1-2  uk-width-small-1-4  uk-width-1-1 uk-padding-remove">
                            <div class="select-wrapper uk-md-large input-append spinner">
                              <select name="style" id="frameStyle" onChange="loadStyle(this.value)">
                                  <option value="0">Style</option>
                                  @foreach($styleValue as $styleValues)
                                       <option value="{{ $styleValues }}">{{ $styleValues }}</option>
                                  @endforeach
                              </select>                              <div class="add-on"> 
                                <a href="javascript:;" class="spin-up" data-spin="up"><i class="uk-icon-sort-up"></i></a>
                                <a href="javascript:;" class="spin-down" data-spin="down"><i class="uk-icon-sort-down"></i></a>
                              </div>
                            </div>
                        </div>
                        <div class="uk-width-large-1-4 uk-width-medium-1-2  uk-width-small-1-4  uk-width-1-1 uk-padding-remove">
                            <div class="select-wrapper uk-md-large input-append spinner">
                              <select name="material" id="frameMaterial" onChange="loadMaterial(this.value)">
                                  <option value="0">Material</option>
                                  @foreach($materialValue as $materialValue)
                                       <option value="{{ $materialValue }}">{{ $materialValue }}</option>
                                  @endforeach
                              </select>                              <div class="add-on"> 
                                <a href="javascript:;" class="spin-up" data-spin="up"><i class="uk-icon-sort-up"></i></a>
                                <a href="javascript:;" class="spin-down" data-spin="down"><i class="uk-icon-sort-down"></i></a>
                              </div>
                            </div>
                        </div>
                      </div>
                    </div>
                    <div class="full-width uk-margin-medium-top uk-padding-remove"> </div>  
                    
                    <div class="uk-width-6-10 uk-padding-remove">                                       
                      <div class="text-wrapper">
                          <input type="text" value="" class="text" placeholder="Enter SKU" id="txtSKU">
                          <button type="submit" class="append-button uk-text-bold" form="form1" value="Submit" onClick="searchFrame()"><i class="fa uk-icon-search"></i></button>                          
                      </div>
                    </div>
                    <div class="uk-width-4-10  uk-text-right">                                       
                      <button type="button" class="uk-button-primary uk-text-large uk-float-right full-width lato uk-button-large" >Reset</button>
                    </div>

                    <div class="full-width uk-margin-medium-top uk-padding-remove"> </div> 
                    <div class="uk-width-large-1-2  uk-width-medium-1-1 uk-width-small-1-2 uk-width-1-1 uk-padding-medium-remove">
                        <label class=" light uk-margin-small-right" for="sortby">Sort By:</label>   
                        <div class="select-wrapper wrapper-large input-append spinner">
                          <select id="sortby"><option>Best Sellers</option><option>Sale</option><option>Name</option></select>
                          <div class="add-on"> 
                            <a href="javascript:;" class="spin-up" data-spin="up"><i class="uk-icon-sort-up"></i></a>
                            <a href="javascript:;" class="spin-down" data-spin="down"><i class="uk-icon-sort-down"></i></a>
                          </div>
                        </div>
                    </div>

                    

                     <div class="uk-width-large-1-2 uk-width-medium-1-1 uk-width-small-1-2 uk-width-1-1 uk-padding-remove  uk-text-right"> 
                          <div id="pagination"></div>                        
                    </div>

                  </div>

                 

                  <div class="full-width uk-margin-medium-top uk-padding-remove"> </div> 
                  <div id="frameDisplay"></div>

                  
                </div> <!-- <div class="product-settings"> -->