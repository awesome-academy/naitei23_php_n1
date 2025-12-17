<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PaymentHistoryController extends Controller
{
    /**
     * Display payment history page
     */
    public function index(Request $request)
    {
        $user = Auth::user();

        $payments = Payment::whereHas('booking', function ($query) use ($user) {
            $query->where('user_id', $user->id);
        })
        ->with(['booking.tourSchedule.tour'])
        ->where('status', 'success')
        ->latest('payment_date')
        ->paginate(10);

        return view('customer.pages.payment-history', compact('payments'));
    }
}
