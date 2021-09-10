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
    protected $session;

    public function __construct($pdo, $session) {
        $this->session = $session;
    }

    public function form() {
        $session = $this->session;
        require ROOT . '/App/View/contact.php';
    }

    public function process() {
        if (empty(filter_input(INPUT_POST, 'name_input')) || empty(filter_input(INPUT_POST, 'email_input')) || empty(filter_input(INPUT_POST, 'message_input'))) {
            $this->redirect('contact-form', 'error', 'All fields must be filled');
        } else {
            $configs = include(ROOT . '/Core/config/config.php');
            $mail = new PHPMailer();
            $mail->IsSMTP();
            $mail->Mailer = 'smtp';
            $mail->SMTPAuth   = TRUE;
            $mail->SMTPSecure = 'ssl';
            $mail->Port       = 465;
            $mail->Host       = 'smtp.gmail.com';
            $mail->Username   = $configs['email_username'];
            $mail->Password   = $configs['email_password'];
            $mail->AddAddress('buzek.jonatan@gmail.com', 'jo');
            $mail->SetFrom('mailer.ocr@gmail.com', 'mailer.ocr');
            $mail->Subject = 'Contact from ' . filter_input(INPUT_POST, 'name_input') . ' <' . filter_input(INPUT_POST, 'email_input') . '>';
            $content = filter_input(INPUT_POST, 'message_input');
            $mail->MsgHTML($content);
            if(!$mail->Send()) {
                $this->redirect('contact-form', 'error', 'An error has occured<br>Please try again');
            } else {
                $this->redirect(null, 'success', 'Your message sent successfully');
            }
        }
    }

}
