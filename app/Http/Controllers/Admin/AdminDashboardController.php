<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Comment;
use App\Models\Like;
use App\Models\Payment;
use App\Models\Review;
use App\Models\Tour;
use App\Models\TourSchedule;
use App\Models\User;

class AdminDashboardController extends Controller
{
    public function index()
    {
        $statCards = [
            [
                'key' => 'total_users',
                'label' => __('common.total_users_label'),
                'value' => User::count(),
                'trend' => [
                    'direction' => 'positive',
                    'text' => __('common.trend_positive_users'),
                ],
            ],
            [
                'key' => 'total_tours',
                'label' => __('common.total_tours_label'),
                'value' => Tour::count(),
                'trend' => [
                    'direction' => 'positive',
                    'text' => __('common.trend_positive_tours'),
                ],
            ],
            [
                'key' => 'total_schedules',
                'label' => __('common.total_schedules_label'),
                'value' => TourSchedule::count(),
                'trend' => null,
            ],
            [
                'key' => 'total_bookings',
                'label' => __('common.total_bookings_label'),
                'value' => Booking::count(),
                'trend' => [
                    'direction' => 'positive',
                    'text' => __('common.trend_positive_bookings'),
                ],
            ],
            [
                'key' => 'pending_bookings',
                'label' => __('common.pending_bookings_label'),
                'value' => Booking::where('status', 'pending')->count(),
                'trend' => null,
            ],
            [
                'key' => 'successful_payments',
                'label' => __('common.successful_payments_label'),
                'value' => Payment::where('status', 'success')->count(),
                'trend' => [
                    'direction' => 'positive',
                    'text' => __('common.trend_positive_payments'),
                ],
            ],
        ];

        $recentBookings = Booking::with([
            'user',
            'tourSchedule.tour',
        ])->latest()->take(5)->get();

        $topTours = Tour::withCount(['reviews', 'likes', 'schedules'])
            ->withAvg('reviews', 'rating')
            ->orderByDesc('reviews_count')
            ->take(5)
            ->get();

        $recentReviews = Review::with(['user', 'tour'])
            ->latest()
            ->take(6)
            ->get();

        return view('admin.pages.dashboard', compact('statCards', 'recentBookings', 'topTours', 'recentReviews'));
    }

    public function stats()
    {
        return response()->json([
            'total_users' => User::count(),
            'total_tours' => Tour::count(),
            'total_schedules' => TourSchedule::count(),
            'total_bookings' => Booking::count(),
            'pending_bookings' => Booking::where('status', 'pending')->count(),
            'successful_payments' => Payment::where('status', 'success')->count(),
            'total_reviews' => Review::count(),
            'total_comments' => Comment::count(),
            'total_likes' => Like::count(),
        ]);
    }
}


