    <table border="0" cellpadding="0" cellspacing="0" width="100%" style="font-family:sans-serif;text-shadow:1px 1px 1px rgba(0,0,0,0.15);margin:0;">
      <tr>
        <td >
          <div align="center" style="width:650px;margin:auto;border-bottom:solid 1px #a0a0a0;box-shadow:0 1px 0 0 #f0f0f0; background: #000;">
            <table border="0" cellpadding="0" cellspacing="0" width="650" style="font-size:12px;">
              <tr>
                <td align="center" width="150%"> <a href="{{ url('/') }}"> <img src="{{ url('_front/assets/images/logo.png')}} " width="170"  alt="Clarkin" style="padding:10px;"> </a> </td>
              </tr>
            </table>
          </div>
          <!-- HEADER PANEL -->

          <div align="center" style="background:#FFF;width:650px;margin:auto;padding:10px 0;border-bottom:solid 1px #a0a0a0;box-shadow:0 1px 0 0 #f0f0f0;">
            <table border="0" cellpadding="0" cellspacing="0" width="650">
              <tr>
                <td colspan="2" style="font:600 13px sans-serif;color:#555;text-transform:uppercase;text-shadow:none;padding:10px 20px;"> Welcome to Clarkin Collection!</td>
              </tr>

                @if ($status != 2)
                <tr>
                    <td colspan="2" style="font:600 25px sans-serif;color:#555;text-transform:uppercase;text-shadow:none;padding:10px 20px;"> Pending Registration <hr></td>
                </tr>
                <tr>
                    <td colspan="2" style="font:600 13px sans-serif;color:#555;text-transform:uppercase;text-shadow:none;padding:10px 20px;"> 
                    Your registration is <u>pending approval</u> as Sales Manager. Once approved, you will receive an email notification.</td>
                </tr>
                @endif
              
              <tr>
                <td colspan="2" style="font:600 13px sans-serif;color:#555;text-transform:uppercase;text-shadow:none;padding:10px 20px;">Your Access Information
              </td>
               
              </tr>
              <tr>
                <td width="50%" style="font:600 13px sans-serif;color:#555;text-shadow:none;padding:10px 20px;"> Sales Manager Information </td>
                <td width="50%" style="font:600 13px sans-serif;color:#555;text-shadow:none;padding:10px 20px;"> Sales Manager Access Information </td>
              </tr>
              <tr>
                <td style="font:300 13px sans-serif;color:#555;text-shadow:none;line-height:18px;padding:10px 20px;">
                  Name: {{ $firstname . ' ' . $lastname }} <br>
                  Email: <a href="mailto:{{ $email }}" style="color:#666;text-decoration:none;border-bottom:dotted 1px #333;"> {{ $email }}</a> <br>                  
                </td>
                <td style="font:300 13px sans-serif;color:#555;text-shadow:none;line-height:18px;padding:10px 20px;">
                  URL: <a href="{{ url('sales-login') }}">{{ url('sales-login') }}</a> <br>
                  Username: {{ $email }} <br>
                  Password: {{ $password }} <br>
                </td>
              </tr>

               <tr>
                <td colspan="2" style="font:600 13px sans-serif;color:#555;text-transform:uppercase;text-shadow:none;padding:10px 20px;">
                </td>
               
              </tr>
             
              
            </table>
          </div>
          <!-- INFO PANEL -->

           <div align='center' style='width:650px;margin:auto;padding:10px 0;'></div>	
          <!-- ORDERS PANEL -->
        </td>
      </tr>
    </table>