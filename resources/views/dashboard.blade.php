<x-app-layout>
    <x-slot name="header">
        <div>
            <h2 class="text-2xl font-semibold text-slate-800">{{ __('common.dashboard') }}</h2>
            <p class="text-sm text-slate-500 mt-1">{{ __('common.dashboard_subtitle') }}</p>
        </div>
    </x-slot>

    <div class="space-y-8">
        <!-- Statistics Cards -->
        <div class="grid gap-5 sm:grid-cols-2 lg:grid-cols-2">
            <div class="glass-card rounded-3xl p-6">
                <p class="text-sm text-slate-500">{{ __('common.upcoming_trips') }}</p>
                <p class="mt-4 text-3xl font-semibold text-slate-800">{{ $upcomingTrips }}</p>
                <p class="mt-2 text-sm text-slate-400">{{ __('common.confirmed_bookings') }}</p>
            </div>
            <div class="glass-card rounded-3xl p-6">
                <p class="text-sm text-slate-500">{{ __('common.total_bookings') }}</p>
                <p class="mt-4 text-3xl font-semibold text-slate-800">{{ $totalBookings }}</p>
                <p class="mt-2 text-sm text-slate-400">{{ __('common.all_time_bookings') }}</p>
            </div>
        </div>

        <!-- Recent Activity - Bookings -->
        <div class="glass-card rounded-3xl p-8">
            <h3 class="text-lg font-semibold text-slate-800 mb-6">{{ __('common.recent_activity') }}</h3>
            @if($bookings->count() > 0)
                <div class="space-y-4">
                    @foreach($bookings as $booking)
                        <div class="flex gap-4 p-4 rounded-xl bg-slate-50 hover:bg-slate-100 transition-colors">
                            <div class="w-12 h-12 rounded-2xl bg-sky-100 flex items-center justify-center text-sky-600 flex-shrink-0">
                                <i class="fas fa-calendar-check"></i>
                            </div>
                            <div class="flex-1">
                                <p class="font-semibold text-slate-800">
                                    {{ $booking->tourSchedule->tour->name ?? __('common.tour_not_found') }}
                                </p>
                                <p class="text-sm text-slate-500">
                                    {{ __('common.booking_date') }}: {{ $booking->booking_date->format('d/m/Y') }}
                                    • {{ __('common.participants') }}: {{ $booking->num_participants }}
                                    • {{ __('common.total_price') }}: {{ number_format($booking->total_price, 0) }} VND
                                </p>
                                <p class="text-xs text-slate-400 mt-1">
                                    @if($booking->tourSchedule->start_date)
                                        {{ __('common.tour_date') }}: {{ $booking->tourSchedule->start_date->format('d/m/Y') }} - {{ $booking->tourSchedule->end_date->format('d/m/Y') }}
                                    @endif
                                </p>
                            </div>
                            <div class="flex items-center">
                                <span class="px-3 py-1 rounded-full text-xs font-semibold
                                    @if($booking->status === 'confirmed') bg-green-100 text-green-700
                                    @elseif($booking->status === 'pending') bg-yellow-100 text-yellow-700
                                    @elseif($booking->status === 'cancelled') bg-red-100 text-red-700
                                    @else bg-slate-100 text-slate-700
                                    @endif">
                                    {{ __('common.' . $booking->status) }}
                                </span>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="text-center py-8">
                    <i class="fas fa-calendar-times text-4xl text-slate-300 mb-3"></i>
                    <p class="text-slate-500">{{ __('common.no_bookings_yet') }}</p>
                </div>
            @endif
        </div>

        <!-- Reviews & Comments Section -->
        <div class="grid gap-5 lg:grid-cols-2">
            <!-- My Reviews -->
            <div class="glass-card rounded-3xl p-8">
                <h3 class="text-lg font-semibold text-slate-800 mb-6">{{ __('common.my_reviews') }}</h3>
                @if($userReviews->count() > 0)
                    <div class="space-y-4">
                        @foreach($userReviews as $review)
                            <div class="p-4 rounded-xl bg-slate-50 hover:bg-slate-100 transition-colors">
                                <div class="flex items-start justify-between mb-2">
                                    <div class="flex-1">
                                        <p class="font-semibold text-slate-800">
                                            {{ $review->tour->name ?? __('common.tour_not_found') }}
                                        </p>
                                        <p class="text-xs text-slate-500 mt-1">
                                            {{ $review->created_at->format('d/m/Y H:i') }}
                                        </p>
                                    </div>
                                    <div class="flex items-center gap-1">
                                        @for($i = 1; $i <= 5; $i++)
                                            @if($i <= $review->rating)
                                                <i class="fas fa-star text-yellow-400 text-sm"></i>
                                            @else
                                                <i class="far fa-star text-gray-300 text-sm"></i>
                                            @endif
                                        @endfor
                                        <span class="text-sm font-semibold ml-1">{{ $review->rating }}/5</span>
                                    </div>
                                </div>
                                @if($review->content)
                                    <p class="text-sm text-slate-700 mt-2 line-clamp-2">{{ $review->content }}</p>
                                @endif
                                <div class="flex items-center gap-4 mt-3 text-xs text-slate-500">
                                    <span><i class="fas fa-comments mr-1"></i>{{ $review->comments_count }} {{ __('common.comments') }}</span>
                                    <span><i class="fas fa-heart mr-1"></i>{{ $review->likes_count }} {{ __('common.helpful') }}</span>
                                </div>
                                <a href="{{ route('customer.tour.details', $review->tour->id ?? '#') }}" class="text-xs text-sky-600 hover:text-sky-700 mt-2 inline-block">
                                    {{ __('common.view_tour') }} →
                                </a>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="text-center py-8">
                        <i class="fas fa-star text-4xl text-slate-300 mb-3"></i>
                        <p class="text-slate-500">{{ __('common.no_reviews_yet') }}</p>
                    </div>
                @endif
            </div>

            <!-- My Comments -->
            <div class="glass-card rounded-3xl p-8">
                <h3 class="text-lg font-semibold text-slate-800 mb-6">{{ __('common.my_comments') }}</h3>
                @if($userComments->count() > 0)
                    <div class="space-y-4">
                        @foreach($userComments as $comment)
                            <div class="p-4 rounded-xl bg-slate-50 hover:bg-slate-100 transition-colors">
                                <div class="flex items-start justify-between mb-2">
                                    <div class="flex-1">
                                        @if($comment->commentable instanceof \App\Models\Review && $comment->commentable->tour)
                                            <p class="font-semibold text-slate-800">
                                                {{ __('common.comment_on_review') }}: {{ $comment->commentable->tour->name }}
                                            </p>
                                        @elseif($comment->commentable instanceof \App\Models\Review)
                                            <p class="font-semibold text-slate-800">
                                                {{ __('common.comment_on_review') }}: {{ __('common.tour_not_found') }}
                                            </p>
                                        @else
                                            <p class="font-semibold text-slate-800">
                                                {{ __('common.comment') }}
                                            </p>
                                        @endif
                                        <p class="text-xs text-slate-500 mt-1">
                                            {{ $comment->created_at->format('d/m/Y H:i') }}
                                        </p>
                                    </div>
                                </div>
                                <p class="text-sm text-slate-700 mt-2 line-clamp-3">{{ $comment->body }}</p>
                                @if($comment->commentable instanceof \App\Models\Review && $comment->commentable->tour)
                                    <a href="{{ route('customer.tour.details', $comment->commentable->tour->id) }}" class="text-xs text-sky-600 hover:text-sky-700 mt-2 inline-block">
                                        {{ __('common.view_review') }} →
                                    </a>
                                @endif
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="text-center py-8">
                        <i class="fas fa-comments text-4xl text-slate-300 mb-3"></i>
                        <p class="text-slate-500">{{ __('common.no_comments_yet') }}</p>
                    </div>
                @endif
            </div>
        </div>

        <!-- All Reviews (from other users and yourself) -->
        <div class="glass-card rounded-3xl p-8">
            <h3 class="text-lg font-semibold text-slate-800 mb-6">{{ __('common.all_reviews') }}</h3>
            @if($allReviews->count() > 0)
                <div class="space-y-4">
                    @foreach($allReviews as $review)
                        <div class="p-4 rounded-xl bg-slate-50 hover:bg-slate-100 transition-colors">
                            <div class="flex items-start justify-between mb-2">
                                <div class="flex items-center gap-3 flex-1">
                                    <div class="w-10 h-10 rounded-full bg-sky-100 text-sky-600 flex items-center justify-center font-semibold flex-shrink-0">
                                        {{ strtoupper(substr($review->user->name ?? __('common.anonymous'), 0, 1)) }}
                                    </div>
                                    <div class="flex-1">
                                        <p class="font-semibold text-slate-800">
                                            {{ $review->user->name ?? __('common.anonymous') }}
                                            @if($review->user_id === auth()->id())
                                                <span class="ml-2 text-xs bg-slate-200 text-slate-600 px-2 py-0.5 rounded-full">{{ __('common.your_review_badge') }}</span>
                                            @endif
                                        </p>
                                        <p class="text-xs text-slate-500 mt-1">
                                            {{ $review->created_at->format('d/m/Y H:i') }}
                                        </p>
                                    </div>
                                </div>
                                <div class="flex items-center gap-1">
                                    @for($i = 1; $i <= 5; $i++)
                                        @if($i <= $review->rating)
                                            <i class="fas fa-star text-yellow-400 text-sm"></i>
                                        @else
                                            <i class="far fa-star text-gray-300 text-sm"></i>
                                        @endif
                                    @endfor
                                    <span class="text-sm font-semibold ml-1">{{ $review->rating }}/5</span>
                                </div>
                            </div>
                            <p class="text-sm font-semibold text-slate-700 mt-2">
                                {{ $review->tour->name ?? __('common.tour_not_found') }}
                            </p>
                            @if($review->content)
                                <p class="text-sm text-slate-600 mt-2 line-clamp-2">{{ $review->content }}</p>
                            @endif
                            <div class="flex items-center gap-4 mt-3 text-xs text-slate-500">
                                <span><i class="fas fa-comments mr-1"></i>{{ $review->comments_count }} {{ __('common.comments') }}</span>
                                <span><i class="fas fa-heart mr-1"></i>{{ $review->likes_count }} {{ __('common.helpful') }}</span>
                            </div>
                            <a href="{{ route('customer.tour.details', $review->tour->id ?? '#') }}" class="text-xs text-sky-600 hover:text-sky-700 mt-2 inline-block">
                                {{ __('common.view_tour') }} →
                            </a>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="text-center py-8">
                    <i class="fas fa-star text-4xl text-slate-300 mb-3"></i>
                    <p class="text-slate-500">{{ __('common.no_reviews_yet') }}</p>
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
