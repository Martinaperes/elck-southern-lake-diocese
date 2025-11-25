<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>ELCK Southern-Lake Church</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-gradient-to-r from-green-100 to-blue-100 min-h-screen flex items-center justify-center font-sans">

    <div class="container mx-auto px-4">
        <div class="flex flex-col md:flex-row bg-white shadow-2xl rounded-2xl overflow-hidden">

            <!-- Hero / Image Section -->
            <div class="md:w-1/2 bg-cover bg-center" style="background-image: url('/images/elck_logo.jpg');">
                <div class="bg-black bg-opacity-40 h-full flex items-center justify-center">
                    <h1 class="text-white text-3xl md:text-4xl font-bold text-center px-4">Welcome to ELCK Southern-Lake Church</h1>
                </div>
            </div>

            <!-- Form Section -->
            <div class="md:w-1/2 p-8 md:p-12 flex flex-col justify-center">
                <div class="text-center mb-6">
                    <i class="fas fa-church text-5xl text-green-600 mb-2"></i>
                    <h2 class="text-2xl font-bold text-gray-700">Faith. Community. Service.</h2>
                    <p class="text-gray-500 mt-2">Connect with us and be part of our family</p>
                </div>

                <div class="bg-gray-50 p-6 rounded-xl shadow-lg">
                    <!-- Slot for login/register forms -->
                    {{ $slot }}
                </div>

                <div class="text-center text-gray-400 mt-4 text-sm">
                    &copy; {{ date('Y') }} ELCK Southern-Lake Church. All rights reserved.
                </div>
            </div>
        </div>
    </div>

</body>
</html>
