<form/>
                {!! Form::open(array('method' => 'post', 'id' => 'frmOptionsAssets','name'=>'frmOptionsAssets')); !!}	
                    <table border="0" >                  	
                  	 <tr>  
                        <? /*                   	
                        <td style="padding:5px 5px;"><input type="text" name="name" id="name" style="width:225px; margin-left:7px;" placeholder="Option Name" value="{!!$options->fldOptionsAssetsName!!}" /></td>
                        */ ?>

                         <td style="padding:5px 5px;">
                         Width:
                         <select name="width" style="width:60px;">
                             @for($i=4;$i<=38;$i++) 
                                <option value="{{$i}}" {{ $i == $options->fldOptionsAssetsWidth ? "selected='selected'" : "" }}>{{$i}}</option>
                             @endfor
                         </select>
                         <select name="widthfraction" style="width:75px;">                             
                             <option value=".0" {{ ".0" == $options->fldOptionsAssetsWidthFraction ? "selected='selected'" : "" }}>0</option>
                             <option value=".125" {{ ".125" == $options->fldOptionsAssetsWidthFraction ? "selected='selected'" : "" }}>1/8</option>
                             <option value=".25"  {{ ".25" == $options->fldOptionsAssetsWidthFraction ? "selected='selected'" : "" }}>1/4</option>
                             <option value=".375"  {{ ".375" == $options->fldOptionsAssetsWidthFraction ? "selected='selected'" : "" }}>3/8</option>
                             <option value=".5"  {{ ".5" == $options->fldOptionsAssetsWidthFraction ? "selected='selected'" : "" }}>1/2</option>
                             <option value=".625" {{ ".625" == $options->fldOptionsAssetsWidthFraction ? "selected='selected'" : "" }}>5/8</option>
                             <option value=".75" {{ ".75" == $options->fldOptionsAssetsWidthFraction ? "selected='selected'" : "" }}>3/4</option>
                             <option value=".875" {{ ".875" == $options->fldOptionsAssetsWidthFraction ? "selected='selected'" : "" }}>7/8</option>                            
                         </select>

                          
                        
                         <?php /*<input type="text" name="width" id="width" style="width:95px; margin-left:7px;" placeholder="Width" value="{{ $options->fldOptionsAssetsWidth }}" />*/ ?>

                         </td>
                         </tr>
                         <tr>
                        <td style="padding:5px 5px;">
                             Height:
                        <?php /*<input type="text" name="height" id="height" style="width:95px; margin-left:7px;" placeholder="Height" value="{{ $options->fldOptionsAssetsHeight }}"/>*/ ?>
                                 <select name="height" style="width:60px;">
                                     @for($i=4;$i<=38;$i++) 
                                        <option value="{{$i}}" {{ $i == $options->fldOptionsAssetsHeight ? "selected='selected'" : "" }}>{{$i}}</option>
                                     @endfor
                                 </select>

                                 <select name="heightfraction" style="width:75px;">                             
                                     <option value=".0" {{ ".0" == $options->fldOptionsAssetsHeightFraction ? "selected='selected'" : "" }}>0</option>
                                     <option value=".125" {{ ".125" == $options->fldOptionsAssetsHeightFraction ? "selected='selected'" : "" }}>1/8</option>
                                     <option value=".25" {{ ".25" == $options->fldOptionsAssetsHeightFraction ? "selected='selected'" : "" }}>1/4</option>
                                     <option value=".375" {{ ".375" == $options->fldOptionsAssetsHeightFraction ? "selected='selected'" : "" }}>3/8</option>
                                     <option value=".5" {{ ".5" == $options->fldOptionsAssetsHeightFraction ? "selected='selected'" : "" }}>1/2</option>
                                     <option value=".625" {{ ".625" == $options->fldOptionsAssetsHeightFraction ? "selected='selected'" : "" }}>5/8</option>
                                     <option value=".75" {{ ".75" == $options->fldOptionsAssetsHeightFraction ? "selected='selected'" : "" }}>3/4</option>
                                     <option value=".875" {{ ".875" == $options->fldOptionsAssetsHeightFraction ? "selected='selected'" : "" }}>7/8</option>                            
                                 </select>

                        </td>

                     </tr>
                      
                     <tr>
                     	  {!! Form::hidden('Id',$options->fldOptionsAssetsID) !!}
                        {!! Form::hidden('option_id',$option_id) !!}
			{!! Form::hidden('product_id',$product_id) !!}

                     	<td style="padding:5px 5px"><button type="button" name="button" class="uk-button uk-button-success" onClick="updateAssetsOptions({!!$options->fldOptionsAssetsID!!})">Save Options</button></td>
                     </tr>
                  </table>
               {!! Form::close() !!}