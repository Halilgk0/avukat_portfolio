<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') - Avukat Portfolio Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <!-- Alpine.js -->
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <style>
        [x-cloak] { display: none !important; }
    </style>
</head>
<body class="min-h-screen bg-gray-100">
    <div class="flex h-screen overflow-hidden">
        <!-- Sidebar -->
        <div class="bg-gray-900 text-white w-64 flex-shrink-0 hidden md:block">
            <div class="p-6 text-xl font-bold">
                Avukat Portfolio <span class="text-sm font-normal">Admin</span>
            </div>
            <nav class="mt-6">
                <a href="{{ route('admin.dashboard') }}" class="flex items-center py-3 px-6 hover:bg-gray-800 {{ request()->routeIs('admin.dashboard') ? 'bg-gray-800' : '' }}">
                    <i class="fas fa-tachometer-alt mr-3"></i>
                    <span>Dashboard</span>
                </a>
                <a href="{{ route('admin.blog-posts.index') }}" class="flex items-center py-3 px-6 hover:bg-gray-800 {{ request()->routeIs('admin.blog-posts.*') ? 'bg-gray-800' : '' }}">
                    <i class="fas fa-newspaper mr-3"></i>
                    <span>Blog Yazıları</span>
                </a>
                <a href="{{ route('admin.legal-cases.index') }}" class="flex items-center px-4 py-3 {{ request()->routeIs('admin.legal-cases.*') ? 'bg-gray-700' : 'hover:bg-gray-700' }} transition rounded-lg">
                    <i class="fas fa-gavel mr-3 text-gray-400"></i>
                    <span>Davalar</span>
                </a>
                <a href="{{ route('admin.about.index') }}" class="flex items-center px-4 py-3 {{ request()->routeIs('admin.about.*') ? 'bg-gray-700' : 'hover:bg-gray-700' }} transition rounded-lg">
                    <i class="fas fa-user-tie mr-3 text-gray-400"></i>
                    <span>Hakkımda</span>
                </a>
                <a href="{{ route('admin.users.index') }}" class="flex items-center px-4 py-3 {{ request()->routeIs('admin.users.*') ? 'bg-gray-700' : 'hover:bg-gray-700' }} transition rounded-lg">
                    <i class="fas fa-users mr-3 text-gray-400"></i>
                    <span>Kullanıcılar</span>
                </a>
                <a href="{{ route('admin.contact-messages.index') }}" class="flex items-center py-3 px-6 hover:bg-gray-800 {{ request()->routeIs('admin.contact-messages.*') ? 'bg-gray-800' : '' }}">
                    <i class="fas fa-envelope mr-3"></i>
                    <span>İletişim Mesajları</span>
                    @if(isset($stats) && isset($stats['unread_messages_count']) && $stats['unread_messages_count'] > 0)
                        <span class="ml-auto inline-flex items-center justify-center px-2 py-1 text-xs font-bold leading-none text-white bg-yellow-500 rounded-full">
                            {{ $stats['unread_messages_count'] }}
                        </span>
                    @endif
                </a>
                <div class="border-t border-gray-800 my-4"></div>
                <a href="{{ route('home') }}" class="flex items-center py-3 px-6 hover:bg-gray-800">
                    <i class="fas fa-arrow-left mr-3"></i>
                    <span>Siteye Dön</span>
                </a>
                <a href="#" onclick="event.preventDefault(); document.getElementById('admin-logout-form').submit();" class="flex items-center py-3 px-6 hover:bg-gray-800">
                    <i class="fas fa-sign-out-alt mr-3"></i>
                    <span>Çıkış Yap</span>
                </a>
                <form id="admin-logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
                    @csrf
                </form>
            </nav>
        </div>

        <!-- Main Content -->
        <div class="flex-1 flex flex-col overflow-hidden">
            <!-- Top Bar -->
            <header class="bg-white shadow-sm">
                <div class="flex items-center justify-between px-6 py-3">
                    <!-- Mobile menu button -->
                    <button class="md:hidden p-2 rounded-md text-gray-600 hover:text-gray-900 focus:outline-none" id="mobile-menu-button">
                        <i class="fas fa-bars"></i>
                    </button>
                    <!-- User dropdown -->
                    <div class="relative" x-data="{ open: false }">
                        <button @click="open = !open" class="flex items-center space-x-2 focus:outline-none">
                            <span>{{ Auth::user()->name }}</span>
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                            </svg>
                        </button>
                        <div x-show="open" 
                             x-cloak
                             @click.away="open = false"
                             class="absolute right-0 mt-2 w-48 bg-white rounded-lg shadow-xl py-2 text-gray-800 z-50">
                            <a href="{{ route('profile') }}" class="block px-4 py-2 hover:bg-gray-100">Profil</a>
                            <a href="#" onclick="event.preventDefault(); document.getElementById('admin-header-logout-form').submit();" class="block px-4 py-2 hover:bg-gray-100">Çıkış Yap</a>
                            <form id="admin-header-logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
                                @csrf
                            </form>
                        </div>
                    </div>
                </div>
            </header>

            <!-- Mobile Sidebar -->
            <div class="md:hidden bg-gray-900 text-white w-64 absolute inset-y-0 left-0 transform -translate-x-full transition duration-200 ease-in-out z-50" id="mobile-sidebar">
                <div class="p-6 text-xl font-bold">
                    Avukat Portfolio <span class="text-sm font-normal">Admin</span>
                </div>
                <nav class="mt-6">
                    <a href="{{ route('admin.dashboard') }}" class="flex items-center py-3 px-6 hover:bg-gray-800 {{ request()->routeIs('admin.dashboard') ? 'bg-gray-800' : '' }}">
                        <i class="fas fa-tachometer-alt mr-3"></i>
                        <span>Dashboard</span>
                    </a>
                    <a href="{{ route('admin.blog-posts.index') }}" class="flex items-center py-3 px-6 hover:bg-gray-800 {{ request()->routeIs('admin.blog-posts.*') ? 'bg-gray-800' : '' }}">
                        <i class="fas fa-newspaper mr-3"></i>
                        <span>Blog Yazıları</span>
                    </a>
                    <a href="{{ route('admin.legal-cases.index') }}" class="flex items-center py-3 px-6 hover:bg-gray-800 {{ request()->routeIs('admin.legal-cases.*') ? 'bg-gray-800' : '' }}">
                        <i class="fas fa-gavel mr-3"></i>
                        <span>Davalar</span>
                    </a>
                    <a href="{{ route('admin.users.index') }}" class="flex items-center py-3 px-6 hover:bg-gray-800 {{ request()->routeIs('admin.users.*') ? 'bg-gray-800' : '' }}">
                        <i class="fas fa-users mr-3"></i>
                        <span>Kullanıcılar</span>
                    </a>
                    <a href="{{ route('admin.contact-messages.index') }}" class="flex items-center py-3 px-6 hover:bg-gray-800 {{ request()->routeIs('admin.contact-messages.*') ? 'bg-gray-800' : '' }}">
                        <i class="fas fa-envelope mr-3"></i>
                        <span>İletişim Mesajları</span>
                        @if(isset($stats) && isset($stats['unread_messages_count']) && $stats['unread_messages_count'] > 0)
                            <span class="ml-auto inline-flex items-center justify-center px-2 py-1 text-xs font-bold leading-none text-white bg-yellow-500 rounded-full">
                                {{ $stats['unread_messages_count'] }}
                            </span>
                        @endif
                    </a>
                    <div class="border-t border-gray-800 my-4"></div>
                    <a href="{{ route('home') }}" class="flex items-center py-3 px-6 hover:bg-gray-800">
                        <i class="fas fa-arrow-left mr-3"></i>
                        <span>Siteye Dön</span>
                    </a>
                    <a href="#" onclick="event.preventDefault(); document.getElementById('mobile-admin-logout-form').submit();" class="flex items-center py-3 px-6 hover:bg-gray-800">
                        <i class="fas fa-sign-out-alt mr-3"></i>
                        <span>Çıkış Yap</span>
                    </a>
                    <form id="mobile-admin-logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
                        @csrf
                    </form>
                </nav>
            </div>

            <!-- Page Content -->
            <main class="flex-1 overflow-x-hidden overflow-y-auto p-6 bg-gray-100">
                <!-- Alerts -->
                @if(session('success'))
                    <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-4" role="alert">
                        <p>{{ session('success') }}</p>
                    </div>
                @endif

                @if(session('error'))
                    <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-4" role="alert">
                        <p>{{ session('error') }}</p>
                    </div>
                @endif

                <!-- Page Title -->
                <div class="flex justify-between items-center mb-6">
                    <h1 class="text-2xl font-bold text-gray-800">@yield('page_title')</h1>
                    @yield('page_actions')
                </div>

                <!-- Content -->
                @yield('content')
            </main>
        </div>
    </div>

    <script>
        // Mobile menu functionality
        document.getElementById('mobile-menu-button').addEventListener('click', function() {
            const mobileSidebar = document.getElementById('mobile-sidebar');
            if (mobileSidebar.classList.contains('-translate-x-full')) {
                mobileSidebar.classList.remove('-translate-x-full');
                mobileSidebar.classList.add('translate-x-0');
            } else {
                mobileSidebar.classList.remove('translate-x-0');
                mobileSidebar.classList.add('-translate-x-full');
            }
        });

        // Click outside mobile sidebar to close
        document.addEventListener('click', function(event) {
            const mobileSidebar = document.getElementById('mobile-sidebar');
            const mobileMenuButton = document.getElementById('mobile-menu-button');
            
            if (!mobileSidebar.contains(event.target) && !mobileMenuButton.contains(event.target) && 
                !mobileSidebar.classList.contains('-translate-x-full')) {
                mobileSidebar.classList.remove('translate-x-0');
                mobileSidebar.classList.add('-translate-x-full');
            }
        });
    </script>
</body>
</html> 