<form method='POST'>
  
<head>

<h1> Contact us </h1>
<style>
    
h1 {
	font-weight: normal;
	font-size: 4em;
	font-family: 'Raleway', sans-serif;
	margin: 0 auto;
	margin-top: 30px;
	width: 500px;
	color: #F90;
    text-align: center;

}
</style>


<style type="text/css" media="screen">
    div.elem-group {
	margin: 40px 0;
  }
  
  label {
    display: block;
	font-family: 'Raleway', sans-serif;
	padding-bottom: 4px;
    font-size: 1.25em;
  }
 
  input, select, textarea {
	border-radius: 2px;
	border: 1px solid #ccc;
	box-sizing: border-box;
	font-size: 1.25em;
	font-family: 'Aleo';
	width: 500px;
    padding: 8px;
  }
  
  textarea {
	height: 250px;
  }
  
  button {
	height: 50px;
	background: green;
	color: white;
	border: 2px solid darkgreen;
	font-size: 1.25em;
	font-family: 'Aleo';
	border-radius: 4px;
	cursor: pointer;
  }
  
  button:hover {
	border: 2px solid black;
  }

</style>
</head>
<style>
body {
  background-image: url('http://tagsincorporation.com/wp-content/uploads/2019/02/school-background.jpg');
  background-repeat: no-repeat;
  background-attachment: fixed;
  background-size: 100% 100%;
}
</style>

<form  method='POST'>
  <div class="elem-group">
    <label for="name">Name</label>

    <input type="text" id="name" name="visitor_name" placeholder="Phillip" pattern=[A-Z\sa-z]{3,20} required>
  </div>

  <div class="elem-group">
    <label for="email">E-mail</label>

    <input type="email" id="email" name="visitor_email" placeholder="phillip@email.com" required>
  </div>
  

  <div class="elem-group">
    <label for="message">Message</label>

    <textarea id="message" name="visitor_message" placeholder="Your message" required></textarea>
  </div>

  <button type="submit">Send Message</button>
</form>
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