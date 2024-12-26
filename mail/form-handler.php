<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// 引入 PHPMailer 的类文件
require './PHPMailer/Exception.php';
require './PHPMailer/PHPMailer.php';
require './PHPMailer/SMTP.php';

// 获取表单数据
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // 获取表单数据并验证
    $name = htmlspecialchars(trim($_POST['name']));
    $email = htmlspecialchars(trim($_POST['email']));
    $message = htmlspecialchars(trim($_POST['message']));
    $subject = htmlspecialchars(trim($_POST['subject']));

    // 创建 PHPMailer 实例
    $mail = new PHPMailer(true);

    try {
        // 服务器配置
        $mail->CharSet = "UTF-8";                      // 邮件编码
        $mail->SMTPDebug = 0;                          // 关闭调试输出（调试时可设为 2）
        $mail->isSMTP();                               // 使用 SMTP 协议
        $mail->Host = 'smtp.163.com';                  // SMTP 服务器
        $mail->SMTPAuth = true;                        // 开启 SMTP 认证
        $mail->Username = 't1eete@163.com';            // SMTP 用户名（你的163邮箱地址）
        $mail->Password = 'RHVaHZssgT4BGXN5';          // SMTP 授权码
        $mail->SMTPSecure = 'ssl';                     // 使用 SSL 加密协议
        $mail->Port = 465;                             // SMTP 服务器端口

        // 设置发件人和收件人
        $mail->setFrom('t1eete@163.com', 'Web');   // 发件人地址和名称
        $mail->addAddress('itsmewow@163.com', 'Recipient'); // 收件人地址和名称

        // 设置回复地址
        $mail->addReplyTo($email, $name);              // 用户提交的邮箱作为回复地址

        // 邮件内容
        $mail->isHTML(true);                          // 使用纯文本格式
        $mail->Subject = "New Form Submission: $subject";
        $mail->Body    = "User Name: $name\n\n" .
                         "Email: $email\n\n" .
                         "Subject: $subject\n\n" .
                         "Message:\n$message";

        // 发送邮件
        $mail->send();
        echo 'Success!';
        header("Location: https://mobblee.github.io/Web/project/contact.html"); // 邮件发送成功后重定向到联系页面
        exit;
    } catch (Exception $e) {
        echo 'Fail: ', $mail->ErrorInfo;
        exit;
    }
}
?>