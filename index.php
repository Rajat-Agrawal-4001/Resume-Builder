<?php

use Dompdf\Dompdf;

session_start();
require_once 'dompdf/autoload.inc.php';
$dompdf = new Dompdf();

$create_flag = -1;

function realEscape($val)
{
    $search = array("\\",  "\x00", "\r",  "'",  '"', "\x1a");
    $replace = array("\\\\", "\\0", "\\r", "\'", '\"', "\\Z");

    return str_replace($search, $replace, $val);
}

function decoder($str)
{
    $str = str_replace("'+" . '"' . "'" . '"' . "+'", "'", $str);
    $str = str_replace("<script>", htmlspecialchars("<script>"), $str);
    $str = str_replace("</script>", htmlspecialchars("</script>"), $str);
    return $str;
}

if (isset($_POST['myform1'])) {

    // print_r($_POST);
    // print_r($_FILES);
    $user_image = './img/avatar.png';
    $user_image = $_POST['user_image'] ? realEscape($_POST['user_image']) : './img/avatar.png';

    if (isset($_FILES["user_image"]["tmp_name"]) && $_FILES["user_image"]["tmp_name"] != '') {
        $user_image = $_FILES["user_image"]["name"];

        $destination_path = "./img/uploads/" . $user_image;
        $user_image = $destination_path;

        if (!move_uploaded_file($_FILES["user_image"]["tmp_name"], $destination_path)) {
            die("-1");
        }
    }

    $name = realEscape($_POST['name']);
    $profile_title = realEscape($_POST['profile_title']);
    $mobile = realEscape($_POST['mobile']);
    $email = realEscape($_POST['email']);
    $city = realEscape($_POST['city']);

    $state = realEscape($_POST['state']);
    $profile_summary = realEscape($_POST['profile_summary']);

    $_SESSION['user_image'] = $user_image;
    $_SESSION['name'] = $name;
    $_SESSION['profile_title'] = $profile_title;
    $_SESSION['mobile'] = $mobile;
    $_SESSION['email'] = $email;
    $_SESSION['city'] = $city;
    $_SESSION['state'] = $state;
    $_SESSION['profile_summary'] = $profile_summary;

    // echo"in".$name. $profile_title. $mobile. $user_image. $city;

    echo "1";

    die;
}
if (isset($_POST['myform2'])) {

    $_SESSION['work_exp'] = array();
    if (isset($_POST['companyname']) && $_POST['companyname'] != '') {

        foreach ($_POST['companyname'] as $key => $val) {

            $cwork = '';
            $we_date = '';
            $company = realEscape($_POST['companyname'][$key]);
            $designation = realEscape($_POST['designation'][$key]);
            $ws_date = realEscape($_POST['ws_date'][$key]);
            if (isset($_POST['we_date'][$key]))
                $we_date = realEscape($_POST['we_date'][$key]);
            if (isset($_POST['cwork'][$key]))
                $cwork = realEscape($_POST['cwork'][$key]);
            $aboutcompany = realEscape($_POST['aboutcompany'][$key]);

            $_SESSION['work_exp'][] = array("companyname" => $company, "designation" => $designation, "ws_date" => $ws_date, "we_date" => $we_date, "cwork" => $cwork, "aboutcompany" => $aboutcompany);
        }
    }
    echo "1";
    die;
}

if (isset($_POST['myform3'])) {

    $_SESSION['education'] = array();
    if (isset($_POST['collegename']) && $_POST['collegename'] != '') {

        foreach ($_POST['collegename'] as $key => $val) {

            $cstudy = '';
            $ee_date = '';
            $college = realEscape($_POST['collegename'][$key]);
            $stream = realEscape($_POST['stream'][$key]);
            $es_date = realEscape($_POST['es_date'][$key]);
            if (isset($_POST['ee_date'][$key]))
                $ee_date = realEscape($_POST['ee_date'][$key]);
            if (isset($_POST['cstudy'][$key]))
                $cstudy = realEscape($_POST['cstudy'][$key]);

            $_SESSION['education'][] = array("collegename" => $college, "stream" => $stream, "es_date" => $es_date, "ee_date" => $ee_date, "cstudy" => $cstudy);
        }
    }
    echo "1";
    die;
}
if (isset($_POST['myform4'])) {

    $_SESSION['skill'] = array();
    if (isset($_POST['skill_name']) && $_POST['skill_name'] != '') {

        foreach ($_POST['skill_name'] as $key => $val) {

            $rating = '';
            $skill = realEscape($_POST['skill_name'][$key]);
            if (isset($_POST['srating'][$key]))
                $rating = realEscape($_POST['srating'][$key]);


            $_SESSION['skill'][] = array("skill_name" => $skill, "srating" => $rating);
        }
    }
    echo "1";
    die;
}
if (isset($_POST['myform5'])) {

    $_SESSION['course'] = array();
    if (isset($_POST['initituename']) && $_POST['initituename'] != '') {

        foreach ($_POST['initituename'] as $key => $val) {

            $initituename = realEscape($_POST['initituename'][$key]);
            $coursename = realEscape($_POST['coursename'][$key]);
            $cs_date = realEscape($_POST['cs_date'][$key]);
            $ce_date = realEscape($_POST['ce_date'][$key]);
            $c_aboutcompany = realEscape($_POST['c_aboutcompany'][$key]);

            $_SESSION['course'][] = array("initituename" => $initituename, "coursename" => $coursename, "cs_date" => $cs_date, "ce_date" => $ce_date, "c_aboutcompany" => $c_aboutcompany);
        }
    }
    echo "1";
    die;
}

if (isset($_POST['myform6'])) {

    $_SESSION['projects'] = array();
    if (isset($_POST['projectname']) && $_POST['projectname'] != '') {

        foreach ($_POST['projectname'] as $key => $val) {

            $projectname = realEscape($_POST['projectname'][$key]);
            $projectlink = realEscape($_POST['projectlink'][$key]);
            $ps_date = realEscape($_POST['ps_date'][$key]);
            $pe_date = realEscape($_POST['pe_date'][$key]);
            $aboutproject = realEscape($_POST['aboutproject'][$key]);

            $_SESSION['projects'][] = array("projectname" => $projectname, "projectlink" => $projectlink, "ps_date" => $ps_date, "pe_date" => $pe_date, "aboutproject" => $aboutproject);
        }
    }
    echo "1";
    die;
}
if (isset($_POST['myform7'])) {

    $_SESSION['lang'] = array();
    if (isset($_POST['lang_name']) && $_POST['lang_name'] != '') {

        foreach ($_POST['lang_name'] as $key => $val) {

            $rating = '';
            $skill = realEscape($_POST['lang_name'][$key]);
            if (isset($_POST['lrating'][$key]))
                $rating = realEscape($_POST['lrating'][$key]);


            $_SESSION['lang'][] = array("lang_name" => $skill, "lrating" => $rating);
        }
    }
    echo "1";
    die;
}
if (isset($_POST['myform8'])) {

    $_SESSION['interest'] = array();
    if (isset($_POST['interest']) && $_POST['interest'] != '') {

        foreach ($_POST['interest'] as $key => $val) {

            $interests = '';
            $interest = realEscape($_POST['interest'][$key]);

            $_SESSION['interest'][] = array("interest" => $interest);
        }
    }
    echo "1";
    die;
}

if (isset($_POST['chooseTheme'])) {

    $theme = realEscape($_POST['theme']);
    $_SESSION['selectedTheme'] = $theme;

    exit();
}

if (isset($_POST['preview'])) {

    header('Location: resume-preview.php');
}

if (isset($_POST['create'])) {

    $create_flag = 2;
    if (!isset($_SESSION['name']) || !isset($_SESSION['work_exp']) || !isset($_SESSION['education']) || !isset($_SESSION['course']) || !isset($_SESSION['skill']) || !isset($_SESSION['lang']) || !isset($_SESSION['projects']) || !isset($_SESSION['interest'])) {
        $create_flag = 0;
    }

    if (isset($_SESSION['name']) && $create_flag != 0) {

        $name = $_SESSION['name'];
        $email = $_SESSION['email'];
        $mobile = $_SESSION['mobile'];
        $city = $_SESSION['city'];
        $img = $_SESSION['user_image'];
        $profile_title = $_SESSION['profile_title'];
        $profile_summary = $_SESSION['profile_summary'];
        $designation = $_SESSION['state'];

        $work_experience = '';
        $education = '';
        $projects = '';
        $skills = '<ul>';
        $int = '<ul>';
        $preview_code = '';
        foreach ($_SESSION['work_exp'] as $key => $value) {

            $company = $_SESSION['work_exp'][$key]['companyname'];
            $desi = $_SESSION['work_exp'][$key]['designation'];
            $sdate = $_SESSION['work_exp'][$key]['ws_date'];
            $edate = $_SESSION['work_exp'][$key]['we_date'];
            $cwork = $_SESSION['work_exp'][$key]['cwork'];
            $acompany = $_SESSION['work_exp'][$key]['aboutcompany'];

            $time = '';

            if ($cwork == '1') {
                $time = '<div class="duration">Currently Working Here</div>';
            }
            if ($cwork == '1' && strtotime($sdate)) {
                $time = '<div class="duration">' . date('d-M-Y', strtotime($sdate)) . ' - ' . 'Currently Working Here' . '</div>';
            }
            if (strtotime($sdate) && strtotime($edate)) {
                $time = '<div class="duration">' . date('d-M-Y', strtotime($sdate)) . ' - ' . date('d-M-Y', strtotime($edate)) . '</div>';
            }

            $work_experience .= '  <div class="section__list-item" style="margin-bottom: 16px;">
			<div class="left">
			  <div class="name">' . htmlspecialchars($company) . '</div>
			  <div class="addr">' . decoder($acompany) . '</div>' . $time . '
			</div>
			<div class="right">
			  <div class="name desi">' . htmlspecialchars($desi) . '</div>
			  <div class="desc">' . htmlspecialchars($company) . '</div>
			</div>
		  </div>';
        }

        foreach ($_SESSION['education'] as $key => $value) {

            $college = $_SESSION['education'][$key]['collegename'];
            $stream = $_SESSION['education'][$key]['stream'];
            $sdate = $_SESSION['education'][$key]['es_date'];
            $edate = $_SESSION['education'][$key]['ee_date'];
            $cstudy = $_SESSION['education'][$key]['cstudy'];

            $time = '';
            if ($cstudy == '1') {
                $time = '<div class="duration">Currently Studing Here</div>';
            }
            if ($cstudy == '1' && strtotime($sdate)) {
                $time = '<div class="duration">' . date('d-M-Y', strtotime($sdate)) . ' - ' . 'Currently Studing Here' . '</div>';
            }
            if (strtotime($sdate) && strtotime($edate)) {
                $time = '<div class="duration">' . date('d-M-Y', strtotime($sdate)) . ' - ' . date('d-M-Y', strtotime($edate)) . '</div>';
            }

            $education .= '    <div class="section__list-item" style="margin-bottom: 16px;">
			<div class="left">
			  <div class="name">' . htmlspecialchars($stream) . '</div>
			  <div class="addr college">' . htmlspecialchars($college) . '</div>' . $time . '
			</div>
		  
		  </div>';
        }

        foreach ($_SESSION['projects'] as $key => $value) {

            $projectname = $_SESSION['projects'][$key]['projectname'];
            $projectlink = $_SESSION['projects'][$key]['projectlink'];
            $ps_date = $_SESSION['projects'][$key]['ps_date'];
            $pe_date = $_SESSION['projects'][$key]['pe_date'];
            $aboutproject = $_SESSION['projects'][$key]['aboutproject'];

            $time = '';

            if (strtotime($ps_date) && strtotime($pe_date)) {
                $time .= '<div class="duration">' . date('d-M-Y', strtotime($ps_date)) . ' - ' . date('d-M-Y', strtotime($pe_date)) . '</div>';
            }
            $projects .= '<div class="section__list-item" style="margin-bottom: 16px;">
			 <div class="name"> ' . htmlspecialchars($projectname) . '</div>
			 <div class="text">' . decoder($aboutproject) . '</div>' . $time . '
		   </div>';
        }

        foreach ($_SESSION['skill'] as $key => $value) {

            $skills .= '<li>' . $_SESSION['skill'][$key]['skill_name'] . '</li>';
        }

        $skills .= '</ul>';

        foreach ($_SESSION['interest'] as $key => $value) {

            $int .= '<li>' . htmlspecialchars($_SESSION['interest'][$key]['interest']) . '</li>';
        }
        $int .= '</ul>';

        $selectedTemplate = 1;
        if (isset($_SESSION['selectedTheme'])) {
            $selectedTemplate = $_SESSION['selectedTheme'];
        }

        switch ($selectedTemplate) {

            case 1:
                $template_code = '<!DOCTYPE html>
    <html>
        <head>
        <link href="https://fonts.googleapis.com/css?family=Lato:400,300,700" rel="stylesheet" type="text/css">
     <style>
     * {
     margin: 0;
     padding: 0;
     box-sizing: border-box;
   }
   
   html {
     height: 100%;
   }
   
   body {
     min-height: 100%;
     background: #eee;
     font-family: "Lato", sans-serif;
     font-weight: 400;
     color: #222;
     font-size: 14px;
     line-height: 26px;
     padding-bottom: 50px;
   }
   
   li{
  text-decoration:none;
    font-weight:normal;
   }
   ul{
  list-style-type:none;
   }
   .container {
     max-width: 700px;
     background: #fff;
     margin: 0px auto 0px;
     box-shadow: 1px 1px 2px #DAD7D7;
     border-radius: 3px;
     padding: 40px;
     margin-top: 50px;
   }
   
   .header {
     margin-bottom: 30px;
   }
   .header .full-name {
     font-size: 40px;
     text-transform: uppercase;
     margin-bottom: 5px;
   }
   .header .first-name {
     font-weight: 700;
   }
   .header .last-name {
     font-weight: 300;
   }
   .header .contact-info {
     margin-bottom: 20px;
   }
   .header .email,
   .header .phone {
     color: #999;
     font-weight: 300;
   }
   .full_name{
    margin: 20px 0px;
   }
   .header .separator {
     height: 10px;
     display: inline-block;
     border-left: 2px solid #999;
     margin: 0px 10px;
   }
   .header .position {
     font-weight: bold;
     display: inline-block;
     margin-right: 10px;
     text-decoration: underline;
   }
   
   .details {
     line-height: 20px;
   }
   .details .section {
     margin-bottom: 40px;
   }
   .details .section:last-of-type {
     margin-bottom: 0px;
   }
   .details .section__title {
     letter-spacing: 2px;
     color: #54AFE4;
     font-weight: bold;
     margin-bottom: 10px;
     text-transform: uppercase;
   }
   .details .section__list-item {
     margin-bottom: 40px;
   }
   .details .section__list-item:last-of-type {
     margin-bottom: 0;
   }
   .details .left,
   .details .right {
     vertical-align: top;
     display: inline-block;
   }
   .details .left {
     width: 60%;
   }
   .details .right {
     tex-align: right;
     width: 39%;
   }
   .details .name {
     font-weight: bold;
   }
   .details a {
     text-decoration: none;
     color: #000;
     font-style: italic;
   }
   .details a:hover {
     text-decoration: underline;
     color: #000;
   }
   .details .skills__item {
     margin-bottom: 10px;
   }
   .details .skills__item .right input {
     display: none;
   }
   .details .skills__item .right label {
     display: inline-block;
     width: 20px;
     height: 20px;
     background: #C3DEF3;
     border-radius: 20px;
     margin-right: 3px;
   }
   .details .skills__item .right input:checked + label {
     background: #79A9CE;
   }
  
     </style>
  
        </head>
        <body>
    
      <div class="container">
        <div class="header">
          <div class="full-name" style="margin-bottom: 20px;">
            <span class="first-name">{{{---NAME_HERE---}}}</span> 
        
          </div>
          <div class="contact-info">
            <span class="email">Email: </span>
            <span class="email-val">{{{---EMAIL_HERE---}}}</span>
            <span class="separator"></span>
            <span class="phone">Phone: </span>
            <span class="phone-val">{{{---MOBILE_HERE---}}}</span><br>
      <span class="email">Address: </span>
            <span class="email-val">{{{---ADDRESS_HERE---}}}</span>
          </div>
          
          <div class="about">
            <span class="position">  {{{---PROFILE_TITLE_HERE---}}} </span>
            <span class="desc">
            {{{---PROFILE_SUMMARY_HERE---}}}
            </span>
          </div>
        </div>
         <div class="details">
          <div class="section">
            <div class="section__title">Experience</div>
            <div class="section__list">{{{---EXPERIENCE_HERE---}}}  
          </div>
          <div class="section">
            <div class="section__title">Education</div>
            <div class="section__list">{{{---EDUCATION_HERE---}}}
            </div>
        </div>
           <div class="section">
            <div class="section__title">Projects</div> 
             <div class="section__list">{{{---PROJECTS_HERE---}}}
              </div>
          </div>
           <div class="section">
             <div class="section__title">Skills</div>
           
             <div class="section__list">
             <div class="">
             {{{---SKILL_HERE---}}}
  </div>
           </div>
             
             </div>
           <div class="section">
           <div class="section__title">
             Interests
             </div>
             <div class="section__list">
               <div class="">
         {{{---INTEREST_HERE---}}}
  </div>
             </div>
           </div>
           </div>
        </div>
      </div>
      
      </body>
      </html>';
                break;

            case 2:
                $template_code = '
               
                <!DOCTYPE html>
                <html>
                <head>
                    <title>Minimal Resume Template</title>
                 
                    <meta name="viewport" content="width=device-width, initial-scale=1.0">

                 
                 <style>
                 
                 /*Load google font*/
                 @import url("https://fonts.googleapis.com/css?family=Lato:300,400,700");
                 
                 *{
margin:0;
padding:0;
box-sizing:border-box;
                 }
                 
                 /* Reset Styles */
                 
                 html, body, div, span, applet, object, iframe,
                 h1, h2, h3, h4, h5, h6, p, blockquote, pre,
                 a, abbr, acronym, address, big, cite, code,
                 del, dfn, em, img, ins, kbd, q, s, samp,
                 small, strike, strong, sub, sup, tt, var,
                 b, u, i, center,
                 dl, dt, dd, ol, ul, li,
                 fieldset, form, label, legend,
                 table, caption, tbody, tfoot, thead, tr, th, td,
                 article, aside, canvas, details, embed, 
                 figure, figcaption, footer, header, hgroup, 
                 menu, nav, output, ruby, section, summary,
                 time, mark, audio, video {
                     margin: 0;
                     padding: 0;
                     border: 0;
                     font-size: 100%;
                     font: inherit;
                     vertical-align: baseline;
                 }
                 /* HTML5 display-role reset for older browsers */
                 article, aside, details, figcaption, figure, 
                 footer, header, hgroup, menu, nav, section {
                     display: block;
                 }
                 a{
                     text-decoration: none;
                     text-transform: none;
                     color: #4A90E2;
                 }
                 
                 body {
                     line-height: 1;
                     font-family: lato, ubuntu,-apple-system,BlinkMacSystemFont,Segoe UI,Roboto,Oxygen,Ubuntu,Cantarell,Open Sans,Helvetica Neue,sans-serif;
                     text-rendering : optimizeLegibility;
                     -webkit-font-smoothing : antialiased;
                     font-size: 19px;
                     background-color: #FEFEFE;
                     color: #04143A;
                 }
                 ol, ul {
                     list-style: none;
                 }
                 blockquote, q {
                     quotes: none;
                 }
                 blockquote:before, blockquote:after,
                 q:before, q:after {
                     content: "";
                     content: none;
                 }
                 table {
                     border-collapse: collapse;
                     border-spacing: 0;
                 }
                 
                 p {
                     color: #15171a;
                     font-size: 17;
                     line-height: 31px;
                 }
                 
                 strong {
                     font-weight: 600;
                 }
                 
                 div , footer {
                     box-sizing: border-box;
                 }
                 
                 /* Reset ends */
                 
                 
                 /*Hero section*/
                 
                 .container {
                     width: 1000px;
                     margin: 60px auto;
                 }
                 
                 .hero {
                     margin: 50px auto; 
                     position: relative;
                 }
                 
                 h1.name {
                     font-size: 70px;
                     font-weight: 300;
                     display: inline-block;
                 }
                 
                 .job-title {
                     vertical-align: top;
                     background-color: #D9E7F8;
                     color: #4A90E2;
                     font-weight: 600;
                     margin-top: 5px;
                     margin-left: 20px;
                     border-radius: 5px;
                     display: inline-block;
                     padding: 15px 25px;
                 }
                 
                 .email {
                     display: block;
                     font-size: 24px;
                     font-weight: 300;
                     color: #81899C;
                     margin-top: 10px;
                 }
                 
                 .lead {
                     font-size: 44px;
                     font-weight: 300;
                     margin-top: 60px;
                     line-height: 55px;
                 }
                 
                 /*hero ends*/
                 
                 /*skills & intrests*/
                 
                 .sections {
                     vertical-align: top;
                     display: inline-block;
                     width: 49.7%;
                 }
                 
                 .section-title {
                     font-size: 20px;
                     font-weight: 600;
                     margin-bottom: 15px;
                 }
                 
                 .list-card {
                     margin-top: 30px;
                 }
                 
                 .list-card .exp , .list-card div{
                     display: inline-block;
                     vertical-align: top;
                 }
                 
                 .list-card .exp {
                     margin-right: 15px;
                     color: #4A90E2;
                     font-weight: 600;
                     width: 100px;
                 }
                 
                 .list-card div {
                     width: 70%;
                 }
                 
                 .list-card h3 {
                     font-size: 20px;
                     font-weight: 600;
                     color: #5B6A9A;
                     line-height: 26px;
                     margin-bottom: 8px;
                 }
                 
                 .list-card div span {
                     font-size: 16px;
                     color: #81899C;
                     line-height: 22px;
                 }
                 
                 /*skill and intrests ends*/
                 
                 /* Achievements */
                 
                 
                 .cards {
                     max-width: 1120px;
                     display: block;
                 }
                 
                 .card {
                  width: 47%;
                  height: 180px;
                  background-color: #EEF0F7;
                  display: inline-block;
                  margin: 7px 5px;
                  vertical-align: top;
                  border-radius: 10px;
                  text-align: center;
                  padding-top: 55px;
                 }
                 
                 .card-active , .card:hover{
                     transform: scale(1.02);
                     transition: 0.5s;
                     background-color: #fff;
                     box-shadow: 0px 5px 50px -8px #ddd;
                     cursor: pointer;
                 }
                 
                 
                 .skill-level {
                     display: inline-block;
                     max-width: 160px;
                 }
                 
                 .skill-level span {
                     font-size: 35px;
                     font-weight: 300;
                     color: #5B6A9A;
                     vertical-align: top;
                 }
                 
                 .skill-level h2 {
                     font-size: 95px;
                     font-weight: 300;
                     display: inline-block;
                     vertical-align: top;
                     color: #5B6A9A;
                     letter-spacing: -5px;
                 }
                 
                 .skill-meta {
                     vertical-align: top;
                     display: inline-block;
                     max-width: 300px;
                     text-align: left;
                     margin-top: 15px;
                     margin-left: 15px;
                 }
                 
                 .skill-meta h3 {
                     font-size: 20px;
                     font-weight: 800;
                     color: #5B6A9A;
                     margin-bottom: 5px;
                 }
                 
                 .skill-meta span{
                     color: #81899C;
                     line-height: 20px;
                     font-size: 16px;
                 }
                 
                 /* Achievements ends */
                 
                 
                 
                 /* Timeline styles*/
                 
                 
                 ol {
                     display: inline-block;
                     min-width:100%;
                     background: none;
                 }
               
                 
                 /* ---- Timeline elements ---- */
                 li {
                     display: inline-block;
                     float: left;
                     width: 25%;
                 }
                 .section__list-item{
                  position: relative;
                  display: inline-block;
                  float: left;
                  width: 25%;
                 }
                  .line {
                   font-size: 20px;
                   font-weight: 600;
                   color: #04143A;
                 }
              
                 li .description {
                   display: none;
                   padding: 10px 0;
                   margin-top: 20px;
                   position: relative;
                   font-weight: normal;
                   z-index: 1;
                   max-width: 95%;
                   font-size: 18px;
                   font-weight: 600;
                   line-height: 25px;
                   color: #5B6A9A;
                 }
                 .description::before {
                   content: "";
                   width: 0; 
                   height: 0; 
                   border-left: 5px solid transparent;
                   border-right: 5px solid transparent;
                   border-bottom: 5px solid #f4f4f4;
                   position: absolute;
                   top: -5px;
                   left: 43%;
                 }
                 
                 .timeline .name {
                  padding: 9px 0;
                  position: relative;
                  font-weight: normal;
                  z-index: 1;
                  font-size: 18px;
                  font-weight: 600;
                  line-height: 25px;
                  color: #5B6A9A;
                }
                 .timeline .name::before {
                  content: "";
                  width: 0; 
                  height: 0; 
                  border-left: 5px solid transparent;
                  border-right: 5px solid transparent;
                  border-bottom: 5px solid #f4f4f4;
                  position: absolute;
                  top: -5px;
                  left: 43%;
                }

                .timeline .college {
           
                  font-weight: normal;
                  z-index: 1;
                  font-size: 14px;
                  font-weight: normal;
                  line-height: 25px;
                  color: #81899C;
                }
                 .timeline .college::before {
                  content: "";
                  width: 0; 
                  height: 0; 
                  border-left: 5px solid transparent;
                  border-right: 5px solid transparent;
                  border-bottom: 5px solid #f4f4f4;
                  position: absolute;
                  top: -5px;
                  left: 43%;
                }
                 
                 .timeline .date{
                     font-size: 14px;
                     color: #81899C;
                     font-weight: 300;
                 }

                 .timeline .duration{
                  font-size: 14px;
                  color: #81899C;
                  font-weight: 300;
              }
.college{
display:none;
}
 

              .timeline .desc, .desi, .text, .addr{
                display:none;

              }

                 
                 /* ---- Hover effects ---- */
                 li:hover {
                   color: #48A4D2;
                 }
                 li .description {
                   display: block;
                 }
                 
                 /*timeline ends*/
                 
                 
                 
                 /* Media queries*/
                 
                 @media(max-width: 1024px){
                     .container {
                         padding: 15px;
                         margin: 0px auto;
                     }
                     .cards {
                         margin-top: 250px;
                     }
                 }
                 
                 @media(max-width: 768px){
                     .container {
                         padding: 15px;
                         margin: 0px auto;
                     }
                     .cards {
                         margin-top: 320px;
                     }
                 
                     .card {
                         padding: 15px;
                         text-align: left;
                     }
                     .card h2 {
                         font-size: 70px;
                     }
                         .card , .sections {
                         width: 100%;
                         height: auto;
                         margin: 10px 0;
                         float: left;
                     }
                 
                     .timeline{
                         border: none;
                         background-color: rgba(0,0,0,0);
                     }
                 
                     .timeline li{
                         margin-top: 70px;
                         height: 150px;
                     }
                 }
                 
                 
                 @media(max-width: 425px) {
                     h1.name {
                         font-size: 40px;
                     }
                 
                     .card , .sections {
                         width: 100%;
                         height: auto;
                         margin: 10px 0;
                         float: left;
                     }
                 
                     .timeline{
                         display: none;
                         }
                 
                     .job-title {
                         position: absolute;
                         font-size: 15px;
                         top: -40px;
                         right: 20px;
                         padding: 10px
                     }
                 
                     .lead {
                         margin-top: 15px;
                         font-size: 20px;
                         line-height: 28px;
                     }
                     .container {
                         margin: 0px;
                         padding: 0 15px;
                     }
                     footer {
                         margin-top: 2050px;
                     }
                     }

                     .list-card ul li {
                      font-size: 20px;
                      font-weight: 600;
                      color: #5B6A9A;
                      line-height: 26px;
                      margin-bottom: 8px;
                     }

                     .left,
                     .right {
                       vertical-align: top;
                       display: inline-block;
                     }
                      .left {
                       width: 60%;
                     }
                     .right {
                       tex-align: right;
                       width: 39%;
                     }

                     .skill_div ul li{
                      display: block;
                      float: none;
                      margin-bottom: 20px;
                                           }
                 
                     </style>
             

                </head>
                <body>
                
                    <div class="container">
                        <div class="hero">
                            <h1 class="name"><strong>{{{---NAME_HERE---}}}</strong></h1>
                            <span class="job-title">{{{---DESIGNATION_HERE---}}}</span>
                            <span class="email">{{{---EMAIL_HERE---}}}</span>
                
                            <h2 class="lead">{{{---PROFILE_TITLE_HERE---}}}</h2>
                        </div>
                    </div>
                
                <!-- Skills and intrest section -->
                    <div class="container">
                
                        <div class="sections">
                            <h2 class="section-title">Skills</h2>
                
                            <div class="list-card">
                            
                                <div class="skill_div">
                                {{{---SKILL_HERE---}}}
                                    
                                </div>
                            </div>
                         
                        </div>

                        <div class="sections">
                                <h2 class="section-title">Interests</h2>
                                
                                <div class="list-card">
                                    <div class="skill_div">

                                    {{{---INTEREST_HERE---}}}
                                       
                                    </div>
                                </div>	
                
                        </div>
                    </div>


                    <!-- Achievements -->

	<div class="container cards">
		
		<div class="card">
			<div class="skill-level">
		
      <span>1.</span>
			</div>

			<div class="skill-meta">
				<h3>Phone Number</h3>
				<span>{{{---MOBILE_HERE---}}}</span>
			</div>
		</div>

			
		<div class="card">
			<div class="skill-level">
      <span>2.</span>
			
			</div>

			<div class="skill-meta">
				<h3>Address</h3>
				<span>{{{---ADDRESS_HERE---}}}</span>
			</div>
		</div>

			
		<div class="card">
			<div class="skill-level">
			<span>3.</span>
			
			</div>

			<div class="skill-meta">
				<h3>Email</h3>
				<span>{{{---EMAIL_HERE---}}}</span>
			</div>
		</div>


		<div class="card">
			<div class="skill-level">
		
      <span>4.</span>
			</div>

			<div class="skill-meta">
				<h3>Website</h3>
				<span>techcity.in</span>
			</div>
		</div>

	</div>

	<!-- Timeeline -->
                
                    <!-- Timeeline -->
                
                    <div class="container">
                        <ol class="timeline">
                        <p class="line">Experiences</p>
                
                          {{{---EXPERIENCE_HERE---}}}

                          </ol>
                

                          <ol class="timeline">
                          <p class="line">Education</p>

                          {{{---EDUCATION_HERE---}}}
                
                        </ol>

                      

                          <ol class="timeline">
                          <p class="line">Projects</p>

                          {{{---PROJECTS_HERE---}}}
               
                        </ol>
                
                    </div>
                
                   
                    
                </body>
                </html>
            ';
                break;
        }

        $preview_code = str_replace("{{{---NAME_HERE---}}}", $name, $template_code);
        $preview_code = str_replace("{{{---EMAIL_HERE---}}}", $email, $preview_code);
        $preview_code = str_replace("{{{---MOBILE_HERE---}}}", $mobile, $preview_code);
        $preview_code = str_replace("{{{---ADDRESS_HERE---}}}", $city, $preview_code);
        $preview_code = str_replace("{{{---DESIGNATION_HERE---}}}", $designation, $preview_code);
        $preview_code = str_replace("{{{---PROFILE_TITLE_HERE---}}}", $profile_title, $preview_code);
        $preview_code = str_replace("{{{---PROFILE_SUMMARY_HERE---}}}", $profile_summary, $preview_code);
        $preview_code = str_replace("{{{---EXPERIENCE_HERE---}}}", $work_experience, $preview_code);
        $preview_code = str_replace("{{{---EDUCATION_HERE---}}}", $education, $preview_code);
        $preview_code = str_replace("{{{---PROJECTS_HERE---}}}", $projects, $preview_code);
        $preview_code = str_replace("{{{---SKILL_HERE---}}}", $skills, $preview_code);
        $preview_code = str_replace("{{{---INTEREST_HERE---}}}", $int, $preview_code);

        unset($_SESSION['user_image']);
        unset($_SESSION['name']);
        unset($_SESSION['profile_title']);
        unset($_SESSION['mobile']);
        unset($_SESSION['email']);
        unset($_SESSION['city']);
        unset($_SESSION['state']);

        unset($_SESSION['profile_summary']);
        unset($_SESSION['work_exp']);
        unset($_SESSION['education']);
        unset($_SESSION['course']);
        unset($_SESSION['skill']);
        unset($_SESSION['projects']);
        unset($_SESSION['lang']);
        unset($_SESSION['interest']);

        //         $options = $dompdf->getOptions();
        // //         // print_r($options);
        // $options->setIsRemoteEnabled(true);
        // $dompdf->setOptions($options);

        $dompdf->loadHtml($preview_code);
        // $dompdf->setPaper('A4', 'portrait');

        $dompdf->setPaper([0, 0, 950, 1500], 'portrait');   // 0,0,width,height(should be acc to resume height)

        $dompdf->render();
        // $output = $dompdf->output();
        $fileName = 'resume' . rand(0, 1000000) . '.pdf';
        $dompdf->stream($fileName);

        // $options = $dompdf->getOptions();
        // $dompdf->setPaper([0,0,227, $docHeight]);

        $create_flag = 1;
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>


    <meta charset="utf-8" />
    <title>Unikit - Admin & Dashboard Template</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
    <meta content="" name="author" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />

    <!-- App favicon -->
    <link rel="shortcut icon" href="../assets/images/favicon.ico">



    <!-- App css -->
    <!-- App css -->
    <link href="https://cdn.jsdelivr.net/gh/Rishi330/admin_template/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <!-- <link href="../assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" /> -->
    <!-- <link href="../assets/css/icons.min.css" rel="stylesheet" type="text/css" />-->
    <link href="./css/app.min.css" rel="stylesheet" type="text/css" />

    <link href="./css/sweetalert2.min.css" rel="stylesheet" type="text/css">
    <!-- <link href="../assets/plugins/rating/starability-all.css" rel="stylesheet" type="text/css" /> -->
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">

</head>

<body id="body" class="dark-sidebar">

    <div class="page-wrapper">

        <!-- Page Content-->
        <div class="page-content-tab" style="margin-left: 150px;">

            <div class="container-fluid">
                <!-- Page-Title -->
                <div class="row">
                    <div class="col-sm-12">
                        <div class="page-title-box">

                            <div class="row">
                                <div class="col-12">
                                    <div class="card">
                                        <div class="card-header">
                                            <h1 class="card-title">Resume Builder </h1>
                                        </div>
                                        <!--end card-header-->
                                        <div class="card-body" style="width: 90%;">

                                            <form id="myform1" method="post">
                                                <div class="col-md-12">
                                                    <div class="card-body">
                                                        <div class="row">
                                                            <div class="col-sm-2">
                                                                <div class="nav flex-column nav-pills text-center" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                                                                    <a class="nav-link waves-effect waves-light active" id="v-pills-home-tab" data-bs-toggle="pill" href="#v-pills-home" role="tab" aria-controls="v-pills-home" aria-selected="false"> <i class="ti ti-device-analytics"></i> Personal Info</a>
                                                                    <a class="nav-link waves-effect waves-light" id="v-pills-work-tab" data-bs-toggle="pill" href="#v-pills-work" role="tab" aria-controls="v-pills-work" aria-selected="false"> <i class="ti ti-device-analytics"></i> Work Experience</a>
                                                                    <a class="nav-link waves-effect waves-light" id="v-pills-education-tab" data-bs-toggle="pill" href="#v-pills-education" role="tab" aria-controls="v-pills-education" aria-selected="false"> <i class="ti ti-school"></i> Education Info</a>
                                                                    <a class="nav-link waves-effect waves-light" id="v-pills-skills-tab" data-bs-toggle="pill" href="#v-pills-skills" role="tab" aria-controls="v-pills-skills" aria-selected="false"> <i class="ti ti-tools"></i> Skills Expertis</a>
                                                                    <a class="nav-link waves-effect waves-light" id="v-pills-courses-tab" data-bs-toggle="pill" href="#v-pills-courses" role="tab" aria-controls="v-pills-courses" aria-selected="false"> <i class="ti ti-layout-list"></i> Courses List</a>
                                                                    <a class="nav-link waves-effect waves-light" id="v-pills-projects-tab" data-bs-toggle="pill" href="#v-pills-projects" role="tab" aria-controls="v-pills-projects" aria-selected="false"> <i class="ti ti-receipt"></i> Projects History</a>
                                                                    <a class="nav-link waves-effect waves-light" id="v-pills-language-tab" data-bs-toggle="pill" href="#v-pills-language" role="tab" aria-controls="v-pills-language" aria-selected="false"> <i class="ti ti-receipt"></i> Languages</a>

                                                                    <a class="nav-link waves-effect waves-light" id="v-pills-interest-tab" data-bs-toggle="pill" href="#v-pills-interest" role="tab" aria-controls="v-pills-interest" aria-selected="false"> <i class="ti ti-receipt"></i> Interests</a>
                                                                </div>
                                                            </div>

                                                            <div class="col-sm-7">

                                                                <div class="tab-content mo-mt-2" id="v-pills-tabContent">
                                                                    <div class="tab-pane fade  active show" id="v-pills-home" role="tabpanel" aria-labelledby="v-pills-home-tab">
                                                                        <div class="row">

                                                                            <div class="met-profile-main">
                                                                                <div class="met-profile-main-pic">
                                                                                    <input type="hidden" value="<?= $_SESSION['user_image'] ?? ''; ?>" name="user_image">
                                                                                    <input accept="image/*" class="validateImage" name="user_image" type='file' id="user_image" style="display:none;" onchange="previewImage(this)" data-previewon="#img">
                                                                                    <img src="<?= $_SESSION['user_image'] ?? './img/avatar.png'; ?>" alt="" height="70" class="rounded-circle" id="img" onclick="document.getElementById('user_image').click()">
                                                                                    <span class="met-profile_main-pic-change">
                                                                                        <i class="fas fa-camera"></i>
                                                                                    </span>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-md-6 mt-2">
                                                                                <div class="mb-3">
                                                                                    <input type="text" name="name" class="form-control" id="fullname" value="<?= $_SESSION['name'] ?? '' ?>" placeholder="Full Name">
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-md-6 mt-2">
                                                                                <div class="mb-3">
                                                                                    <input type="text" name="profile_title" class="form-control" id="profiletitle" value="<?= $_SESSION['profile_title'] ?? ''; ?>" placeholder="Profile Title">
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-md-6 mt-2">
                                                                                <div class="mb-3">
                                                                                    <input type="text" name="mobile" class="form-control" id="mobile" value="<?= $_SESSION['mobile'] ?? '' ?>" placeholder="Mobile No">
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-md-6">
                                                                                <div class="mb-3">
                                                                                    <input type="email" name="email" class="form-control" id="email" value="<?= $_SESSION['email'] ?? '' ?>" placeholder="Email id">
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-md-6">
                                                                                <div class="mb-3">
                                                                                    <input type="text" name="city" class="form-control" value="<?= $_SESSION['city'] ?? '' ?>" id="city" placeholder="Address">
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-md-6">
                                                                                <div class="mb-3">
                                                                                    <input type="text" name="state" class="form-control" value="<?= $_SESSION['state'] ?? '' ?>" id="designation" placeholder="Position">
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="row">
                                                                            <div class="mb-3">
                                                                                <textarea class="form-control" name="profile_summary" rows="5" id="profilesumary" placeholder="Profile Summary"><?= $_SESSION['profile_summary'] ?? ''; ?></textarea>
                                                                            </div>
                                                                        </div>
                                                                        <input type="hidden" name="myform1" value="1">
                                                                        <input type="submit" class="btn btn-de-primary btn-sm" value="Save"></button>
                                            </form>

                                        </div>

                                        <div>

                                        </div>

                                        <div class="tab-pane fade in" id="v-pills-work" role="tabpanel" aria-labelledby="v-pills-work-tab">
                                            <form id="myform2">
                                                <div id="v-pills-work1">
                                                    <h4>Professional Summary</h4>
                                                    <small>Show relevant experience.Use bullet points to showcase your achievements</small>
                                                    <?php
                                                    if (isset($_SESSION['work_exp'])) {

                                                        foreach ($_SESSION['work_exp'] as $key => $value) {

                                                            $company = $_SESSION['work_exp'][$key]['companyname'];
                                                            $desi = $_SESSION['work_exp'][$key]['designation'];
                                                            $sdate = $_SESSION['work_exp'][$key]['ws_date'];
                                                            $edate = $_SESSION['work_exp'][$key]['we_date'];
                                                            $cwork = $_SESSION['work_exp'][$key]['cwork'];
                                                            $acompany = $_SESSION['work_exp'][$key]['aboutcompany'];
                                                    ?>
                                                            <div class="row">

                                                                <div class="col-md-6">
                                                                    <div class="mb-3">

                                                                        <input type="text" class="form-control companyname" id="companyname1" name="companyname[]" value="<?= $company; ?>" placeholder="Company Name" required="required">
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <div class="mb-3">
                                                                        <input type="text" class="form-control" name="designation[]" id="designation" value="<?= $desi; ?>" placeholder="Designation" required="required">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="input-group">

                                                                <input type="date" name="ws_date[]" placeholder="Start" class="form-control datepicker-input" value="<?= $sdate; ?>" aria-label="StartDate">


                                                                <span class="input-group-text">to</span>

                                                                <input type="date" id="DateRange1<?= $key ?>" name="we_date[]" placeholder="End" class="form-control datepicker-input" value="<?= $edate; ?>" aria-label="EndDate" <?php if ($cwork == '1') echo "disabled"; ?>>
                                                            </div>
                                                            <div class="mb-3">
                                                                <div class="custom-control custom-checkbox">
                                                                    <input type="checkbox" name="cwork[]" class="custom-control-input" id="InlineCheckbox" value="1" data-id="1<?= $key ?>" data-parsley-multiple="groups" data-parsley-mincheck="2" <?php if ($cwork == '1') echo "checked"; ?> onclick="hideSection(this)">
                                                                    <label class="custom-control-label" for="InlineCheckbox">Currently Working Here</label>
                                                                </div>
                                                            </div>
                                                            <div class="mb-3">
                                                                <textarea class="form-control professionalTextArea" rows="5" name="aboutcompany[]" id="aboutcompany" placeholder="Write about Company">value="<?= $acompany; ?>"</textarea>
                                                            </div>

                                                        <?php
                                                        }
                                                    } else {
                                                        ?>

                                                        <div class="row">

                                                            <div class="col-md-6">
                                                                <div class="mb-3">
                                                                    <form id="myform2">
                                                                        <input type="text" class="form-control companyname" id="companyname1" name="companyname[]" placeholder="Company Name">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="mb-3">
                                                                    <input type="text" class="form-control" name="designation[]" id="designation" placeholder="Designation">

                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="input-group">

                                                            <input type="date" name="ws_date[]" placeholder="Start" class="form-control datepicker-input ws_date" aria-label="StartDate">
                                                            <span class="input-group-text">to</span>

                                                            <input id="DateRange0" type="date" name="we_date[]" placeholder="End" class="form-control we_date datepicker-input" aria-label="EndDate">
                                                        </div>
                                                        <div class="mb-3">
                                                            <div class="custom-control custom-checkbox">
                                                                <input type="checkbox" name="cwork[]" class="custom-control-input" id="InlineCheckbox" data-parsley-multiple="groups" data-id="0" data-parsley-mincheck="2" value="1" onclick="hideSection(this)">
                                                                <label class="custom-control-label" for="InlineCheckbox">Currently Working Here</label>
                                                            </div>
                                                        </div>
                                                        <div class="mb-3">
                                                            <textarea class="form-control professionalTextArea aboutcompany" rows="5" name="aboutcompany[]" id="aboutcompany" placeholder="Write about Company"></textarea>
                                                        </div>
                                                    <?php } ?>

                                                    <button type="button" class="btn btn-dark btn-sm" id="work_btn">Add Row</button>
                                                </div>
                                                <input type="hidden" name="myform2" value="1">
                                                <input type="submit" class="btn btn-de-primary btn-sm" value="Save"></button>
                                            </form>
                                        </div>



                                        <div class="tab-pane fade in" id="v-pills-education" role="tabpanel" aria-labelledby="v-pills-education-tab">
                                            <form id="myform3">
                                                <div id="v-pills-education1">
                                                    <h4>Education Summary</h4>
                                                    <small>A varied education on your resume sums up the value that your learnings and background will bring to job.</small>
                                                    <?php
                                                    if (isset($_SESSION['education'])) {

                                                        foreach ($_SESSION['education'] as $key => $value) {

                                                            $college = $_SESSION['education'][$key]['collegename'];
                                                            $stream = $_SESSION['education'][$key]['stream'];
                                                            $sdate = $_SESSION['education'][$key]['es_date'];
                                                            $edate = $_SESSION['education'][$key]['ee_date'];
                                                            $cstudy = $_SESSION['education'][$key]['cstudy'];

                                                    ?>
                                                            <div class="row mt-5">

                                                                <div class="col-md-6">
                                                                    <div class="mb-3">
                                                                        <input type="text" class="form-control" id="collegename" placeholder="College Name" value="<?= $college; ?>" name="collegename[]" required="required">
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <div class="mb-3">
                                                                        <input type="text" name="stream[]" value="<?= $stream; ?>" class="form-control" id="stream" placeholder="Stream" required="required">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="input-group">
                                                                <input type="date" name="es_date[]" placeholder="Start" class="form-control datepicker-input" aria-label="StartDate" value="<?= $sdate; ?>">

                                                                <span class="input-group-text">to</span>

                                                                <input type="date" id="Studying1<?= $key ?>" name="ee_date[]" placeholder="End" class="form-control datepicker-input" aria-label="EndDate" value="<?= $edate; ?>" <?php if ($cstudy == '1') echo "disabled"; ?>>
                                                            </div>
                                                            <div class="mb-3">
                                                                <div class="custom-control custom-checkbox">
                                                                    <input type="checkbox" name="cstudy[]" class="custom-control-input" id="InlineCheckbox" data-id="1<?= $key ?>" data-parsley-multiple="groups" data-parsley-mincheck="2" value="1" <?php if ($cstudy == '1') echo "checked"; ?> onclick="hideSection2(this)">
                                                                    <label class="custom-control-label" for="InlineCheckbox">Currently Studing Here</label>
                                                                </div>
                                                            </div>
                                                        <?php }
                                                    } else { ?>

                                                        <div class="row">

                                                            <div class="col-md-6">
                                                                <div class="mb-3">
                                                                    <input type="text" class="form-control collegename" id="collegename" placeholder="College Name" name="collegename[]">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="mb-3">
                                                                    <input type="text" name="stream[]" class="form-control stream" id="stream" placeholder="Stream">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="input-group" id="DateRange">

                                                            <input type="date" name="es_date[]" placeholder="Start" class="form-control es_date datepicker-input" aria-label="StartDate">
                                                            <span class="input-group-text">to</span>

                                                            <input type="date" id="Studying0" name="ee_date[]" placeholder="End" class="form-control ee_date datepicker-input" aria-label="EndDate">

                                                        </div>
                                                        <div class="mb-3">
                                                            <div class="custom-control custom-checkbox">
                                                                <input type="checkbox" name="cstudy[]" class="custom-control-input" id="InlineCheckbox" data-parsley-multiple="groups" data-id="0" data-parsley-mincheck="2" value="1" onclick="hideSection2(this)">
                                                                <label class="custom-control-label" for="InlineCheckbox">Currently Studing Here</label>
                                                            </div>
                                                        </div>
                                                    <?php } ?>

                                                    <button type="button" class="btn btn-dark btn-sm" id="edu_btn">Add Row</button>

                                                </div>
                                                <input type="hidden" name="myform3" value="1">
                                                <button type="submit" class="btn btn-de-primary btn-sm">Save</button>
                                            </form>
                                        </div>


                                        <div class="tab-pane fade in" id="v-pills-skills" role="tabpanel" aria-labelledby="v-pills-skills-tab">
                                            <form id="myform4">
                                                <div id="v-pills-skills1">

                                                    <div class="row mt-2">

                                                        <?php
                                                        if (isset($_SESSION['skill'])) {

                                                            foreach ($_SESSION['skill'] as $key => $value) {

                                                                $skill = $_SESSION['skill'][$key]['skill_name'];
                                                                $rate = $_SESSION['skill'][$key]['srating'];

                                                        ?>
                                                                <div class="col-md-5">
                                                                    <div class="mb-3">
                                                                        <input type="text" class="form-control" value="<?= $skill; ?>" name="skill_name[]" placeholder="Skill" required="required">
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-3">
                                                                    <div class="starability-checkmark">
                                                                        <input type="radio" id="checkmark-rate5" name="srating[]" value="5" <?php if ($rate == '5') echo "checked"; ?>>
                                                                        <label for="checkmark-rate5" title="Amazing">5 stars</label>

                                                                        <input type="radio" id="checkmark-rate4" name="srating[]" value="4" <?php if ($rate == '4') echo "checked"; ?>>
                                                                        <label for="checkmark-rate4" title="Very good">4 stars</label>

                                                                        <input type="radio" id="checkmark-rate3" name="srating[]" value="3" <?php if ($rate == '3') echo "checked"; ?>>
                                                                        <label for="checkmark-rate3" title="Average">3 stars</label>

                                                                        <input type="radio" id="checkmark-rate2" name="srating[]" value="2" <?php if ($rate == '2') echo "checked"; ?>>
                                                                        <label for="checkmark-rate2" title="Not good">2 stars</label>

                                                                        <input type="radio" id="checkmark-rate1" name="srating[]" value="1" <?php if ($rate == '1') echo "checked"; ?>>
                                                                        <label for="checkmark-rate1" title="Terrible">1 star</label>
                                                                    </div>
                                                                </div>
                                                            <?php }
                                                        } else { ?>
                                                            <div class="col-md-5">
                                                                <div class="mb-3">
                                                                    <input type="text" class="form-control skill_name" name="skill_name[]" placeholder="Skill">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-3">
                                                                <div class="starability-checkmark">
                                                                    <input type="radio" id="checkmark-rate5" name="srating[]" value="5">
                                                                    <label for="checkmark-rate5" title="Amazing">5 stars</label>

                                                                    <input type="radio" id="checkmark-rate4" name="srating[]" value="4">
                                                                    <label for="checkmark-rate4" title="Very good">4 stars</label>

                                                                    <input type="radio" id="checkmark-rate3" name="srating[]" value="3">
                                                                    <label for="checkmark-rate3" title="Average">3 stars</label>

                                                                    <input type="radio" id="checkmark-rate2" name="srating[]" value="2">
                                                                    <label for="checkmark-rate2" title="Not good">2 stars</label>

                                                                    <input type="radio" id="checkmark-rate1" name="srating[]" value="1">
                                                                    <label for="checkmark-rate1" title="Terrible">1 star</label>
                                                                </div>
                                                            </div>
                                                        <?php } ?>

                                                        <div class="col-md-2">
                                                            <button type="button" class="btn btn-sm btn-primary" id="skill_btn"><i class="mdi mdi-check-all me-2"></i>Add</button>
                                                        </div>
                                                    </div>

                                                </div>
                                                <input type="hidden" name="myform4" value="1">
                                                <button type="submit" class="btn btn-de-primary btn-sm">Save</button>
                                            </form>
                                        </div>
                                        <div class="tab-pane fade in" id="v-pills-courses" role="tabpanel" aria-labelledby="v-pills-courses-tab">
                                            <form id="myform5">

                                                <div id="v-pills-courses1">
                                                    <h4>Courses Summary</h4>
                                                    <small>A varied education on your resume sums up the value that your learnings and background will bring to job.</small>

                                                    <?php
                                                    if (isset($_SESSION['course'])) {

                                                        foreach ($_SESSION['course'] as $key => $value) {

                                                            $initituename = $_SESSION['course'][$key]['initituename'];
                                                            $coursename = $_SESSION['course'][$key]['coursename'];
                                                            $cs_date = $_SESSION['course'][$key]['cs_date'];
                                                            $ce_date = $_SESSION['course'][$key]['ce_date'];
                                                            $c_aboutcompany = $_SESSION['course'][$key]['c_aboutcompany'];

                                                    ?>
                                                            <div class="row">
                                                                <div class="col-md-6">
                                                                    <div class="mb-3">
                                                                        <input type="text" class="form-control" name="initituename[]" id="initituename" value="<?= $initituename; ?>" placeholder="Institute Name" required="required">
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <div class="mb-3">
                                                                        <input type="text" class="form-control" name="coursename[]" id="coursename" value="<?= $coursename; ?>" placeholder="Course Name" required="required">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="input-group" id="DateRange">


                                                                <input type="date" name="cs_date[]" placeholder="Start" class="form-control datepicker-input" aria-label="StartDate" value="<?= $cs_date; ?>">

                                                                <span class="input-group-text">to</span>

                                                                <input type="date" name="ce_date[]" placeholder="End" class="form-control datepicker-input" aria-label="EndDate" value="<?= $ce_date; ?>">
                                                            </div>
                                                            <div class="mb-3 mt-3">
                                                                <textarea class="form-control courseTextArea" rows="5" name="c_aboutcompany[]" id="aboutcompany" placeholder="Course Details"><?= $c_aboutcompany; ?></textarea>
                                                            </div>
                                                        <?php }
                                                    } else { ?>

                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <div class="mb-3">
                                                                    <input type="text" class="form-control  initituename" name="initituename[]" id="initituename" placeholder="Institute Name">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="mb-3">
                                                                    <input type="text" class="form-control coursename" name="coursename[]" id="coursename" placeholder="Course Name">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="input-group" id="DateRange">
                                                            <input type="date" name="cs_date[]" placeholder="Start" class="form-control cs_date datepicker-input" aria-label="StartDate">

                                                            <span class="input-group-text">to</span>

                                                            <input type="date" name="ce_date[]" placeholder="End" class="form-control ce_date datepicker-input" aria-label="EndDate">

                                                        </div>
                                                        <div class="mb-3 mt-3">
                                                            <textarea class="form-control c_aboutcompany courseTextArea" rows="5" name="c_aboutcompany[]" id="aboutcompany" placeholder="Course Details"></textarea>
                                                        </div>
                                                    <?php } ?>

                                                    <button type="button" class="btn btn-dark btn-sm" id="course_btn">Add Row</button>
                                                </div>
                                                <input type="hidden" name="myform5" value="1">
                                                <button type="submit" class="btn btn-de-primary btn-sm">Save</button>
                                            </form>
                                        </div>
                                        <div class="tab-pane fade in" id="v-pills-projects" role="tabpanel" aria-labelledby="v-pills-projects-tab">
                                            <form id="myform6">

                                                <div id="v-pills-projects1">
                                                    <h4>Projects Summary</h4>
                                                    <?php
                                                    if (isset($_SESSION['projects'])) {

                                                        foreach ($_SESSION['projects'] as $key => $value) {

                                                            $projectname = $_SESSION['projects'][$key]['projectname'];
                                                            $projectlink = $_SESSION['projects'][$key]['projectlink'];
                                                            $ps_date = $_SESSION['projects'][$key]['ps_date'];
                                                            $pe_date = $_SESSION['projects'][$key]['pe_date'];
                                                            $aboutproject = $_SESSION['projects'][$key]['aboutproject'];

                                                    ?>
                                                            <div class="row">
                                                                <div class="col-md-6">
                                                                    <div class="mb-3">
                                                                        <input type="text" class="form-control" id="projectname" placeholder="Project Name" value="<?= $projectname; ?>" name="projectname[]" required="required">
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <div class="mb-3">
                                                                        <input type="text" value="<?= $projectlink; ?>" class="form-control" name="projectlink[]" id="projectlink" placeholder="Project Link" required="required">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="input-group" id="DateRange">
                                                                <input type="date" value="<?= $ps_date; ?>" name="ps_date[]" placeholder="Start" class="form-control datepicker-input" aria-label="StartDate">

                                                                <span class="input-group-text">to</span>
                                                                <input type="date" value="<?= $pe_date; ?>" name="pe_date[]" placeholder="End" class="form-control datepicker-input" aria-label="EndDate">

                                                            </div>
                                                            <div class="mb-3 mt-3">
                                                                <textarea class="form-control projectTextArea" rows="5" id="aboutproject" name="aboutproject[]" placeholder="Project Details" required="required"><?= $aboutproject; ?></textarea>
                                                            </div>
                                                        <?php }
                                                    } else { ?>

                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <div class="mb-3">
                                                                    <input type="text" class="form-control projectname" id="projectname" placeholder="Project Name" name="projectname[]">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="mb-3">
                                                                    <input type="text" class="form-control projectlink" name="projectlink[]" id="projectlink" placeholder="Project Link">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="input-group" id="DateRange">

                                                            <input type="date" name="ps_date[]" placeholder="Start" class="form-control ps_date datepicker-input" aria-label="StartDate">


                                                            <span class="input-group-text">to</span>
                                                            <input type="date" name="pe_date[]" placeholder="End" class="form-control pe_date datepicker-input" aria-label="EndDate">


                                                        </div>
                                                        <div class="mb-3 mt-3">
                                                            <textarea class="form-control aboutproject projectTextArea" rows="5" id="aboutproject" name="aboutproject[]" placeholder="Project Details"></textarea>
                                                        </div>
                                                    <?php } ?>


                                                    <button type="button" class="btn btn-dark btn-sm" id="project_btn">Add Row</button>
                                                </div>
                                                <input type="hidden" name="myform6" value="1">
                                                <button type="submit" class="btn btn-de-primary btn-sm">Save</button>
                                            </form>
                                        </div>
                                        <div class="tab-pane fade in" id="v-pills-language" role="tabpanel" aria-labelledby="v-pills-language-tab">
                                            <form id="myform7">
                                                <div id="v-pills-language1">


                                                    <div class="row mt-2">

                                                        <?php
                                                        if (isset($_SESSION['lang'])) {

                                                            foreach ($_SESSION['lang'] as $key => $value) {

                                                                $skill = $_SESSION['lang'][$key]['lang_name'];
                                                                $rate = $_SESSION['lang'][$key]['lrating'];

                                                        ?>
                                                                <div class="col-md-5">
                                                                    <div class="mb-3">
                                                                        <input type="text" name="lang_name[]" value="<?= $skill; ?>" class="form-control" id="" placeholder="Language" required="required">
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-3">
                                                                    <div class="starability-checkmark">
                                                                        <input type="radio" id="checkmark-rate5" name="lrating[]" value="5" <?php if ($rate == '5') echo "checked"; ?>>
                                                                        <label for="checkmark-rate5" title="Amazing">5 stars</label>

                                                                        <input type="radio" id="checkmark-rate4" name="lrating[]" value="4" <?php if ($rate == '4') echo "checked"; ?>>
                                                                        <label for="checkmark-rate4" title="Very good">4 stars</label>

                                                                        <input type="radio" id="checkmark-rate3" name="lrating[]" value="3" <?php if ($rate == '3') echo "checked"; ?>>
                                                                        <label for="checkmark-rate3" title="Average">3 stars</label>

                                                                        <input type="radio" id="checkmark-rate2" name="lrating[]" value="2" <?php if ($rate == '2') echo "checked"; ?>>
                                                                        <label for="checkmark-rate2" title="Not good">2 stars</label>

                                                                        <input type="radio" id="checkmark-rate1" name="lrating[]" value="1" <?php if ($rate == '1') echo "checked"; ?>>
                                                                        <label for="checkmark-rate1" title="Terrible">1 star</label>
                                                                    </div>
                                                                </div>
                                                            <?php }
                                                        } else { ?>


                                                            <div class="col-md-5">
                                                                <div class="mb-3">
                                                                    <input type="text" name="lang_name[]" class="form-control lang_name" id="" placeholder="Language">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-3">
                                                                <div class="starability-checkmark">
                                                                    <input type="radio" id="checkmark-rate5" name="lrating[]" value="5">
                                                                    <label for="checkmark-rate5" title="Amazing">5 stars</label>

                                                                    <input type="radio" id="checkmark-rate4" name="lrating[]" value="4">
                                                                    <label for="checkmark-rate4" title="Very good">4 stars</label>

                                                                    <input type="radio" id="checkmark-rate3" name="lrating[]" value="3">
                                                                    <label for="checkmark-rate3" title="Average">3 stars</label>

                                                                    <input type="radio" id="checkmark-rate2" name="lrating[]" value="2">
                                                                    <label for="checkmark-rate2" title="Not good">2 stars</label>

                                                                    <input type="radio" id="checkmark-rate1" name="lrating[]" value="1">
                                                                    <label for="checkmark-rate1" title="Terrible">1 star</label>
                                                                </div>
                                                            </div>
                                                        <?php } ?>
                                                        <div class="col-md-2">
                                                            <button type="button" class="btn btn-sm btn-primary" id="lang_btn"><i class="mdi mdi-check-all me-2"></i>Add</button>
                                                        </div>
                                                    </div>

                                                </div>
                                                <input type="hidden" name="myform7" value="1">
                                                <button type="submit" class="btn btn-de-primary btn-sm">Save</button>
                                            </form>
                                        </div>

                                        <div class="tab-pane fade in" id="v-pills-interest" role="tabpanel" aria-labelledby="v-pills-interest-tab">
                                            <form id="myform8">
                                                <div id="v-pills-interest1">


                                                    <div class="row mt-2">

                                                        <?php
                                                        if (isset($_SESSION['interest'])) {

                                                            foreach ($_SESSION['interest'] as $key => $value) {

                                                                $int = $_SESSION['interest'][$key]['interest'];


                                                        ?>
                                                                <div class="col-md-5">
                                                                    <div class="mb-3">
                                                                        <input type="text" name="interest[]" value="<?= $int; ?>" class="form-control" id="" placeholder="Interest" required="required">
                                                                    </div>
                                                                </div>

                                                            <?php }
                                                        } else { ?>


                                                            <div class="col-md-5">
                                                                <div class="mb-3">
                                                                    <input type="text" name="interest[]" class="form-control interest" id="" placeholder="Interest">
                                                                </div>
                                                            </div>

                                                        <?php } ?>
                                                        <div class="col-md-2">
                                                            <button type="button" class="btn btn-sm btn-primary" id="int_btn"><i class="mdi mdi-check-all me-2"></i>Add</button>
                                                        </div>
                                                    </div>

                                                </div>
                                                <input type="hidden" name="myform8" value="1">
                                                <button type="submit" class="btn btn-de-primary btn-sm">Save</button>
                                            </form>
                                        </div>



                                    </div>
                                </div>
                                <div class="col-md-3 ">
                                    <div class="met-profile-main">
                                        <div class="met-profile-main-pic">
                                            <img src="https://cdn-images.zety.com/templates/zety/uk/cv-template-nanica@3x.png" alt="" height="80" class="rounded-circle">
                                        </div>
                                        <div class="met-profile_user-detail">
                                            <h6 class="met-user-name">Classic Template</h6>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-4 text-end">
                                            <form method="POST" action="#">
                                                <input type="hidden" name="preview" value="1">
                                                <button type="submit" class="btn btn-sm btn-outline-primary px-4">Preview</button>
                                            </form>
                                        </div>
                                        <div class="col-sm-8 text-end">
                                            <button type="button" data-bs-toggle="modal" data-bs-target="#exampleModalLarge" class="btn btn-sm btn-dark px-4">Change Template</button>
                                        </div>
                                    </div>
                                    <div class="row">

                                        <div class="col-sm-4 text-end mt-4">
                                            <form method="POST" action="#">
                                                <input type="hidden" name="create" value="1">
                                                <input type="submit" id="createResume" class="btn btn-sm btn-outline-primary px-4" value="Create Resume">
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>

                </div><!--end page-title-box-->
            </div><!--end col-->
        </div>
    </div>
    </div>
    </div>
    </div>
    </div><!-- container -->

    <!--Start Rightbar-->
    <!--Start Rightbar/offcanvas-->
    <div class="offcanvas offcanvas-end" tabindex="-1" id="Appearance" aria-labelledby="AppearanceLabel">
        <div class="offcanvas-header border-bottom">
            <h5 class="m-0 font-14" id="AppearanceLabel">Appearance</h5>
            <button type="button" class="btn-close text-reset p-0 m-0 align-self-center" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
            <h6>Account Settings</h6>
            <div class="p-2 text-start mt-3">
                <div class="form-check form-switch mb-2">
                    <input class="form-check-input" type="checkbox" id="settings-switch1">
                    <label class="form-check-label" for="settings-switch1">Auto updates</label>
                </div><!--end form-switch-->
                <div class="form-check form-switch mb-2">
                    <input class="form-check-input" type="checkbox" id="settings-switch2" checked>
                    <label class="form-check-label" for="settings-switch2">Location Permission</label>
                </div><!--end form-switch-->
                <div class="form-check form-switch">
                    <input class="form-check-input" type="checkbox" id="settings-switch3">
                    <label class="form-check-label" for="settings-switch3">Show offline Contacts</label>
                </div><!--end form-switch-->
            </div><!--end /div-->
            <h6>General Settings</h6>
            <div class="p-2 text-start mt-3">
                <div class="form-check form-switch mb-2">
                    <input class="form-check-input" type="checkbox" id="settings-switch4">
                    <label class="form-check-label" for="settings-switch4">Show me Online</label>
                </div><!--end form-switch-->
                <div class="form-check form-switch mb-2">
                    <input class="form-check-input" type="checkbox" id="settings-switch5" checked>
                    <label class="form-check-label" for="settings-switch5">Status visible to all</label>
                </div><!--end form-switch-->
                <div class="form-check form-switch">
                    <input class="form-check-input" type="checkbox" id="settings-switch6">
                    <label class="form-check-label" for="settings-switch6">Notifications Popup</label>
                </div><!--end form-switch-->
            </div><!--end /div-->
        </div><!--end offcanvas-body-->
    </div>
    <!--end Rightbar/offcanvas-->
    <!--end Rightbar-->

    <!--Start Footer-->
    <!-- Footer Start -->
    <footer class="footer text-center text-sm-start">
        &copy; <script>
            document.write(new Date().getFullYear())
        </script> Unikit <span class="text-muted d-none d-sm-inline-block float-end">Crafted with <i class="mdi mdi-heart text-danger"></i> by Mannatthemes</span>
    </footer>
    <!-- end Footer -->
    <!--end footer-->
    </div>
    <!-- end page content -->
    </div>
    <!-- end page-wrapper -->


    <div class="modal fade bd-example-modal-lg" id="exampleModalLarge" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <form id="themeForm" method="POST" action="#">

                    <div class="modal-body">
                        <button type="button" class="btn-close float-end" data-bs-dismiss="modal" aria-label="Close"></button>
                        <div class="row">

                            <div class="col-lg-4 text-center d-flex flex-column align-items-start">
                                <input type="radio" class="my-3" style="width: 16px; height:16px" name="theme" value="1" checked>
                                <img src="img/template1.png" alt="" class="img-fluid" height="200px" width="150px">
                                <span class="my-3">Template 1</span>
                            </div><!--end col-->

                            <div class="col-lg-4 text-center d-flex flex-column align-items-start">
                                <input type="radio" class="my-3" style="width: 16px; height:16px" name="theme" value="2" <?php
                                                                                                                            if (isset($_SESSION['selectedTheme']) && $_SESSION['selectedTheme'] == '2') {
                                                                                                                                echo "checked";
                                                                                                                            }
                                                                                                                            ?>>
                                <img src="img/template2.png" alt="" class="img-fluid" height="200px" width="150px">
                                <span class="my-3">Template 2</span>
                            </div><!--end col-->

                        </div><!--end row-->

                    </div><!--end modal-body-->
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary btn-md" data-bs-dismiss="modal">Select</button>

                    </div><!--end modal-footer-->

                </form>
            </div><!--end modal-content-->
        </div><!--end modal-dialog-->
    </div><!--end modal-->
    <!-- Javascript  -->
    <!-- App js -->

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
    <script src="js/app.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>
    <script src="js/sweetalert2.min.js"></script>

    <script>
        var b = '<?php echo $create_flag ?>';
        //   console.log(b)


        if (b != '-1') {

            if (b == '0') {
                Swal.fire("Please Fill All Tab Fields.", '', 'error');
            } else if (b == '1') {
                Swal.fire({
                    icon: 'success',
                    title: 'Your Resume PDF Has been Created.',
                    showConfirmButton: true,
                    confirmButtonText: 'Ok'
                }).then(result => {
                    window.location.reload();
                })
            } else if (b == '2') {
                Swal.fire({
                    icon: 'error',
                    title: 'Something Went wrong.',
                    showConfirmButton: true,
                    confirmButtonText: 'Ok'
                })
            }
        }

        function hideSection(e) {

            let id = $(e).data('id');

            // $('#DateRange' + id).toggle();
            if ($('#DateRange' + id).prop('disabled') === true) {
                $('#DateRange' + id).prop('disabled', false);
            } else {
                $('#DateRange' + id).prop('disabled', true);
            }
        }

        function hideSection2(e) {

            let id = $(e).data('id');

            if ($('#Studying' + id).prop('disabled') === true) {
                $('#Studying' + id).prop('disabled', false);
            } else {
                $('#Studying' + id).prop('disabled', true);
            }
        }

        $("#profilesumary").summernote({
            placeholder: 'Profile Summary'

        });
        $(".professionalTextArea").summernote({
            placeholder: 'Write about Company'

        });
        $(".courseTextArea").summernote({
            placeholder: 'Course Details'

        });
        $(".projectTextArea").summernote({
            placeholder: 'Project Details'

        });


        $(document).ready(function() {

            $('#myform1').on("submit", function(event) {

                event.preventDefault();
                if ($('#fullname').val() == '') {
                    Swal.fire("Enter Your full name.", "", "error");
                    return;
                }
                if ($('#profiletitle').val() == '') {
                    Swal.fire("Profile Title is Mandatory.", "", "error");
                    return;
                }
                if ($('#email').val() == '') {
                    Swal.fire("Enter E-mail Address.", "", "error");
                    return;
                }
                if ($('#city').val() == '') {
                    Swal.fire("Enter Your Address.", "", "error");
                    return;
                }
                if ($('#profilesumary').val() == '') {
                    Swal.fire("Enter Profile Description.", "", "error");
                    return;
                }

                let form_data = new FormData(this);

                $.ajax({
                    type: "POST",
                    data: form_data,
                    cache: false,
                    contentType: false,
                    processData: false,
                    dataType: "text",
                    success: function(data) {
                        console.log(data);

                        if (data.trim() == '1') {

                            //  Swal.fire("Saved", "", "info");
                            $('[href="#v-pills-work"]').tab('show');
                        } else {
                            Swal.fire("Error", "Sorry! Something went wrong.", "error");
                        }
                    }

                })

            });


            $('#myform2').on("submit", function(event) {

                event.preventDefault();
                //	alert('ok')
                let flg = 0;
                $('.companyname').each(function(index, ele) {

                    if ($(ele).val() == '') {
                        Swal.fire("Enter Company Name.", "", "error");
                        flg = 1;
                        return;
                    }
                });
                if (flg == 1)
                    return;

                $('.ws_date').each(function(index, ele) {

                    if ($(ele).val() == '') {
                        Swal.fire("Please Select Work start date.", "", "error");
                        flg = 1;
                        return;
                    }
                });
                if (flg == 1)
                    return;

                $('.we_date').each(function(index, ele) {

                    if ($(ele).val() == '' && $(ele).prop('disabled') === false) {
                        Swal.fire("Please Select Work end date.", "", "error");
                        flg = 1;
                        return;
                    }
                });
                if (flg == 1)
                    return;

                $('.aboutcompany').each(function(index, ele) {

                    if ($(ele).val() == '') {
                        Swal.fire("Write Something about Company.", "", "error");
                        flg = 1;
                        return;
                    }
                });
                if (flg == 1)
                    return;

                let form_data = new FormData(this);
                console.log(form_data);

                $.ajax({
                    type: "POST",
                    data: form_data,
                    cache: false,
                    contentType: false,
                    processData: false,
                    dataType: "text",
                    success: function(data) {
                        console.log(data);

                        if (data.trim() == '1') {
                            // Swal.fire("Saved", "", "info");
                            $('[href="#v-pills-education"]').tab('show');
                        } else {
                            Swal.fire("Error", "Sorry! Something went wrong.", "error");
                        }
                    }

                })

            });

            $('#myform3').on("submit", function(event) {

                event.preventDefault();

                let flg = 0;
                $('.collegename').each(function(index, ele) {

                    if ($(ele).val() == '') {
                        Swal.fire("Enter College Name.", "", "error");
                        flg = 1;
                        return;
                    }
                });
                if (flg == 1)
                    return;

                $('.stream').each(function(index, ele) {

                    if ($(ele).val() == '') {
                        Swal.fire("Enter Stream.", "", "error");
                        flg = 1;
                        return;
                    }
                });
                if (flg == 1)
                    return;

                $('.es_date').each(function(index, ele) {

                    if ($(ele).val() == '') {
                        Swal.fire("Please Select Education start date.", "", "error");
                        flg = 1;
                        return;
                    }
                });
                if (flg == 1)
                    return;

                $('.ee_date').each(function(index, ele) {

                    if ($(ele).val() == '' && $(ele).prop('disabled') === false) {
                        Swal.fire("Please Select Education end date.", "", "error");
                        flg = 1;
                        return;
                    }
                });
                if (flg == 1)
                    return;

                let form_data = new FormData(this);
                console.log(form_data);

                $.ajax({
                    type: "POST",
                    data: form_data,
                    cache: false,
                    contentType: false,
                    processData: false,
                    dataType: "text",
                    success: function(data) {
                        console.log(data);

                        if (data.trim() == '1') {
                            //  Swal.fire("Saved", "", "info");
                            $('[href="#v-pills-skills"]').tab('show');
                        } else {
                            Swal.fire("Error", "Sorry! Something went wrong.", "error");
                        }
                    }

                })

            });

            $('#myform4').on("submit", function(event) {

                event.preventDefault();
                // course validation
                let flg = 0;
                $('.skill_name').each(function(index, ele) {

                    if ($(ele).val() == '') {
                        Swal.fire("Please Enter Any Skill.", "", "error");
                        flg = 1;
                        return;
                    }
                });
                if (flg == 1)
                    return;

                let form_data = new FormData(this);
                console.log(form_data);

                $.ajax({
                    type: "POST",
                    data: form_data,
                    cache: false,
                    contentType: false,
                    processData: false,
                    dataType: "text",
                    success: function(data) {
                        console.log(data);

                        if (data.trim() == '1') {
                            // Swal.fire("Saved", "", "info");
                            $('[href="#v-pills-courses"]').tab('show');
                        } else {
                            Swal.fire("Error", "Sorry! Something went wrong.", "error");
                        }

                    }

                })

            });

            $('#myform5').on("submit", function(event) {

                event.preventDefault();

                let flg = 0;
                $('.initituename').each(function(index, ele) {

                    if ($(ele).val() == '') {
                        Swal.fire("Enter Institute Name.", "", "error");
                        flg = 1;
                        return;
                    }
                });
                if (flg == 1)
                    return;

                $('.coursename').each(function(index, ele) {

                    if ($(ele).val() == '') {
                        Swal.fire("Enter Course Name.", "", "error");
                        flg = 1;
                        return;
                    }
                });
                if (flg == 1)
                    return;

                $('.cs_date').each(function(index, ele) {

                    if ($(ele).val() == '') {
                        Swal.fire("Please Select Course start date.", "", "error");
                        flg = 1;
                        return;
                    }
                });
                if (flg == 1)
                    return;

                $('.ce_date').each(function(index, ele) {

                    if ($(ele).val() == '' && $(ele).prop('disabled') === false) {
                        Swal.fire("Please Select Course end date.", "", "error");
                        flg = 1;
                        return;
                    }
                });
                if (flg == 1)
                    return;

                $('.c_aboutcompany').each(function(index, ele) {

                    if ($(ele).val() == '') {
                        Swal.fire("Please Write about Course.", "", "error");
                        flg = 1;
                        return;
                    }
                });
                if (flg == 1)
                    return;


                let form_data = new FormData(this);
                console.log(form_data);

                $.ajax({
                    type: "POST",
                    data: form_data,
                    cache: false,
                    contentType: false,
                    processData: false,
                    dataType: "text",
                    success: function(data) {
                        console.log(data);

                        if (data.trim() == '1') {
                            //  Swal.fire("Saved", "", "info");
                            $('[href="#v-pills-projects"]').tab('show');
                        } else {
                            Swal.fire("Error", "Sorry! Something went wrong.", "error");
                        }
                    }

                })

            });

            $('#myform6').on("submit", function(event) {
                event.preventDefault();


                let flg = 0;
                $('.projectname').each(function(index, ele) {

                    if ($(ele).val() == '') {
                        Swal.fire("Enter Project Name.", "", "error");
                        flg = 1;
                        return;
                    }
                });
                if (flg == 1)
                    return;

                $('.projectlink').each(function(index, ele) {

                    if ($(ele).val() == '') {
                        Swal.fire("Enter Project Link.", "", "error");
                        flg = 1;
                        return;
                    }
                });
                if (flg == 1)
                    return;

                $('.ps_date').each(function(index, ele) {

                    if ($(ele).val() == '') {
                        Swal.fire("Please Select Project start date.", "", "error");
                        flg = 1;
                        return;
                    }
                });
                if (flg == 1)
                    return;

                $('.pe_date').each(function(index, ele) {

                    if ($(ele).val() == '' && $(ele).prop('disabled') === false) {
                        Swal.fire("Please Select Project end date.", "", "error");
                        flg = 1;
                        return;
                    }
                });
                if (flg == 1)
                    return;

                $('.aboutproject').each(function(index, ele) {

                    if ($(ele).val() == '') {
                        Swal.fire("Please Write about Project.", "", "error");
                        flg = 1;
                        return;
                    }
                });
                if (flg == 1)
                    return;

                let form_data = new FormData(this);
                console.log(form_data);

                $.ajax({
                    type: "POST",
                    data: form_data,
                    cache: false,
                    contentType: false,
                    processData: false,
                    dataType: "text",
                    success: function(data) {
                        console.log(data);

                        if (data.trim() == '1') {
                            //  Swal.fire("Saved", "", "info");
                            $('[href="#v-pills-language"]').tab('show');
                        } else {
                            Swal.fire("Error", "Sorry! Something went wrong.", "error");
                        }
                    }

                })

            });


            $('#myform7').on("submit", function(event) {

                event.preventDefault();

                let flg = 0;
                $('.lang_name').each(function(index, ele) {

                    if ($(ele).val() == '') {
                        Swal.fire("Write any Language here.", "", "error");
                        flg = 1;
                        return;
                    }
                });
                if (flg == 1)
                    return;

                let form_data = new FormData(this);
                console.log(form_data);

                $.ajax({
                    type: "POST",
                    data: form_data,
                    cache: false,
                    contentType: false,
                    processData: false,
                    dataType: "text",
                    success: function(data) {
                        console.log(data);

                        if (data.trim() == '1') {
                            //  Swal.fire("Saved", "", "info");
                            $('[href="#v-pills-interest"]').tab('show');
                        } else {

                            Swal.fire("Error", "Sorry! Something went wrong.", "error");
                        }
                    }

                })

            });

            $('#myform8').on("submit", function(event) {

                event.preventDefault();

                let flg = 0;
                $('.interest').each(function(index, ele) {

                    if ($(ele).val() == '') {
                        Swal.fire("Write your Interest here.", "", "error");
                        flg = 1;
                        return;
                    }
                });
                if (flg == 1)
                    return;

                let form_data = new FormData(this);
                console.log(form_data);

                $.ajax({
                    type: "POST",
                    data: form_data,
                    cache: false,
                    contentType: false,
                    processData: false,
                    dataType: "text",
                    success: function(data) {
                        console.log(data);

                        if (data.trim() == '1') {
                            Swal.fire("All Saved", "", "info");
                        } else {

                            Swal.fire("Error", "Sorry! Something went wrong.", "error");
                        }
                    }

                })

            });

            $('#previewResume').on('click', function() {

                $.ajax({
                    type: "POST",
                    data: {
                        preview: true
                    },
                    success: function(data) {
                        console.log(data);

                        if (data.trim() == '1') {

                        } else if (data.trim() == '-1') {
                            Swal.fire({
                                icon: 'error',
                                title: 'Fill All Tabs to Preview',
                                showConfirmButton: true,
                                confirmButtonText: 'Ok'
                            });
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Sorry! Something went wrong.',
                                showConfirmButton: true,
                                confirmButtonText: 'Ok'
                            }).then(result => {
                                location.reload();
                            })

                        }
                    }

                })

            });

            $('#themeForm').on('submit', function(ev) {
                ev.preventDefault();

                $.ajax({
                    type: "POST",
                    data: 'chooseTheme=true&' + $('#themeForm').serialize(),
                    success: function(data) {
                        // console.log(data);
                    }
                })

            });

            var i = 1;

            $('#work_btn').click(function() {
                $('#v-pills-work1').append('<div class="form-row mt-3" id="add_row' + i + '">	<div class="row"><div class="col-md-6"><div class="mb-3"><input type="text" class="form-control companyname" id="companyname' + i + '" name="companyname[]" placeholder="Company Name"></div></div><div class="col-md-6"><div class="mb-3"><input type="text" class="form-control designation" id="designation' + i + '" name="designation[]" placeholder="Designation"></div></div></div><div class="input-group" >	<input type="date" name="ws_date[]" placeholder="Start" class="form-control ws_date datepicker-input" aria-label="StartDate"><span class="input-group-text">to</span><input type="date" id="DateRange' + i + '" name="we_date[]" placeholder="End" class="form-control we_date datepicker-input" aria-label="EndDate"></div><div class="mb-3"><div class="custom-control custom-checkbox"><input type="checkbox" class="custom-control-input" id="InlineCheckbox' + i + '" name="cwork[]" data-id="' + i + '" data-parsley-multiple="groups" data-parsley-mincheck="2" value="1" onclick="hideSection(this)"><label class="custom-control-label" for="InlineCheckbox' + i + '">Currently Working Here</label></div></div>  <div class="mb-3"><textarea class="form-control aboutcompany professionalTextArea" rows="5" id="aboutcompany" name="aboutcompany[]" placeholder="Write about Company"></textarea></div><button type="button" class="btn btn-dark btn-sm delete_button" id="' + i + '">Delete</button></div>');
                i++;
                $(".professionalTextArea").summernote({
                    placeholder: 'Write about Company'

                });
            });
            $(document).on('click', '.delete_button', function() {
                var button_id = $(this).attr("id");
                $('#add_row' + button_id + '').remove();
            });

            $('#edu_btn').click(function() {
                $('#v-pills-education1').append('<div class="form-row mt-3" id="add_row' + i + '">	<div class="row"><div class="col-md-6"><div class="mb-3"><input type="text" class="form-control collegename" id="collegename" name="collegename[]" placeholder="College Name"></div></div><div class="col-md-6"><div class="mb-3"><input type="text" class="form-control stream" id="stream" name="stream[]" placeholder="Stream"></div></div></div><div class="input-group" id="DateRange"><input type="date" name="es_date[]" placeholder="Start" class="form-control es_date datepicker-input" aria-label="StartDate"><span class="input-group-text">to</span><input type="date" id="Studying' + i + '"  class="form-control ee_date datepicker-input" name="ee_date[]" placeholder="End" aria-label="EndDate"></div>	<div class="mb-3"><div class="custom-control custom-checkbox"><input type="checkbox" name="cstudy[]" class="custom-control-input" id="InlineCheckbox" data-parsley-multiple="groups" data-id="' + i + '" data-parsley-mincheck="2" value="1" onclick="hideSection2(this)"><label class="custom-control-label" for="InlineCheckbox">Currently Studing Here</label></div></div><button type="button" class="btn btn-dark btn-sm delete_button" id="' + i + '">Delete</button></div>');
                i++;
            });
            $(document).on('click', '.delete_button', function() {
                var button_id = $(this).attr("id");
                $('#add_row' + button_id + '').remove();
            });

            $('#skill_btn').click(function() {
                $('#v-pills-skills1').append('<div class="form-row mt-3" id="add_row' + i + '"><div class="row mt-2"><div class="col-md-5"><div class="mb-3"><input type="text" class="form-control skill_name" name="skill_name[]" placeholder="Skill"></div></div><div class="col-md-3"><div class="starability-checkmark"><input type="radio" id="checkmark-rate5' + i + '" name="srating[]" value="5"><label for="checkmark-rate5' + i + '" title="Amazing">5 stars</label><input type="radio" id="checkmark-rate4' + i + '" name="srating[]" value="4"><label for="checkmark-rate4' + i + '" title="Very good">4 stars</label><input type="radio" id="checkmark-rate3' + i + '" name="srating[]" value="3"><label for="checkmark-rate3" title="Average">3 stars</label><input type="radio" id="checkmark-rate2' + i + '" name="srating[]" value="2"><label for="checkmark-rate2" title="Not good">2 stars</label><input type="radio" id="checkmark-rate1' + i + '" name="srating[]" value="1"><label for="checkmark-rate1' + i + '" title="Terrible">1 star</label></div></div><div class="col-md-2"><button type="button" class="btn btn-sm btn-primary delete_button" id="' + i + '"><i class="mdi mdi-check-all me-2"></i>Del</button>	</div></div></div>');
                i++;
            });
            $(document).on('click', '.delete_button', function() {
                var button_id = $(this).attr("id");
                $('#add_row' + button_id + '').remove();
            });

            $('#course_btn').click(function() {
                $('#v-pills-courses1').append('<div class="form-row mt-3" id="add_row' + i + '"><div class="row"><div class="col-md-6"><div class="mb-3"><input type="text" class="form-control initituename" id="initituename" name="initituename[]" placeholder="Institute Name"></div></div><div class="col-md-6"><div class="mb-3"><input type="text" class="form-control coursename" name="coursename[]" id="coursename' + i + '"  placeholder="Course Name"></div></div></div><div class="input-group" id="DateRange"><input type="date" name="cs_date[]" placeholder="Start" class="form-control cs_date datepicker-input" aria-label="StartDate"><span class="input-group-text">to</span><input type="date" name="ce_date[]" placeholder="End" class="form-control ce_date datepicker-input" aria-label="EndDate"></div><div class="mb-3 mt-3"><textarea class="form-control c_aboutcompany courseTextArea" rows="5" name="c_aboutcompany[]" placeholder="Course Details"></textarea></div><button type="button" class="btn btn-dark btn-sm delete_button" id="' + i + '">Delete</button></div>');
                i++;

                $(".courseTextArea").summernote({
                    placeholder: 'Course Details'

                });
            });
            $(document).on('click', '.delete_button', function() {
                var button_id = $(this).attr("id");
                $('#add_row' + button_id + '').remove();
            });

            $('#project_btn').click(function() {
                $('#v-pills-projects1').append('<div class="form-row mt-3" id="add_row' + i + '">	<div class="row"><div class="col-md-6"><div class="mb-3"><input type="text" class="form-control projectname" id="projectname" name="projectname[]" placeholder="Project Name"></div></div><div class="col-md-6"><div class="mb-3"><input type="text" class="form-control projectlink" id="projectlink' + i + '" name="projectlink[]" placeholder="Project Link"></div></div></div><div class="input-group" id="DateRange"><input type="date" name="ps_date[]" placeholder="Start" class="form-control ps_date datepicker-input" aria-label="StartDate"><span class="input-group-text">to</span>	<input type="date" name="pe_date[]" placeholder="End" class="form-control pe_date datepicker-input" aria-label="EndDate"></div><div class="mb-3 mt-3"><textarea class="form-control aboutproject projectTextArea" rows="5" id="aboutproject" name="aboutproject[]" placeholder="Project Details"></textarea></div><button type="button" class="btn btn-dark btn-sm delete_button" id="' + i + '">Delete</button></div>');
                i++;
                $(".projectTextArea").summernote({
                    placeholder: 'Project Details'

                });
            });
            $(document).on('click', '.delete_button', function() {
                var button_id = $(this).attr("id");
                $('#add_row' + button_id + '').remove();
            });

            $('#lang_btn').click(function() {
                $('#v-pills-language1').append('<div class="form-row mt-3" id="add_row' + i + '"><div class="row mt-2"><div class="col-md-5"><div class="mb-3"><input type="text" class="form-control lang_name" id="" name="lang_name[]" placeholder="Language"></div></div><div class="col-md-3"><div class="starability-checkmark"><input type="radio" id="checkmark-rate5' + i + '" name="lrating[]" value="5"><label for="checkmark-rate5' + i + '" title="Amazing">5 stars</label><input type="radio" id="checkmark-rate4' + i + '" name="lrating[]" value="4"><label for="checkmark-rate4' + i + '" title="Very good">4 stars</label><input type="radio" id="checkmark-rate3' + i + '" name="lrating[]" value="3"><label for="checkmark-rate3' + i + '" title="Average">3 stars</label><input type="radio" id="checkmark-rate2' + i + '" name="lrating[]" value="2"><label for="checkmark-rate2' + i + '" title="Not good">2 stars</label><input type="radio" id="checkmark-rate1' + i + '" name="lrating[]" value="1"><label for="checkmark-rate1' + i + '" title="Terrible">1 star</label></div></div><div class="col-md-2"><button type="button" class="btn btn-sm btn-primary delete_button" id="' + i + '"><i class="mdi mdi-check-all me-2"></i>Del</button></div></div></div>');
                i++;
            });
            $(document).on('click', '.delete_button', function() {
                var button_id = $(this).attr("id");
                $('#add_row' + button_id + '').remove();
            });

            $('#int_btn').click(function() {
                $('#v-pills-interest1').append('<div class="form-row mt-3" id="add_row' + i + '"><div class="row mt-2"><div class="col-md-5"><div class="mb-3"><input type="text" class="form-control interest" id="" name="interest[]" placeholder="Interest"></div></div><div class="col-md-2"><button type="button" class="btn btn-sm btn-primary delete_button" id="' + i + '"><i class="mdi mdi-check-all me-2"></i>Del</button></div></div></div>');
                i++;
            });
            $(document).on('click', '.delete_button', function() {
                var button_id = $(this).attr("id");
                $('#add_row' + button_id + '').remove();
            });

        });

        function previewImage(th) {
            var targetID = $(th).data("previewon");

            var fileExtension = ['png', 'jpeg', 'jpg', 'gif'];
            if ($.inArray($(th).val().split('.').pop().toLowerCase(), fileExtension) == -1) {
                Swal.fire({
                    icon: 'error',
                    title: 'Only .jpeg, .png, .jpg, and .gif formats are allowed.',
                    showConfirmButton: true
                })
                th.value = '';
            } else {
                var imgsrc = URL.createObjectURL(event.target.files[0]);
                $(targetID).attr('src', imgsrc);
            }
        }
    </script>
</body>
<!--end body-->

<!-- /pages-starter.html  , Tue, 25 Jan 2022 08:04:26 GMT -->

</html>