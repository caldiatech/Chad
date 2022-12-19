<form/>
                {{ Form::open(array('method' => 'post', 'id' => 'frmOptions','name'=>'frmOptions')); }}	
                    <table border="0">                  	
                  	 <tr>                     	
                        <td><input type="text" name="name" id="name" style="width:225px; margin-left:7px;" value="{{ $options->name }}" /></td>
                     </tr>
                     <tr>
                     	{{ Form::hidden('Id',$options->id) }}
                     	<td style="padding:5px 5px"><button type="button" name="button" onClick="updateOptions({{$options->id}})">Save Options</button></td>
                     </tr>
                  </table>
               {{ Form::close() }}