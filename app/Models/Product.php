<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Product extends Model
{
    use HasUuids;

    public $timestamps = false;

    protected $fillable = [
        'sku',
        'name',
        'price',
        'stock',
        'category_id',
    ];
    
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }
}
