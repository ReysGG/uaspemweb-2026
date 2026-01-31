<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Invoice extends Model
{
    use HasFactory;

    const STATUS_DRAFT = 'draft';
    const STATUS_SENT = 'sent';
    const STATUS_PAID = 'paid';

    const STATUSES = [
        self::STATUS_DRAFT => 'Draft',
        self::STATUS_SENT => 'Sent',
        self::STATUS_PAID => 'Paid',
    ];

    protected $fillable = [
        'sale_id',
        'invoice_number',
        'issue_date',
        'due_date',
        'status',
        'pdf_path',
    ];

    protected $casts = [
        'issue_date' => 'date',
        'due_date' => 'date',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($invoice) {
            if (empty($invoice->invoice_number)) {
                $prefix = 'INV-' . date('Ymd');
                $count = static::whereDate('created_at', today())->count() + 1;
                $invoice->invoice_number = $prefix . '-' . str_pad($count, 4, '0', STR_PAD_LEFT);
            }

            if (empty($invoice->issue_date)) {
                $invoice->issue_date = now();
            }

            if (empty($invoice->due_date)) {
                $invoice->due_date = now()->addDays(30);
            }
        });
    }

    public function sale(): BelongsTo
    {
        return $this->belongsTo(Sale::class);
    }

    public function getStatusLabelAttribute(): string
    {
        return self::STATUSES[$this->status] ?? $this->status;
    }

    public function getStatusColorAttribute(): string
    {
        return match($this->status) {
            self::STATUS_DRAFT => 'gray',
            self::STATUS_SENT => 'warning',
            self::STATUS_PAID => 'success',
            default => 'gray',
        };
    }
}
