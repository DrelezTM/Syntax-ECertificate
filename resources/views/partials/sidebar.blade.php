<!-- Navbar -->
<nav class="fixed w-full border-b-[#F5F5F5] border-[1px] flex justify-between items-center text-lg bg-white shadow-[0_5px_50px_-20px_rgba(0,0,0,0.3)] z-50">
    <div class="px-6 py-4 flex justify-between items-center w-full">
        <div class="flex items-center gap-4">
            <button id="btnOpen" class="flex md:hidden justify-center items-center" onclick="toggleSidebar()">
                <i class="fa-solid fa-bars text-[#AEAEB5] text-2xl"></i>
            </button>
            <a href="/">
                <img src="/syntax-community.png" class="w-[150px]" alt="">
            </a>
        </div>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
            @method('POST')
        </form>
        <button class="text-[#35448f] cursor-pointer" onclick="logout()">
            <i class="fa-solid fa-right-from-bracket text-xl"></i>
        </button>
        
    </div>
</nav>

<!-- Sidebar -->
<aside id="sidebar" class="fixed top-0 left-0 h-screen w-60 bg-white shadow-[0_5px_50px_-20px_rgba(0,0,0,0.3)] transition-transform duration-300 ease-in-out md:translate-x-0 translate-x-[-240px] z-40">
    <div class="flex flex-col h-full">
        <div class="p-6">
            <img src="/syntax-community.png" class="w-[150px]" alt="">
        </div>
        <nav class="flex-1 p-4">
            <ul class="space-y-2">
                <li>
                    <a href="{{ route('certificates') }}" class="flex items-center gap-3 p-3 rounded-lg 
                        {{ Route::is('certificates') || Route::is('certificates.add') || Route::is('certificates.edit') ? 'bg-[#a2afed] text-[#35448f]' : 'text-[#AEAEB5] hover:bg-gray-50' }}">
                        <i class="fas fa-award"></i>
                        Certificates
                    </a>
                </li>

                <li>
                    <a href="{{ route('assets') }}" class="flex items-center gap-3 p-3 rounded-lg 
                        {{ Route::is('assets') || Route::is('assets.add') || Route::is('assets.edit') ? 'bg-[#a2afed] text-[#35448f]' : 'text-[#AEAEB5] hover:bg-gray-50' }}">
                        <i class="fa-solid fa-file-lines"></i>
                        File Assets
                    </a>
                </li>

                <li>
                    <a href="{{ route('students') }}" class="flex items-center gap-3 p-3 rounded-lg 
                        {{ Route::is('students') || Route::is('students.add') || Route::is('students.edit') ? 'bg-[#a2afed] text-[#35448f]' : 'text-[#AEAEB5] hover:bg-gray-50' }}">
                        <i class="fas fa-user-graduate"></i>
                        Students
                    </a>
                </li>

                <li>
                    <a href="{{ route('users') }}" class="flex items-center gap-3 p-3 rounded-lg 
                        {{ Route::is('users') || Route::is('users.add') ? 'bg-[#a2afed] text-[#35448f]' : 'text-[#AEAEB5] hover:bg-gray-50' }}">
                        <i class="fas fa-user-plus"></i>
                        Users
                    </a>
                </li>
            </ul>            
        </nav>
    </div>
</aside>

<script>
    function toggleSidebar() {
        const sidebar = document.getElementById('sidebar');
        sidebar.classList.toggle('translate-x-[-240px]');
    }

    function logout() {
        Swal.fire({
                title: 'Are you sure to Logout?',
                text: "This action cannot be undone.",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Yes, logout!'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('logout-form').submit();
                }
            });
    }
</script>