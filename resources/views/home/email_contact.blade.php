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

          <div align="center" style="background:rgba(0,0,0,0.10);width:650px;margin:auto;padding:10px 0;border-bottom:solid 1px #a0a0a0;box-shadow:0 1px 0 0 #f0f0f0;">
            <table border="0" cellpadding="0" cellspacing="0" width="650">
              <tr>
                <td style="font:300 13px sans-serif;color:#555;text-shadow:none;padding:10px 20px;">Name</td>
                <td style="font:300 13px sans-serif;color:#555;text-shadow:none;padding:10px 20px;">:</td>
                <td style="font:300 13px sans-serif;color:#555;text-shadow:none;padding:10px 20px;">
                	{{ $firstname . ' ' . $lastname }}
                </td>

              </tr>
              <tr>
                <td style="font:300 13px sans-serif;color:#555;text-shadow:none;padding:10px 20px;">Email Address</td>
                <td style="font:300 13px sans-serif;color:#555;text-shadow:none;padding:10px 20px;">:</td>
                <td style="font:300 13px sans-serif;color:#555;text-shadow:none;padding:10px 20px;">
                	{{ $email }}
                </td>

              </tr>
              <tr>
                <td style="font:300 13px sans-serif;color:#555;text-shadow:none;padding:10px 20px;">Contact no</td>
                <td style="font:300 13px sans-serif;color:#555;text-shadow:none;padding:10px 20px;">:</td>
                <td style="font:300 13px sans-serif;color:#555;text-shadow:none;padding:10px 20px;">
                	{{ $phone }}
                </td>

              </tr>
              <tr>
                <td style="font:300 13px sans-serif;color:#555;text-shadow:none;padding:10px 20px;">Company</td>
                <td style="font:300 13px sans-serif;color:#555;text-shadow:none;padding:10px 20px;">:</td>
                <td style="font:300 13px sans-serif;color:#555;text-shadow:none;padding:10px 20px;">
                	{{ $subject }}
                </td>

              </tr>
               <tr>
                <td style="font:300 13px sans-serif;color:#555;text-shadow:none;padding:10px 20px;">Comments</td>
                <td style="font:300 13px sans-serif;color:#555;text-shadow:none;padding:10px 20px;">:</td>
                <td style="font:300 13px sans-serif;color:#555;text-shadow:none;padding:10px 20px;">
                	{{ $comments }}
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