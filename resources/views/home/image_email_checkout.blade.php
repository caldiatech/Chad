
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
        <table border="0" cellpadding="0" cellspacing="0" width="650" style="font-size:12px;">             
          <tr>
            <td width="50%" style="background:rgba(0,0,0,0.10);font-weight:600;color:#555;text-align:left;padding:10px;"> Order No : {{ $order_code }} </td>
            <td width="50%" style="background:rgba(0,0,0,0.10);font-weight:600;color:#555;text-align:right;padding:10px;"> Order Date : {{ date('F d, Y',strtotime($order_date)) }} </td>
          </tr>
        </table>
        <table border="0" cellpadding="0" cellspacing="0" width="650">
          <tr>
            <td width="50%" style="font:600 13px sans-serif;color:#555;text-transform:uppercase;text-shadow:none;padding:10px 20px;"> Billing Information </td>
          </tr>
          <tr>
            <td style="font:300 13px sans-serif;color:#555;text-shadow:none;line-height:18px;padding:10px 20px;">
              {{ $bFirstname . ' ' . $bLastname }} <br>
              {{ $bAddress . ' ' . $bAddress1 . ' ' . $bCity . ' ' . $bSTate . ' ' . $bZip }} <br>
              <a href="mailto:{{ $bEmail }}" style="color:#666;text-decoration:none;border-bottom:dotted 1px #333;"> {{ $bEmail }}</a> <br>
              {{ $bPhone }} <br /><br /><br />
            </td>
          </tr>
          
        </table>
      </div>
      <!-- INFO PANEL -->

       <div align='center' style='width:650px;margin:auto;padding:10px 0;'>
          <p>Click the button below to download the image:</p>
              <a href="{{ url('/download-image/'.$order_code) }}" target="_blank" download>
                  <button style="background-color: #008CBA; border: none; color: white; padding: 15px 32px; text-align: center; text-decoration: none; display: inline-block; font-size: 16px; margin: 4px 2px; cursor: pointer;">Download Image</button>
              </a>
      </div>	
      <!-- ORDERS PANEL -->
    </td>
  </tr>
</table>