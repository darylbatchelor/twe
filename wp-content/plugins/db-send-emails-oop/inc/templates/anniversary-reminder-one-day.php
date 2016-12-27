<?php

/*
$allusers->display_name: name of email reciever
$anniversary: is the anniversary year number
$modern_gift: modern gift 
$traditional_gift_uk: UK traditional gift
$traditional_gift_us: US traditional gift
$gemstone: gemstone
$color: anniversary color
$ideas: block of text with affiliate links to amazon
$amazon_link: amazon affiliate link
To get Images use: IMG_DIR . 'image-name.jpg';



*/
$headers = array('Content-Type: text/html; charset=UTF-8');

$subject = 'Your anniversary is TOMORROW';

$body = '
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>30 Day Reminder</title>
</head>

<body bgcolor="#5e5544">
<table width="100%" border="0" cellspacing="0" cellpadding="0" bgcolor="#5e5544">
  <tr>
    <td><table width="600" border="0" cellspacing="0" cellpadding="0" bgcolor="#FFFFFF" align="center">
        <tr>
          <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td width="146"><a href= "' . get_home_url() . '" target="_blank"><img src="'. IMG_DIR . 'logo.jpg" width="146" height="76" border="0" alt=""/></a></td>
                <td width="393"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                      <td height="46" align="right" valign="middle"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                          
                        </table></td>
                    </tr>
                    <tr>
                      <td height="30"><img src="'. IMG_DIR . 'PROMO-GREEN2_01_04.jpg" width="393" height="30" border="0" alt=""/></td>
                    </tr>
                  </table></td>
              </tr>
            </table></td>
        </tr>
        <tr>
          <td align="center">&nbsp;</td>
        </tr>
        <tr>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td width="10%">&nbsp;</td>
                <td width="80%" align="left" valign="top"><font style="font-family: Georgia, \'Times New Roman\', Times, serif; color:#010101; font-size:24px"><strong><em>Hi ' . $allusers->display_name . ',</em></strong></font><br /><br />
                  <font style="font-family: Verdana, Geneva, sans-serif; color:#666766; font-size:13px; line-height:21px">Your ' . $anniversary . ' year anniversary is tomrrow!  Hopefully by now you have everything all sorted!  Just remember write on your card and wrap your presents then go ahead and delete this email. <br /><br />
                    If you have not yet got anything, give yourself an uppercut now... go on we will wait... Ok so if you have time today, go out and find something locally.  See our present pack and anniversary themes below for ideas.  If all else fails, at the very least go get a card, some flowers and a bottle of your wifes (not your) favourite wine/liquor, maybe a box of her favourite chocolates...  This should at least get you out of the danger zone.</font></td>


        <td width="10%">&nbsp;</td>
        </tr>

         <tr>
          <td>&nbsp;</td>
        </tr>

              <tr>
                <td>&nbsp;</td>
                <td align="center" valign="top"><table width="108" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td><img src="'. IMG_DIR . 'PROMO-GREEN2_04_01.jpg" width="108" height="9" style="display:block" border="0" alt=""/></td>
                  </tr>
                  <tr>
                    <td align="center" valign="middle" bgcolor="#b7c68b"><font style="font-family: Georgia, \'Times New Roman\', Times, serif; color:#5e5544; font-size:14px"><em><a href="http://yourlink" target="_blank" style="color:#5e5544; text-decoration: underline">click here</a></em></font></td>
                  </tr>
                  <tr>
                    <td align="center" valign="middle" bgcolor="#b7c68b"><font style="font-family: Georgia, \'Times New Roman\', Times, serif; color:#5e5544; font-size:15px"><strong><a href="' . $affiliate_link . '" target="_blank" style="color:#5e5544; text-decoration:none"><em>FOR THE PRESENT PACK</em></a></strong></font></td>
                  </tr>
                  <tr>
                    <td height="10" align="center" valign="middle" bgcolor="#b7c68b"> </td>
                  </tr>
                </table></td>
                <td>&nbsp;</td>
              </tr>

              <tr>
                <td width="10%">&nbsp;</td>
                <td width="80%" align="left" valign="top"><br />
                  <font style="font-family: Verdana, Geneva, sans-serif; color:#666766; font-size:13px; line-height:21px"><strong>This Year’s Present Pack:</strong><br />' . $ideas . '

          <br /><br />

          If you want to go with a different theme, we have compiled a list of typical ' . $anniversary . ' year anniversary present themes below with links to good presents.

          <br /><br />

          <strong>' . $anniversary . ' Year Anniversary Themes</strong><br />
          <strong>Modern Gift:</strong> ' . $modern_gift . '<br />
          <strong>Traditional Gift (US):</strong> ' .$traditional_gift_us . '<br />
          <strong>Traditional Gift (UK):</strong> ' .$traditional_gift_uk . '<br />
         <strong>Gemstone:</strong> ' . $gemstone . '<br />
          <strong>Color:</strong> ' . $color . '<br />

          <br /><br />

          Hope this helps,<br /><br />
          The Guys at The Man PA</font></td>
                <td width="10%">&nbsp;</td>
              </tr>

            </table></td>
        </tr>
        <tr>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td><img src="'. IMG_DIR . 'PROMO-GREEN2_07.jpg" width="598" height="7" style="display:block" border="0" alt=""/></td>
        </tr>
        <tr>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td width="13%" align="center">&nbsp;</td>
                <td width="14%" align="center"><font style="font-family:\'Myriad Pro\', Helvetica, Arial, sans-serif; color:#010203; font-size:9px; text-transform:uppercase"><a href= "' . get_home_url( $blog_id = null, $path = 'user-profile', $scheme = null ) . '" style="color:#010203; text-decoration:none"><strong>MANAGE ACCOUNT</strong></a></font></td>
                <td width="2%" align="center"><font style="font-family:\'Myriad Pro\', Helvetica, Arial, sans-serif; color:#010203; font-size:9px; text-transform:uppercase"><strong>|</strong></font></td>
                <td width="9%" align="center"><font style="font-family:\'Myriad Pro\', Helvetica, Arial, sans-serif; color:#010203; font-size:9px; text-transform:uppercase"><a href= "' . get_home_url( $blog_id = null, $path = 'about', $scheme = null ) . '" style="color:#010203; text-decoration:none"><strong>ABOUT </strong></a></font></td>
                <td width="2%" align="center"><font style="font-family:\'Myriad Pro\', Helvetica, Arial, sans-serif; color:#010203; font-size:9px; text-transform:uppercase"><strong>|</strong></font></td>
                <td width="10%" align="center"><font style="font-family:\'Myriad Pro\', Helvetica, Arial, sans-serif; color:#010203; font-size:9px; text-transform:uppercase"><a href= "' . get_home_url( $blog_id = null, $path = 'contact', $scheme = null ) . '" style="color:#010203; text-decoration:none"><strong>CONTACT </strong></a></font></td>
                <td width="2%" align="center"><font style="font-family:\'Myriad Pro\'\, Helvetica, Arial, sans-serif; color:#010203; font-size:9px; text-transform:uppercase"><strong>|</strong></font></td>
                <td width="17%" align="center"><font style="font-family:\'Myriad Pro\', Helvetica, Arial, sans-serif; color:#010203; font-size:9px; text-transform:uppercase"><a href= "' . get_home_url( $blog_id = null, $path = 'contact', $scheme = null ) . '" style="color:#010203; text-decoration:none"><strong>STAY CONNECTED</strong></a></font></td>
                <td width="4%" align="right"><a href="https://www.facebook.com/themanpa/" target="_blank"><img src="'. IMG_DIR . 'PROMO-GREEN2_09_01.jpg" alt="facebook" width="21" height="19" border="0" /></a></td>
                
                <td width="5%">&nbsp;</td>
              </tr>
            </table></td>
        </tr>
        <tr>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td align="center"><font style="font-family:\'Myriad Pro\', Helvetica, Arial, sans-serif; color:#231f20; font-size:8px"><strong>The Man PA | 142 Kalynda Pde, Bohle Plains, QLD, Australia 4817 | <a href= "mailto:contactus@themanpa.com" style="color:#010203; text-decoration:none">contactus@themanpa.com</a></strong></font></td>
        </tr>
        <tr>
          <td>&nbsp;</td>
        </tr>
      </table></td>
  </tr>
</table>
</body>
</html>';