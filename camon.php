<?php
session_start();
require "config.php";
require 'vendor/autoload.php';
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
if (isset($_POST['submit']) && isset($_POST['hoten']) && isset($_POST['sdt']) && isset($_POST['email']) && isset($_POST['g-recaptcha-response'])) {
    if (!isset($_SESSION['code'])) {
        //kiểm tra recaptcha
        $response = $_POST['g-recaptcha-response'];
        $remoteip = $_SERVER['REMOTE_ADDR'];
        $url = 'https://www.google.com/recaptcha/api/siteverify';
        $data = [
            'secret' => $secret,
            'response' => $response,
            'remoteip' => $remoteip
        ];

        $options = [
            'http' => [
                'header' => "Content-type: application/x-www-form-urlencoded\r\n",
                'method' => 'POST',
                'content' => http_build_query($data),
            ],
        ];

        $context = stream_context_create($options);
        $result = file_get_contents($url, false, $context);
        $resultJson = json_decode($result);

        if ($resultJson->success) {
        } else {
            header("Location:/");
            exit;
        }

        //thông tin form
        $name = mysqli_real_escape_string($conn, $_POST['hoten']);
        if (!preg_match("/^[\p{L}\s]+$/u", $name)) {
            header("Location:/");
            exit;
        }
        $phone = mysqli_real_escape_string($conn, $_POST['sdt']);
        if (!preg_match("/^0[0-9]{9}$/", $phone)) {
            header("Location:/");
            exit;
        }
        $email = mysqli_real_escape_string($conn, $_POST['email']);
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            header("Location/");
            exit;
        }

        $sql_code = "SELECT * FROM code LIMIT 1";
        $code = $conn->query($sql_code);
        if (mysqli_num_rows($code) == 0) {
            $code = 'tạm thời hết mã rồi !!';
        } else {
            $code = mysqli_fetch_assoc($code);
            $code = $code['code'];
            try {
                $currentDate = date('Y-m-d');
                $sql_khuyenmai = "INSERT INTO khuyenmai (email, phone, name, code,date) VALUES ('$email', '$phone', '$name', '$code','$currentDate')";
                $khuyenmai = mysqli_query($conn, $sql_khuyenmai);
                //xóa code vừa sử dụng
                $sql_delcode = "DELETE FROM code WHERE code = '$code'";
                $delcode = mysqli_query($conn, $sql_delcode);
                $mail = new PHPMailer(true);
                $mail->isSMTP();  // Sử dụng SMTP
                $mail->Host = 'smtp.gmail.com';
                // Máy chủ SMTP của bạn
                $mail->SMTPAuth = true;                    // Bật xác thực SMTP
                $mail->Username = $mailsv;                // Tên đăng nhập email
                $mail->Password = $mailsvpass;                       // Mật khẩu email
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;// Bảo mật
                $mail->Port = 465;
                // Người gửi và người nhận
                $mail->setFrom($mailsv, 'VPSTTT'); // Địa chỉ người gửi
                $mail->addAddress($email, $name); // Địa chỉ người nhận

                // Nội dung email
                $mail->isHTML(true);
                $mail->ContentType = 'text/html';                             // Đặt định dạng email là HTML
                $mail->Subject = 'Chúc mừng! Bạn đã nhận được mã giới thiệu 15%';
                $bodymail = '<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chương trình Giới thiệu khách hàng - VPSTTT</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        body,
        p,
        span,
        div,
        td {
            color: black !important;
        }
        /* ✅ Thay font Roboto bằng Arial, Helvetica */
        body {
            font-family: Arial, Helvetica, sans-serif;
            font-size: 14px;
            line-height: 1.6;
            color: black !important;
            background-color: white;
            padding: 20px;
        }

        .container {
            max-width: 600px;
            margin: 0 auto;
            background-color: #ffffff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .header {
            background-color: #6a0dad;
            text-align: center;
            padding: 15px;
            border-radius: 10px 10px 0 0;
        }

        .header h1 {
            color: white;
            font-size: 24px;
            font-weight: bold;
            margin: 0;
        }

        .content {
            padding: 20px;
        }

        .content p {
            margin-bottom: 10px;
        }

        .code {
            font-weight: bold;
            color: #6a0dad;
        }

        .list {
            margin: 15px 0;
            padding-left: 20px;
            list-style: none;
        }

        .list li {
            margin-bottom: 8px;
        }

        .link {
            color: #000;
            text-decoration: underline;
        }

        .footer {
            text-align: center;
            background-color: #f4f4f4;
            padding: 10px;
            font-size: 12px;
            color: #777;
            border-radius: 0 0 10px 10px;
        }

        .thank-you {
            text-align: center;
            font-weight: bold;
            margin-top: 15px;
        }

        /* ✅ Giảm cỡ chữ trên điện thoại */
        @media (max-width: 768px) {
            body {
                padding: 10px;
                font-size: 12px;
            }

            .container {
                padding: 15px;
            }

            .header h1 {
                font-size: 20px;
            }

            .list {
                padding-left: 10px;
            }

            .footer {
                font-size: 10px;
            }
        }
    </style>
</head>

<body>
    <div class="container">
        <!-- Header -->
        <div class="header">
            <h1>VPSTTT</h1>
        </div>

        <!-- Nội dung -->
        <div class="content">
            <p>Kính gửi Quý khách hàng,</p>
            <p>Cảm ơn quý khách đã tham gia chương trình <strong>"Giới thiệu khách hàng - Nhận ngay ưu đãi!"</strong>
                của VPSTTT.</p>

            <p><strong>MÃ GIỚI THIỆU ĐỘC QUYỀN CỦA BẠN:</strong>
                <span class="code">' . $code . '</span>
            </p>
            <p>Thời gian sử dụng mã: 2 tháng kể từ ngày nhận.</p>

            <hr style="margin-bottom:10px">

            <p><strong>HÀNH ĐỘNG NGAY ĐỂ NHẬN ƯU ĐÃI</strong></p>
            <ul class="list">
                <li>1. Chia sẻ mã với bạn bè chưa có tài khoản tại VPSTTT.</li>
                <li>2. Người được giới thiệu đăng ký và nhập mã 15% khi mua dịch vụ.</li>
                <li>3. Họ phát sinh giao dịch hợp lệ tại VPSTTT.</li>
                <li>4. Mã được dùng mỗi 5 lần, bạn nhận thưởng ngay!</li>
            </ul>

            <hr style="margin-bottom:10px">

            <p><strong>Xem hướng dẫn sử dụng mã:</strong>
                <a target="_blank" href="https://vpsttt.com/huong-dan-su-dung-ma-gioi-thieu-vpsttt-2025/" class="link">https://vpsttt.com/huong-dan-su-dung-ma-gioi-thieu-vpsttt-2025/</a>
            </p>

            <p><strong>Thể lệ chương trình:</strong>
                <a href="https://khuyenmai.vpsttt.com" class="link">https://khuyenmai.vpsttt.com/</a>
            </p>

            <p><strong>Thời gian diễn ra chương trình:</strong> 20/02/2024 - 31/12/2025</p>

            <hr style="margin-bottom:10px">

            <p><strong>Mọi thắc mắc, vui lòng liên hệ:</strong></p>
            <p>📞 Hotline CSKH 24/7: 0328-812-674</p>
            <p>📧 Email: <a href="mailto:lienhe@vpsttt.com" class="link">lienhe@vpsttt.com</a></p>
            <p>🌍 Website: <a href="https://vpsttt.com" class="link">https://vpsttt.com</a></p>
            <p>📢 Fanpage: <a href="https://www.facebook.com/trang.vpsttt"
                    class="link">https://www.facebook.com/trang.vpsttt</a></p>
            <p>💬 Zalo OA: <a href="https://zalo.me/vpstttgroup" class="link">https://zalo.me/vpstttgroup</a></p>

            <hr>

            <p class="thank-you">Cảm ơn quý khách đã đồng hành cùng VPSTTT!</p>
        </div>

        <!-- Footer -->
        <div class="footer">
            © 2025 VPSTTT. Mọi quyền được bảo lưu.
        </div>
    </div>
</body>

</html>';
                $mail->Body = $bodymail;
                $mail->addAttachment('the_le_chi_tiet_chuong_trinh.pdf');
                $mail->CharSet = 'UTF-8';
                $mail->send();
            } catch (Exception $e) {
                $code = 'tạm thời đã hết mã !!';
            }
        }
        $_SESSION['code'] = $code;
    }
} else {
    header("Location:/");
    exit;
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="robots" content="noindex, nofollow">
    <meta name="og:title" property="og:title" content="Tham gia Chương Trình Giới Thiệu - Nhận Ưu Đãi Lớn với VPSTTT!">
    <meta property="og:image" content="public/assets/images/logo/logo.png">
    <meta name="og:description"
        content="Giới thiệu bạn bè tới VPSTTT và cùng nhau hưởng ưu đãi đặc biệt! Tìm hiểu ngay cách để nhận thưởng và cung cấp giá trị cho bạn bè của bạn!">
    <link rel="icon" href="./public/assets/images/logo/favicon.png" type="image/gif" sizes="16x16">
    <meta name="description"
        content="Giới thiệu bạn bè tới VPSTTT và cùng nhau hưởng ưu đãi đặc biệt! Tìm hiểu ngay cách để nhận thưởng và cung cấp giá trị cho bạn bè của bạn!">
    <title>Cảm ơn quý khách!</title>
    <!-- FontAwesome -->
    <link rel="stylesheet" href="./public/lib/fontawesome/css/all.min.css">
    <!-- Google Font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;500;600;700;800&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tiny-slider/2.9.4/tiny-slider.css">
    <!-- Main Style -->
    <link rel="stylesheet" href="./public/assets/css/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>

</head>

<body style="font-family: 'Roboto', sans-serif;" class="landing">
    <!-- Preloader Start -->
    <div class="preloader h-full fixed w-full z-50 bg-white transition duration-300">
        <img src="./public/assets/images/logo/logo.png"
            class="max-w-[20rem] block absolute top-2/4 left-2/4 transform -translate-x-2/4 -translate-y-2/4"
            alt="Logo">
    </div>
    <!-- Preloader End -->
    <!-- Header -->

    <header class=" bg-white sticky top-0 w-full z-10">
        <nav class="py-4 shadow-[0px_0px_27px_0px_rgba(0,0,0,0.06)]">
            <div class="container">
                <div class="flex items-center justify-between">
                    <div class="flex items-center">
                        <a href="/">
                            <img src="./public/assets/images/logo/logo.png" class="w-48 md:w-56" alt="Logo Image">
                            <!-- Tăng kích thước logo -->
                        </a>
                    </div>

                    <div class="lg:hidden">
                        <button
                            class="bg-[#e4dbed] text-primary hover:bg-primary font-semibold hover:text-white rounded-std transition-colors shadow-std py-2 px-3"
                            id="navToggoler">
                            <i class="fas fa-bars"></i>
                        </button>
                    </div>

                    <div class="hidden lg:flex items-center ">
                        <ul class="font-medium flex flex-col lg:flex-row items-center relative py-0" id="js-clone-nav">
                            <li class="relative hidden lg:block">
                                <a href="javascript:void(0)" class="nav-link before:hidden py-2 pl-3 pr-4 text-black"
                                    data-toggler="active" data-d2c-dropdown="dropdown1">
                                    <span class="mr-2">Hướng dẫn</span>
                                </a>
                                <!-- Sub Menu -->
                                <ul class="mt-1 hidden absolute right-0 top-full py-3 px-4 border border-primary-1 rounded min-w-[180px] bg-white z-50"
                                    data-d2c-dropdownItem="down-element1">
                                    <li>
                                        <a target="_blank"
                                            class="text-black font-semibold hover:text-primary text-base flex items-center py-1 transition-colors duration-500 capitalize"
                                            href="https://vpsttt.com/huong-dan-su-dung-ma-gioi-thieu-vpsttt-2025/">Sử
                                            dụng mã</a>
                                    </li>
                                    <li>
                                        <a target="_blank"
                                            class="text-black font-semibold hover:text-primary text-base flex items-center py-1 transition-colors duration-500 capitalize"
                                            href="https://vpsttt.com/huong-dan-mua-vps-tren-vpsttt-com-2/">Mua hàng</a>
                                    </li>
                                </ul>
                            </li>
                            <li>
                                <a target="_blank"
                                    href="https://vpsttt.com/huong-dan-su-dung-ma-gioi-thieu-vpsttt-2025/"
                                    class="block lg:hidden py-2 pl-3 pr-4 font-semibold text-secondary hover:text-primary transition-colors duration-300">
                                    Hướng
                                    dẫn dùng mã</a>
                            </li>
                            <li>
                                <a target="_blank" href="https://vpsttt.com/huong-dan-mua-vps-tren-vpsttt-com-2/"
                                    class="block lg:hidden py-2 pl-3 pr-4 font-semibold text-secondary hover:text-primary transition-colors duration-300">Hướng
                                    dẫn mua hàng</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </nav>
    </header>

    <!-- Mobile View Nav -->
    <div class="block lg:hidden w-60 fixed right-0 top-0 bottom-0 bg-white z-50 h-screen translate-x-full transition-transform duration-500 p-4 border border-primary-1"
        id="mobile_view_nav">
        <button
            class="bg-white text-primary hover:bg-primary font-semibold hover:text-white rounded-std transition-colors shadow-std ml-3"
            id="navCloser">
            <i class="fas fa-times"></i>
        </button>
    </div>

    <style>
        @keyframes pulse-ring {
            0% {
                transform: scale(1);
                opacity: 0.6;
            }

            80% {
                transform: scale(2.5);
                opacity: 0;
            }

            100% {
                transform: scale(3);
                opacity: 0;
            }
        }

        .pulse-ring {
            position: absolute;
            width: 100%;
            height: 100%;
            border-radius: 9999px;
            background: rgba(59, 130, 246, 0.5);
            /* Màu xanh của Messenger */
            animation: pulse-ring 1.5s infinite ease-out;
        }

        .pulse-ring-zalo {
            background: rgba(24, 119, 242, 0.5);
            /* Màu xanh của Zalo */
        }

        .vpsttt-bgcolor {
            background-color: #7643c9;
        }

        .vpsttt-hvbgcolor:hover {
            background-color: #7643c9;
        }


        .vpsttt-color {
            color: #7643c9;
        }

        .vpsttt-hvcolor:hover {
            color: #7643c9;
        }
    </style>

    <div class="fixed bottom-6 left-6 flex flex-col space-y-4 z-[9999]">
        <!-- Messenger -->
        <a href="https://www.facebook.com/trang.vpsttt" target="_blank"
            class="relative w-14 h-14 flex items-center justify-center">
            <span class="pulse-ring absolute"></span>
            <span class="pulse-ring absolute" style="animation-delay: 0.5s"></span>
            <div
                class="w-14 h-14 flex items-center justify-center bg-blue-600 rounded-full shadow-lg hover:scale-110 transition-transform">
                <i class="fab fa-facebook-messenger text-white text-2xl"></i>
            </div>
        </a>

        <!-- Zalo -->
        <a href="https://zalo.me/vpstttgroup" target="_blank"
            class="relative w-14 h-14 flex items-center justify-center">
            <span class="pulse-ring pulse-ring-zalo absolute"></span>
            <span class="pulse-ring pulse-ring-zalo absolute" style="animation-delay: 0.5s"></span>
            <div
                class="w-14 h-14 flex items-center justify-center bg-blue-400 rounded-full shadow-lg hover:scale-110 transition-transform">
                <img src="./public/assets/images/logo/zalo.png" alt="Zalo" class="w-8 h-8">
            </div>
        </a>
    </div>
    <section
        class="bg-[url('../../../public/assets/images/landing/contact.png')] bg-no-repeat bg-cover py-10 md:py-14 xl:py-24 flex items-center justify-center"
        id="dangky">
        <div class="container text-center">
            <div
                class="rounded-lg p-8 mb-10 max-w-2xl mx-auto transition-transform duration-300 hover:scale-105 hover:shadow-2xl">
                <h4 class="d2c_title vpsttt-color text-center mb-4 text-3xl font-bold">
                    <i class="fas fa-heart text-red-600"></i> Cảm ơn quý khách!
                </h4>
                <p class="text-black text-lg">Chúng tôi xin chân thành cảm ơn quý khách đã quan tâm đến chương trình
                    giới thiệu khách hàng của VPSTTT.</p>
                <p class="text-black text-lg mt-2">Mã giới thiệu độc quyền:</p>
                <div class="flex items-center justify-center">
                    <p class="font-bold text-4xl animate-color-change mr-4">
                        <span id="promo-code"><?= $_SESSION['code'] ?></span>
                    </p>
                    <button onclick="copyToClipboard()"
                        class="flex items-center text-blue-600 px-2 py-1 rounded-lg hover:text-blue-800 transition duration-300">
                        <i class="fas fa-copy mr-2"></i> Copy
                    </button>
                </div>
                <p class="text-info-1 text-lg mt-4">Liên hệ với chúng tôi qua <a target="_blank"
                        class="underline text-blue-500" href="https://zalo.me/vpstttgroup">Zalo OA</a> hoặc <a
                        target="_blank" class="underline text-blue-500"
                        href="https://www.facebook.com/trang.vpsttt">Fanpage</a>.</p>
            </div>
        </div>

    </section>
    <style>
        @keyframes colorChange {
            0% {
                color: #ff5733;
            }

            /* Màu đỏ */
            25% {
                color: #33ff57;
            }

            /* Màu xanh lá */
            50% {
                color: #3357ff;
            }

            /* Màu xanh dương */
            75% {
                color: #f1c40f;
            }

            /* Màu vàng */
            100% {
                color: #ff5733;
            }

            /* Quay lại màu đỏ */
        }

        .animate-color-change {
            animation: colorChange 4s infinite;
        }
    </style>
    <script>
        function copyToClipboard() {
            const promoCode = document.getElementById("promo-code").innerText;
            navigator.clipboard.writeText(promoCode).then(() => {
                alert("Đã sao chép mã: " + promoCode);
            }).catch(err => {
                console.error("Không thể sao chép mã: ", err);
            });
        }
    </script>
    <section
        class="bg-[url('../../../public/assets/images/landing/exp.png')] bg-no-repeat bg-cover py-10 md:py-14 xl:py-24">
        <div class="container">
            <h4 class="d2c_title text-center mb-10 vpsttt-color">Thể lệ chương trình</h4>
            <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-2 gap-6 mb-4">

                <!-- Card 1 -->
                <div class="card group vpsttt-hvbgcolor transition-colors duration-300">
                    <div class="card-body p-6">
                        <div
                            class="px-4 py-2 bg-primary-1 group-hover:bg-white rounded-std-1/2 inline-flex mb-4 transition-colors duration-300">
                            <i class="fas fa-user-friends vpsttt-color text-xl"></i>
                        </div>
                        <h5
                            class="text-lg text-black group-hover:text-white font-bold mb-4 transition-colors duration-300">
                            Người giới thiệu</h5>
                        <p class="group-hover:text-white transition-colors duration-300 text-black">
                            <i class="group-hover:text-white fas fa-check-circle vpsttt-color text-sm mr-2"></i> Người
                            giới thiệu là khách hàng
                            đã sử dụng dịch vụ tại VPSTTT.
                        </p>
                        <p class="group-hover:text-white transition-colors duration-300 text-black">
                            <i class="group-hover:text-white fas fa-check-circle vpsttt-color text-sm mr-2"></i> Sau khi
                            thực hiện đủ theo yêu
                            cầu chương trình, công ty kiểm tra dữ liệu trên hệ thống để xác minh quý khách hàng đã đủ
                            điều kiện nhận thưởng.
                        </p>
                        <p class="group-hover:text-white transition-colors duration-300 text-black">
                            <i class="group-hover:text-white fas fa-check-circle vpsttt-color text-sm mr-2"></i> VPSTTT
                            sẽ trực tiếp liên hệ
                            với bạn để trao đổi về phần thưởng.
                        </p>
                    </div>
                </div>

                <!-- Card 2 -->
                <div class="card group vpsttt-hvbgcolor transition-colors duration-300">
                    <div class="card-body p-6">
                        <div
                            class="px-4 py-2 bg-primary-1 group-hover:bg-white rounded-std-1/2 inline-flex mb-4 transition-colors duration-300">
                            <i class="fas fa-gift vpsttt-color text-xl"></i>
                        </div>
                        <h5
                            class="text-lg text-black group-hover:text-white font-bold mb-4 transition-colors duration-300">
                            Người được giới thiệu</h5>
                        <p class="group-hover:text-white transition-colors duration-300 text-black">
                            <i class="group-hover:text-white fas fa-check-circle vpsttt-color text-sm mr-2"></i> Là
                            những khách hàng mới chưa có hoặc đã có tài khoản tại vpsttt.com
                        </p>
                        <p class="group-hover:text-white transition-colors duration-300 text-black">
                            <i class="group-hover:text-white fas fa-check-circle vpsttt-color text-sm mr-2"></i> Thực
                            hiện đăng nhập và sử dụng
                            mã giảm giá thành công thông qua người giới thiệu và được ghi nhận trong thời gian diễn ra
                            chương trình.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section
        class="bg-[url('../../../public/assets/images/landing/exp.png')] bg-no-repeat bg-cover py-10 md:py-14 xl:py-24">
        <div class="container">
            <h4 class="d2c_title text-center mb-10 text-3xl font-bold vpsttt-color">Hướng dẫn!</h4>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-4">

                <!-- Hướng dẫn lấy mã -->
                <div class="card group vpsttt-hvbgcolor transition-colors duration-300">
                    <div class="card-body p-6 text-center">
                        <div
                            class="px-4 py-2 bg-primary-1 group-hover:bg-white rounded-std-1/2 inline-flex mb-4 transition-colors duration-300">
                            <i class="fas fa-pencil-alt vpsttt-color text-2xl"></i>
                            <!-- Icon cho việc điền thông tin -->
                        </div>
                        <h5
                            class="text-lg text-black group-hover:text-white font-bold mb-4 transition-colors duration-300">
                            Hướng dẫn lấy mã giới thiệu
                        </h5>
                        <p class="group-hover:text-white text-black transition-colors duration-300">
                            Điền thông tin của bạn và nhận mã giới thiệu nhanh chóng.
                        </p>
                        <a target="_blank" href="https://vpsttt.com/huong-dan-lay-ma-gioi-thieu-vpsttt-2025/"
                            class="inline-flex py-2 px-4 bg-primary-1 font-bold rounded-std capitalize mt-4 vpsttt-color group-hover:bg-white transition-colors duration-300">Xem
                            ngay</a>
                    </div>
                </div>

                <!-- Hướng dẫn sử dụng mã -->
                <div class="card group vpsttt-hvbgcolor transition-colors duration-300">
                    <div class="card-body p-6 text-center">
                        <div
                            class="px-4 py-2 bg-primary-1 group-hover:bg-white rounded-std-1/2 inline-flex mb-4 transition-colors duration-300">
                            <i class="fas fa-share-alt vpsttt-color text-2xl"></i> <!-- Icon cho việc chia sẻ -->
                        </div>
                        <h5
                            class="text-lg text-black group-hover:text-white font-bold mb-4 transition-colors duration-300">
                            Hướng dẫn sử dụng mã giới thiệu
                        </h5>
                        <p class="group-hover:text-white text-black transition-colors duration-300">
                            Cách sử dụng mã giới thiệu để mua hàng tại VPSTTT.
                        </p>
                        <a target="_blank" href="https://vpsttt.com/huong-dan-su-dung-ma-gioi-thieu-vpsttt-2025/"
                            class="inline-flex py-2 px-4 bg-primary-1 font-bold rounded-std capitalize mt-4 vpsttt-color group-hover:bg-white transition-colors duration-300">Xem
                            ngay</a>
                    </div>
                </div>

                <!-- Hướng dẫn mua hàng -->
                <div class="card group vpsttt-hvbgcolor transition-colors duration-300">
                    <div class="card-body p-6 text-center">
                        <div
                            class="px-4 py-2 bg-primary-1 group-hover:bg-white rounded-std-1/2 inline-flex mb-4 transition-colors duration-300">
                            <i class="fas fa-shopping-cart vpsttt-color text-2xl"></i> <!-- Icon cho việc mua hàng -->
                        </div>
                        <h5
                            class="text-lg text-black group-hover:text-white font-bold mb-4 transition-colors duration-300">
                            Hướng dẫn mua hàng
                        </h5>
                        <p class="group-hover:text-white text-black transition-colors duration-300">
                            Hướng dẫn mua hàng tại VPSTTT.
                        </p>
                        <a target="_blank" href="https://vpsttt.com/huong-dan-mua-vps-tren-vpsttt-com-2/"
                            class="inline-flex py-2 px-4 bg-primary-1 font-bold rounded-std capitalize mt-4 vpsttt-color group-hover:bg-white transition-colors duration-300">Xem
                            ngay</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Include Font Awesome for icons -->
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
    <footer class="bg-primary">
        <div class="container">
            <div
                class="flex flex-col md:flex-row items-center justify-between py-4 border-b border-[rgba(228,219,237,0.06)]">
                <div class="mb-4 md:mb-0">
                    <a href="https://vpsttt.com/"><img class="w-48 md:w-56"
                            src="./public/assets/images/logo/logowhite.svg" alt="Logo Image"></a>
                </div>

                <div class="text-white text-center md:text-left">
                    <p class="font-semibold text-lg text-white">Thông tin liên hệ</p>
                    <p class="text-white">Email: <a href="mailto:lienhe@vpsttt.com"
                            class="text-white hover:underline">lienhe@vpsttt.com</a></p>
                    <p class="text-white">Hotline: <a href="tel:+84328812674" class="text-white hover:underline">+84 328
                            812 674</a></p>
                    <p class="text-white">Địa chỉ: Số 15 Đường B3, Phường Vĩnh Hòa, Thành phố Nha Trang, Tỉnh Khánh Hòa
                    </p>
                </div>

                <div class="mb-4 md:mb-0">
                    <a target="_blank" href="https://vpsttt.com/chinh-sach-bao-mat/"
                        class="text-white text-base font-semibold">Chính sách bảo mật</a>
                    <span class="text-white text-base font-semibold">|</span>
                    <a target="_blank" href="https://vpsttt.com/dieu-khoan-su-dung-dich-vu/"
                        class="text-white text-base font-semibold">Điều khoản dịch vụ</a>
                </div>

                <div class="mb-4 md:mb-0 flex space-x-3">
                    <!-- Facebook -->
                    <a target="_blank" href="https://www.facebook.com/trang.vpsttt"
                        class="bg-[#1877F2] text-white w-10 h-10 flex items-center justify-center rounded-full shadow-lg hover:bg-blue-600 transition-colors">
                        <i class="fab fa-facebook-f text-lg"></i>
                    </a>

                    <!-- Zalo -->
                    <a target="_blank" href="https://zalo.me/vpstttgroup"
                        class="bg-[#0088FF] text-white w-10 h-10 flex items-center justify-center rounded-full shadow-lg hover:bg-blue-500 transition-colors">
                        <img src="public/assets/images/logo/zalo.png" alt="Zalo" class="w-6 h-6">
                    </a>
                </div>
            </div>

            <div class="py-4 text-center">
                <p class="text-white">All rights reserved by <a href="https://devttt.com/"
                        class="text-white font-semibold" target="_blank">DEVTTT</a></p>
            </div>
        </div>
    </footer>
    <!-- footer -->

    <!-- jquery -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <!-- Main Js Config -->
    <script src="./public/assets/js/main.js"></script>

    <!-- Tiny Slider -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tiny-slider/2.9.2/min/tiny-slider.js"></script>
    <!-- <script>
        var slider = tns({
            "container": "#slider",
            "controls": false,
            "items": 2,
            "controlsText": true,
            "autoplay": false,
            "autoplayTimeout": 100,
            "autoplayButton": true,
            "slideBy": "page",
            "mouseDrag": true,
            "swipeAngle": true,
            "speed": 400,
            "nav": true,
            responsive: {
                1024: {
                    items: 2
                },
                0: {
                    items: 1
                }

            }
        });
    </script> -->
</body>

</html>