<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Syntax Certificates - Add Certificates</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap" rel="stylesheet">
    <link rel="icon" href="/syntax.png" type="image/png">
    <meta name="keywords" content="Syntax Community, Syntax ID, Syntax, SMK Telekomunikasi Telesandi, SMK Telkom, Pemrograman, Syntax Telesandi, Syntax Creative, Syntax Tels, Syntx ID, Syntax Certificate">
    <meta name="description" content="Syntax E-Certificate - Add Certificates.">
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
            <a href={{ route('certificates' )}} class="text-[#35448f] flex items-center gap-2 hover:text-[#435197]">
                <i class="fa-solid fa-arrow-left"></i>
                Back to Certificates
            </a>
        </div>

        <div class="bg-white rounded-lg shadow-[0_5px_50px_-20px_rgba(0,0,0,0.3)] p-6 mb-8">
            <form method="POST" action={{ route('certificates.add.post' )}} enctype="multipart/form-data">
                @csrf
                <div class="space-y-6">
                    <div>
                        <label for="title" class="block text-sm font-medium text-gray-700 mb-1">Certificate Title <span class="text-red-400">*</span></label>
                        <input type="text" name="title" id="title" placeholder="Enter certificate title (eg: Lomba Coding 2025)" class="w-full px-4 py-2 rounded-lg border border-gray-200 focus:outline-none focus:border-[#35448f]">
                        @error('title')
                            <p class="text-red-500 text-sm">* {{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="organizer" class="block text-sm font-medium text-gray-700 mb-1">Certificate Organizer <span class="text-red-400">*</span></label>
                        <input type="text" name="organizer" id="organizer" placeholder="Enter certificate organizer (eg: Syntax)" class="w-full px-4 py-2 rounded-lg border border-gray-200 focus:outline-none focus:border-[#35448f]">
                        @error('organizer')
                            <p class="text-red-500 text-sm">* {{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="description" class="block text-sm font-medium text-gray-700 mb-1">Certificate Description</label>
                        <textarea type="text" name="description" id="description" placeholder="Enter certificates description" rows="3" class="w-full px-4 py-2 rounded-lg border border-gray-200 focus:outline-none focus:border-[#35448f]"></textarea>
                        @error('description')
                            <p class="text-red-500 text-sm">* {{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="file" class="block text-sm font-medium text-gray-700 mb-1">Certificate File <span class="text-red-400">*</span></label>
                        <input type="file" name="file" id="file" accept=".pdf,.png,.jpg" class="w-full px-4 py-2 rounded-lg border border-gray-200 focus:outline-none focus:border-[#35448f]" required />
                        @error('file')
                            <p class="text-red-500 text-sm">* {{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="certificate_id" class="block text-sm font-medium text-gray-700 mb-1">Certificate ID <span class="text-red-400">*</span></label>
                        <input type="text" name="certificate_id" id="certificate_id" class="w-full px-4 py-2 rounded-lg border border-gray-200 focus:outline-none focus:border-[#35448f]" required />
                        @error('certificate_id')
                            <p class="text-red-500 text-sm">* {{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="student_nis" class="block text-sm font-medium text-gray-700 mb-1">Student NIS <span class="text-red-400">*</span></label>
                        <input type="text" name="student_nis" id="student_nis" class="w-full px-4 py-2 rounded-lg border border-gray-200 focus:outline-none focus:border-[#35448f]" required />
                        @error('student_nis')
                            <p class="text-red-500 text-sm">* {{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="flex justify-end gap-4 mt-8">
                    <a href={{ route('certificates') }} class="px-6 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50">Cancel</a>
                    <button type="submit" class="px-6 py-2 bg-[#35448f] text-white rounded-lg hover:bg-[#435197]">Add Certificates</button>
                </div>
            </form>
        </div>

        <div class="flex items-center gap-2 my-4">
            <div class="flex-1 h-px bg-gray-300"></div>
            <p class="text-sm text-gray-500">OR (IF MULTIPLE)</p>
            <div class="flex-1 h-px bg-gray-300"></div>
        </div>

        <div class="bg-white rounded-lg shadow-[0_5px_50px_-20px_rgba(0,0,0,0.3)] p-6 mt-8">
            <form method="POST" action={{ route('certificates.add.post.multiple' )}} enctype="multipart/form-data">
                @csrf
                <div class="space-y-6">
                    <div>
                        <label for="title" class="block text-sm font-medium text-gray-700 mb-1">Certificate Title <span class="text-red-400">*</span></label>
                        <input type="text" name="title" id="title" placeholder="Enter certificate title (eg: Lomba Coding 2025)" class="w-full px-4 py-2 rounded-lg border border-gray-200 focus:outline-none focus:border-[#35448f]">
                        @error('title')
                            <p class="text-red-500 text-sm">* {{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="organizer" class="block text-sm font-medium text-gray-700 mb-1">Certificate Organizer <span class="text-red-400">*</span></label>
                        <input type="text" name="organizer" id="organizer" placeholder="Enter certificate organizer (eg: Syntax)" class="w-full px-4 py-2 rounded-lg border border-gray-200 focus:outline-none focus:border-[#35448f]">
                        @error('organizer')
                            <p class="text-red-500 text-sm">* {{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="description" class="block text-sm font-medium text-gray-700 mb-1">Certificate Description</label>
                        <textarea type="text" name="description" id="description" placeholder="Enter certificates description" rows="3" class="w-full px-4 py-2 rounded-lg border border-gray-200 focus:outline-none focus:border-[#35448f]"></textarea>
                        @error('description')
                            <p class="text-red-500 text-sm">* {{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="files" class="block text-sm font-medium text-gray-700 mb-1">Certificate Files <span class="text-red-400">*</span></label>
                        <input type="file" name="files[]" id="files" accept=".pdf,.png,.jpg" class="w-full px-4 py-2 rounded-lg border border-gray-200 focus:outline-none focus:border-[#35448f]" multiple required />
                        @error('files')
                            <p class="text-red-500 text-sm">* {{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="data" class="block text-sm font-medium text-gray-700 mb-1">Certificate Data (CSV) <span class="text-red-400">*</span></label>
                        <input type="file" name="data" id="data" accept=".csv" class="w-full px-4 py-2 rounded-lg border border-gray-200 focus:outline-none focus:border-[#35448f]" required />
                        @error('data')
                            <p class="text-red-500 text-sm">* {{ $message }}</p>
                        @enderror
                        
                        <p class="text-gray-500 text-sm">Perlu template data CSV? <a href="/files/template-certificates.csv" class="text-[#35448f] hover:text-[#435197]">Klik Disini</a> untuk mengunduh template</p>
                    </div>
                </div>

                <div class="flex justify-end gap-4 mt-8">
                    <a href={{ route('certificates') }} class="px-6 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50">Cancel</a>
                    <button type="submit" class="px-6 py-2 bg-[#35448f] text-white rounded-lg hover:bg-[#435197]">Add Certificates</button>
                </div>
            </form>
        </div>
    </main>
</body>
</html>