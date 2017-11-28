<?php
// Import PHPMailer classes into the global namespace
// These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';

Class Mailer {
    protected $mail;

    public function __construct()
    {
        $this->mail = new PHPMailer(true);                              // Passing `true` enables exceptions$this->
        $this->mail->SMTPDebug = 2;                                 // Enable verbose debug output
        $this->mail->isSMTP();                                      // Set mailer to use SMTP
        $this->mail->Host = 'smtp1.mail.ru';  // Specify main and backup SMTP servers
        $this->mail->SMTPAuth = true;                               // Enable SMTP authentication
        $this->mail->Username = 'loft_lessons@mail.ru';                 // SMTP username
        $this->mail->Password = 'Prostohochuest';                           // SMTP password
        $this->mail->SMTPSecure = 'ssl';                            // Enable TLS encryption, `ssl` also accepted
        $this->mail->Port = 465;                                    // TCP port to connect to

        //Recipien$this->ts
        $this->mail->setFrom('loft_lessons@mail.ru', 'Бургерная №1');
        $this->mail->addAddress("$email", "$name");     // Add a recipient
        $this->mail->addReplyTo('loft_lessons@mail.ru', "Robot");
        $this->mail->CharSet = 'UTF-8';
        //$mail->addCC('cc@example.com');
        //$mail->addBCC('bcc@example.com');

        //Attachments
        //$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
        // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name

        //Content
        $this->mail->isHTML(true);                                  // Set email format to HTML
        $this->mail->Subject = "Письмо с сайта Burgers. Ваш заказ от " .date('d.m.Y');

    }

    public function SetMessage($order_data) {
        $this->mail->Body    = "$order_data";
        $this->mail->AltBody = 'Ваш почтовый клиент не поддерживает Html, попробуйте другой ';
    }
    public function SendMessage() {
        if  (!$this->mail->send()) {
            echo 'Письмо не может быть отправлено.';
            echo 'Ошибка: ' . $this->mail->ErrorInfo;
        }
    }
}

$mailer = new Mailer();
$mailer->SetMessage("$order_data");
$mailer->SendMessage();

