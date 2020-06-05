<head>
<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Material Design Bootstrap</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

<style type="text/css" media="screen">
    div.elem-group {
  margin: 40px 0;
  text-align:center;
  }
  input, select, textarea {
	border-radius: 2px;
	border: 1px solid #ccc;
	box-sizing: border-box;
	font-size: 1.25em;
	width: 500px;
    padding: 8px;
  }
  textarea {
  height: 250px;
  }
  li {
  color: black;
  }
  p {
  color: white;
  }
  button {
	height: 50px;
	background: #F90;
	color: white;
	font-size: 1.25em;
	font-family: 'Aleo';
	border-radius: 4px;
  cursor: pointer;
  }
  button:hover {
	border: 2px solid black;
  }
  body {
  background-image: url('https://i.pinimg.com/564x/c1/59/5c/c1595cbdcc1f24951ca656742f954a74.jpg');
  background-repeat: no-repeat;
  background-attachment: fixed;
  background-size: 100% 100%;
}
h1 {
	color: #F90;
  text-align: center;
}
</style>
</head>

<body>
<h1>Contact us</h1>
</body>


<form  method='POST'>
  <div class="elem-group">
    <input type="text" id="name" name="visitor_name" placeholder="Name" pattern=[A-Z\sa-z]{3,20} required>
  </div>

  <div class="elem-group">
    <input type="email" id="email" name="visitor_email" placeholder="@email.com" required>
  </div>
  

  <div class="elem-group">
    <textarea id="message" name="visitor_message" placeholder="Your message" required></textarea>
  </div>

  <div class="elem-group">
  <button type="submit">Send Message</button>
  </div>  
</form>   

<div class="elem-group">
<ul class="contact-icons">
 <li><i class="fa fa-map-marker fa-2x"></i>
   <p>Thessaloniki, 54248, Greece</p>
  </li>
  <li>
    <i class="fa fa-phone fa-2x"></i>
    <p>+ 30 745 2356896</p>
   </li>
   <li>
     <i class="fa fa-envelope fa-2x"></i>
     <p><a href="mailto:biblioo@gmail.com">biblioo@gmail.com</a></p>
    </li>
   </ul>
   </div>  
<?php


if($_POST) {
    $visitor_name = "";
    $visitor_email = "";
    $email_title = "";
    $visitor_message = "";
     
    if(isset($_POST['visitor_name'])) {
        $visitor_name = filter_var($_POST['visitor_name'], FILTER_SANITIZE_STRING);
    }
     
    if(isset($_POST['visitor_email'])) {
        $visitor_email = str_replace(array("\r", "\n", "%0a", "%0d"), '', $_POST['visitor_email']);
        $visitor_email = filter_var($visitor_email, FILTER_VALIDATE_EMAIL);
    }
     
    if(isset($_POST['email_title'])) {
        $email_title = filter_var($_POST['email_title'], FILTER_SANITIZE_STRING);
    }
     
     
    if(isset($_POST['visitor_message'])) {
        $visitor_message = htmlspecialchars($_POST['visitor_message']);
    }
     
    $recipient = 'mm473@hw.ac.uk';
    $headers  = 'MIME-Version: 1.0' . "\r\n"
    .'Content-type: text/html; charset=utf-8' . "\r\n"
    .'From: ' . $visitor_email . "\r\n";
     
    if(mail($recipient, $email_title, $visitor_message, $headers)) {
        echo "<p>Thank you for contacting us, $visitor_name. You will get a reply within 24 hours.</p>";
    } else {
        echo '<p>We are sorry but the email did not go through.</p>';
    }
  }
?>