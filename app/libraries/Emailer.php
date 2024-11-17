<?php 

use PHPMailer\PHPMailer\Exception;

use PHPMailer\PHPMailer\PHPMailer;

use PHPMailer\PHPMailer\SMTP;

require 'app/third_party/PHPMailer/src/Exception.php';

require 'app/third_party/PHPMailer/src/PHPMailer.php';

require 'app/third_party/PHPMailer/src/SMTP.php';

class Emailer{
    
    private $mail_host;
    private $username;
    private $password;
    private $send_from;
    private $send_from_name;
    private $reply_to;
    private $reply_to_name;


    public function __construct() {
        $config = parse_ini_file('system/config.ini', true)['emailer'];
        
        $this->mail_host = $config['host'];
        $this->username = $config['email'];
        $this->password = $config['password'];
        $this->send_from = $config['email'];
        $this->send_from_name = 'Doindie Official';
        $this->reply_to = $config['email'];
        $this->reply_to_name = 'Doindie Official';
    
    }

    public function sendMail($email, $subject, $message){
    
        $mail = new PHPMailer(true);
    
        $mail->isSMTP();
    
        $mail->SMTPAuth = true;
    
        $mail->Host = $this->mail_host;
    
        $mail->Username = $this->username;
    
        $mail->Password = $this->password;
        
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    
        $mail->Port = 587;
    
        $mail->setFrom($this->send_from, $this->send_from_name);
    
        $mail->addAddress($email);
    
        $mail->addReplyTo($this->reply_to, $this->reply_to_name);
    
        $mail->isHTML(true);
    
        $mail->Subject = $subject;
    
        $mail->Body = $message;
    
        $mail->AltBody = $message;
        
         if(!$mail->send()){
            
             return "error";
            }else{
            return "success";
         }
    }

}


