<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') - {{ $siteSettings['site_name'] }}</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/custom.css') }}">
    <style>
        /* Dropdown menü temel stil */
        .dropdown-menu {
            display: none;
            position: absolute;
            right: 0;
            top: 100%;
            margin-top: 10px;
            width: 200px;
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.2);
            z-index: 1000;
        }
        
        /* Dropdown açık olduğunda */
        .dropdown-active {
            display: block;
        }
        
        /* Dropdown menü öğeleri */
        .dropdown-menu a {
            display: flex;
            align-items: center;
            padding: 10px 15px;
            color: #333;
            text-decoration: none;
            transition: background-color 0.2s;
        }
        
        .dropdown-menu a:hover {
            background-color: #f5f5f5;
        }
        
        .dropdown-menu a i {
            margin-right: 10px;
            width: 16px;
            text-align: center;
        }
        
        /* Çıkış Yap butonu */
        .dropdown-menu a.logout-link {
            color: #dc2626;
        }
        
        /* Ayırıcı çizgi */
        .dropdown-divider {
            height: 1px;
            background-color: #e5e5e5;
            margin: 5px 0;
        }
        
        /* Dropdown butonu stil */
        .dropdown-button {
            display: flex;
            align-items: center;
            cursor: pointer;
            padding: 5px 10px;
            border-radius: 5px;
            transition: background-color 0.2s;
        }
        
        .dropdown-button:hover {
            background-color: rgba(255, 255, 255, 0.1);
        }
        
        .dropdown-button svg {
            margin-left: 5px;
            transition: transform 0.2s;
        }
        
        .dropdown-button.active svg {
            transform: rotate(180deg);
        }
    </style>
</head>
<body class="min-h-screen bg-gray-100">
    <!-- Navigation -->
    <nav class="bg-gray-900 text-white">
        <div class="container mx-auto px-6 py-4">
            <div class="flex items-center justify-between">
                <div class="flex items-center">
                    <a href="/" class="flex items-center">
                        @if($siteSettings['site_logo'])
                            <img src="{{ Storage::url($siteSettings['site_logo']) }}" alt="{{ $siteSettings['site_name'] }}" class="h-10 mr-3">
                        @endif
                        <span class="text-xl font-bold">{{ $siteSettings['site_name'] }}</span>
                    </a>
                    <div class="hidden md:flex items-center ml-12 space-x-8">
                        <a href="/" class="hover:text-gray-300">Ana Sayfa</a>
                        <a href="/about" class="hover:text-gray-300">Hakkımda</a>
                        <a href="/services" class="hover:text-gray-300">Hizmetler</a>
                        <a href="/cases" class="hover:text-gray-300">Davalar</a>
                        <a href="/blog" class="hover:text-gray-300">Blog</a>
                        <a href="/contact" class="hover:text-gray-300">İletişim</a>
                    </div>
                </div>
                
                <div class="hidden md:flex items-center space-x-4">
                    @guest
                        <a href="/login" class="px-4 py-2 text-white hover:text-gray-300 transition duration-300">Giriş Yap</a>
                        <a href="/register" class="px-4 py-2 bg-white text-gray-900 rounded-lg hover:bg-gray-100 transition duration-300">Kayıt Ol</a>
                    @else
                        <!-- Basit dropdown menü -->
                        <div class="relative" id="userDropdownContainer">
                            <button id="userDropdownButton" class="dropdown-button">
                                <span>{{ Auth::user()->name }}</span>
                                <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                                </svg>
                            </button>
                            
                            <!-- Dropdown menü içeriği -->
                            <div id="userDropdownMenu" class="dropdown-menu">
                                @if(Auth::user()->isAdmin())
                                    <a href="/admin">
                                        <i class="fas fa-tachometer-alt"></i>
                                        Admin Paneli
                                    </a>
                                    <div class="dropdown-divider"></div>
                                @endif
                                <a href="/profile">
                                    <i class="fas fa-user"></i>
                                    Profil
                                </a>
                                <a href="#" class="logout-link" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    <i class="fas fa-sign-out-alt"></i>
                                    Çıkış Yap
                                </a>
                            </div>
                        </div>
                        <form id="logout-form" action="/logout" method="POST" class="hidden">
                            @csrf
                        </form>
                    @endguest
                </div>

                <!-- Mobile menu button -->
                <div class="md:hidden">
                    <button class="mobile-menu-button p-2 focus:outline-none">
                        <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                        </svg>
                    </button>
                </div>
            </div>

            <!-- Mobile Menu -->
            <div class="mobile-menu hidden md:hidden mt-4">
                <!-- Site logo and name for mobile -->
                <div class="flex items-center pb-4 mb-4 border-b border-gray-700">
                    @if($siteSettings['site_logo'])
                        <img src="{{ Storage::url($siteSettings['site_logo']) }}" alt="{{ $siteSettings['site_name'] }}" class="h-8 mr-3">
                    @endif
                    <span class="text-lg font-bold">{{ $siteSettings['site_name'] }}</span>
                </div>
                <a href="/" class="block py-2 hover:text-gray-300">Ana Sayfa</a>
                <a href="/about" class="block py-2 hover:text-gray-300">Hakkımda</a>
                <a href="/services" class="block py-2 hover:text-gray-300">Hizmetler</a>
                <a href="/cases" class="block py-2 hover:text-gray-300">Davalar</a>
                <a href="/blog" class="block py-2 hover:text-gray-300">Blog</a>
                <a href="/contact" class="block py-2 hover:text-gray-300">İletişim</a>
                @guest
                    <a href="/login" class="block py-2 hover:text-gray-300">Giriş Yap</a>
                    <a href="/register" class="block py-2 hover:text-gray-300">Kayıt Ol</a>
                @else
                    @if(Auth::user()->isAdmin())
                        <a href="/admin" class="block py-2 hover:text-gray-300">Admin Paneli</a>
                    @endif
                    <a href="/profile" class="block py-2 hover:text-gray-300">Profil</a>
                    <a href="#" onclick="event.preventDefault(); document.getElementById('mobile-logout-form').submit();" class="block py-2 hover:text-gray-300">Çıkış Yap</a>
                    <form id="mobile-logout-form" action="/logout" method="POST" class="hidden">
                        @csrf
                    </form>
                @endguest
            </div>
        </div>
    </nav>

    <!-- Content -->
    <main>
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-gray-900 text-white py-12">
        <div class="container mx-auto px-6">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                <div>
                    <h3 class="text-lg font-semibold mb-4">İletişim</h3>
                    <p class="mb-2">[Adres]</p>
                    <p class="mb-2">Tel: [Telefon]</p>
                    <p>E-posta: [E-posta]</p>
                    </div>
                <div>
                    <h3 class="text-lg font-semibold mb-4">Hizmetler</h3>
                    <ul class="space-y-2">
                        <li><a href="#" class="hover:text-gray-300">Ticaret Hukuku</a></li>
                        <li><a href="#" class="hover:text-gray-300">Aile Hukuku</a></li>
                        <li><a href="#" class="hover:text-gray-300">Ceza Hukuku</a></li>
                        <li><a href="#" class="hover:text-gray-300">İş Hukuku</a></li>
                    </ul>
                </div>
                <div>
                    <h3 class="text-lg font-semibold mb-4">Hızlı Bağlantılar</h3>
                    <ul class="space-y-2">
                        <li><a href="/" class="hover:text-gray-300">Ana Sayfa</a></li>
                        <li><a href="/about" class="hover:text-gray-300">Hakkımda</a></li>
                        <li><a href="/blog" class="hover:text-gray-300">Blog</a></li>
                        <li><a href="/contact" class="hover:text-gray-300">İletişim</a></li>
                    </ul>
                </div>
                <div>
                    <h3 class="text-lg font-semibold mb-4">Sosyal Medya</h3>
                    <div class="flex space-x-4">
                        <a href="#" class="hover:text-gray-300">
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>
                        </a>
                        <a href="#" class="hover:text-gray-300">
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24"><path d="M23.953 4.57a10 10 0 01-2.825.775 4.958 4.958 0 002.163-2.723c-.951.555-2.005.959-3.127 1.184a4.92 4.92 0 00-8.384 4.482C7.69 8.095 4.067 6.13 1.64 3.162a4.822 4.822 0 00-.666 2.475c0 1.71.87 3.213 2.188 4.096a4.904 4.904 0 01-2.228-.616v.06a4.923 4.923 0 003.946 4.827 4.996 4.996 0 01-2.212.085 4.936 4.936 0 004.604 3.417 9.867 9.867 0 01-6.102 2.105c-.39 0-.779-.023-1.17-.067a13.995 13.995 0 007.557 2.209c9.053 0 13.998-7.496 13.998-13.985 0-.21 0-.42-.015-.63A9.935 9.935 0 0024 4.59z"/></svg>
                        </a>
                        <a href="#" class="hover:text-gray-300">
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24"><path d="M12 0C8.74 0 8.333.015 7.053.072 5.775.132 4.905.333 4.14.63c-.789.306-1.459.717-2.126 1.384S.935 3.35.63 4.14C.333 4.905.131 5.775.072 7.053.012 8.333 0 8.74 0 12s.015 3.667.072 4.947c.06 1.277.261 2.148.558 2.913.306.788.717 1.459 1.384 2.126.667.666 1.336 1.079 2.126 1.384.766.296 1.636.499 2.913.558C8.333 23.988 8.74 24 12 24s3.667-.015 4.947-.072c1.277-.06 2.148-.262 2.913-.558.788-.306 1.459-.718 2.126-1.384.666-.667 1.079-1.335 1.384-2.126.296-.765.499-1.636.558-2.913.06-1.28.072-1.687.072-4.947s-.015-3.667-.072-4.947c-.06-1.277-.262-2.149-.558-2.913-.306-.789-.718-1.459-1.384-2.126C21.319 1.347 20.651.935 19.86.63c-.765-.297-1.636-.499-2.913-.558C15.667.012 15.26 0 12 0zm0 2.16c3.203 0 3.585.016 4.85.071 1.17.055 1.805.249 2.227.415.562.217.96.477 1.382.896.419.42.679.819.896 1.381.164.422.36 1.057.413 2.227.057 1.266.07 1.646.07 4.85s-.015 3.585-.074 4.85c-.061 1.17-.256 1.805-.421 2.227-.224.562-.479.96-.899 1.382-.419.419-.824.679-1.38.896-.42.164-1.065.36-2.235.413-1.274.057-1.649.07-4.859.07-3.211 0-3.586-.015-4.859-.074-1.171-.061-1.816-.256-2.236-.421-.569-.224-.96-.479-1.379-.899-.421-.419-.69-.824-.9-1.38-.165-.42-.359-1.065-.42-2.235-.045-1.26-.061-1.649-.061-4.844 0-3.196.016-3.586.061-4.861.061-1.17.255-1.814.42-2.234.21-.57.479-.96.9-1.381.419-.419.81-.689 1.379-.898.42-.166 1.051-.361 2.221-.421 1.275-.045 1.65-.06 4.859-.06l.045.03zm0 3.678c-3.405 0-6.162 2.76-6.162 6.162 0 3.405 2.76 6.162 6.162 6.162 3.405 0 6.162-2.76 6.162-6.162 0-3.405-2.76-6.162-6.162-6.162zM12 16c-2.21 0-4-1.79-4-4s1.79-4 4-4 4 1.79 4 4-1.79 4-4 4zm7.846-10.405c0 .795-.646 1.44-1.44 1.44-.795 0-1.44-.646-1.44-1.44 0-.794.646-1.439 1.44-1.439.793-.001 1.44.645 1.44 1.439z"/></svg>
                        </a>
                        <a href="#" class="hover:text-gray-300">
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24"><path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433c-1.144 0-2.063-.926-2.063-2.065 0-1.138.92-2.063 2.063-2.063 1.14 0 2.064.925 2.064 2.063 0 1.139-.925 2.065-2.064 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/></svg>
                        </a>
                    </div>
                </div>
            </div>
            <div class="mt-8 border-t border-gray-800 pt-8 text-center">
                <p>&copy; {{ date('Y') }} {{ $siteSettings['site_name'] }} - Tüm hakları saklıdır.</p>
            </div>
        </div>
    </footer>

    <script src="{{ asset('js/app.js') }}"></script>
    <script>
        // Mobile menu functionality
        document.addEventListener('DOMContentLoaded', function() {
            // Mobil menü toggle
        document.querySelector('.mobile-menu-button').addEventListener('click', function() {
            document.querySelector('.mobile-menu').classList.toggle('hidden');
            });
            
            // Kullanıcı dropdown menüsü
            var dropdownButton = document.getElementById('userDropdownButton');
            var dropdownMenu = document.getElementById('userDropdownMenu');
            
            if (dropdownButton) {
                dropdownButton.addEventListener('click', function(e) {
                    e.stopPropagation();
                    dropdownMenu.classList.toggle('dropdown-active');
                    dropdownButton.classList.toggle('active');
                });
                
                // Sayfa herhangi bir yerine tıklandığında menüyü kapat
                document.addEventListener('click', function(e) {
                    if (dropdownMenu.classList.contains('dropdown-active') && 
                        !dropdownMenu.contains(e.target) && 
                        !dropdownButton.contains(e.target)) {
                        dropdownMenu.classList.remove('dropdown-active');
                        dropdownButton.classList.remove('active');
                    }
                });
            }
        });
    </script>
</body>
</html>
