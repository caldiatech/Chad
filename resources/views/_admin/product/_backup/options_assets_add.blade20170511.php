<form/>
                {!! Form::open(array('method' => 'post', 'id' => 'frmOptionsAssets','name'=>'frmOptionsAssets')); !!}	
                    <table border="0" >                  	
                  	 <tr>                                           	
                        <td style="padding:5px 5px;">
                          Width: 
                           <? /* <input type="text" name="width" id="width" style="width:95px; margin-left:7px;" placeholder="Width" /> */ ?>

                           <select name="width" style="width:60px;">
                             @for($i=4;$i<=38;$i++) 
                                <option value="{{$i}}">{{$i}}</option>
                             @endfor
                         </select>
                         <select name="widthfraction" style="width: 75px;">                             
                             <option value=".0">0</option>
                             <option value=".125">1/8</option>
                             <option value=".25">1/4</option>
                             <option value=".375">3/8</option>
                             <option value=".5">1/2</option>
                             <option value=".625">5/8</option>
                             <option value=".75">3/4</option>
                             <option value=".875">7/8</option>                            
                         </select>

                        </td>
                        </tr>
                        <tr>
                        <td style="padding:5px 5px;">

                            <?php /*<input type="text" name="height" id="height" style="width:95px; margin-left:7px;" placeholder="Height" />*/ ?>
                                 Height: 
                                <select name="height" style="width:60px;">
                                     @for($i=4;$i<=38;$i++) 
                                        <option value="{{$i}}">{{$i}}</option>
                                     @endfor
                                 </select>

                                 <select name="heightfraction" style="width:75px;">                             
                                     <option value=".0">0</option>
                                     <option value=".125">1/8</option>
                                     <option value=".25">1/4</option>
                                     <option value=".375">3/8</option>
                                     <option value=".5">1/2</option>
                                     <option value=".625">5/8</option>
                                     <option value=".75">3/4</option>
                                     <option value=".875">7/8</option>                            
                                 </select>


                        </td>
                     </tr>
                     
                     <tr>
                     	{!! Form::hidden('option_id',$option_id) !!}
			{!! Form::hidden('product_id',$product_id) !!}
                     	<td style="padding:5px 5px"><button type="button" name="button" class="uk-button uk-button-success" onClick="saveAssetsOptions()">Save Options</button></td>
                     </tr>
                  </table>
               {!! Form::close() !!}