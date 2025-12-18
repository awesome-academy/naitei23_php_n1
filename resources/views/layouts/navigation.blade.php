{{-- Ghi chú (Tiếng Việt):
    - Component navigation dùng trên trang có header chính.
    - Sử dụng Alpine.js cho trạng thái `open` (mobile) và `langOpen` (language menu).
    - Nếu muốn tái sử dụng logic language dropdown, tách JS vào file riêng trong `resources/js/`.
--}}
<nav x-data="{ open: false, langOpen: false }" class="bg-gradient-to-r from-sky-600 to-blue-600 text-white shadow-lg">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex items-center gap-10">
                <a href="{{ url('/') }}" class="flex items-center gap-2 text-lg font-semibold">
                    <x-application-logo class="text-white" />
                </a>

                <div class="hidden sm:flex items-center gap-4">
                    <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                        {{ __('common.dashboard') }}
                    </x-nav-link>
                    <x-nav-link :href="route('payment.history')" :active="request()->routeIs('payment.history')">
                        {{ __('common.payment_history') }}
                    </x-nav-link>
                    <x-nav-link :href="route('profile.edit')" :active="request()->routeIs('profile.*')">
                        {{ __('common.profile') }}
                    </x-nav-link>
                </div>
            </div>

            <div class="hidden sm:flex sm:items-center gap-4">
                @php
                    $currentLocale = app()->getLocale();
                    $flagUrls = config('app.locale_flags', []);
                    $fallbackFlag = 'https://flagcdn.com/w20/us.png';
                    $currentFlag = $flagUrls[$currentLocale] ?? $fallbackFlag;
                @endphp
                <div class="relative">
                    <button type="button"
                            @click="langOpen = !langOpen"
                            class="flex items-center gap-2 px-3 py-2 rounded-lg bg-white/10 hover:bg-white/20 text-white transition-colors"
                            aria-haspopup="true"
                            :aria-expanded="langOpen ? 'true' : 'false'"
                            aria-label="{{ __('common.change_language') }}">
                        <img src="{{ $currentFlag }}" alt="{{ strtoupper($currentLocale) }}" width="20" height="15" class="object-cover rounded" style="border: 1px solid rgba(255,255,255,0.3);">
                        <span class="text-sm font-medium">{{ strtoupper($currentLocale) }}</span>
                        <i class="fas fa-chevron-down text-xs"></i>
                    </button>
                    <div x-show="langOpen"
                         @click.away="langOpen = false"
                         x-cloak
                         class="absolute right-0 mt-2 w-48 bg-white rounded-lg shadow-lg border border-slate-200 py-1 z-50">
                        <a href="{{ route('locale.switch', 'en') }}" 
                           role="menuitem"
                           class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 {{ $currentLocale === 'en' ? 'bg-sky-50 text-sky-600' : '' }}">
                        <img src="{{ $flagUrls['en'] ?? $fallbackFlag }}" alt="EN" width="20" height="15" class="object-cover rounded mr-3" style="border: 1px solid #e5e7eb;">
                            <span>{{ __('common.english') }}</span>
                        </a>
                        <a href="{{ route('locale.switch', 'vi') }}" 
                           role="menuitem"
                           class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 {{ $currentLocale === 'vi' ? 'bg-sky-50 text-sky-600' : '' }}">
                        <img src="{{ $flagUrls['vi'] ?? 'https://flagcdn.com/w20/vn.png' }}" alt="VI" width="20" height="15" class="object-cover rounded mr-3" style="border: 1px solid #e5e7eb;">
                            <span>{{ __('common.vietnamese') }}</span>
                        </a>
                        <a href="{{ route('locale.switch', 'ja') }}" 
                           role="menuitem"
                           class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 {{ $currentLocale === 'ja' ? 'bg-sky-50 text-sky-600' : '' }}">
                        <img src="{{ $flagUrls['ja'] ?? 'https://flagcdn.com/w20/jp.png' }}" alt="JA" width="20" height="15" class="object-cover rounded mr-3" style="border: 1px solid #e5e7eb;">
                            <span>{{ __('common.japanese') }}</span>
                        </a>
                    </div>
                </div>
                <span class="text-sm text-white/80">
                    {{ Auth::user()->email }}
                </span>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="traveloka-button bg-white/15 text-white hover:bg-white/25">
                        {{ __('common.logout') }}
                    </button>
                </form>
            </div>

            <div class="-mr-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-white hover:bg-white/10 focus:outline-none focus:bg-white/10">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden bg-white text-slate-700">
        <div class="pt-2 pb-3 space-y-1 px-4">
            <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                {{ __('common.dashboard') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('payment.history')" :active="request()->routeIs('payment.history')">
                {{ __('common.payment_history') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('profile.edit')" :active="request()->routeIs('profile.*')">
                {{ __('common.profile') }}
            </x-responsive-nav-link>
        </div>
        <div class="border-t border-slate-100 px-4 py-4 space-y-2">
            <div class="font-medium text-base text-slate-900">{{ Auth::user()->name }}</div>
            <div class="text-sm text-slate-500">{{ Auth::user()->email }}</div>

            <form method="POST" action="{{ route('logout') }}">
                @csrf

                <x-responsive-nav-link :href="route('logout')"
                                        onclick="event.preventDefault();
                                                    this.closest('form').submit();">
                    {{ __('common.logout') }}
                </x-responsive-nav-link>
            </form>
        </div>
    </div>
</nav>
