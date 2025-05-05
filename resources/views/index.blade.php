<!DOCTYPE html>
<html lang="en" style="scroll-behavior: smooth;">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Syntax Certificates - Home</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap" rel="stylesheet">
    <link rel="icon" href="/syntax.png" type="image/png">
    <meta name="keywords" content="Syntax Community, Syntax ID, Syntax, SMK Telekomunikasi Telesandi, SMK Telkom, Pemrograman, Syntax Telesandi, Syntax Creative, Syntax Tels, Syntx ID, Syntax Certificate">
    <meta name="description" content="Syntax E-Certificate Verification System is a secure platform designed to validate the authenticity of certificates issued by Syntax.">
    @vite('resources/css/app.css')
    <style>
        .hero-pattern {
            background-image: url("/hero.jpg");
            background-size: cover;
            background-position: center;
        }
    </style>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body class="flex flex-col min-h-screen bg-white text-white transition-all duration-300" style="font-family: 'Inter';">
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

    <nav class="syntax-blue shadow-md fixed z-50 w-full" id="navbar">
        <div class="max-w-6xl mx-auto px-12">
            <div class="flex justify-between">
                <div class="flex space-x-4">
                    <div class="flex items-center py-4">
                        <img id="image" class="w-[160px]" src="/syntax-community-2.png" alt="">
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

    <section class="bg-[#eff2fe] hero-pattern relative h-screen">
        <div class="bg-black opacity-75 w-full h-screen absolute z-0"></div>
        <div class="z-10 absolute w-full h-screen">
            <div class="max-w-6xl mx-auto">
                <div class="flex flex-col items-center text-center justify-center h-screen px-8">
                    <h1 class="text-3xl md:text-5xl font-bold text-white mb-6">Certificate Verification Portal</h1>
                    <p class="text-lg md:text-xl text-gray-300 mb-8">Verify the authenticity of certificates issued by Syntax Community</p>
                    <div class="flex flex-col md:flex-row space-y-4 md:space-y-0 md:space-x-4">
                        <a href={{ route('checkid') }} class="bg-[#35448e] text-white font-bold py-3 px-6 rounded-lg shadow-lg border-2 border-[#35448e] hover:bg-[#435197] transition duration-300">
                            <i class="fas fa-search mr-3"></i>Search by ID
                        </a>
                        <a href={{ route('scan') }} class="bg-white text-[#35448e] border-2 border-[#35448e] font-bold py-3 px-6 rounded-lg shadow-lg hover:bg-gray-300 transition duration-300">
                            <i class="fas fa-qrcode mr-3"></i>Scan QR Code
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <main class="flex-grow">
        <section class="py-12 md:py-20 bg-white px-12">
            <div class="max-w-6xl mx-auto px-4">
                <div class="text-center mb-12">
                    <h2 class="text-3xl font-bold text-[#35448e]">How It Works</h2>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    <div class="bg-white p-6 rounded-lg shadow-md text-center">
                        <div class="w-16 h-16 bg-[#ff2e43] font-bold rounded-full flex items-center justify-center text-white text-2xl mx-auto mb-4">1</div>
                        <h3 class="text-xl font-bold mb-3 text-[#35448e]">Enter ID or Scan QR</h3>
                        <p class="text-gray-600">Input the certificate ID or scan the QR code displayed on your certificate</p>
                    </div>
                    <div class="bg-white p-6 rounded-lg shadow-md text-center">
                        <div class="w-16 h-16 bg-[#ff2e43] font-bold rounded-full flex items-center justify-center text-white text-2xl mx-auto mb-4">2</div>
                        <h3 class="text-xl font-bold mb-3 text-[#35448e]">Verification Process</h3>
                        <p class="text-gray-600">Our system will instantly check the certificate in our secure database</p>
                    </div>
                    <div class="bg-white p-6 rounded-lg shadow-md text-center">
                        <div class="w-16 h-16 bg-[#ff2e43] font-bold rounded-full flex items-center justify-center text-white text-2xl mx-auto mb-4">3</div>
                        <h3 class="text-xl font-bold mb-3 text-[#35448e]">View Results</h3>
                        <p class="text-gray-600">Instantly see verification results and certificate details</p>
                    </div>
                </div>
            </div>
        </section>
        
        <section id="about" class="py-12 md:py-20 bg-[#eff2fe] px-12">
            <div class="max-w-6xl mx-auto px-4">
                <div class="text-center mb-8">
                    <h2 class="text-3xl font-bold text-[#35448e]">About Syntax E-Certificate</h2>
                </div>
                <div class="bg-white p-12 md:p-8 rounded-lg shadow-lg">
                    <p class="text-gray-700 mb-4">Syntax E-Certificate Verification System is a secure platform designed to validate the authenticity of certificates issued by Syntax. Our digital certification system ensures that all certificates can be easily verified by employers, educational institutions, and other relevant parties.</p>
                    <p class="text-gray-700 mb-4">Each Syntax certificate contains a unique identifier and QR code that can be used to instantly verify its authenticity through this portal. This helps prevent fraud and ensures that only legitimate Syntax certifications are recognized.</p>
                    <div class="mt-6 py-4 border-t border-gray-200">
                        <h3 class="text-xl font-bold text-[#35448e] mb-4">Why Verify?</h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div class="flex items-start">
                                <i class="fas fa-shield-alt text-[#ff2e43] ml-1 mr-3 mt-1"></i>
                                <div>
                                    <h4 class="font-medium text-[#35448e]">Prevent Fraud</h4>
                                    <p class="text-sm text-gray-600">Ensure certificates haven't been falsified</p>
                                </div>
                            </div>
                            <div class="flex items-start">
                                <i class="fas fa-check-double text-[#ff2e43] ml-1 mr-3 mt-1"></i>
                                <div>
                                    <h4 class="font-medium text-[#35448e]">Confirm Authenticity</h4>
                                    <p class="text-sm text-gray-600">Verify official Syntax certification</p>
                                </div>
                            </div>
                            <div class="flex items-start">
                                <i class="fas fa-database text-[#ff2e43] ml-1 mr-3 mt-1"></i>
                                <div>
                                    <h4 class="font-medium text-[#35448e]">Access Details</h4>
                                    <p class="text-sm text-gray-600">View certification details and date</p>
                                </div>
                            </div>
                            <div class="flex items-start">
                                <i class="fas fa-history text-[#ff2e43] ml-1 mr-3 mt-1"></i>
                                <div>
                                    <h4 class="font-medium text-[#35448e]">Check Validity</h4>
                                    <p class="text-sm text-gray-600">Confirm if the certification is current</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <footer class="syntax-blue text-[#35448e] px-6 md:px-0">
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

        const image = document.getElementById('image');
        const navbar = document.getElementById('navbar');
        window.addEventListener("scroll", function() {
            const body = document.body;
            if (window.scrollY >= 100) {
                image.src = "/syntax-community.png";
                navbar.classList.add('bg-white');
                navbar.classList.remove('bg-none');
                navbar.classList.add('text-black');
                navbar.classList.remove('text-white');
            } else {
                image.src = "/syntax-community-2.png";
                navbar.classList.add('bg-none');
                navbar.classList.remove('bg-white');
                navbar.classList.add('text-white');
                navbar.classList.remove('text-black');
            }
        });

    </script>
</body>
</html>