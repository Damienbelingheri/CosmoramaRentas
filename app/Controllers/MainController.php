<?php

namespace App\Controllers;

use App\Models\Category;
use App\Models\Product;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;


class MainController extends CoreController {

    /**
     * Méthode s'occupant de la page d'accueil
     *
     * @return void
     */
    public function home()
    {
        //pas de passage dans la vue car déja présent dans la méthode show()
        //pour les récuperer aussi dans la nav
        $this->show('front/main/home');
    }

    public function sendMail()
    {

        if (isset($_POST)) {

    

            $reply_name = strip_tags(filter_input(INPUT_POST, 'name'));

            $replyto= strip_tags(filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL));
            $message = strip_tags(filter_input(INPUT_POST, 'message'));

           // dd($_POST, $replyto, $reply_name, $message);

            date_default_timezone_set('Etc/UTC');
            //Create a new PHPMailer instance
            $mail = new PHPMailer();
            //Tell PHPMailer to use SMTP
            $mail->isSMTP();
            //Enable SMTP debugging
            // 0 = off (for production use)
            // 1 = client messages
            // 2 = client and server messages
            $mail->SMTPDebug = 2;
            //Ask for HTML-friendly debug output
            $mail->Debugoutput = 'html';
            //Set the hostname of the mail server
            $mail->Host = 'smtp.gmail.com';
            // use
            // $mail->Host = gethostbyname('smtp.gmail.com');
            // if your network does not support SMTP over IPv6
            //Set the SMTP port number - 587 for authenticated TLS, a.k.a. RFC4409 SMTP submission
            $mail->Port = 587;
            //Set the encryption system to use - ssl (deprecated) or tls
            $mail->SMTPSecure = 'tls';
            //Whether to use SMTP authentication
            $mail->SMTPAuth = true;
            //Username to use for SMTP authentication - use full email address for gmail
            $mail->Username = "essaiphpmailer@gmail.com";
            //Password to use for SMTP authentication
            $mail->Password = "H7Cngsnj3PAmkiD";
            //Set who the message is to be sent from
            $mail->setFrom($replyto, $reply_name);
            //Set an alternative reply-to address
            $mail->addReplyTo($replyto, $reply_name);
            //Set who the message is to be sent to
            $mail->addAddress('essaiphpmailer@gmail.com', 'Damien');
            //Set the subject line
            $mail->Subject = 'CosmoramaRentas';
            //Read an HTML message body from an external file, convert referenced images to embedded,
            //convert HTML into a basic plain-text alternative body
            //$mail->msgHTML(file_get_contents('contents.html'), dirname(__FILE__));
            //Replace the plain text body with one created manually
            $mail->AltBody = 'Ceci est un message texte';
            $mail->Body = $message;
            //Attach an image file
            // $mail->addAttachment('images/phpmailer_mini.png');
            //send the message, check for errors
            if (!$mail->send()) {
                echo "Mailer Error: " . $mail->ErrorInfo;
                $_SESSION['mailSent'] = "Tu correo ha sido enviado, te contactaremos lo más pronto posible ";
               
                $this->redirectToRoute("main-home");
                // $this->redirectToRoute("main-home");
            } else {
                $_SESSION['mailSent'] = "Tu correo ha sido enviado, te contactaremos lo más pronto posible ";
                $this->redirectToRoute("main-home");
            }
        }
    }

}






