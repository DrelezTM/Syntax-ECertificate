<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Syntax Certificates - Edit File Assets</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap" rel="stylesheet">
    <link rel="icon" href="/syntax.png" type="image/png">
    <meta name="keywords" content="Syntax Community, Syntax ID, Syntax, SMK Telekomunikasi Telesandi, SMK Telkom, Pemrograman, Syntax Telesandi, Syntax Creative, Syntax Tels, Syntx ID, Syntax Certificate">
    <meta name="description" content="Syntax E-Certificate - Edit Assets.">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    @vite('resources/css/app.css')
</head>
<body class="bg-[#f0f3ff]" style="font-family: 'Inter';">
    @include('partials.sidebar')

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

    <main class="pt-28 md:pl-64 p-6">
        <div class="mb-6">
            <a href={{ route('assets' )}} class="text-[#35448f] flex items-center gap-2 hover:text-[#435197]">
                <i class="fa-solid fa-arrow-left"></i>
                Back to Files
            </a>
        </div>

        <div class="bg-white rounded-lg shadow-[0_5px_50px_-20px_rgba(0,0,0,0.3)] p-6">
            <form method="POST" action="{{ route('assets.edit.post' )}}?filename={{ $file['filename'] }}">
                @csrf
                <div class="space-y-6">
                    <div>
                        <label for="new_filename" class="block text-sm font-medium text-gray-700 mb-1">New Filename <span class="text-red-400">*</span></label>
                        <input type="text" name="new_filename" id="new_filename" placeholder="Enter new filename (eg: Cert.jpg)" class="w-full px-4 py-2 rounded-lg border border-gray-200 focus:outline-none focus:border-[#35448f]" value="{{ $file['filename'] }}" required>
                        @error('new_filename')
                            <p class="text-red-500 text-sm">* {{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="flex justify-end gap-4 mt-8">
                    <a href={{ route('assets') }} class="px-6 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50">Cancel</a>
                    <button type="submit" class="px-6 py-2 bg-[#35448f] text-white rounded-lg hover:bg-[#435197]">Edit Files</button>
                </div>
            </form>
        </div>
    </main>
</body>
</html>