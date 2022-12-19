<form/>
                {!! Form::open(array('method' => 'post', 'id' => 'frmOptionsAssets','name'=>'frmOptionsAssets')); !!}	
                    <table border="0" >                  	
                  	 <tr>                     	
                        <td style="padding:5px 5px;"><input type="text" name="name" id="name" style="width:225px; margin-left:7px;" placeholder="Option Name" /></td>
                     </tr>
                     
                     <tr>
                     	{!! Form::hidden('option_id',$option_id) !!}
                     	<td style="padding:5px 5px"><button type="button" name="button" onClick="saveAssetsOptions()">Save Options</button></td>
                     </tr>
                  </table>
               {!! Form::close() !!}