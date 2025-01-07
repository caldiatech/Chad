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
                <td colspan="2" style="font:25px sans-serif;color:#555;text-transform:uppercase;text-shadow:none;padding:10px 20px;"> Thanks for Registering!<hr></td>
               
              </tr>
              <tr>
                <td colspan="2" style="font:13px sans-serif;color:#555;text-transform:uppercase;text-shadow:none;padding:10px 20px;"> Welcome to Clarkin Collection!</td>
              </tr>
              <tr>
                <td colspan="2" style="font:13px sans-serif;color:#555;text-transform:uppercase;text-shadow:none;padding:10px 20px;">
                    <p>
                        Hi all, I just signed up with the <a href"https://clarkincollection.com/"> https://clarkincollection.com/</a> unedited files page.  It's a landscape photographer site focusing on the most iconic scenery throughout North America. His pricing is one of the lowest I've seen and one of the cool options, he provides, is the ability to purchase his unedited files, at a nominal price, which you can then edit on your own, make them your own and do as you wish with them. I purchased a bundle of 3 large scale image files for $18.75 after my 25% discount. 
                    </p>
                    <p>
                    Once you've created your own masterpiece, if you so choose, he will have the highest quality acrylic or metal print made and shipped to you, at his cost, which provides you more savings.You can also choose any size you wish. 
Anyway, if you are interested and decide to make a purchase, please utilize my promo code <span style="font:600 13px sans-serif;color">{{ $promocode }}</span>, as it provides you another 25% off and I receive a small credit toward future purchases. You may also want to sign up, receive your own promo code to share and receive some credits from others with interest. But, please don't forget to use my promo code should you make a purchase, as that saves you the extra 25%. Just click on the Unedited Files link at the top of the home page to register.
                    </p>
                </td>
                {{-- <td colspan="2" style="font:13px sans-serif;color:#555;text-transform:uppercase;text-shadow:none;padding:10px 20px;">As a registered user you can: 
                    <ul>
                        <li>Personalize your shopping experience.</li>
                        <li>Speed through checkout.</li>                        
                    </ul>
                </td> --}}
               
              </tr>
               <tr>
                <td colspan="2" style="font:13px sans-serif;color:#555;text-transform:uppercase;text-shadow:none;padding:10px 20px;">Your Access Information
                </td>
               
              </tr>
              <tr>
                <td width="50%" style="font:13px sans-serif;color:#555;text-transform:uppercase;text-shadow:none;padding:10px 20px;"> Client Information </td>
                <td width="50%" style="font:13px sans-serif;color:#555;text-transform:uppercase;text-shadow:none;padding:10px 20px;"> Client Access Information </td>
              </tr>
              <tr>
                <td style="font:13px sans-serif;color:#555;text-shadow:none;line-height:18px;padding:10px 20px;">
                  Name: {{ $firstname . ' ' . $lastname }} <br>                  
                  Email: <a href="mailto:{{ $email }}" style="color:#666;text-decoration:none;border-bottom:dotted 1px #333;"> {{ $email }}</a> <br>                  
                </td>
                <td style="font:13px sans-serif;color:#555;text-shadow:none;line-height:18px;padding:10px 20px;">
                  Username: {{ $email }} <br>
                  Password: {{ $password }} <br>
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