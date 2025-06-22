<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class Transaction extends Model
{
    use HasFactory,SoftDeletes , LogsActivity;

    protected $fillable=[
            'vendor_id',
            'category_id',
            'date_transaction',
            // 'description',
            'currency',
            'amount',
            'amount_dollar',
            'image',
            'is_paid',
        ];
    
    // --- TAMBAHKAN METHOD INI UNTUK KONFIGURASI LOG ---
    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            // Tentukan field mana saja yang ingin dicatat perubahannya
            ->logOnly([
                'vendor.name', 
                'category.name', 
                'amount', 
                'amount_dollar', 
                'date_transaction', 
                'description'
            ])
            // Pesan log yang lebih manusiawi
            ->setDescriptionForEvent(fn(string $eventName) => "Transaksi telah di-{$eventName}")
            // Mencatat field yang berubah saja, bukan semuanya
            ->logOnlyDirty()
            // Memberi nama log agar mudah difilter
            ->useLogName('Transaksi');
    }
    // --- AKHIR PENAMBAHAN ---

    public function category(): BelongsTo{
        return $this->belongsTo(Category::class);
    }

    public function vendor(): BelongsTo
    {
        return $this->belongsTo(Vendor::class);
    }

    public function scopeExpenses($query){
        return $query->whereHas('category', function ($query){
            $query->where('amount', '>', 0);
        });
    }

    public function scopeCategory($query){
        return $query->whereHas('category_id, SUM(amount) as total', function($query){
            $query->where('amount','>', 0)
            ->groupBy('category_id')
            ->orderBy('category_id')
            ->get();
        });
    }


}

