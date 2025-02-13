<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Test Floating Button</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
</head>
<body class="bg-gray-100 h-screen">

    <!-- Floating Contact Buttons -->
    <div class="fixed bottom-6 left-6 flex flex-col space-y-3 z-[9999]">
        <a href="https://m.me/yourpage" target="_blank"
            class="w-14 h-14 flex items-center justify-center bg-blue-600 rounded-full shadow-lg hover:scale-110 transition-transform">
            <i class="fab fa-facebook-messenger text-white text-2xl"></i>
        </a>

        <a href="https://zalo.me/yourid" target="_blank"
            class="w-14 h-14 flex items-center justify-center bg-blue-400 rounded-full shadow-lg hover:scale-110 transition-transform">
            <i class="fas fa-comment text-white text-2xl"></i>
        </a>

        <a href="tel:+84123456789"
            class="w-14 h-14 flex items-center justify-center bg-gray-600 rounded-full shadow-lg hover:scale-110 transition-transform">
            <i class="fas fa-phone-alt text-white text-2xl"></i>
        </a>
    </div>

</body>
</html>