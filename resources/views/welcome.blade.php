<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Traveloka</title>
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="min-h-screen traveloka-gradient antialiased">
        <div class="max-w-6xl mx-auto px-6 py-10 lg:py-16">
            <div class="flex items-center justify-between">
                <x-application-logo class="text-2xl text-sky-600" />
                <div class="flex items-center gap-4">
                    @php
                        $currentLocale = app()->getLocale();
                        $flagUrls = config('app.locale_flags');
                        $currentFlag = $flagUrls[$currentLocale] ?? $flagUrls['en'];
                        $fallbackFlag = 'https://flagcdn.com/w20/us.png';
                    @endphp
                    <div class="relative" x-data="{ open: false }">
                        <button type="button"
                                @click="open = !open"
                                class="flex items-center gap-2 px-3 py-2 rounded-lg border border-slate-200 hover:border-sky-300 bg-white text-slate-700 hover:text-sky-600 transition-colors"
                                aria-haspopup="true"
                                :aria-expanded="open ? 'true' : 'false'"
                                aria-label="{{ __('common.change_language') }}">
                            <img src="{{ $currentFlag }}" alt="{{ strtoupper($currentLocale) }}" width="20" height="15" class="object-cover rounded" style="border: 1px solid #e5e7eb;">
                            <span class="text-sm font-medium">{{ strtoupper($currentLocale) }}</span>
                            <i class="fas fa-chevron-down text-xs"></i>
                        </button>
                        <div x-show="open"
                             @click.away="open = false"
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
                    <div class="space-x-4 text-sm font-semibold text-slate-600">
                        @if (Route::has('login'))
                            @auth
                                <a href="{{ url('/dashboard') }}" class="text-sky-600">{{ __('common.dashboard') }}</a>
                            @else
                                <a href="{{ route('login') }}" class="text-slate-600 hover:text-sky-600">{{ __('common.login') }}</a>
                                @if (Route::has('register'))
                                    <a href="{{ route('register') }}" class="px-4 py-2 rounded-full bg-sky-600 text-white hover:bg-sky-500">
                                        {{ __('common.register') }}
                                    </a>
                                @endif
                            @endauth
                        @endif
                    </div>
                </div>
            </div>

            <div class="mt-14 grid gap-12 lg:grid-cols-2 items-center">
                <div>
                    <p class="text-sm font-semibold text-sky-600 uppercase">{{ __('common.travel_easy') }}</p>
                    <h1 class="mt-4 text-4xl lg:text-5xl font-bold text-slate-900 leading-snug">
                        {{ __('common.discover_vietnam') }} <span class="text-sky-600">Traveloka</span>
                    </h1>
                    <p class="mt-6 text-lg text-slate-600">
                        {{ __('common.welcome_description') }}
                    </p>
                    <div class="mt-8 flex flex-wrap gap-4">
                        <a href="{{ route('register') }}" class="traveloka-button bg-gradient-to-r from-sky-600 to-blue-600 text-white shadow-xl">
                            {{ __('common.get_started') }}
                        </a>
                        <a href="{{ route('login') }}" class="traveloka-button bg-white text-sky-600 border border-sky-100">
                            {{ __('common.i_have_account') }}
                        </a>
                    </div>
                    <div class="mt-8 flex items-center gap-6 text-sm text-slate-500">
                        <div>
                            <p class="text-2xl font-semibold text-slate-900">4.9/5</p>
                            <p>{{ __('common.user_rating') }}</p>
                        </div>
                        <div>
                            <p class="text-2xl font-semibold text-slate-900">+1.2k</p>
                            <p>{{ __('common.new_tours_monthly') }}</p>
                        </div>
                    </div>
                </div>
                <div class="glass-card rounded-[32px] p-10 relative overflow-hidden">
                    <div class="absolute inset-0 bg-gradient-to-br from-sky-100 via-transparent to-white opacity-80"></div>
                    <div class="relative space-y-6 text-slate-700">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm text-slate-500">{{ __('common.departure') }}</p>
                                <p class="text-xl font-semibold text-slate-900">Hà Giang</p>
                                <p class="text-sm text-slate-500">24 - 26 Nov</p>
                            </div>
                            <span class="px-4 py-2 rounded-full bg-sky-50 text-sky-600 text-sm font-semibold">
                                {{ __('common.confirmed') }}
                            </span>
                        </div>
                        <hr class="border-slate-100">
                        <div>
                            <p class="text-sm text-slate-500 mb-2">{{ __('common.highlights') }}</p>
                            <ul class="space-y-2 text-sm">
                                <li>• Cột mốc Lũng Cú</li>
                                <li>• Đèo Mã Pí Lèng</li>
                                <li>• Phiên chợ Đồng Văn</li>
                            </ul>
                        </div>
                        <div class="mt-6 p-5 rounded-2xl bg-white shadow-inner text-sm">
                            "{{ __('common.testimonial') }}"
                            <p class="mt-3 font-semibold text-slate-800">— Gia Hưng, HCM</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>

