<form/>
                {!! Form::open(array('method' => 'post', 'id' => 'frmOptions','name'=>'frmOptions')); !!}	
                    <table border="0">                  	
                  	 <tr>                     	
                        <td><input type="text" name="name" id="name" style="width:225px; margin-left:7px;" placeholder="Option Name" /></td>
                     </tr>
                     <tr>
                     	{!! Form::hidden('main_id','0') !!}
                     	<td style="padding:5px 5px">
                        <button type="button" class="uk-button uk-button-primary" name="button" onClick="saveOptions()">Save Options</button>
                        <button type="button" name="cancel_button" class="uk-button uk-button-dark" onClick="cancel_option()">Cancel</button></td>
                     </tr>
                  </table>
               {!! Form::close() !!}