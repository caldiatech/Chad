<form/>
                {{ Form::open(array('method' => 'post', 'id' => 'frmCategory','name'=>'frmCategory')); }}	
                    <table border="0">                  	
                  	 <tr>                     	
                        <td><input type="text" name="name" id="name" style="width:225px; margin-left:7px;" /></td>
                     </tr>
                     <tr>
                     	<td style="padding:5px 5px"><button type="button" name="button" onClick="saveCategory()">Save Category</button></td>
                     </tr>
                  </table>
               {{ Form::close() }}