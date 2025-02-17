<?php
require "config.php";
require 'vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
$name ='hung';
$email ='shin11052017@gmail.com';
$phone ='';
// if (($name == '') or ($email == '') or ($phone == '')) {
//     echo json_encode(["success" => false, "message" => "Vui lòng điền đầy đủ thông tin."]);
//     exit;
// }
// if (empty($name) || empty($email) || empty($phone)) {
//     echo json_encode(["success" => false, "message" => "Vui lòng điền đầy đủ thông tin."]);
//     exit;
// }
//lấy mã code
$sql_code = "SELECT * FROM code LIMIT 1";
$code = $conn->query($sql_code);
if (mysqli_num_rows($code) == 0) {
    echo json_encode(["success" => false, "message" => "Tạm thời hết mã giới thiệu, quý khách vui lòng liên hệ với chúng tôi qua zalo OA để được hỗ trợ"]);
    exit;
}
$code = mysqli_fetch_assoc($code);

echo json_encode(["success" => true, "message" => "Cám ơn quý khách đã đăng ký chương trình, mã giới thiệu của bạn là:"]);
exit;
// //ghi vào khuyen mai
// $sql_khuyenmai = "INSERT INTO khuyenmai (email, phone, name, code) VALUES ('$email', '$phone', '$name', '$code')";
// $khuyenmai = mysqli_query($conn, $sql_khuyenmai);
// if ($khuyenmai) {
//     //xóa code vừa sử dụng
//     $sql_delcode = "DELETE FROM code WHERE code = $code";
//     $delcode = mysqli_query($conn, $sql_delcode);
// } else {
//     echo json_encode(["success" => false, "message" => "Hệ thống đang lỗi"]);
//     exit;
// }

// Gửi email
// $mail = new PHPMailer(true);
// try {
//     // Cấu hình máy chủ
//     // Cấu hình máy chủ SMTP
//     $mail->isSMTP();                                            // Sử dụng SMTP
//     $mail->Host = 'smtp.vpsttt.vn';                     // Máy chủ SMTP của bạn
//     $mail->SMTPAuth = true;                                 // Bật xác thực SMTP
//     $mail->Username = 'khuyenmai@vpsttt.vn';                // Tên đăng nhập email
//     $mail->Password = 'nJIBmM9YE4uDdTK';                       // Mật khẩu email
//     $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;      // Bảo mật
//     $mail->Port = 587;                                  // Cổng SMTP

//     // Người gửi và người nhận
//     $mail->setFrom('khuyenmai@vpsttt.vn', 'VPSTTT'); // Địa chỉ người gửi
//     $mail->addAddress($email,$name); // Địa chỉ người nhận

//     // Nội dung email
//     $mail->isHTML(true);                                  // Đặt định dạng email là HTML
//     $mail->Subject = 'Tiêu đề email';
//     $mail->Body = 'Nội dung email ở đây.';
//     $mail->AltBody = 'Nội dung thay thế nếu không hỗ trợ HTML.';

//     // Gửi email
//     $mail->send();
//     echo json_encode(["success" => true, "message" => "Cám ơn quý khách đã đăng ký chương trình, mã giới thiệu của bạn là:" . $code]);
// } catch (Exception $e) {
//     echo json_encode(["success" => true, "message" => "Cám ơn quý khách đã đăng ký chương trình, mã giới thiệu của bạn là:" . $code]);
// }
?>