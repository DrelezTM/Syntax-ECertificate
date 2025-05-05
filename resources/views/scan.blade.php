<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Syntax Certificates - Check Certificate via Scan</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap" rel="stylesheet">
    <link rel="icon" href="/syntax.png" type="image/png">
    <meta name="keywords" content="Syntax Community, Syntax ID, Syntax, SMK Telekomunikasi Telesandi, SMK Telkom, Pemrograman, Syntax Telesandi, Syntax Creative, Syntax Tels, Syntx ID, Syntax Certificate">
    <meta name="description" content="Syntax E-Certificate - Check Certificate via Scan.">
    @vite('resources/css/app.css')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body class="bg-[#F0F3FF]" style="font-family: 'Inter';">
    @if(session('error'))
    <script>
        Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: "{{ session('error') }}"
        });
    </script>
    @endif

    @if(session('success'))
    <script>
        Swal.fire({
            icon: 'success',
            title: 'Berhasil!',
            text: "{{ session('success') }}"
        });
    </script>
    @endif

    <nav class="bg-white shadow-md fixed z-50 w-full" id="navbar">
        <div class="max-w-6xl mx-auto px-12">
            <div class="flex justify-between">
                <div class="flex space-x-4">
                    <div class="flex items-center py-4">
                        <img id="image" class="w-[160px]" src="/syntax-community.png" alt="">
                    </div>
                </div>
                <div class="hidden md:flex items-center space-x-3">
                    <a href={{ route('index') }} class="py-4 px-3 transition duration-300 hover:text-gray-400">HOME</a>
                    <a href={{ route('checkid') }} class="py-4 px-3 transition duration-300 hover:text-gray-400">SEARCH CERTIFICATE</a>
                    <a href={{ route('scan') }} class="py-4 px-3 transition duration-300 hover:text-gray-400">SCAN CERTIFICATE</a>
                </div>
                <div class="md:hidden flex items-center">
                    <button class="mobile-menu-button outline-none">
                        <svg class="w-6 h-6" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
                            <path d="M4 6h16M4 12h16M4 18h16"></path>
                        </svg>
                    </button>
                </div>
            </div>
        </div>
        <div class="mobile-menu hidden md:hidden px-10 pb-10 pt-4">
            <a href={{ route('index') }} class="block py-2 px-4 hover:text-gray-400 transition duration-300">HOME</a>
            <a href={{ route('checkid') }} class="block py-2 px-4 hover:text-gray-400 transition duration-300">SEARCH CERTIFICATE</a>
            <a href={{ route('scan') }} class="block py-2 px-4 hover:text-gray-400 transition duration-300">SCAN CERTIFICATE</a>
        </div>
    </nav>

    <section class="pt-36 pb-10 md:px-16 px-10 h-screen flex justify-center items-center">
        <div class="bg-white flex flex-col p-6 gap-5 w-full max-w-6xl rounded-lg shadow-md"> 
            <h3 class="text-xl font-bold text-center">Search Certificate by ID</h3>
            <div class="flex flex-col gap-3">
                <div class="flex flex-col gap-3">
                    <p class="text-center">Point the QR Code at the Camera:</p>
                    <video class="bg-black w-[300px] mx-auto" id="reader"></video>
                    <select class="w-full bg-gray-200 px-4 py-3 rounded-lg outline-none" id="cam-list"></select>
                </div>
                <div class="flex w-full justify-center items-center">
                    <hr class="flex flex-1">
                    <p class="px-4 text-sm text-[#757575]">or</p>
                    <hr class="flex flex-1">
                </div>
                <p class="text-center text-[#757575]">You can also directly check the certificate using the <a class="text-[#3a56e7] hover:text-[#2c42ad]" href={{ route('checkid') }}>Certificate ID</a>.</p>
            </div>
        </div>
    </section>
    <footer class="bg-white text-[#35448e] px-6 md:px-0">
        <div class="max-w-6xl mx-auto px-4 py-8">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                <div class="md:col-span-1">
                    <h3 class="text-xl font-bold mb-4">SYNTAX</h3>
                    <p class="text-gray-800 mb-4">Empowering professionals through quality certification programs.</p>
                    <div class="flex space-x-4">
                        <a href="#" class="text-[#ff2e43] hover:text-[#b4515b] transition duration-300">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                        <a href="#" class="text-[#ff2e43] hover:text-[#b4515b] transition duration-300">
                            <i class="fab fa-twitter"></i>
                        </a>
                        <a href="#" class="text-[#ff2e43] hover:text-[#b4515b] transition duration-300">
                            <i class="fab fa-linkedin-in"></i>
                        </a>
                        <a href="#" class="text-[#ff2e43] hover:text-[#b4515b] transition duration-300">
                            <i class="fab fa-instagram"></i>
                        </a>
                    </div>
                </div>
                <div>
                    <h3 class="text-lg font-semibold mb-4">Quick Links</h3>
                    <ul class="space-y-2">
                        <li><a href={{ route('index') }} class="text-gray-800 hover:text-gray-600 transition duration-300">Home</a></li>
                        <li><a href={{ route('checkid') }} class="text-gray-800 hover:text-gray-600 transition duration-300">Search Certificate</a></li>
                        <li><a href={{ route('scan') }} class="text-gray-800 hover:text-gray-600 transition duration-300">Scan QR Code</a></li>
                        <li><a href="{{ route('index') }}#about" class="text-gray-800 hover:text-gray-600 transition duration-300">About</a></li>
                    </ul>
                </div>
                <div>
                    <h3 class="text-lg font-semibold mb-4">Our Programs</h3>
                    <ul class="space-y-2">
                        <li><a href="#" class="text-gray-800 hover:text-gray-600 transition duration-300">Web Development</a></li>
                        <li><a href="#" class="text-gray-800 hover:text-gray-600 transition duration-300">Programming Desktop</a></li>
                        <li><a href="#" class="text-gray-800 hover:text-gray-600 transition duration-300">Mobile Development</a></li>
                        <li><a href="#" class="text-gray-800 hover:text-gray-600 transition duration-300">Scratch Game</a></li>
                    </ul>
                </div>
                <!-- Contact -->
                <div>
                    <h3 class="text-lg font-semibold mb-4">Contact Us</h3>
                    <ul class="space-y-2">
                        <li class="flex items-start">
                            <i class="fas fa-map-marker-alt mr-2 mt-1 text-[#ff2e43] hover:text-[#b4515b]"></i>
                            <span class="text-gray-800 hover:text-gray-600">SMK Telekomunikasi Telesandi Bekasi - Syntax</span>
                        </li>
                        <li class="flex items-start">
                            <i class="fas fa-envelope mr-2 mt-1 text-[#ff2e43] hover:text-[#b4515b]"></i>
                            <span class="text-gray-800 hover:text-gray-600">telssyntaxcommunity@gmail.com</span>
                        </li>
                        <li class="flex items-start">
                            <i class="fas fa-phone mr-2 mt-1 text-[#ff2e43] hover:text-[#b4515b]"></i>
                            <span class="text-gray-800 hover:text-gray-600">+62 813 2525 0554</span>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="border-t border-[#35448e] mt-8 pt-6 text-center md:flex md:justify-between md:text-left">
                <p class="text-gray-800 hover:text-gray-600">&copy; 2025 Syntax Community. All rights reserved.</p>
                <div class="mt-4 md:mt-0">
                    <a href="https://github.com/DrelezTM" target="_blank" class="text-gray-800 hover:text-gray-600 transition duration-300 mr-4"><i class="fa-solid fa-code-fork mr-1"></i> DrelezTM</a>
                </div>
            </div>
        </div>
    </footer>
    <script src="/js/qr-scanner/qr-scanner.umd.min.js"></script>

    <script>
        const reader = document.getElementById('reader');
        const camList = document.getElementById('cam-list');

        const scanner = new QrScanner(
            reader,
            result => {
                const cert_id = result.data.replace('https://e-certificate.syntx.id/', '');
                const url = '{{ request()->url() }}'.replace('/scan', '').replace('/scan/', '');
                window.location.href = `${url}/${cert_id}`
            },
            {
                highlightScanRegion: true,
                highlightCodeOutline: true,
            }
        );

        scanner.start().then(() => {
            QrScanner.listCameras(true).then(cameras => cameras.forEach(camera => {
                const option = document.createElement('option');
                option.value = camera.id;
                option.text = camera.label;
                camList.add(option);
            }));
        });

        camList.addEventListener('change', event => {
            scanner.setCamera(event.target.value);
        });
        
        document.querySelector('.mobile-menu-button').addEventListener('click', function() {
            document.querySelector('.mobile-menu').classList.toggle('hidden');
        });
    </script>
</body>
</html>