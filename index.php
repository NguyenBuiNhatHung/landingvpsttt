<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="robots" content="index, follow">
    <meta name="og:title" property="og:title" content="Tham gia Chương Trình Giới Thiệu - Nhận Ưu Đãi Lớn với VPSTTT!">
    <meta property="og:image" content="public/assets/images/logo/logo.png">
    <meta name="og:description"
        content="Giới thiệu bạn bè tới VPSTTT và cùng nhau hưởng ưu đãi đặc biệt! Tìm hiểu ngay cách để nhận thưởng và cung cấp giá trị cho bạn bè của bạn!">
    <link rel="icon" href="./public/assets/images/logo/favicon.png" type="image/gif" sizes="16x16">
    <meta name="description"
        content="Giới thiệu bạn bè tới VPSTTT và cùng nhau hưởng ưu đãi đặc biệt! Tìm hiểu ngay cách để nhận thưởng và cung cấp giá trị cho bạn bè của bạn!">
    <title>Tham gia Chương Trình Giới Thiệu - Nhận Ưu Đãi Lớn với VPSTTT!</title>
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
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type');
require "config.php";
function getUserIP()
{
    // Kiểm tra xem IP có được cung cấp qua proxy hay không
    if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
        $ip = $_SERVER['HTTP_CLIENT_IP'];
    } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
    } else {
        $ip = $_SERVER['REMOTE_ADDR'];
    }
    return $ip;
}
//check ip đã được lưu lại chưa
$userIP = getUserIP();
$sql_checkip = "select * from view where ip = '$userIP';";
$checkip = mysqli_query($conn, $sql_checkip);
if (mysqli_num_rows($checkip)) {
    //đã tồn tại trong view
    $sql_upip = "update view set count = count +1 where ip = '$userIP'";
    $upip = mysqli_query($conn, $sql_upip);
} else {
    $sql_addip = "INSERT INTO view (ip, count) VALUES ( '$userIP',1)";
    $addip = mysqli_query($conn, $sql_addip);
}

?>

<body class="landing">
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
                            <img src="./public/assets/images/logo/logo.png" class="w-36" alt="Logo Image">
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
                            <li>
                                <a href="index.php"
                                    class="block py-2 pl-3 pr-4 font-semibold text-secondary hover:text-primary transition-colors duration-300"
                                    aria-current="page">Trang chủ</a>
                            </li>
                            <li>
                                <a href="#gioithieu"
                                    class="block py-2 pl-3 pr-4 font-semibold text-secondary hover:text-primary transition-colors duration-300">Giới
                                    thiệu</a>
                            </li>
                            <li class="relative hidden lg:block">
                                <a href="javascript:void(0)"
                                    class="nav-link before:hidden py-2 pl-3 pr-4 text-secondary" data-toggler="active"
                                    data-d2c-dropdown="dropdown1">
                                    <span class="mr-2">Hướng dẫn</span>
                                </a>
                                <!-- Sub Menu -->
                                <ul class="mt-1 hidden absolute right-0 top-full py-3 px-4 border border-primary-1 rounded min-w-[180px] bg-white z-50"
                                    data-d2c-dropdownItem="down-element1">
                                    <li>
                                        <a class="text-global font-semibold hover:text-primary text-base flex items-center py-1 transition-colors duration-500 capitalize"
                                            href="#huongdan">Tham gia</a>
                                    </li>
                                    <li>
                                        <un class="text-global font-semibold hover:text-primary text-base flex items-center py-1 transition-colors duration-500 capitalize"
                                            href="./pages/registration.html">Sử dụng mã</a>
                                    </li>
                                    <li>
                                        <a class="text-global font-semibold hover:text-primary text-base flex items-center py-1 transition-colors duration-500 capitalize"
                                            href="./pages/forgot.html">Mua hàng</a>
                                    </li>
                                </ul>
                            </li>
                            <li>
                                <a href="#huongdan"
                                    class="block lg:hidden py-2 pl-3 pr-4 font-semibold text-secondary hover:text-primary transition-colors duration-300">Hướng
                                    dẫn lấy mã</a>
                            </li>
                            <li>
                                <un href="#d2c_services"
                                    class="block lg:hidden py-2 pl-3 pr-4 font-semibold text-secondary hover:text-primary transition-colors duration-300">
                                    Hướng
                                    dẫn dùng mã</a>
                            </li>
                            <li>
                                <a href="#d2c_services"
                                    class="block lg:hidden py-2 pl-3 pr-4 font-semibold text-secondary hover:text-primary transition-colors duration-300">Hướng
                                    dẫn mua hàng</a>
                            </li>
                            <li>
                                <a href="#loiich"
                                    class="block py-2 pl-3 pr-4 font-semibold text-secondary hover:text-primary transition-colors duration-300">Lợi
                                    ích</a>
                            </li>
                            <li>
                                <a href="#cauhoi"
                                    class="block py-2 pl-3 pr-4 font-semibold text-secondary hover:text-primary transition-colors duration-300">Câu
                                    hỏi</a>
                            </li>
                            <li class="ml-3 mt-2 lg:mt-0">
                                <a href="#dangky"
                                    class="block py-2 px-5 pr-4 text-white bg-primary rounded-std font-bold">Bắt đầu</a>
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
    <!-- Header -->

    <!-- Banner Section -->
    <section
        class="bg-[url('../../../public/assets/images/landing/hero_bg.png')] bg-no-repeat py-16 xl:py-20 bg-cover h-auto md:min-h-fit lg:h-screen flex items-center"
        id="home">
        <div class="container">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 items-center">
                <div class="text-center lg:text-left order-2 md:order-1">
                    <h1 class="text-3xl md:text-5xl text-primary font-semibold mb-8 leading-10 md:leading-[60px]">
                        GIỚI THIỆU BẠN BÈ - NHẬN NGAY <span class="font-extrabold">100.000 VND</span> VÀ <span
                            class="font-extrabold">15%</span> ƯU ĐÃI!
                    </h1>
                    <p class="mb-4">Cùng VPSTTT lan tỏa giá trị, nhận quà hấp dẫn từ mọi giới thiệu thành công!</p>

                    <div class="flex items-center justify-center lg:justify-start mt-10">
                        <a href="#dangky"
                            class="inline-flex py-2 px-6 text-white bg-primary rounded-std mr-2 font-bold">Nhận mã giới
                            thiệu của bạn!</a>
                        <!-- <button class="inline-flex items-center px-4 text-primary font-semibold rounded-std"><i
                                class="far fa-play-circle text-4xl mr-2"></i> <span
                                class="text-sm font-bold">Watch</span></button> -->
                    </div>
                </div>
                <div class="order-1 md:order-2">
                    <img class="w-full sm:w-3/4 lg:w-full mx-auto" src="./public/assets/images/landing/hero_img.png"
                        alt="Hero Image">
                </div>
            </div>
        </div>
    </section>
    <!-- Banner Section -->

    <!-- About -->
    <section
        class="bg-[url('../../../public/assets/images/landing/works.png')] bg-no-repeat bg-cover py-10 md:py-14 xl:py-24"
        id="gioithieu">
        <div class="container">
            <div class="grid grid-cols-1 lg:grid-cols-2 items-center gap-6">
                <div class="pr-0 xl:pr-5 mb-5 mb-lg:0">
                    <img class="max-w-full mx-auto" src="./public/assets/images/landing/about_img.png"
                        alt="About Image">
                </div>
                <div class="ml-5">
                    <h4 class="d2c_title mb-4">Tại sao bạn nên tham gia ?</h4>
                    <p class="mb-4 text-info-1">Tham gia chương trình giới thiệu của VPSTTT không chỉ mang lại cơ hội
                        nhận thưởng hấp dẫn mà còn giúp bạn kết nối với những người xung quanh. Với mỗi 5 lần giới thiệu
                        thành công, bạn sẽ nhận ngay 100.000 VND vào tài khoản mua hàng hoặc 50.000 VND tiền mặt hoặc sử
                        dụng VPS 1 tháng miễn phí, tạo ra nguồn thu nhập bổ
                        sung dễ dàng và thú vị.</p>
                    <p class="mb-4 text-info-1">Ngoài lợi ích cho người giới thiệu, người được giới thiệu cũng nhận được
                        ưu đãi giảm ngay 15% cho hợp đồng đầu tiên. Đừng bỏ lỡ cơ hội này để lan tỏa giá trị và nhận về
                        những phần quà hấp dẫn cùng VPSTTT!</p>
                    <ul class="mb-4">
                        <li class="text-secondary inline-flex items-start font-semibold mb-3 ">
                            <span class="text-primary text-lg mr-4"><i class="far fa-check-circle"></i></span>
                            Nhận 1 tháng sử dụng VPST miễn phí hoặc 100.000 VND vào tài khoản mua hàng cho 5 lần sử dụng
                            mã giới thiệu.
                        </li>
                        <li class="text-secondary inline-flex items-start font-semibold mb-3">
                            <span class="text-primary text-lg mr-4"><i class="far fa-check-circle"></i></span>
                            Người được giới thiệu giảm ngay 15% khi đăng ký.
                        </li>
                        <li class="text-secondary inline-flex items-start font-semibold mb-3">
                            <span class="text-primary text-lg mr-4"><i class="far fa-check-circle"></i></span>
                            Không giới hạn số lần giới thiệu.
                        </li>
                    </ul>
                    <a href="#dangky"
                        class="inline-flex py-2 px-8 text-white bg-primary font-bold rounded-std mr-2 capitalize">Thử
                        ngay</a>
                </div>
            </div>
        </div>
    </section>
    <!-- About -->
    <!-- Chỉ 3 bước đơn giản để nhận thưởng -->
    <section
        class="bg-[url('../../../public/assets/images/landing/exp.png')] bg-no-repeat bg-cover py-10 md:py-14 xl:py-24"
        id="huongdan">
        <div class="container">
            <h4 class="d2c_title text-center mb-10 text-3xl font-bold text-primary">Chỉ 3 bước đơn giản để nhận thưởng!
            </h4>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-4">

                <!-- Bước 1 -->
                <div class="card group hover:bg-primary transition-colors duration-300">
                    <div class="card-body p-6 text-center">
                        <div
                            class="px-4 py-2 bg-primary-1 group-hover:bg-white rounded-std-1/2 inline-flex mb-4 transition-colors duration-300">
                            <i class="fas fa-key text-primary text-2xl"></i>
                        </div>
                        <h5
                            class="text-lg text-secondary group-hover:text-white font-bold mb-4 transition-colors duration-300">
                            Bước 1: Điền thông tin và lấy mã giới thiệu
                        </h5>
                        <p class="group-hover:text-[#EAEAEA] transition-colors duration-300">
                            Điền thông tin của bạn và nhận mã giới thiệu độc quyền của bạn.
                        </p>
                    </div>
                </div>

                <!-- Bước 2 -->
                <div class="card group hover:bg-primary transition-colors duration-300">
                    <div class="card-body p-6 text-center">
                        <div
                            class="px-4 py-2 bg-primary-1 group-hover:bg-white rounded-std-1/2 inline-flex mb-4 transition-colors duration-300">
                            <i class="fas fa-bullhorn text-primary text-2xl"></i>
                        </div>
                        <h5
                            class="text-lg text-secondary group-hover:text-white font-bold mb-4 transition-colors duration-300">
                            Bước 2: Chia sẻ mã với bạn bè
                        </h5>
                        <p class="group-hover:text-[#EAEAEA] transition-colors duration-300">
                            Gửi mã giới thiệu của bạn cho bạn bè qua mạng xã hội, tin nhắn hoặc email.
                        </p>
                    </div>
                </div>

                <!-- Bước 3 -->
                <div class="card group hover:bg-primary transition-colors duration-300">
                    <div class="card-body p-6 text-center">
                        <div
                            class="px-4 py-2 bg-primary-1 group-hover:bg-white rounded-std-1/2 inline-flex mb-4 transition-colors duration-300">
                            <i class="fas fa-coins text-primary text-2xl"></i>
                        </div>
                        <h5
                            class="text-lg text-secondary group-hover:text-white font-bold mb-4 transition-colors duration-300">
                            Bước 3: Nhận thưởng khi họ sử dụng
                        </h5>
                        <p class="group-hover:text-[#EAEAEA] transition-colors duration-300">
                            Nhận thưởng ngay khi bạn bè sử dụng mã giới thiệu của mình.
                        </p>
                    </div>
                </div>
            </div>

            <div class="text-center mt-10">
                <a href="#dangky"
                    class="inline-flex py-3 px-8 text-white bg-primary font-bold rounded-std capitalize">Bắt đầu
                    ngay</a>
            </div>
        </div>
    </section>
    <!-- Chỉ 3 bước đơn giản để nhận thưởng -->
    <!-- Thoughtful Exploration -->
    <section
        class="bg-[url('../../../public/assets/images/landing/exp.png')] bg-no-repeat bg-cover py-10 md:py-14 xl:py-24"
        id="loiich">
        <div class="container">
            <h4 class="d2c_title text-center mb-10">Lợi ích nhận được khi đến với VPSTTT</h4>
            <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-2 gap-6 mb-4">

                <!-- Card -->
                <div class="card group hover:bg-primary transition-colors duration-300">
                    <div class="card-body p-6">
                        <div
                            class="px-4 py-2 bg-primary-1 group-hover:bg-white rounded-std-1/2 inline-flex mb-4 transition-colors duration-300">
                            <i class="fas fa-dollar-sign text-primary text-xl"></i>
                        </div>
                        <h5
                            class="text-lg text-secondary group-hover:text-white font-bold mb-4 transition-colors duration-300">
                            Tiền Thưởng Ngay Khi Giới Thiệu</h5>
                        <p class="group-hover:text-[#EAEAEA] transition-colors duration-300">Khi bạn giới thiệu thành
                            công 5 bạn bè, bạn sẽ nhận ngay 100.000 VND vào tài khoản mua hàng hoặc sử dụng VPS 1 tháng
                            miễn phí. Đây là cơ hội tuyệt vời
                            để kiếm thêm thu nhập mà không cần đầu tư nhiều thời gian hay công sức.</p>
                    </div>
                </div>
                <!-- Card -->
                <!-- Card -->
                <div class="card group hover:bg-primary transition-colors duration-300">
                    <div class="card-body p-6">
                        <div
                            class="px-4 py-2 bg-primary-1 group-hover:bg-white rounded-std-1/2 inline-flex mb-4 transition-colors duration-300">
                            <i class="fas fa-sync-alt text-primary text-xl"></i>
                        </div>
                        <h5
                            class="text-lg text-secondary group-hover:text-white font-bold mb-4  transition-colors duration-300">
                            Cơ Hội Nhận Thưởng Không Giới Hạn</h5>
                        <p class="group-hover:text-[#EAEAEA] transition-colors duration-300">Bạn có thể giới thiệu bao
                            nhiêu bạn bè tùy thích mà không bị giới hạn thời gian. Mỗi lần giới thiệu thành công đều
                            mang lại cho
                            bạn phần thưởng, giúp tối đa hóa lợi ích từ chương trình này. Hãy tận dụng cơ hội để gia
                            tăng thu nhập một cách tối đa!</p>
                    </div>
                </div>
                <!-- Card -->
                <!-- Card -->
                <div class="card group hover:bg-primary transition-colors duration-300">
                    <div class="card-body p-6">
                        <div
                            class="px-4 py-2 bg-primary-1 group-hover:bg-white rounded-std-1/2 inline-flex mb-4 transition-colors duration-300">
                            <i class="fas fa-tags text-primary text-xl"></i>
                        </div>
                        <h5
                            class="text-lg text-secondary group-hover:text-white font-bold mb-4  transition-colors duration-300">
                            Ưu Đãi Hấp Dẫn Dành Cho Người Được Giới Thiệu</h5>
                        <p class="group-hover:text-[#EAEAEA] transition-colors duration-300">Mỗi người được bạn giới
                            thiệu sẽ nhận được giảm giá 15% cho hợp đồng đầu tiên. Điều này không chỉ giúp bạn thu hút
                            nhiều người tham gia mà còn tạo ra giá trị thực cho họ ngay từ lần đầu tiên.</p>
                    </div>
                </div>
                <!-- Card -->
                <!-- Card -->
                <div class="card group hover:bg-primary transition-colors duration-300">
                    <div class="card-body p-6">
                        <div
                            class="px-4 py-2 bg-primary-1 group-hover:bg-white rounded-std-1/2 inline-flex mb-4 transition-colors duration-300">
                            <i class="fas fa-headset text-primary text-xl"></i>
                        </div>
                        <h5
                            class="text-lg text-secondary group-hover:text-white font-bold mb-4  transition-colors duration-300">
                            Dịch Vụ Khách Hàng Tận Tâm</h5>
                        <p class="group-hover:text-[#EAEAEA] transition-colors duration-300">Chúng tôi luôn sẵn sàng hỗ
                            trợ bạn 24/7. Đội ngũ chăm sóc khách hàng của VPSTTT luôn sẵn lòng giải đáp thắc mắc và hỗ
                            trợ bạn trong suốt quá trình tham gia, đảm bảo bạn có trải nghiệm tốt nhất.</p>
                    </div>
                </div>
                <!-- Card -->
            </div>
            <div class="text-center mt-20">
                <a href="#dangky"
                    class="inline-flex py-2 px-8 text-white bg-primary font-bold rounded-std mr-2 capitalize">Thử
                    ngay</a>
            </div>
        </div>
    </section>
    <!-- Thoughtful Exploration -->
    <!-- Câu hỏi thường gặp (FAQ) -->
    <section class="py-10 md:py-14 xl:py-24" id="cauhoi">
        <div class="container">
            <div class="text-center mb-10">
                <h4 class="d2c_title text-center mb-2">Câu hỏi thường gặp</h4>
                <p class="text-info-1">Dưới đây là những câu hỏi phổ biến mà khách hàng thường thắc mắc. Nếu bạn cần
                    thêm thông tin, vui lòng liên hệ với chúng tôi!</p>
            </div>

            <div class="overflow-hidden">
                <div class="flex flex-col gap-6 py-6 px-4" id="faq-list">

                    <!-- Câu hỏi 1 -->
                    <div class="border border-gray-300 rounded-lg p-6 bg-white shadow-md">
                        <button
                            class="flex justify-between items-center w-full text-left font-semibold text-lg text-primary faq-toggle">
                            <span>Tôi có thể nhận thưởng bằng cách nào?</span>
                            <i class="fas fa-chevron-down text-gray-500"></i>
                        </button>
                        <div class="faq-content hidden mt-4 text-secondary">
                            Bạn chỉ cần đăng nhập, lấy mã giới thiệu và chia sẻ với bạn bè. Khi họ sử dụng mã giới
                            thiệu, chúng tôi sẽ liên hệ và bạn sẽ nhận
                            thưởng ngay nhé!
                        </div>
                    </div>

                    <!-- Câu hỏi 2 -->
                    <div class="border border-gray-300 rounded-lg p-6 bg-white shadow-md">
                        <button
                            class="flex justify-between items-center w-full text-left font-semibold text-lg text-primary faq-toggle">
                            <span>Làm thế nào để chia sẻ mã giới thiệu?</span>
                            <i class="fas fa-chevron-down text-gray-500"></i>
                        </button>
                        <div class="faq-content hidden mt-4 text-secondary">
                            Bạn có thể chia sẻ mã giới thiệu qua Facebook, Zalo, email hoặc tin nhắn trực tiếp.
                        </div>
                    </div>

                    <!-- Câu hỏi 3 -->
                    <div class="border border-gray-300 rounded-lg p-6 bg-white shadow-md">
                        <button
                            class="flex justify-between items-center w-full text-left font-semibold text-lg text-primary faq-toggle">
                            <span>Phần thưởng là gì?</span>
                            <i class="fas fa-chevron-down text-gray-500"></i>
                        </button>
                        <div class="faq-content hidden mt-4 text-secondary">
                            Bạn có thể nhận tiền thưởng 100.000 VND vào tài khoản mua hàng tại VPSTTT hoặc 50.000 VND
                            vào tài khoản ngân hàng của bạn, hoặc quà tặng 1 tháng sử dụng VPS miễn phí nhé. Phần quà
                            cực kỳ hấp dẫn, hãy nhận liền tay !!!
                        </div>
                    </div>

                    <!-- Câu hỏi 4 -->
                    <div class="border border-gray-300 rounded-lg p-6 bg-white shadow-md">
                        <button
                            class="flex justify-between items-center w-full text-left font-semibold text-lg text-primary faq-toggle">
                            <span>Tôi có thể giới thiệu bao nhiêu người?</span>
                            <i class="fas fa-chevron-down text-gray-500"></i>
                        </button>
                        <div class="faq-content hidden mt-4 text-secondary">
                            Không giới hạn! Với mỗi mã giới thiệu sẽ sử dụng được 5 lần cho mỗi thành viên mới. Bạn có
                            thể giới thiệu càng nhiều người càng tốt và nhận thưởng tương ứng.
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>
    <!-- Câu hỏi thường gặp (FAQ) -->

    <!-- Script Toggle FAQ -->
    <script>
        document.querySelectorAll(".faq-toggle").forEach(button => {
            button.addEventListener("click", () => {
                const content = button.nextElementSibling;
                content.classList.toggle("hidden");
                button.querySelector("i").classList.toggle("rotate-180");
            });
        });
    </script>

    <!-- Testimonial -->
    <!-- <section class="py-10 md:py-14 xl:py-24" id="d2c_testimonial">
        <div class="container">
            <div class="text-center mb-10">
                <h4 class="d2c_title text-center mb-2">What do people say</h4>
                <p class="text-info-1">Service features tended no do thoughts me on dissuade scarcely own are pretty
                    spring <br> suffer old denote his proposal speedily amr striking am now.</p>
            </div>

            <div class="overflow-hidden">
                <div class="flex items-center gap-6 py-6 px-4" id="slider">
                    <div
                        class="card border-0 bg-[url('../../../public/assets/images/landing/testimonial_bg.png')] bg-no-repeat bg-cover bg-left-top min-h-[16rem] flex items-center justify-center">
                        <div class="card-body p-8 text-center">
                            <img class="h-16 w-16 object-cover mx-auto mb-4"
                                src="./public/assets/images/landing/reviwer_img1.png" alt="reviewer Image">
                            <p class="mb-4">The journey of insight is like embarking on an adventure through uncharted
                                territory. There "Navigating the Path of Insight" checklist is your guide.</p>
                            <div class="text-primary mb-2">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                            </div>
                            <p>Brooklyn Simmons</p>
                        </div>
                    </div>

                    <div
                        class="card border-0 bg-[url('../../../public/assets/images/landing/testimonial_bg.png')] bg-no-repeat bg-cover bg-left-top min-h-[16rem] flex items-center justify-center">
                        <div class="card-body p-8 text-center">
                            <img class="h-16 w-16 object-cover mx-auto mb-4"
                                src="./public/assets/images/landing/reviwer_img2.png" alt="reviewer Image">
                            <p class="mb-4">I have kept the menu bar clean and straightforward. Each menu item
                                represents key area of functionality within the dashboard. You can further customize the
                                wording,</p>
                            <div class="text-primary mb-2">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                            </div>
                            <p>Savannah Nguyen</p>
                        </div>
                    </div>
                    <div
                        class="card border-0 bg-[url('../../../public/assets/images/landing/testimonial_bg.png')] bg-no-repeat bg-cover bg-left-top min-h-[16rem] flex items-center slide">
                        <div class="card-body p-8 text-center">
                            <img class="h-16 w-16 object-cover mx-auto mb-4"
                                src="./public/assets/images/landing/reviwer_img1.png" alt="reviewer Image">
                            <p class="mb-4">The journey of insight is like embarking on an adventure through uncharted
                                territory. There "Navigating the Path of Insight" checklist is your guide.</p>
                            <div class="text-primary mb-2">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                            </div>
                            <p>Brooklyn Simmons</p>
                        </div>
                    </div>

                    <div
                        class="card border-0 bg-[url('../../../public/assets/images/landing/testimonial_bg.png')] bg-no-repeat bg-cover bg-left-top min-h-[16rem] flex items-center slide">
                        <div class="card-body p-8 text-center">
                            <img class="h-16 w-16 object-cover mx-auto mb-4"
                                src="./public/assets/images/landing/reviwer_img2.png" alt="reviewer Image">
                            <p class="mb-4">I have kept the menu bar clean and straightforward. Each menu item
                                represents key area of functionality within the dashboard. You can further customize the
                                wording,</p>
                            <div class="text-primary mb-2">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                            </div>
                            <p>Savannah Nguyen</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section> -->
    <!-- Testimonial -->

    <!-- Contact -->
    <section
        class="bg-[url('../../../public/assets/images/landing/contact.png')] bg-no-repeat bg-cover py-10 md:py-14 xl:py-24"
        id="dangky">
        <div class="container">
            <div class="text-center mb-10">
                <h4 class="d2c_title text-center mb-2">Đăng ký tham gia tại đây!</h4>
                <p class="text-info-1">Đăng ký tham gia chương trình giới thiệu khách hàng mới của VPSTTT cực kỳ dễ dàng
                    và nhanh chóng <br>
                    Chỉ với một nút nhấn đã đăng ký thành công.</p>
            </div>
            <div class="text-center w-full md:w-3/4 mx-auto">
                <div class="col-start-2 col-end-12 col-span-4">
                    <form action="camon" method="POST" id="registerForm" class="w-full">
                        <div class="grid grid-cols-1 gap-6">
                            <div class="mb-4 text-left">
                                <label for="hoten">Họ và tên</label>
                                <input type="text" id="hoten" class="form-control" name="hoten"
                                    placeholder="Trần Quang Hào" required>
                                <p id="hoten-error" class="text-red-500 text-sm mt-1 hidden"></p>
                            </div>
                        </div>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="mb-4 text-left">
                                <label for="email">Địa chỉ Email</label>
                                <input type="email" id="email" class="form-control" name="email"
                                    placeholder="tranhao@gmail.com" required>
                                <p id="email-error" class="text-red-500 text-sm mt-1 hidden"></p>
                            </div>
                            <div class="mb-4 text-left relative">
                                <label for="sdt">Số điện thoại</label>
                                <input type="tel" id="sdt" class="form-control" name="sdt" placeholder="0328812674"
                                    required>
                                <p id="sdt-error" class="text-red-500 text-sm mt-1 hidden"></p>
                            </div>
                        </div>
                        <div class="g-recaptcha mb-4" data-sitekey="6Le4IbwqAAAAANh5lyRt9ZBbnpBT8dfBG6ma5cGq"
                            data-callback="onRecaptchaSuccess"></div>
                        <!-- Nút Submit -->
                        <button type="submit" id="submit-btn" name="submit"
                            class="block py-3 px-4 text-white bg-gray-400 font-bold rounded-std w-full cursor-not-allowed"
                            disabled>
                            Đăng ký
                        </button>
                    </form>
                </div>
            </div>
            <script src="https://www.google.com/recaptcha/api.js" async defer></script>
        </div>
    </section>


    <!-- Thêm script reCAPTCHA -->
    <!-- <script src="https://www.google.com/recaptcha/api.js" async defer></script> -->
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const hoten = document.getElementById("hoten");
            const email = document.getElementById("email");
            const sdt = document.getElementById("sdt");
            const submitBtn = document.getElementById("submit-btn");
            let isRecaptchaValid = false; // Biến để kiểm tra trạng thái reCAPTCHA

            function validateForm() {
                let isValid = true;

                // Kiểm tra họ tên
                const nameRegex = /^[a-zA-ZÀ-ỹ\s]+$/;
                if (!hoten.value.trim()) {
                    document.getElementById("hoten-error").textContent = "Họ và tên không được để trống.";
                    document.getElementById("hoten-error").classList.remove("hidden");
                    isValid = false;
                } else if (!nameRegex.test(hoten.value.trim())) {
                    document.getElementById("hoten-error").textContent = "Họ và tên không hợp lệ.";
                    document.getElementById("hoten-error").classList.remove("hidden");
                    isValid = false;
                } else {
                    document.getElementById("hoten-error").classList.add("hidden");
                }

                // Kiểm tra email
                const emailRegex = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/;
                if (!email.value.trim()) {
                    document.getElementById("email-error").textContent = "Email không được để trống.";
                    document.getElementById("email-error").classList.remove("hidden");
                    isValid = false;
                } else if (!emailRegex.test(email.value.trim())) {
                    document.getElementById("email-error").textContent = "Email không hợp lệ.";
                    document.getElementById("email-error").classList.remove("hidden");
                    isValid = false;
                } else {
                    document.getElementById("email-error").classList.add("hidden");
                }

                // Kiểm tra số điện thoại
                const phoneRegex = /^0\d{9}$/;
                if (!sdt.value.trim()) {
                    document.getElementById("sdt-error").textContent = "Số điện thoại không được để trống.";
                    document.getElementById("sdt-error").classList.remove("hidden");
                    isValid = false;
                } else if (!phoneRegex.test(sdt.value.trim())) {
                    document.getElementById("sdt-error").textContent = "Số điện thoại phải có 10 số và bắt đầu bằng 0.";
                    document.getElementById("sdt-error").classList.remove("hidden");
                    isValid = false;
                } else {
                    document.getElementById("sdt-error").classList.add("hidden");
                }

                // Bật hoặc tắt nút Submit
                submitBtn.disabled = !isValid || !isRecaptchaValid; // Kiểm tra cả reCAPTCHA
                submitBtn.classList.toggle("bg-primary", isValid && isRecaptchaValid);
                submitBtn.classList.toggle("bg-gray-400", !isValid || !isRecaptchaValid);
                submitBtn.classList.toggle("cursor-not-allowed", !isValid || !isRecaptchaValid);
            }

            // Hàm được gọi khi reCAPTCHA thành công
            function onRecaptchaSuccess() {
                isRecaptchaValid = true; // Đánh dấu reCAPTCHA là hợp lệ
                validateForm(); // Kiểm tra lại trạng thái nút đăng ký
            }

            hoten.addEventListener("input", validateForm);
            email.addEventListener("input", validateForm);
            sdt.addEventListener("input", validateForm);

            // Gán sự kiện cho reCAPTCHA
            window.onRecaptchaSuccess = onRecaptchaSuccess; // Gán hàm gọi lại cho reCAPTCHA
        });
    </script>
    <!-- Contact -->
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

    <!-- Button mở danh sách -->
    <!-- Button mở danh sách -->
    <div id="toggle-btn"
        class="fixed bottom-6 right-6 w-14 h-14 bg-blue-500 text-white flex items-center justify-center rounded-full shadow-lg cursor-pointer z-50">
        <i class="fas fa-user text-2xl"></i>
    </div>

    <!-- Danh sách đăng ký -->
    <div id="success-list"
        class="fixed bottom-20 right-6 bg-white shadow-xl rounded-lg p-4 space-y-3 w-64 transition-all duration-300 z-40">
        <h4 class="text-lg font-semibold text-primary">🎉 Đăng ký thành công</h4>
        <div id="user-list" class="space-y-2"></div>
    </div>

    <script>
        const users = [
            { name: "Nguyễn Văn A", time: "5 phút trước" },
            { name: "Trần Thị B", time: "10 phút trước" },
            { name: "Lê Văn C", time: "15 phút trước" },
        ];

        const successList = document.getElementById("success-list");
        const toggleBtn = document.getElementById("toggle-btn");
        const userList = document.getElementById("user-list");

        function showUsers() {
            userList.innerHTML = ""; // Xóa danh sách cũ
            users.forEach((user, index) => {
                setTimeout(() => {
                    const userItem = document.createElement("div");
                    userItem.className = "flex items-center space-x-3 p-2 bg-gray-100 rounded-lg opacity-0 transition-opacity duration-500";
                    userItem.innerHTML = `
                    <div class="w-8 h-8 flex items-center justify-center bg-blue-500 text-white rounded-full">
                        <i class="fas fa-user"></i>
                    </div>
                    <div>
                        <p class="text-sm font-medium">${user.name}</p>
                        <p class="text-xs text-gray-500">${user.time}</p>
                    </div>
                `;
                    userList.appendChild(userItem);
                    setTimeout(() => {
                        userItem.classList.remove("opacity-0");
                    }, 100);
                }, index * 1500); // Delay từng người 1,5 giây
            });

            // Sau 10s tự động thu nhỏ danh sách
            setTimeout(() => {
                successList.classList.add("hidden");
            }, 6000);
        }

        // Khi nhấn vào icon thì toggle danh sách
        toggleBtn.addEventListener("click", () => {
            successList.classList.toggle("hidden");
        });

        // Ban đầu hiển thị danh sách
        showUsers();
    </script>
    <!-- footer -->
    <footer class="bg-primary">
        <div class="container">
            <div class="text-center py-24 border-b border-[rgba(228,219,237,0.06)]">
                <h2 class="text-4xl text-white font-bold mb-5">Bạn đã sẵn sàng nắm bắt cơ hội này chưa?</h2>
                <p class="mb-4 text-white">Đừng để cơ hội trôi qua! Hãy kết nối ngay hôm nay qua Messenger, Zalo, hoặc
                    gọi điện để khám phá những giải pháp mà chúng tôi cung cấp.<br>
                    Mỗi kết nối là một bước tiến gần hơn đến mục tiêu của bạn. Nắm bắt cơ hội này và cùng chúng tôi phát
                    triển! <br>
                    <a href="#dangky"
                        class="inline-flex py-2 px-8 text-primary font-bold bg-white rounded-std mr-2 mt-3">Bắt đầu
                        ngay</a>
                </p>
            </div>

            <div
                class="flex flex-col md:flex-row items-center justify-between py-4 border-b border-[rgba(228,219,237,0.06)]">
                <div class="mb-4 md:mb-0">
                    <a href="https://vpsttt.com/"><img class="w-36" src="./public/assets/images/logo/logowhite.svg"
                            alt="Logo Image"></a>
                </div>

                <div class="text-white text-center md:text-left">
                    <p class="font-semibold text-lg">Thông tin liên hệ</p>
                    <p>Email: <a href="mailto:lienhe@vpsttt.com"
                            class="text-white hover:underline">lienhe@vpsttt.com</a></p>
                    <p>Hotline: <a href="tel:+84328812674" class="text-white hover:underline">+84 328 812 674</a></p>
                    <p>Địa chỉ: Số 15 Đường B3, Phường Vĩnh Hòa, Thành phố Nha Trang, Tỉnh Khánh Hòa</p>
                </div>

                <div class="mb-4 md:mb-0">
                    <a target="_blank" href="https://designtocodes.com/privacy-policy/"
                        class="text-white text-base font-semibold">Privacy Policy</a>
                    <span class="text-white text-base font-semibold">|</span>
                    <a target="_blank" href="https://designtocodes.com/terms/"
                        class="text-white text-base font-semibold">Terms of Service</a>
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
                <p class="text-primary-1">All rights reserved by <a href="https://devttt.com/"
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