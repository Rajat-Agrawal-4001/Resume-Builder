<?php
session_start();

$conn = mysqli_connect('localhost', 'root', '', 'idealvillage');
if (!$conn) {
  echo "Connection Error.";
  die;
}

function realEscape($val)
{
  global $conn;
  return mysqli_escape_string($conn, $val);
}
function encoder($str)
{
  $str = str_replace("'", "'+" . '"' . "'" . '"' . "+'", $str);
  return $str;
}

function decoder($str)
{
  $str = str_replace("'+" . '"' . "'" . '"' . "+'", "'", $str);
  $str = str_replace("<script>", htmlspecialchars("<script>"), $str);
  $str = str_replace("</script>", htmlspecialchars("</script>"), $str);
  return $str;
}
$name = 'Your Name';
$email = 'Email';
$mobile = 'Mobile';
$city = 'Address..';
$profile_title = 'Title';
$profile_summary = 'Description..';
$designation = 'Position';
if (isset($_SESSION['name'])) {
  $name = $_SESSION['name'];
  $email = $_SESSION['email'];
  $mobile = $_SESSION['mobile'];
  $city = $_SESSION['city'];
  $profile_title = $_SESSION['profile_title'];
  $profile_summary = $_SESSION['profile_summary'];
  $designation = $_SESSION['state'];
}
$work_experience = '';
$education = '';
$projects = '';
$skills = '<ul>';
$int = '<ul>';

$selectedTemplate = 1;
if (isset($_SESSION['selectedTheme'])) {
  $selectedTemplate = $_SESSION['selectedTheme'];
}

if (isset($_SESSION['work_exp'])) {
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
			  <div class="addr">' .  decoder($acompany) . '</div>' . $time . '
			</div>
			<div class="right">
			  <div class="name desi">' . htmlspecialchars($desi) . '</div>
			  <div class="desc">' . htmlspecialchars($company) . '</div>
			</div>
		  </div>';
  }
}
if (isset($_SESSION['education'])) {
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
			  <div class="addr college">' . htmlspecialchars($college) . '</div>
        <div class="name">' . htmlspecialchars($stream) . '</div>' . $time . '
			</div>
		  
		  </div>';
  }
}

if (isset($_SESSION['projects'])) {
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
}

if (isset($_SESSION['skill'])) {
  foreach ($_SESSION['skill'] as $key => $value) {

    $skills .= '<li>' . $_SESSION['skill'][$key]['skill_name'] . '</li>';
  }
}
$skills .= '</ul>';
if (isset($_SESSION['interest'])) {
  foreach ($_SESSION['interest'] as $key => $value) {

    $int .= '<li>' . htmlspecialchars($_SESSION['interest'][$key]['interest']) . '</li>';
  }
}
$int .= '</ul>';

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

echo $preview_code;
die;
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
  <link href="../assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
  <link href="../assets/css/icons.min.css" rel="stylesheet" type="text/css" />
  <link href="../assets/css/app.min.css" rel="stylesheet" type="text/css" />
  <link href="../assets/plugins/sweet-alert2/sweetalert2.min.css" rel="stylesheet" type="text/css">
  <link href="../assets/plugins/rating/starability-all.css" rel="stylesheet" type="text/css" />

</head>

<body id="body" class="dark-sidebar">
  <!-- leftbar-menu -->
  <?php include 'menu.php'; ?>
  <!-- end left-sidenav-->
  <!-- end leftbar-menu-->

  <!-- Top Bar Start -->
  <!-- Top Bar Start -->
  <?php include 'top-bar.php'; ?>
  <!-- Top Bar End -->
  <!-- Top Bar End -->

  <div class="page-wrapper">

    <!-- Page Content-->
    <div class="page-content-tab">

      <div class="container-fluid">
        <!-- Page-Title -->
        <div class="row">
          <div class="col-sm-12">
            <div class="page-title-box">

              <div class="row">





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

  <!-- Javascript  -->
  <!-- App js -->

  <script src="../assets/js/jquery.min.js"> </script>
  <script src="../assets/js/app.js"></script>
  <script src="../assets/plugins/sweet-alert2/sweetalert2.min.js"></script>


</body>
<!--end body-->

<!-- /pages-starter.html  , Tue, 25 Jan 2022 08:04:26 GMT -->

</html>