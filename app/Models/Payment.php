<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Payment extends Model
{
    use HasFactory;

    protected $fillable = [
        'booking_id',
        'amount',
        'payment_method',
        'status',
        'transaction_id',
        'payment_date',
        'stripe_payment_intent_id',
        'stripe_session_id',
        'stripe_metadata',
        'invoice_id',
        'pdf_path',
    ];

    protected $casts = [
        'amount' => 'decimal:2',
        'payment_date' => 'datetime',
    ];

    public function booking(): BelongsTo
    {
        return $this->belongsTo(Booking::class, 'booking_id');
    }

    /**
     * Generate unique invoice ID
     */
    public static function generateInvoiceId(): string
    {
        do {
            $invoiceId = 'INV-' . date('Ymd') . '-' . strtoupper(substr(uniqid(), -6));
        } while (self::where('invoice_id', $invoiceId)->exists());

        return $invoiceId;
    }

    /**
     * Boot method to auto-generate invoice_id when payment is created
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($payment) {
            if (empty($payment->invoice_id)) {
                $payment->invoice_id = self::generateInvoiceId();
            }
        });
    }
}

