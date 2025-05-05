<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Syntax Community - Certificates</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap" rel="stylesheet">
    <link rel="icon" href="/syntax.png" type="image/png">
    <meta name="keywords" content="Syntax Community, Syntax ID, Syntax, SMK Telekomunikasi Telesandi, SMK Telkom, Pemrograman, Syntax Telesandi, Syntax Creative, Syntax Tels, Syntx ID, Syntax Certificate">
    <meta name="description" content="Syntax E-Certificate - Certificate List.">
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

    <!-- Main Content -->
    <main class="pt-28 md:pl-64 p-6">
        <!-- Header Actions -->
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4 mb-6">
            <form method="GET" action="{{ route('certificates') }}" class="flex flex-col md:flex-row items-center gap-4 w-full md:w-auto">
                <div class="relative w-full md:w-96">
                    <input id="searchInput" name="search" type="text" value="{{ request('search') }}" placeholder="Search students..." class="w-full pl-10 pr-4 py-2 rounded-lg border border-gray-200 focus:outline-none focus:border-[#435197]">
                    <i class="fa-solid fa-search absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                </div>
            
                <select name="perPage" onchange="this.form.submit()" class="border-gray-200 w-full md:w-fit rounded-lg py-2 px-3 focus:outline-none focus:border-[#435197] border-[1px]">
                    @foreach([10, 25, 50, 100] as $size)
                        <option value="{{ $size }}" {{ request('perPage', 10) == $size ? 'selected' : '' }}>{{ $size }} rows</option>
                    @endforeach
                </select>
            </form>
            <a href={{ route('certificates.add') }} class="bg-[#35448f] text-white hover:bg-[#435197] px-4 py-2 rounded-lg flex items-center gap-2 transition-colors">
                <i class="fa-solid fa-plus"></i>
                Add Certificates
            </a>
        </div>

        <div class="bg-white rounded-lg shadow-[0_5px_50px_-20px_rgba(0,0,0,0.3)] overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full" id="certificatesTable">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">No</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Student</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Certificate</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">File Status</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @forelse ($certificates as $certificate)
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4 text-sm text-gray-500">{{ $loop->iteration }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div>
                                        <div class="text-sm font-medium text-gray-900">{{ $certificate->student->name ?? 'TIDAK DIKETAHUI' }}</div>
                                        <div class="text-sm text-gray-500">{{ $certificate->student_nis }}</div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex items-center">
                                    <div>
                                        <div class="text-sm font-medium text-gray-900">{{ $certificate->title }}</div>
                                        <div class="text-sm text-gray-500">{{ $certificate->organizer }}</div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 text-sm text-gray-500">
                                @php
                                    $path = 'certificates/' . $certificate->filename;
                                    $exists = Storage::disk('public')->exists($path);
                                @endphp
                                {!! $exists ? '<span class="text-xs bg-green-200 text-green-600 px-3 py-1 rounded-xl">FOUND</span>' : '<span class="text-xs bg-red-200 text-red-600 px-3 py-1 rounded-xl">NOT FOUND</span>' !!}
                            </td>
                            <td class="px-6 py-4 text-sm text-gray-500">{{ \Carbon\Carbon::parse($certificate->date)->translatedFormat('d-m-Y') }}</td>
                            <td class="px-6 py-4 text-sm">
                                <div class="flex gap-5">
                                    <a href="/{{ $certificate->certificate_id }}" target="_blank" class="text-blue-600 hover:text-blue-800"><i class="fa-solid fa-up-right-from-square"></i></a>
                                    <a href="{{ route('certificates.edit') }}?id={{ $certificate->id }}" class="text-yellow-500 hover:text-yellow-600"><i class="fa-solid fa-pen-to-square"></i></a>
                                    <button class="text-red-600 hover:text-red-800" onclick="deleteItem({{ $certificate->id }})"><i class="fa-solid fa-trash"></i></button>
                                </div>
                            </td>
                        </tr>

                        <form id="delete-form-{{ $certificate->id }}" action="{{ route('certificates.delete') }}?id={{ $certificate->id }}" method="POST" style="display: none;">
                            @csrf
                            @method('DELETE')
                        </form>
                        @empty
                        <tr>
                            <td colspan="6" class="px-6 py-4 text-center text-sm text-gray-500">No certificates found.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="bg-white px-4 py-3 flex items-center justify-between border-t border-gray-200 sm:px-6">
                <div class="flex-1 flex justify-between sm:hidden">
                    @if ($certificates->onFirstPage())
                        <span class="relative inline-flex items-center px-4 py-2 text-sm font-medium text-gray-400 bg-white border border-gray-300 rounded-md cursor-not-allowed">Previous</span>
                    @else
                        <a href="{{ $certificates->previousPageUrl() }}" class="relative inline-flex items-center px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-md hover:bg-gray-50">Previous</a>
                    @endif
            
                    @if ($certificates->hasMorePages())
                        <a href="{{ $certificates->nextPageUrl() }}" class="ml-3 relative inline-flex items-center px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-md hover:bg-gray-50">Next</a>
                    @else
                        <span class="ml-3 relative inline-flex items-center px-4 py-2 text-sm font-medium text-gray-400 bg-white border border-gray-300 rounded-md cursor-not-allowed">Next</span>
                    @endif
                </div>
            
                <div class="hidden sm:flex-1 sm:flex sm:items-center sm:justify-between">
                    <div>
                        <p class="text-sm text-gray-700">
                            Showing
                            <span class="font-medium">{{ $certificates->firstItem() }}</span>
                            to
                            <span class="font-medium">{{ $certificates->lastItem() }}</span>
                            of
                            <span class="font-medium">{{ $certificates->total() }}</span>
                            results
                        </p>
                    </div>
                    <div>
                        <nav class="relative z-0 inline-flex rounded-md shadow-sm -space-x-px" aria-label="Pagination">
                            @php
                                $currentPage = $certificates->currentPage();
                                $lastPage = $certificates->lastPage();
                                $start = max(1, $currentPage - 1);
                                $end = min($lastPage, $currentPage + 1);
                            @endphp

                            {{-- Previous --}}
                            @if ($certificates->onFirstPage())
                                <span class="relative inline-flex items-center px-2 py-2 rounded-l-md border border-gray-300 bg-white text-sm font-medium text-gray-400 cursor-not-allowed">
                                    <i class="fa-solid fa-chevron-left"></i>
                                </span>
                            @else
                                <a href="{{ $certificates->previousPageUrl() }}" class="relative inline-flex items-center px-2 py-2 rounded-l-md border border-gray-300 bg-white text-sm font-medium text-gray-500 hover:bg-gray-50">
                                    <i class="fa-solid fa-chevron-left"></i>
                                </a>
                            @endif

                            {{-- Page Numbers --}}
                            @for ($i = $start; $i <= $end; $i++)
                                @if ($i == $currentPage)
                                    <span class="relative inline-flex items-center px-4 py-2 border border-gray-300 bg-blue-600 hover:bg-blue-800 text-sm font-medium text-white">{{ $i }}</span>
                                @else
                                    <a href="{{ $certificates->url($i) }}" class="relative inline-flex items-center px-4 py-2 border border-gray-300 bg-white text-sm font-medium text-gray-700 hover:bg-gray-50">{{ $i }}</a>
                                @endif
                            @endfor

                            {{-- Next --}}
                            @if ($certificates->hasMorePages())
                                <a href="{{ $certificates->nextPageUrl() }}" class="relative inline-flex items-center px-2 py-2 rounded-r-md border border-gray-300 bg-white text-sm font-medium text-gray-500 hover:bg-gray-50">
                                    <i class="fa-solid fa-chevron-right"></i>
                                </a>
                            @else
                                <span class="relative inline-flex items-center px-2 py-2 rounded-r-md border border-gray-300 bg-white text-sm font-medium text-gray-400 cursor-not-allowed">
                                    <i class="fa-solid fa-chevron-right"></i>
                                </span>
                            @endif

                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <script>
        function deleteItem(id) {
            Swal.fire({
                title: 'Are you sure?',
                text: "This action cannot be undone.",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('delete-form-' + id).submit();
                }
            });
        }
    </script>
</body>
</html>