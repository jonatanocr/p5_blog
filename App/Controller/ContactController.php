<?php


namespace App\Controller;

use Core\Controller\Controller;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require ROOT.'/vendor/phpmailer/phpmailer/src/Exception.php';
require ROOT.'/vendor/phpmailer/phpmailer/src/PHPMailer.php';
require ROOT.'/vendor/phpmailer/phpmailer/src/SMTP.php';

class ContactController extends Controller
{
    public function form() {
        require(ROOT . '/App/View/contact.php');
    }

    public function process() {
        if (empty($_POST["name_input"]) OR empty($_POST["email_input"]) OR empty($_POST["message_input"])) {
            $this->redirect('contact-form', 'error', 'All fields must be filled');
        } else {
            //todo mettre ca dans un fichier de config
            define('GMailUSER', 'email@gmail.com'); // utilisateur Gmail
            define('GMailPWD', 'password'); // Mot de passe Gmail
            $mail = new PHPMailer();
            $mail->IsSMTP();
            $mail->Mailer = 'smtp';
            $mail->SMTPAuth   = TRUE;
            $mail->SMTPSecure = 'ssl';
            $mail->Port       = 465;
            $mail->Host       = 'smtp.gmail.com';
            $mail->Username   = GMailUSER;
            $mail->Password   = GMailPWD;
            $mail->AddAddress('buzek.jonatan@gmail.com', 'jo');
            $mail->SetFrom('mailer.ocr@gmail.com', 'mailer.ocr');
            $mail->Subject = 'Contact from ' . $_POST["name_input"] . ' <' . $_POST["email_input"] . '>';
            $content = $_POST["message_input"];
            $mail->MsgHTML($content);
            if(!$mail->Send()) {
                $this->redirect('contact-form', 'error', 'An error has occured<br>Please try again');
            } else {
                $this->redirect(null, 'success', 'Your message sent successfully');
            }
        }
    }

}