<?PHP

require '../PHPMailer/src/PHPMailer.php';
require '../PHPMailer/src/Exception.php';
require '../PHPMailer/src/OAuth.php';
require '../PHPMailer/src/POP3.php';
require '../PHPMailer/src/SMTP.php';
//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader


//Instantiation and passing `true` enables exceptions

function mailHikky($email ,$name , $title, $content){
    $mail = new PHPMailer(true);
    try {
        //Server settings
        $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      
        $mail->isSMTP();                                            
        $mail->Host       = 'smtp.gmail.com';                     
        $mail->SMTPAuth   = true;                                 
        $mail->Username   = 'hikkywannafly@gmail.com';                     //SMTP username
        $mail->Password   = 'nguyenchitam123';                               //SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         //Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
        $mail->Port       = 587;                                    //TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above
        $mail->SMTPSecure = 'tls';
        //Recipients
        $mail->setFrom('hikkywannafly@gmail.com', 'Hikky_ne');
        $mail->addAddress($email, $name);     //Add a recipient
        $mail->isHTML(true);                                  //Set email format to HTML
        $mail->Subject = "Cam on ban da den zoi Hikkywannafly #$title";
        $mail->Body    = $content;
        // $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
        
        $mail->send();
        echo 'Message has been sent';
         } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
}

?>