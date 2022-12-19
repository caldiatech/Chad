<form/>
                {!! Form::open(array('method' => 'post', 'id' => 'frmOptionsAssets','name'=>'frmOptionsAssets')); !!}	
                    <table border="0" >                  	
                  	 <tr>  
                        <? /*                   	
                        <td style="padding:5px 5px;"><input type="text" name="name" id="name" style="width:225px; margin-left:7px;" placeholder="Option Name" value="{!!$options->fldOptionsAssetsName!!}" /></td>
                        */ ?>

                         <td style="padding:5px 5px;"><input type="text" name="width" id="width" style="width:95px; margin-left:7px;" placeholder="Width" value="{{ $options->fldOptionsAssetsWidth }}" /></td>
                        <td style="padding:5px 5px;"><input type="text" name="height" id="height" style="width:95px; margin-left:7px;" placeholder="Height" value="{{ $options->fldOptionsAssetsHeight }}"/></td>

                     </tr>
                      
                     <tr>
                     	  {!! Form::hidden('Id',$options->fldOptionsAssetsID) !!}
                        {!! Form::hidden('option_id',$option_id) !!}
			{!! Form::hidden('product_id',$product_id) !!}

                     	<td style="padding:5px 5px"><button type="button" name="button" onClick="updateAssetsOptions({!!$options->fldOptionsAssetsID!!})">Save Options</button></td>
                     </tr>
                  </table>
               {!! Form::close() !!}