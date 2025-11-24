<x-app-layout>
    <x-slot name="header">
        <div>
            <h2 class="text-2xl font-semibold text-slate-800">{{ __('common.dashboard') }}</h2>
            <p class="text-sm text-slate-500 mt-1">{{ __('common.dashboard_subtitle') }}</p>
        </div>
    </x-slot>

    <div class="space-y-8">
        <div class="grid gap-5 sm:grid-cols-2 lg:grid-cols-3">
            <div class="glass-card rounded-3xl p-6">
                <p class="text-sm text-slate-500">{{ __('common.upcoming_trips') }}</p>
                <p class="mt-4 text-3xl font-semibold text-slate-800">02</p>
                <p class="mt-2 text-sm text-slate-400">{{ __('common.sample_locations') }}</p>
            </div>
            <div class="glass-card rounded-3xl p-6">
                <p class="text-sm text-slate-500">{{ __('common.loyalty_points') }}</p>
                <p class="mt-4 text-3xl font-semibold text-slate-800">1.540</p>
                <p class="mt-2 text-sm text-slate-400">{{ __('common.redeem_at_loyalty') }}</p>
            </div>
            <div class="glass-card rounded-3xl p-6">
                <p class="text-sm text-slate-500">{{ __('common.personalized_offers') }}</p>
                <p class="mt-4 text-3xl font-semibold text-slate-800">5</p>
                <p class="mt-2 text-sm text-slate-400">{{ __('common.valid_this_week') }}</p>
            </div>
        </div>

        <div class="glass-card rounded-3xl p-8">
            <h3 class="text-lg font-semibold text-slate-800">{{ __('common.recent_activity') }}</h3>
            <div class="mt-6 grid gap-6 md:grid-cols-2">
                <div class="flex gap-4">
                    <div class="w-12 h-12 rounded-2xl bg-sky-100 flex items-center justify-center text-sky-600">
                        ✈️
                    </div>
                    <div>
                        <p class="font-semibold text-slate-800">{{ __('common.booked_tour_sample') }}</p>
                        <p class="text-sm text-slate-500">{{ __('common.payment_success_sample') }}</p>
                    </div>
                </div>
                <div class="flex gap-4">
                    <div class="w-12 h-12 rounded-2xl bg-orange-100 flex items-center justify-center text-orange-500">
                        ⭐
                    </div>
                    <div>
                        <p class="font-semibold text-slate-800">{{ __('common.reviewed_tour_sample') }}</p>
                        <p class="text-sm text-slate-500">{{ __('common.received_bonus_points') }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>