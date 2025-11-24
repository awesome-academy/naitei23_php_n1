<header class="bg-white shadow-sm sticky top-0 z-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center h-16">
            <div class="flex items-center">
                <a href="{{ route('customer.categories') }}" class="flex items-center space-x-2">
                    <i class="fas fa-plane text-2xl text-orange-500"></i>
                    <span class="text-xl font-bold text-gray-900">Traveloka Tour</span>
                </a>
            </div>

            <nav class="hidden md:flex space-x-8">
                <a href="{{ route('customer.categories') }}" 
                   class="text-gray-700 hover:text-orange-500 px-3 py-2 rounded-md text-sm font-medium {{ request()->routeIs('customer.categories') ? 'text-orange-500' : '' }}">
                    {{ __('common.tour_categories') }}
                </a>
                <a href="#" class="text-gray-700 hover:text-orange-500 px-3 py-2 rounded-md text-sm font-medium">
                    {{ __('common.about_us') }}
                </a>
                <a href="#" class="text-gray-700 hover:text-orange-500 px-3 py-2 rounded-md text-sm font-medium">
                    {{ __('common.contact') }}
                </a>
            </nav>

            <div class="flex items-center space-x-4">
                @php
                    $currentLocale = app()->getLocale();
                    $flagUrls = config('app.locale_flags', []);
                    $fallbackFlag = 'https://flagcdn.com/w20/us.png';
                    $currentFlag = $flagUrls[$currentLocale] ?? $fallbackFlag;
                @endphp
                
                <div class="relative language-switcher-customer">
                    <button type="button"
                            id="customerLanguageToggle"
                            class="flex items-center space-x-2 text-gray-700 hover:text-orange-500 focus:outline-none px-3 py-2 rounded-md transition-colors"
                            aria-haspopup="true"
                            aria-expanded="false"
                            aria-label="{{ __('common.change_language') }}">
                        <img src="{{ $currentFlag }}" alt="{{ strtoupper($currentLocale) }}" width="20" height="15" class="w-5 h-4 object-cover rounded" style="border: 1px solid #e5e7eb;">
                        <span class="text-sm font-medium">{{ strtoupper($currentLocale) }}</span>
                        <i class="fas fa-chevron-down text-xs"></i>
                    </button>
                    <div id="customerLanguageMenu" 
                         class="hidden absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg py-1 z-50 border border-gray-200"
                         role="menu"
                         aria-orientation="vertical">
                        <a href="{{ route('locale.switch', 'en') }}" 
                           role="menuitem"
                           class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 {{ $currentLocale === 'en' ? 'bg-orange-50 text-orange-600' : '' }}">
                        <img src="{{ $flagUrls['en'] ?? $fallbackFlag }}" alt="EN" width="20" height="15" class="w-5 h-4 object-cover rounded mr-3" style="border: 1px solid #e5e7eb;">
                            <span>{{ __('common.english') }}</span>
                        </a>
                        <a href="{{ route('locale.switch', 'vi') }}" 
                           role="menuitem"
                           class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 {{ $currentLocale === 'vi' ? 'bg-orange-50 text-orange-600' : '' }}">
                        <img src="{{ $flagUrls['vi'] ?? 'https://flagcdn.com/w20/vn.png' }}" alt="VI" width="20" height="15" class="w-5 h-4 object-cover rounded mr-3" style="border: 1px solid #e5e7eb;">
                            <span>{{ __('common.vietnamese') }}</span>
                        </a>
                        <a href="{{ route('locale.switch', 'ja') }}" 
                           role="menuitem"
                           class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 {{ $currentLocale === 'ja' ? 'bg-orange-50 text-orange-600' : '' }}">
                        <img src="{{ $flagUrls['ja'] ?? 'https://flagcdn.com/w20/jp.png' }}" alt="JA" width="20" height="15" class="w-5 h-4 object-cover rounded mr-3" style="border: 1px solid #e5e7eb;">
                            <span>{{ __('common.japanese') }}</span>
                        </a>
                    </div>
                </div>

                @auth
                    <div class="relative user-dropdown">
                        <button id="userDropdown" 
                                class="flex items-center space-x-2 text-gray-700 hover:text-orange-500 focus:outline-none"
                                aria-expanded="false"
                                aria-haspopup="true"
                                aria-label="User menu">
                            <i class="fas fa-user-circle text-xl"></i>
                            <span class="hidden md:inline">{{ Auth::user()->name }}</span>
                            <i class="fas fa-chevron-down text-xs"></i>
                        </button>
                        <div id="userMenu" 
                             class="hidden absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg py-1 z-50"
                             role="menu"
                             aria-orientation="vertical">
                            <a href="{{ route('profile.edit') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                <i class="fas fa-user mr-2"></i> {{ __('common.profile') }}
                            </a>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                    <i class="fas fa-sign-out-alt mr-2"></i> {{ __('common.logout') }}
                                </button>
                            </form>
                        </div>
                    </div>
                @else
                    <a href="{{ route('login') }}" class="text-gray-700 hover:text-orange-500 px-3 py-2 rounded-md text-sm font-medium">
                        {{ __('common.login') }}
                    </a>
                    <a href="{{ route('register') }}" class="bg-orange-500 text-white px-4 py-2 rounded-md text-sm font-medium hover:bg-orange-600">
                        {{ __('common.register') }}
                    </a>
                @endauth
            </div>
        </div>
    </div>
</header>

<style>
.user-dropdown {
    position: relative;
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Language switcher
    const languageToggle = document.getElementById('customerLanguageToggle');
    const languageMenu = document.getElementById('customerLanguageMenu');
    
    if (languageToggle && languageMenu) {
        languageToggle.addEventListener('click', function(e) {
            e.stopPropagation();
            e.preventDefault();
            const isOpen = !languageMenu.classList.contains('hidden');
            languageMenu.classList.toggle('hidden', isOpen);
            languageToggle.setAttribute('aria-expanded', !isOpen);
        });

        // Close when clicking outside
        document.addEventListener('click', function(e) {
            if (!languageToggle.contains(e.target) && !languageMenu.contains(e.target)) {
                languageMenu.classList.add('hidden');
                languageToggle.setAttribute('aria-expanded', 'false');
            }
        });

        // Keyboard navigation
        languageToggle.addEventListener('keydown', function(e) {
            if (e.key === 'Enter' || e.key === ' ') {
                e.preventDefault();
                languageToggle.click();
            } else if (e.key === 'Escape') {
                languageMenu.classList.add('hidden');
                languageToggle.setAttribute('aria-expanded', 'false');
            }
        });
    }

    // User dropdown
    const userDropdown = document.getElementById('userDropdown');
    const userMenu = document.getElementById('userMenu');
    
    if (userDropdown && userMenu) {
        const toggleMenu = function(isOpen) {
            userMenu.classList.toggle('hidden', !isOpen);
            userDropdown.setAttribute('aria-expanded', isOpen);
        };

        // Click handler
        userDropdown.addEventListener('click', function(e) {
            e.preventDefault();
            const isOpen = !userMenu.classList.contains('hidden');
            toggleMenu(!isOpen);
        });

        // Keyboard navigation
        userDropdown.addEventListener('keydown', function(e) {
            if (e.key === 'Enter' || e.key === ' ') {
                e.preventDefault();
                const isOpen = !userMenu.classList.contains('hidden');
                toggleMenu(!isOpen);
            } else if (e.key === 'Escape') {
                toggleMenu(false);
            }
        });

        // Close dropdown when clicking outside
        document.addEventListener('click', function(e) {
            if (!userDropdown.contains(e.target) && !userMenu.contains(e.target)) {
                toggleMenu(false);
            }
        });

        // Close on Escape key
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape' && !userMenu.classList.contains('hidden')) {
                toggleMenu(false);
            }
        });
    }
});
</script>

