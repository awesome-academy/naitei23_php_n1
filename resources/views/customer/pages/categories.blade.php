@extends('customer.layouts.app')

@section('title', __('common.tour_categories') . ' - ' . __('common.brand'))

@section('hero')
<section class="bg-gradient-to-r from-orange-500 to-orange-600 text-white py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <h1 class="text-4xl font-bold mb-4">{{ __('common.tour_categories') }}</h1>
        <div class="flex items-center justify-center space-x-2 text-orange-100">
            <a href="{{ route('customer.categories') }}" class="hover:text-white">{{ __('common.home') }}</a>
            <i class="fas fa-chevron-right text-xs"></i>
            <span>{{ __('common.tour_categories') }}</span>
        </div>
    </div>
</section>
@endsection

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <!-- Info Bar -->
    <div class="bg-gray-50 rounded-lg p-4 mb-8">
        <div class="flex items-center justify-center text-sm text-gray-600">
            <span>{{ __('common.showing') }} {{ $tours->count() }} {{ __('common.tours') }}</span>
        </div>
    </div>

    <!-- Tours Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6 mb-12">
        @forelse($tours as $tour)
        <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-xl transition-shadow duration-300 group">
            <div class="relative h-48 overflow-hidden">
                <img src="{{ $tour->image_url ?? 'https://images.unsplash.com/photo-1507525428034-b723cf961d3e?w=400' }}" 
                     alt="{{ $tour->name }}"
                     class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-300">
                <div class="absolute inset-0 bg-black bg-opacity-0 group-hover:bg-opacity-50 transition-opacity duration-300 flex items-center justify-center">
                    <a href="{{ route('customer.tours', $tour->id) }}" 
                       class="opacity-0 group-hover:opacity-100 bg-orange-500 text-white px-6 py-2 rounded-md font-semibold transition-opacity duration-300 hover:bg-orange-600">
                        {{ __('common.view_schedules') }}
                    </a>
                </div>
            </div>
            <div class="p-4">
                <h3 class="text-lg font-semibold text-gray-900 mb-2">{{ $tour->name }}</h3>
                @if($tour->description)
                <p class="text-sm text-gray-600 mb-3 line-clamp-2">{{ $tour->description }}</p>
                @endif
                <p class="text-orange-500 font-medium text-sm">
                    <i class="fas fa-map-marker-alt mr-1"></i>
                    {{ $tour->location }}
                </p>
                <p class="text-gray-500 text-xs mt-2">
                    <i class="fas fa-calendar-alt mr-1"></i>
                    {{ $tour->schedules_count ?? 0 }} {{ __('common.schedules') }}
                </p>
            </div>
        </div>
        @empty
        <div class="col-span-full text-center py-12">
            <i class="fas fa-inbox text-6xl text-gray-300 mb-4"></i>
            <p class="text-gray-600 text-lg">{{ __('common.no_tours_found') }}</p>
        </div>
        @endforelse
    </div>
</div>
@endsection


