		<table border="0">	
        	@foreach($sales_manager as $sales_managers)
             	<tr>
                   <td class="radio-cat"><input type="radio" name="manager_id" value="{{$sales_managers->fldSalesManagerID}}" {{$sales_managers->fldSalesManagerID==$id ? 'checked' : ""}} /> {{ $sales_managers->fldSalesManagerFirstname . ' ' . $sales_managers->fldSalesManagerLastname}}</td>
                </tr>
          @endforeach
       </table>