<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Syntax Certificates - Edit Students</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap" rel="stylesheet">
    <link rel="icon" href="/syntax.png" type="image/png">
    <meta name="keywords" content="Syntax Community, Syntax ID, Syntax, SMK Telekomunikasi Telesandi, SMK Telkom, Pemrograman, Syntax Telesandi, Syntax Creative, Syntax Tels, Syntx ID, Syntax Certificate">
    <meta name="description" content="Syntax E-Certificate - Edit Student.">
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
            <a href={{ route('students' )}} class="text-[#35448f] flex items-center gap-2 hover:text-[#435197]">
                <i class="fa-solid fa-arrow-left"></i>
                Back to Students
            </a>
        </div>

        <div class="bg-white rounded-lg shadow-[0_5px_50px_-20px_rgba(0,0,0,0.3)] p-6">
            <form method="POST" action="{{ route('students.edit.post' )}}?id={{ $student->id }}" enctype="multipart/form-data">
                @csrf
                <div class="space-y-6">
                    <div>
                        <label for="nis" class="block text-sm font-medium text-gray-700 mb-1">Student NIS <span class="text-red-400">*</span></label>
                        <input type="text" name="nis" id="nis" placeholder="Enter student nis (eg: 222310114)" class="w-full px-4 py-2 rounded-lg border border-gray-200 focus:outline-none focus:border-[#35448f]" value="{{ $student->nis }}">
                        @error('nis')
                            <p class="text-red-500 text-sm">* {{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Student Name <span class="text-red-400">*</span></label>
                        <input type="text" name="name" id="name" placeholder="Enter student name (eg: Yazid Yusuf)" class="w-full px-4 py-2 rounded-lg border border-gray-200 focus:outline-none focus:border-[#35448f]" value="{{ $student->name }}">
                        @error('name')
                            <p class="text-red-500 text-sm">* {{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="major" class="block text-sm font-medium text-gray-700 mb-1">Student Major <span class="text-red-400">*</span></label>
                        <input type="text" name="major" id="major" placeholder="Enter student major (eg: REKAYASA PERANGKAT LUNAK)" class="w-full px-4 py-2 rounded-lg border border-gray-200 focus:outline-none focus:border-[#35448f]" value="{{ $student->major }}">
                        @error('major')
                            <p class="text-red-500 text-sm">* {{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="gender" class="block text-sm font-medium text-gray-700 mb-1">Student Gender <span class="text-red-400">*</span></label>
                        <select name="gender" id="gender" class="w-full px-4 py-2 rounded-lg border border-gray-200 focus:outline-none focus:border-[#35448f]">
                            <option value="LAKI-LAKI" {{ $student->gender === 'LAKI-LAKI' ? 'selected' : '' }}>LAKI-LAKI</option>
                            <option value="PEREMPUAN" {{ $student->gender === 'PEREMPUAN' ? 'selected' : '' }}>PEREMPUAN</option>
                        </select>
                        @error('gender')
                            <p class="text-red-500 text-sm">* {{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="batch" class="block text-sm font-medium text-gray-700 mb-1">Student Batch <span class="text-red-400">*</span></label>
                        <input type="number" name="batch" id="batch" placeholder="Enter student batch (eg: 15)" class="w-full px-4 py-2 rounded-lg border border-gray-200 focus:outline-none focus:border-[#35448f]" value="{{ $student->batch }}">
                        @error('batch')
                            <p class="text-red-500 text-sm">* {{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="flex justify-end gap-4 mt-8">
                    <a href={{ route('students') }} class="px-6 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50">Cancel</a>
                    <button type="submit" class="px-6 py-2 bg-[#35448f] text-white rounded-lg hover:bg-[#435197]">Edit Student</button>
                </div>
            </form>
        </div>
    </main>
</body>
</html>