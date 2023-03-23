
                {!! Form::open(array('method' => 'post', 'id' => 'frmOptionsAssets','name'=>'frmOptionsAssets')); !!}	
                    <table border="0" >                  	
                  	 <tr>                                           	
                        <td style="padding:5px 5px;"  id="edit-width-section">
                          Width: <input type="number" name="width" style="width:60px;" id="edit-width" value="40" required>
                            
                         <div class="selection-fraction-wrapper">
                             <select name="widthfraction" style="width: 75px;" required>                             
                                 <option value=".0">0</option>
                                 <option value=".125">1/8</option>
                                 <option value=".25">1/4</option>
                                 <option value=".375">3/8</option>
                                 <option value=".5">1/2</option>
                                 <option value=".625">5/8</option>
                                 <option value=".75">3/4</option>
                                 <option value=".875">7/8</option>                            
                             </select>
                         </div>

                        </td>
                        </tr>
                        <tr>
                        <td style="padding:5px 5px;"  id="edit-height-section">

                                 Height: <input type="number" name="height" style="width:60px;" id="edit-height" value="40" required>

                                <div class="selection-fraction-wrapper">
                                 <select name="heightfraction" style="width:75px;" required>                             
                                     <option value=".0">0</option>
                                     <option value=".125">1/8</option>
                                     <option value=".25">1/4</option>
                                     <option value=".375">3/8</option>
                                     <option value=".5">1/2</option>
                                     <option value=".625">5/8</option>
                                     <option value=".75">3/4</option>
                                     <option value=".875">7/8</option>
                                 </select>
                                </div>
                        </td>
                     </tr>
                     
                     <input type="hidden" name="maintainproportions" id="edit-maintainproportions" value="1"  />
                     <input type="hidden" name="aspectRatio" id="edit-aspectRatio" value="1"  />
                     
                     <tr>
                     	{!! Form::hidden('option_id',$option_id) !!}
			{!! Form::hidden('product_id',$product_id) !!}
                     	<td style="padding:5px 5px"><button type="button" name="button" class="uk-button uk-button-success" onClick="saveAssetsOptions()">Save Options</button><button type="button" name="cancel_button" class="uk-button uk-button-dark" onClick="cancel_option_asset({{$option_id}})">Cancel</button></td>
                     </tr>
                  </table>
               {!! Form::close() !!}
               {!! Html::script('_admin/assets/js/height.js') !!}
