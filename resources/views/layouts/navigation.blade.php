<nav x-data="{ open: false }" class="bg-gradient-to-r from-sky-600 to-blue-600 text-white shadow-lg">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex items-center gap-10">
                <a href="{{ route('dashboard') }}" class="flex items-center gap-2 text-lg font-semibold">
                    <x-application-logo class="text-white" />
                </a>

                <div class="hidden sm:flex items-center gap-4">
                    <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                        {{ __('Dashboard') }}
                    </x-nav-link>
                    <x-nav-link :href="route('profile.edit')" :active="request()->routeIs('profile.*')">
                        {{ __('Profile') }}
                    </x-nav-link>
                </div>
            </div>

            <div class="hidden sm:flex sm:items-center gap-4">
                <span class="text-sm text-white/80">
                    {{ Auth::user()->email }}
                </span>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="traveloka-button bg-white/15 text-white hover:bg-white/25">
                        {{ __('Log Out') }}
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
                {{ __('Dashboard') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('profile.edit')" :active="request()->routeIs('profile.*')">
                {{ __('Profile') }}
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
                    {{ __('Log Out') }}
                </x-responsive-nav-link>
            </form>
        </div>
    </div>
</nav>
