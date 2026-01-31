<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Sale extends Model
{
    use HasFactory;

    const STATUS_QUOTATION = 'quotation';
    const STATUS_CONFIRMED = 'confirmed';
    const STATUS_PROCESSING = 'processing';
    const STATUS_SHIPPED = 'shipped';
    const STATUS_COMPLETED = 'completed';

    const STATUSES = [
        self::STATUS_QUOTATION => 'Quotation',
        self::STATUS_CONFIRMED => 'Confirmed',
        self::STATUS_PROCESSING => 'Processing',
        self::STATUS_SHIPPED => 'Shipped',
        self::STATUS_COMPLETED => 'Completed',
    ];

    protected $fillable = [
        'customer_id',
        'seller_id',
        'sale_number',
        'status',
        'subtotal',
        'tax_rate',
        'tax_amount',
        'total',
        'eta',
        'notes',
    ];

    protected $casts = [
        'subtotal' => 'decimal:2',
        'tax_rate' => 'decimal:2',
        'tax_amount' => 'decimal:2',
        'total' => 'decimal:2',
        'eta' => 'date',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($sale) {
            if (empty($sale->sale_number)) {
                $prefix = 'SL-' . date('Ymd');
                $count = static::whereDate('created_at', today())->count() + 1;
                $sale->sale_number = $prefix . '-' . str_pad($count, 4, '0', STR_PAD_LEFT);
            }
        });
    }

    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class);
    }

    public function seller(): BelongsTo
    {
        return $this->belongsTo(User::class, 'seller_id');
    }

    public function items(): HasMany
    {
        return $this->hasMany(SaleItem::class);
    }

    public function invoice(): HasOne
    {
        return $this->hasOne(Invoice::class);
    }

    public function statusHistories(): HasMany
    {
        return $this->hasMany(SaleStatusHistory::class);
    }

    public function calculateTotals(): void
    {
        $this->subtotal = $this->items->sum('total_price');
        $this->tax_amount = $this->subtotal * ($this->tax_rate / 100);
        $this->total = $this->subtotal + $this->tax_amount;
    }

    public function getStatusLabelAttribute(): string
    {
        return self::STATUSES[$this->status] ?? $this->status;
    }

    public function getStatusColorAttribute(): string
    {
        return match($this->status) {
            self::STATUS_QUOTATION => 'gray',
            self::STATUS_CONFIRMED => 'info',
            self::STATUS_PROCESSING => 'warning',
            self::STATUS_SHIPPED => 'primary',
            self::STATUS_COMPLETED => 'success',
            default => 'gray',
        };
    }
}
