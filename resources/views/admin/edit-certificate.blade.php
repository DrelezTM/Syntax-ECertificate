<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Syntax Certificates - Edit Certificates</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap" rel="stylesheet">
    <link rel="icon" href="/syntax.png" type="image/png">
    <meta name="keywords" content="Syntax Community, Syntax ID, Syntax, SMK Telekomunikasi Telesandi, SMK Telkom, Pemrograman, Syntax Telesandi, Syntax Creative, Syntax Tels, Syntx ID, Syntax Certificate">
    <meta name="description" content="Syntax E-Certificate - Edit Certificate.">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    @vite('resources/css/app.css')
</head>
<body class="bg-[#f0f3ff]" style="font-family: 'Inter';">
    @include('partials/sidebar')

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

        <div class="bg-white rounded-lg shadow-[0_5px_50px_-20px_rgba(0,0,0,0.3)] p-6">
            <form method="POST" action="{{ route('certificates.edit.post' )}}?id={{ $certificate->id }}" enctype="multipart/form-data">
                @csrf
                <div class="space-y-6">
                    <div>
                        <label for="certificate_id" class="block text-sm font-medium text-gray-700 mb-1">Certificate ID <span class="text-red-400">*</span></label>
                        <input type="text" name="certificate_id" id="certificate_id" placeholder="Enter certificate id (eg: SYNTX902183902)" class="w-full px-4 py-2 rounded-lg border border-gray-200 focus:outline-none focus:border-[#35448f]" value="{{ $certificate->certificate_id }}">
                        @error('certificate_id')
                            <p class="text-red-500 text-sm">* {{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="student_nis" class="block text-sm font-medium text-gray-700 mb-1">Student NIS <span class="text-red-400">*</span></label>
                        <input type="text" name="student_nis" id="student_nis" placeholder="Enter student nis (eg: 222310114)" class="w-full px-4 py-2 rounded-lg border border-gray-200 focus:outline-none focus:border-[#35448f]" value="{{ $certificate->student_nis }}">
                        @error('student_nis')
                            <p class="text-red-500 text-sm">* {{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="title" class="block text-sm font-medium text-gray-700 mb-1">Certificate Title <span class="text-red-400">*</span></label>
                        <input type="text" name="title" id="title" placeholder="Enter certificate title (eg: Lomba Coding 2025)" class="w-full px-4 py-2 rounded-lg border border-gray-200 focus:outline-none focus:border-[#35448f]" value="{{ $certificate->title }}">
                        @error('title')
                            <p class="text-red-500 text-sm">* {{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="organizer" class="block text-sm font-medium text-gray-700 mb-1">Certificate Organizer <span class="text-red-400">*</span></label>
                        <input type="text" name="organizer" id="organizer" placeholder="Enter certificate organizer (eg: Syntax)" class="w-full px-4 py-2 rounded-lg border border-gray-200 focus:outline-none focus:border-[#35448f]" value="{{ $certificate->organizer }}">
                        @error('organizer')
                            <p class="text-red-500 text-sm">* {{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="description" class="block text-sm font-medium text-gray-700 mb-1">Certificate Description</label>
                        <textarea type="text" name="description" id="description" placeholder="Enter certificates description" rows="3" class="w-full px-4 py-2 rounded-lg border border-gray-200 focus:outline-none focus:border-[#35448f]">{{ $certificate->description }}</textarea>
                        @error('description')
                            <p class="text-red-500 text-sm">* {{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="date" class="block text-sm font-medium text-gray-700 mb-1">Certificate Publish Date <span class="text-red-400">*</span></label>
                        <input type="date" name="date" id="date" class="w-full px-4 py-2 rounded-lg border border-gray-200 focus:outline-none focus:border-[#35448f]" value="{{ $certificate->date ? $certificate->date : '' }}">
                        @error('date')
                            <p class="text-red-500 text-sm">* {{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="files" class="block text-sm font-medium text-gray-700 mb-1">Certificate Files</label>
                        <div class="flex gap-3 items-center justify-center">
                            <input type="file" name="file" id="file" accept=".pdf,.png,.jpg" class="w-full px-4 py-2 rounded-lg border border-gray-200 focus:outline-none focus:border-[#35448f]" />
                            <a href="/storage/certificates/{{ $certificate->filename }}" target="_blank" class="px-6 py-2 bg-[#35448f] text-white rounded-lg hover:bg-[#435197]">Buka</a>
                        </div>
                        @error('file')
                            <p class="text-red-500 text-sm">* {{ $message }}</p>
                        @enderror
                        <span class="text-gray-400 text-sm mb-1">* Kosongkan jika tidak ingin mengganti file sebelumnya</span>
                    </div>
                </div>

                <div class="flex justify-end gap-4 mt-8">
                    <a href="/certificates" class="px-6 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50">Cancel</a>
                    <button type="submit" class="px-6 py-2 bg-[#35448f] text-white rounded-lg hover:bg-[#435197]">Edit Certificates</button>
                </div>
            </form>
        </div>
    </main>
</body>
</html>