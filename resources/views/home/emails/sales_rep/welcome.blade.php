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
               <tr>
                    <td height="45" style="font:300 13px sans-serif;color:#555;text-shadow:none;padding:10px 20px;"><p>Hi {{ $firstname }}!</p> 
                    <p style="font: 30px Arial, Helvetica, sans-serif;color:#555;">Welcome to Clarkin</p></td>
                  </tr>
                  <tr>
                   <td height="45" style="padding:7px;color:#555;">{{ $manager }} added you as Sales Person.</td>   
                  </tr>
                  <tr>
                   <td height="45" style="padding:7px;color:#555;">To login use the following credentials</td>   
                  </tr>
                  <tr>
                    <td height="45" style="padding:7px;color:#555;">
                      <table border="0">          
                            <tr>
                              <td style="padding:7px;color:#555;">URL</td>
                                <td style="padding:7px;color:#555;">:</td>
                                <td style="padding:7px;color:#555;">{{ url('sales-login') }}</td>
                            </tr>
                            <tr>
                              <td style="padding:7px;color:#555;">Username</td>
                                <td style="padding:7px;color:#555;">:</td>
                                <td style="padding:7px;color:#555;">{{ $username }}</td>
                            </tr>
                            <tr>
                              <td style="padding:7px;color:#555;">Password</td>
                                <td style="padding:7px;color:#555;">:</td>
                                <td style="padding:7px;color:#555;">{{ $password }}</td>
                            </tr>
                        </table>
                    </td>
                  </tr>
                  <tr>
                    <td height="45" style="padding:7px;color:#555;">If you have any questions or encounter any problems logging in, please <a href="{{url('/contact')  }}">contact us</a>.</td>
                  </tr>
                  <tr>
                   <td height="45" style="padding:7px;color:#555;">Thanks, <br />Clarkin</td>   
                  </tr>
              
            </table>
          </div>
          <!-- INFO PANEL -->

           <div align='center' style='width:650px;margin:auto;padding:10px 0;'></div>	
          <!-- ORDERS PANEL -->
        </td>
      </tr>
    </table>