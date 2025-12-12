<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Comment;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function dashboard(Request $request)
    {
        $user = Auth::user();
        
        if (!$user) {
            return redirect()->route('login');
        }
        
        // Get user's bookings with tour schedule and tour info
        $bookings = Booking::where('user_id', $user->id)
            ->with(['tourSchedule.tour'])
            ->latest('booking_date')
            ->limit(10)
            ->get();
        
        // Get user's reviews with tour info
        $userReviews = Review::where('user_id', $user->id)
            ->with(['tour', 'comments.user', 'likes'])
            ->withCount(['comments', 'likes'])
            ->latest()
            ->limit(5)
            ->get();
        
        // Get all reviews (including other users) with comments
        $allReviews = Review::with(['user', 'tour', 'comments.user', 'likes'])
            ->withCount(['comments', 'likes'])
            ->latest()
            ->limit(10)
            ->get();
        
        // Get user's comments
        $userComments = Comment::where('user_id', $user->id)
            ->with([
                'commentable' => function($morphTo) {
                    $morphTo->morphWith([
                        \App\Models\Review::class => ['tour'],
                    ]);
                },
                'user'
            ])
            ->latest()
            ->limit(5)
            ->get();
        
        // Count statistics
        $upcomingTrips = Booking::where('user_id', $user->id)
            ->where('status', 'confirmed')
            ->whereHas('tourSchedule', function($query) {
                $query->where('start_date', '>=', now());
            })
            ->count();
        
        $totalBookings = Booking::where('user_id', $user->id)->count();
        
        return view('dashboard', [
            'bookings' => $bookings,
            'userReviews' => $userReviews,
            'allReviews' => $allReviews,
            'userComments' => $userComments,
            'upcomingTrips' => $upcomingTrips,
            'totalBookings' => $totalBookings,
        ]);
    }
}
