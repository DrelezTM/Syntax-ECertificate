<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Syntax Certificates - Result Certificates</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap" rel="stylesheet">
    <link rel="icon" href="/syntax.png" type="image/png">
    <meta name="keywords" content="Syntax Community, Syntax ID, Syntax, SMK Telekomunikasi Telesandi, SMK Telkom, Pemrograman, Syntax Telesandi, Syntax Creative, Syntax Tels, Syntx ID, Syntax Certificate">
    <meta name="description" content="Syntax E-Certificate - Result Certificates.">
    @vite('resources/css/app.css')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        .certificate-card {
            transition: all 0.3s ease;
        }
        .certificate-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 15px rgba(58, 86, 231, 0.1);
        }
    </style>
</head>
<body class="bg-[#F0F3FF] font-sans" style="font-family: 'Inter';">
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

    <!-- Main Content -->
    <section class="pt-28 pb-10 md:px-16 px-6 gap-6 flex flex-col max-w-7xl mx-auto">
        <h1 class="text-2xl md:text-3xl font-bold text-gray-800 text-center mb-4">Certificate Verification</h1>
        
        <div class="grid md:gap-8 gap-8 md:grid-cols-2">
            <!-- Certificate Status Card -->
            <div class="grid grid-rows-[auto_auto] gap-4">
                <div class="bg-white shadow-md rounded-xl flex flex-1 flex-col p-10 gap-6 items-center justify-center certificate-card border border-gray-100">
                    <div class="bg-green-50 p-4 rounded-full">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" width="64" height="64" fill="#24a854">
                            <path d="M256 48a208 208 0 1 1 0 416 208 208 0 1 1 0-416zm0 464A256 256 0 1 0 256 0a256 256 0 1 0 0 512zM369 209c9.4-9.4 9.4-24.6 0-33.9s-24.6-9.4-33.9 0l-111 111-47-47c-9.4-9.4-24.6-9.4-33.9 0s-9.4 24.6 0 33.9l64 64c9.4 9.4 24.6 9.4 33.9 0L369 209z" />
                        </svg>
                    </div>
                    <h3 class="font-bold text-2xl text-gray-800">Certificate Found!</h3>
                    <p class="text-gray-500 text-center">This document has been verified and is authentic</p>
                </div>
                <a class="bg-[#35448e] text-white font-bold py-3 cursor-pointer px-6 rounded-lg shadow-lg border-2 border-[#35448e] hover:bg-[#435197] transition duration-300 rounded-xl text-white p-4 flex items-center justify-center gap-2 font-medium" href="/storage/certificates/{{ $certificate->filename }}">
                    <svg width="20" height="20" fill="#fff" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512">
                        <path d="M0 64C0 28.7 28.7 0 64 0L224 0l0 128c0 17.7 14.3 32 32 32l128 0 0 128-168 0c-13.3 0-24 10.7-24 24s10.7 24 24 24l168 0 0 112c0 35.3-28.7 64-64 64L64 512c-35.3 0-64-28.7-64-64L0 64zM384 336l0-48 110.1 0-39-39c-9.4-9.4-9.4-24.6 0-33.9s24.6-9.4 33.9 0l80 80c9.4 9.4 9.4 24.6 0 33.9l-80 80c-9.4 9.4-24.6 9.4-33.9 0s-9.4-24.6 0-33.9l39-39L384 336zm0-208l-128 0L256 0 384 128z"/>
                    </svg>
                    Download Certificate
                </a>
            </div>

            <!-- Certificate Details Card -->
            <div class="bg-white shadow-md rounded-xl flex flex-1 flex-col p-6 md:p-8 gap-4 certificate-card border border-gray-100">
                <h3 class="font-bold text-xl text-[#35448e] border-b pb-3 mb-2">Certificate Details</h3>
                <div class="divide-y">
                    <div class="py-3 grid grid-cols-[130px_1fr] gap-2">
                        <span class="text-sm text-gray-500 font-medium">Certificate ID</span>
                        <span class="text-sm text-gray-700 font-medium">{{ $certificate->certificate_id }}</span>
                    </div>
                    <div class="py-3 grid grid-cols-[130px_1fr] gap-2">
                        <span class="text-sm text-gray-500 font-medium">Student</span>
                        <span class="text-sm text-gray-700 font-medium">{{ $certificate->student->name }} ({{ $certificate->student_nis }})</span>
                    </div>
                    <div class="py-3 grid grid-cols-[130px_1fr] gap-2">
                        <span class="text-sm text-gray-500 font-medium">Title</span>
                        <span class="text-sm text-gray-700 font-medium">{{ $certificate->title }}</span>
                    </div>
                    <div class="py-3 grid grid-cols-[130px_1fr] gap-2">
                        <span class="text-sm text-gray-500 font-medium">Description</span>
                        <span class="text-sm text-gray-700 font-medium">{{ $certificate->description }}</span>
                    </div>
                    <div class="py-3 grid grid-cols-[130px_1fr] gap-2">
                        <span class="text-sm text-gray-500 font-medium">Organizer</span>
                        <span class="text-sm text-gray-700 font-medium">{{ $certificate->organizer }}</span>
                    </div>
                    <div class="py-3 grid grid-cols-[130px_1fr] gap-2">
                        <span class="text-sm text-gray-500 font-medium">Issue Date</span>
                        <span class="text-sm text-gray-700 font-medium">{{ $certificate->date }}</span>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- QR Navigation -->
        <div class="mt-8 bg-white shadow-md rounded-xl p-6 border border-gray-100">
            <h3 class="font-bold text-xl text-gray-800 mb-4">Verify Another Certificate</h3>
            <div class="grid md:grid-cols-2 gap-6">
                <a href={{ route('checkid') }} class="p-4 border border-gray-200 rounded-lg flex items-center gap-3 hover:border-[#3a56e7] transition-all group">
                    <div class="bg-blue-50 p-3 rounded-lg">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#3a56e7" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-search"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>
                    </div>
                    <div>
                        <h4 class="font-medium text-gray-800 group-hover:text-[#3a56e7] transition-all">Check by ID</h4>
                        <p class="text-sm text-gray-500">Enter the certificate ID manually</p>
                    </div>
                </a>
                <a href={{ route('scan') }} class="p-4 border border-gray-200 rounded-lg flex items-center gap-3 hover:border-[#3a56e7] transition-all group">
                    <div class="bg-blue-50 p-3 rounded-lg">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#3a56e7" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-camera"><path d="M23 19a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h4l2-3h6l2 3h4a2 2 0 0 1 2 2z"></path><circle cx="12" cy="13" r="4"></circle></svg>
                    </div>
                    <div>
                        <h4 class="font-medium text-gray-800 group-hover:text-[#3a56e7] transition-all">Scan QR Code</h4>
                        <p class="text-sm text-gray-500">Use your camera to scan certificate QR</p>
                    </div>
                </a>
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
    <script>
        document.querySelector('.mobile-menu-button').addEventListener('click', function() {
            document.querySelector('.mobile-menu').classList.toggle('hidden');
        });

        Swal.fire({
            icon: 'success',
            title: 'Certificate Found!',
            text: "This document has been verified and is authentic"
        });
    </script>
</body>
