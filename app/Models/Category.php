<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'group_type',
    ];

    /**
     * Semua barang yang termasuk kategori ini.
     */
    public function items(): HasMany
    {
        return $this->hasMany(Item::class);
    }

    /**
     * Scope untuk kategori Barang Persediaan.
     */
    public function scopePersediaan($query)
    {
        return $query->where('group_type', 'persediaan');
    }

    /**
     * Scope untuk kategori ATK.
     */
    public function scopeAtk($query)
    {
        return $query->where('group_type', 'atk');
    }
}