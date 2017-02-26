<?php


$headers = array('Content-Type: text/html; charset=UTF-8');
if ($days == '1') {
  $day_word = 'day';
} else {
  $day_word = 'days';
}

$number_of_links = count($interests);
if ($number_of_links > 1 || empty($interests)) {
  $links = ' is a link ';
} else {
  $links = ' are links ';
}

$subject = $birthday_person_name . '\'s ' . $birthday_number_suffix . ' birthday is in ' . $days . ' ' . $day_word;

$body = '
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Wife Birthday Reminder</title>
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
                <td width="80%" align="left" valign="top"><font style="font-family: Georgia, \'Times New Roman\', Times, serif; color:#010101; font-size:24px"><strong><em>Hi ' . $user_name . ',</em></strong></font><br /><br />
                  <font style="font-family: Verdana, Geneva, sans-serif; color:#666766; font-size:13px; line-height:21px">' . $birthday_person_name . '\'s ' . $birthday_number_suffix . ' birthday is in ' . $days . ' ' . $day_word . '!  Below ' . $links . 'to some ideas that may make a great present for ' . $birthday_person_name . '.</font></td>


        <td width="10%">&nbsp;</td>
        </tr>

         <tr>
          <td>&nbsp;</td>
        </tr>'; 

                // use this in the template
        if (!empty($interests)) 
        {
          foreach ($interests as $key => $value) 
          {

          $interest = $value;
           $affiliate_link = "https://www.amazon.com/s/ref=nb_sb_noss?url=search-alias%3Daps&field-keywords=" . $interest . "&tag=themanpa-20";
           $body .=
                   '<tr>
                      <td>&nbsp;</td>
                      <td align="center" valign="top"><table width="108" border="0" cellspacing="0" cellpadding="0">
                        <tr>
                          <td><img src="'. IMG_DIR . 'PROMO-GREEN2_04_01.jpg" width="108" height="9" style="display:block" border="0" alt=""/></td>
                        </tr>
                        <tr>
                          <td align="center" valign="middle" bgcolor="#b7c68b"><font style="font-family: Georgia, \'Times New Roman\', Times, serif; color:#5e5544; font-size:14px"><em><a href="http://yourlink" target="_blank" style="color:#5e5544; text-decoration: underline">click here</a></em></font></td>
                        </tr>
                        <tr>
                          <td align="center" valign="middle" bgcolor="#b7c68b"><font style="font-family: Georgia, \'Times New Roman\', Times, serif; color:#5e5544; font-size:15px"><strong><a href="' . $affiliate_link . '" target="_blank" style="color:#5e5544; text-decoration:none"><em>for ' . $interest . ' presents</em></a></strong></font></td>
                        </tr>
                        <tr>
                          <td height="10" align="center" valign="middle" bgcolor="#b7c68b"> </td>
                        </tr>
                      </table></td>
                      <td>&nbsp;</td>
                    </tr>';

              // if under 2
          if ($birthday_person_age < 2 ) 
          {
            $affiliate_link = "https://www.amazon.com/s/ref=sr_nr_p_72_0?fst=as%3Aoff&rh=n%3A165793011%2Cp_n_age_range%3A165813011%2Cp_72%3A1248963011&bbn=165793011&ie=UTF8&qid=1484725449&rnid=1248961011&tag=themanpa-20";
          } else if ($birthday_person_age >= 2 && $birthday_person_age < 5 ) 
          //if between 2-4
          
          {
            if ($birthday_person_gender == 'female') {
              $affiliate_link = "https://www.amazon.com/s/ref=sr_nr_p_72_0?fst=as%3Aoff&rh=n%3A165793011%2Ck%3Agirl%2Cp_n_feature_four_browse-bin%3A3480744011%2Cp_n_age_range%3A165890011%2Cp_72%3A1248963011&keywords=girl&ie=UTF8&qid=1484725880&rnid=1248961011&tag=themanpa-20";
            } else {
              $affiliate_link = "https://www.amazon.com/gp/search/ref=sr_nr_p_n_age_range_1?fst=as%3Aoff&rh=n%3A165793011%2Ck%3Aboy%2Cp_n_feature_four_browse-bin%3A3480743011%2Cp_72%3A1248963011%2Cp_n_age_range%3A165890011&keywords=boy&ie=UTF8&qid=1484726341&rnid=165794011&tag=themanpa-20";
            }
            
          } 
          //if 5-7
          else if ($birthday_person_age > 4 && $birthday_person_age < 8 ) 
          {
            if ($birthday_person_gender == 'female') {
              $affiliate_link = "https://www.amazon.com/s/ref=sr_nr_p_72_0?fst=as%3Aoff&rh=n%3A165793011%2Ck%3Agirl%2Cp_n_age_range%3A165936011%2Cp_n_feature_four_browse-bin%3A3480744011%2Cp_72%3A1248963011&keywords=girl&ie=UTF8&qid=1484726236&rnid=1248961011&tag=themanpa-20";
            } else {
              $affiliate_link = "https://www.amazon.com/s/ref=sr_nr_p_n_age_range_2?fst=as%3Aoff&rh=n%3A165793011%2Ck%3Aboy%2Cp_n_feature_four_browse-bin%3A3480743011%2Cp_72%3A1248963011%2Cp_n_age_range%3A165936011&keywords=boy&ie=UTF8&qid=1484726198&rnid=165794011&tag=themanpa-20";
            }
          }
          //if 8 - 13
          else if ($birthday_person_age > 7 && $birthday_person_age < 14 ) 
          {
            if ($birthday_person_gender == 'female') {
              $affiliate_link = "https://www.amazon.com/s/ref=sr_nr_p_72_0?fst=as%3Aoff&rh=n%3A165793011%2Ck%3Agirl%2Cp_n_age_range%3A5442387011%2Cp_n_feature_four_browse-bin%3A3480744011%2Cp_72%3A1248963011&keywords=girl&ie=UTF8&qid=1484726549&rnid=1248961011&tag=themanpa-20";
            } else {
              $affiliate_link = "https://www.amazon.com/gp/search/ref=sr_nr_p_n_age_range_3?fst=as%3Aoff&rh=n%3A165793011%2Ck%3Aboy%2Cp_n_feature_four_browse-bin%3A3480743011%2Cp_72%3A1248963011%2Cp_n_age_range%3A5442387011&keywords=boy&ie=UTF8&qid=1484726456&rnid=165794011&tag=themanpa-20";
            }
          }

          //if 14 - 15
          else if ($birthday_person_age > 13 && $birthday_person_age < 16 ) 
          {
            if ($birthday_person_gender == 'female') {
              $affiliate_link = "https://www.amazon.com/s/ref=sr_nr_p_72_0?fst=as%3Aoff&rh=n%3A165793011%2Ck%3Agirl%2Cp_n_feature_four_browse-bin%3A3480744011%2Cp_n_age_range%3A5442388011%2Cp_72%3A1248963011&keywords=girl&ie=UTF8&qid=1484727888&rnid=1248961011&tag=themanpa-20";
            } else {
              $affiliate_link = "https://www.amazon.com/s/ref=sr_nr_p_72_0?fst=as%3Aoff&rh=n%3A165793011%2Ck%3Aboy%2Cp_n_feature_four_browse-bin%3A3480743011%2Cp_n_age_range%3A5442388011%2Cp_72%3A1248963011&keywords=boy&ie=UTF8&qid=1484727846&rnid=1248961011&tag=themanpa-20";
            }
          }
          // if over 15
          else if ($birthday_person_age > 15) {
            $keywords = $birthday_person_age . " birthday gift for ";
            if ($birthday_person_gender == 'male') {
              $keywords .= "men";
            } else {
              $keywords .= "women";
            }
        $affiliate_link = "https://www.amazon.com/s/ref=nb_sb_noss?url=search-alias%3Daps&field-keywords=" . $keywords . "&tag=themanpa-20";

          }

          
                  $body .=
                   '<tr>
                      <td>&nbsp;</td>
                      <td align="center" valign="top"><table width="108" border="0" cellspacing="0" cellpadding="0">
                        <tr>
                          <td><img src="'. IMG_DIR . 'PROMO-GREEN2_04_01.jpg" width="108" height="9" style="display:block" border="0" alt=""/></td>
                        </tr>
                        <tr>
                          <td align="center" valign="middle" bgcolor="#b7c68b"><font style="font-family: Georgia, \'Times New Roman\', Times, serif; color:#5e5544; font-size:14px"><em><a href="http://yourlink" target="_blank" style="color:#5e5544; text-decoration: underline">click here</a></em></font></td>
                        </tr>
                        <tr>
                          <td align="center" valign="middle" bgcolor="#b7c68b"><font style="font-family: Georgia, \'Times New Roman\', Times, serif; color:#5e5544; font-size:15px"><strong><a href="' . $affiliate_link . '" target="_blank" style="color:#5e5544; text-decoration:none"><em>for lucky dip mystery presents for ' . $birthday_person_name . ' </em></a></strong></font></td>
                        </tr>
                        <tr>
                          <td height="10" align="center" valign="middle" bgcolor="#b7c68b"> </td>
                        </tr>
                      </table></td>
                      <td>&nbsp;</td>
                    </tr>';

                
          }
        } else 
        { 
          // if under 2
          if ($birthday_person_age < 2 ) 
          {
            $affiliate_link = "https://www.amazon.com/s/ref=sr_nr_p_72_0?fst=as%3Aoff&rh=n%3A165793011%2Cp_n_age_range%3A165813011%2Cp_72%3A1248963011&bbn=165793011&ie=UTF8&qid=1484725449&rnid=1248961011&tag=themanpa-20";
          } else if ($birthday_person_age >= 2 && $birthday_person_age < 5 ) 
          //if between 2-4
          
          {
            if ($birthday_person_gender == 'female') {
              $affiliate_link = "https://www.amazon.com/s/ref=sr_nr_p_72_0?fst=as%3Aoff&rh=n%3A165793011%2Ck%3Agirl%2Cp_n_feature_four_browse-bin%3A3480744011%2Cp_n_age_range%3A165890011%2Cp_72%3A1248963011&keywords=girl&ie=UTF8&qid=1484725880&rnid=1248961011&tag=themanpa-20";
            } else {
              $affiliate_link = "https://www.amazon.com/gp/search/ref=sr_nr_p_n_age_range_1?fst=as%3Aoff&rh=n%3A165793011%2Ck%3Aboy%2Cp_n_feature_four_browse-bin%3A3480743011%2Cp_72%3A1248963011%2Cp_n_age_range%3A165890011&keywords=boy&ie=UTF8&qid=1484726341&rnid=165794011&tag=themanpa-20";
            }
            
          } 
          //if 5-7
          else if ($birthday_person_age > 4 && $birthday_person_age < 8 ) 
          {
            if ($birthday_person_gender == 'female') {
              $affiliate_link = "https://www.amazon.com/s/ref=sr_nr_p_72_0?fst=as%3Aoff&rh=n%3A165793011%2Ck%3Agirl%2Cp_n_age_range%3A165936011%2Cp_n_feature_four_browse-bin%3A3480744011%2Cp_72%3A1248963011&keywords=girl&ie=UTF8&qid=1484726236&rnid=1248961011&tag=themanpa-20";
            } else {
              $affiliate_link = "https://www.amazon.com/s/ref=sr_nr_p_n_age_range_2?fst=as%3Aoff&rh=n%3A165793011%2Ck%3Aboy%2Cp_n_feature_four_browse-bin%3A3480743011%2Cp_72%3A1248963011%2Cp_n_age_range%3A165936011&keywords=boy&ie=UTF8&qid=1484726198&rnid=165794011&tag=themanpa-20";
            }
          }
          //if 8 - 13
          else if ($birthday_person_age > 7 && $birthday_person_age < 14 ) 
          {
            if ($birthday_person_gender == 'female') {
              $affiliate_link = "https://www.amazon.com/s/ref=sr_nr_p_72_0?fst=as%3Aoff&rh=n%3A165793011%2Ck%3Agirl%2Cp_n_age_range%3A5442387011%2Cp_n_feature_four_browse-bin%3A3480744011%2Cp_72%3A1248963011&keywords=girl&ie=UTF8&qid=1484726549&rnid=1248961011&tag=themanpa-20";
            } else {
              $affiliate_link = "https://www.amazon.com/gp/search/ref=sr_nr_p_n_age_range_3?fst=as%3Aoff&rh=n%3A165793011%2Ck%3Aboy%2Cp_n_feature_four_browse-bin%3A3480743011%2Cp_72%3A1248963011%2Cp_n_age_range%3A5442387011&keywords=boy&ie=UTF8&qid=1484726456&rnid=165794011&tag=themanpa-20";
            }
          }

          //if 14 - 15
          else if ($birthday_person_age > 13 && $birthday_person_age < 16 ) 
          {
            if ($birthday_person_gender == 'female') {
              $affiliate_link = "https://www.amazon.com/s/ref=sr_nr_p_72_0?fst=as%3Aoff&rh=n%3A165793011%2Ck%3Agirl%2Cp_n_feature_four_browse-bin%3A3480744011%2Cp_n_age_range%3A5442388011%2Cp_72%3A1248963011&keywords=girl&ie=UTF8&qid=1484727888&rnid=1248961011&tag=themanpa-20";
            } else {
              $affiliate_link = "https://www.amazon.com/s/ref=sr_nr_p_72_0?fst=as%3Aoff&rh=n%3A165793011%2Ck%3Aboy%2Cp_n_feature_four_browse-bin%3A3480743011%2Cp_n_age_range%3A5442388011%2Cp_72%3A1248963011&keywords=boy&ie=UTF8&qid=1484727846&rnid=1248961011&tag=themanpa-20";
            }
          }
          // if over 15
          else if ($birthday_person_age > 15) {
            $keywords = $birthday_person_age . " birthday gift for ";
            if ($birthday_person_gender == 'male') {
              $keywords .= "men";
            } else {
              $keywords .= "women";
            }
        $affiliate_link = "https://www.amazon.com/s/ref=nb_sb_noss?url=search-alias%3Daps&field-keywords=" . $keywords . "&tag=themanpa-20";

          }

          
                  $body .=
                   '<tr>
                      <td>&nbsp;</td>
                      <td align="center" valign="top"><table width="108" border="0" cellspacing="0" cellpadding="0">
                        <tr>
                          <td><img src="'. IMG_DIR . 'PROMO-GREEN2_04_01.jpg" width="108" height="9" style="display:block" border="0" alt=""/></td>
                        </tr>
                        <tr>
                          <td align="center" valign="middle" bgcolor="#b7c68b"><font style="font-family: Georgia, \'Times New Roman\', Times, serif; color:#5e5544; font-size:14px"><em><a href="http://yourlink" target="_blank" style="color:#5e5544; text-decoration: underline">click here</a></em></font></td>
                        </tr>
                        <tr>
                          <td align="center" valign="middle" bgcolor="#b7c68b"><font style="font-family: Georgia, \'Times New Roman\', Times, serif; color:#5e5544; font-size:15px"><strong><a href="' . $affiliate_link . '" target="_blank" style="color:#5e5544; text-decoration:none"><em>for presents for ' . $birthday_person_name . ' </em></a></strong></font></td>
                        </tr>
                        <tr>
                          <td height="10" align="center" valign="middle" bgcolor="#b7c68b"> </td>
                        </tr>
                      </table></td>
                      <td>&nbsp;</td>
                    </tr>';

                }

                $body .= '

              <tr>
                <td width="10%">&nbsp;</td>
                <td width="80%" align="left" valign="top"><br />
                 

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