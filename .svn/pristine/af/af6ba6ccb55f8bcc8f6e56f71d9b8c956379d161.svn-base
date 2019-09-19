<?php
    use PHPMailer\PHPMailer\PHPMailer;

        require_once "PHPMailer/PHPMailer.php";
        require_once "PHPMailer/SMTP.php";
        require_once "PHPMailer/Exception.php";

        $mail = new PHPMailer();

        //SMTP Settings
        $mail->isSMTP();    
        $mail->Host = "smtp.gmail.com";
        $mail->SMTPAuth = true;
        $mail->Username = "sgcmo123@gmail.com";
        $mail->Password = 'sgrealcmo';
        $mail->Port = 465; //587
        $mail->SMTPSecure = "ssl"; //tls

        $email = "test@gmail.com";
        $name = "The Crisis Management Office";
        $subject = "CMS Incident Summary Report";
        $body = "Attached is the latest incident summary report.";

        //Email Settings
        $mail->isHTML(true);
        $mail->setFrom($email, $name);
        $mail->addAddress("cr9roxdswk@gmail.com");
        $mail->addAttachment("test.pdf");
        $mail->Subject = $subject;
        $mail->Body = $body;


if ($mail->send()) {
    $status = "success";
    $response = "Email is sent!";
} else {
    echo $mail->ErrorInfo;
    $status = "failed";
    $response = "Something is wrong: <br><br>" . $mail->ErrorInfo;
}

?>
