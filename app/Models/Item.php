<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Item extends Model
{
    protected $fillable = [
        'category_id',
        'name',
        'unit',
        'opening_stock',
        'current_price',
        'description',
    ];

    protected function casts(): array
    {
        return [
            'opening_stock' => 'decimal:2',
            'current_price' => 'decimal:2',
        ];
    }

    /**
     * Kategori barang.
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * Semua riwayat transaksi barang.
     */
    public function stockTransactions(): HasMany
    {
        return $this->hasMany(StockTransaction::class);
    }

    /**
     * Hitung saldo barang berdasarkan seluruh transaksi.
     */
    public function getCurrentStock(): float
    {
        $masuk = $this->stockTransactions()
            ->where('type', 'masuk')
            ->sum('quantity');

        $keluar = $this->stockTransactions()
            ->where('type', 'keluar')
            ->sum('quantity');

        return (float) $this->opening_stock
            + (float) $masuk
            - (float) $keluar;
    }
}