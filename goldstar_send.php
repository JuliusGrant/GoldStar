
<?php
if(isset($_POST['email'])) {

    // CHANGE THE TWO LINES BELOW
   $email_to = "juliusbgrant@gmail.com";

    $email_subject = "Gold Star submission";


    function died($error) {
        // your error code can go here
        echo "We are very sorry, but there were error(s) found with the form you submitted. ";
        echo "These errors appear below.<br /><br />";
        echo $error."<br /><br />";
        echo "Please go back and fix these errors.<br /><br />";
        die();
    }


   // validation expected data exists
    if(!isset($_POST['Sender_name']) ||
        !isset($_POST['Receiver_name']) ||
        !isset($_POST['email']) ||

        !isset($_POST['comments'])) {
        died('We are sorry, but there appears to be a problem with the form you submitted.');

    }

    $Sender_name = $_POST['Sender_name']; // required
    $Receiver_name = $_POST['Receiver_name']; // required
    $email_from = $_POST['email']; // required

    $comments = $_POST['comments']; // required

    $error_message = "";
    $email_exp = '/^[A-Za-z0-9._%-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}$/';
  if(!preg_match($email_exp,$email_from)) {
    $error_message .= 'The Email Address you entered does not appear to be valid.<br />';
  }
    $string_exp = "/^[A-Za-z .'-]+$/";
  if(!preg_match($string_exp,$Sender_name)) {
    $error_message .= 'The First Name you entered does not appear to be valid.<br />';
  }
  if(!preg_match($string_exp,$Receiver_name)) {
    $error_message .= 'The Last Name you entered does not appear to be valid.<br />';
  }
  if(strlen($comments) < 2) {
    $error_message .= 'The Comments you entered do not appear to be valid.<br />';
  }
  if(strlen($error_message) > 0) {
    died($error_message);
  }
     $email_message = "\n\n";

    function clean_string($string) {
      $bad = array("content-type","bcc:","to:","cc:","href");
      return str_replace($bad,"",$string);
    }

      $email_message .= "To: ".clean_string($Receiver_name)."\n\n";
	 $email_message .= "".clean_string($comments)."\n\n";
	 $email_message .= "From ".clean_string($Sender_name)."\n";




// create email headers
$headers = 'From: '.$email_from."\r\n".
'Reply-To: '.$email_from."\r\n" .
'X-Mailer: PHP/' . phpversion();
@mail($email_to, $email_subject, $email_message, $headers);
?>

<!-- place your own success html below -->

<h1>Congrats! You did it. Don will have your gold star presented at the next meeting..</h1> <br/>
 <a href="GoldStars.html"> Back to JTN Document Hub </a>
<?php
}
die();
?>
