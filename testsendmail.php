<?php
    //goi thu vien
    include('PHPMailer-5.2.26/class.smtp.php');
    include "PHPMailer-5.2.26/class.phpmailer.php"; 
    $nFrom = "Su Store";    //mail duoc gui tu dau, thuong de ten cong ty ban
    $mFrom = 'mailtestforworkofstudy@gmail.com';  //dia chi email cua ban 
    $mPass = '1502okko';       //mat khau email cua ban
    $nTo = 'Call me Su'; //Ten nguoi nhan
    $mTo = 'callmesu.pls@gmail.com';   //dia chi nhan mail
    $mail             = new PHPMailer();
    $body             = 'Test gửi mail';   // Noi dung email
    $title = 'Đây là nội dung test gửi mail';   //Tieu de gui mail
    $mail->IsSMTP();             
    $mail->CharSet  = "utf-8";
    $mail->SMTPDebug  = 0;   // enables SMTP debug information (for testing)
    $mail->SMTPAuth   = true;    // enable SMTP authentication
    $mail->SMTPSecure = "ssl";   // sets the prefix to the servier
    $mail->Host       = "smtp.gmail.com";    // sever gui mail.
    $mail->Port       = 465;         // cong gui mail de nguyen
    // xong phan cau hinh bat dau phan gui mail
    $mail->Username   = $mFrom;  // khai bao dia chi email
    $mail->Password   = $mPass;              // khai bao mat khau
    $mail->SetFrom($mFrom, $nFrom);
    $mail->AddReplyTo('mailtestforworkofstudy@gmail.com', 'Su Store'); //khi nguoi dung phan hoi se duoc gui den email nay
    $mail->Subject    = $title;// tieu de email 
    $mail->MsgHTML($body);// noi dung chinh cua mail se nam o day.
    $mail->AddAddress($mTo, $nTo);
    // thuc thi lenh gui mail 
    if(!$mail->Send()) {
        echo 'Co loi!';
         
    } else {
         
        echo 'mail của bạn đã được gửi đi hãy kiếm tra hộp thư đến để xem kết quả. ';
    }
?>