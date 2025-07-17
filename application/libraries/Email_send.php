<?php
/**
* 
*/
include APPPATH . 'third_party/phpmailer/PHPMailerAutoload.php';
class Email_send
{
	function send_mail($email_to = NULL, $subject = NULL, $template = NULL,$data = NULL)
    {
    	/*echo $email_to;
    	echo $subject;
    	echo $template;
    	x_debug($data);*/
		if (empty($email_to) || empty($data) || empty($template))
		{
			return FALSE;
		}
		
		//$this->load->library('email');
		// $this->load->helper('url');
        date_default_timezone_set('Etc/UTC');
        $mail = new PHPMailer();
        $mail->isSMTP();
        //$mail->SMTPDebug   = 0;
       // $mail->DKIM_domain = '127.0.0.1';
       // $mail->Debugoutput = 'html';
        $mail->Host        = "smtp.gmail.com";
        $mail->Port        = 25;
      //  $mail->SMTPAuth    = false;
        $mail->Username    = "surajgawade192@gmail.com";
        $mail->Password    = "8355891163";
        //$mail->SMTPSecure  = 'ssl';
        $mail->setFrom('surajgawade192@gmail.com', 'Suraj Gawade');
        // $mail->setFrom('it@raoson.com', 'harshali maku');
        //$mail->addReplyTo('replyto@example.com', 'First Last');
        $can_name='';
        
        if(isset($data['can_name']) && !empty($data['can_name']))
        {
            $can_name=$data['can_name'];
        }
        $mail->addAddress($email_to, $can_name);
        // $mail->addAddress('harshali.maku@gmail.com', 'kunal');
        $mail->Subject = $subject;
        //$mail->msgHTML(file_get_contents('contents.html'), dirname(__FILE__));

        $mail->msgHTML($template);
        $mail->AltBody = 'This is a plain-text message body';
        //Attach an image file
        //$mail->addAttachment('images/phpmailer_mini.png');
         
        if (!$mail->send()) {
      
        //  echo 'Mailer Error: ' . $mail->ErrorInfo;
           echo "2";
        } 
        else {
            echo "1"; 
        }
    }
function resignation($email_to,$email_title,$template,$mail_cc,$mail_bcc,$email_desc)
    {
        date_default_timezone_set('Etc/UTC');
        $mail = new PHPMailer();
        $mail->isSMTP();
        $mail->SMTPDebug   = 0;
        $mail->DKIM_domain = '127.0.0.1';
        $mail->Debugoutput = 'html';
        $mail->Host        = "smtpout.secureserver.net";
        $mail->Port        = 465;
        $mail->SMTPAuth    = true;
        $mail->Username    = "it@raoson.com";
        $mail->Password    = "Koonal2910";
        $mail->SMTPSecure  = 'ssl';
        $mail->setFrom('hrms@raoson.com', 'Raoson');
        // $mail->setFrom('it@raoson.com', 'harshali maku');
        //$mail->addReplyTo('replyto@example.com', 'First Last');
        
        $mail->addAddress($email_to, $email_title);
        // $mail->addAddress('harshali.maku@gmail.com', 'kunal');
        $mail->Subject = $email_title;
        //$mail->msgHTML(file_get_contents('contents.html'), dirname(__FILE__));
        $mail->addCC($mail_cc);
        $mail->addBCC($mail_bcc);

        $mail->msgHTML($template);
        //$mail->AltBody = 'This is a plain-text message body';
        //Attach an image file
        //$mail->addAttachment('images/phpmailer_mini.png');
         $mail->send();
         return true;
           
    }

    
    function send_mail_new($mail_config= NULL,$email_to=NULL,$message = NULL, $subject = NULL)
    {    
        if (empty($mail_config) && empty($email_to) && empty($message) )
        {
            return FALSE;
        }   
        $mail=get_smtp_details();
        $email_from='hrms@raoson.com';
        if(isset($mail_config['email_from']) && !empty($mail_config['email_from']))
        {
            $email_from=$mail_config['email_from'];
        }
        $title='Raoson';
        if(isset($subject) && !empty($subject))
        {
            $title = $subject;
        }
        else
        {
            $title = $mail_config['title'];
        }
        $mail->setFrom($email_from, $title);
        $name='';
        $mail->addAddress($email_to, $name);
        if(isset($mail_config['email_cc']) && !empty($mail_config['email_cc']))
        {
            $mail->addCC($mail_config['email_cc']);
        }
        if(isset($mail_config['email_bcc']) && !empty($mail_config['email_bcc']))
        {
            $mail->addBCC($mail_config['email_cc']);
        }
        if(isset($mail_config['reply_to']) && !empty($mail_config['reply_to']))
        {
            $mail->addBCC($mail_config['reply_to']);
        }
        if(isset($subject) && !empty($subject))
        {
            $subject = $subject;
        }
        else
        {
            $subject = $mail_config['subject'];
        }
        $mail->Subject = $subject;
        $mail->msgHTML($message);
        $mail->AltBody = 'This is a plain-text message body';
        //Attach an image file
        //$mail->addAttachment('images/phpmailer_mini.png');
         
        if (!$mail->send()) {
           return '';
        } 
        else {
            return "1"; 
        }
    }
	
}
?>