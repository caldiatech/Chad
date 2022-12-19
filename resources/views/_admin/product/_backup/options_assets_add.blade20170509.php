<form/>
                {!! Form::open(array('method' => 'post', 'id' => 'frmOptionsAssets','name'=>'frmOptionsAssets')); !!}	
                    <table border="0" >                  	
                  	 <tr>                     	
                        <td style="padding:5px 5px;"><input type="text" name="width" id="width" style="width:95px; margin-left:7px;" placeholder="Width" /></td>
                        <td style="padding:5px 5px;"><input type="text" name="height" id="height" style="width:95px; margin-left:7px;" placeholder="Height" /></td>
                     </tr>
                     
                     <tr>
                     	{!! Form::hidden('option_id',$option_id) !!}
			{!! Form::hidden('product_id',$product_id) !!}
                     	<td style="padding:5px 5px"><button type="button" name="button" class="uk-button uk-button-success" onClick="saveAssetsOptions()">Save Options</button></td>
                     </tr>
                  </table>
               {!! Form::close() !!}