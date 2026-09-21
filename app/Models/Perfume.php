<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Str;

class Perfume extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id', 'name', 'brand', 'audience', 'slug', 'size', 'price', 'sale_price',
        'stock', 'description', 'image', 'is_featured', 'is_active',
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'sale_price' => 'decimal:2',
        'is_featured' => 'boolean',
        'is_active' => 'boolean',
    ];

    protected $appends = ['image_url', 'current_price'];

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function getImageUrlAttribute(): string
    {
        $url = $this->image ? asset('storage/'.$this->image) : asset('images/hero-perfume.svg');

        return $url.'?v='.($this->updated_at?->timestamp ?? 'default');
    }

    public function getCurrentPriceAttribute(): string
    {
        return $this->sale_price ?: $this->price;
    }

    protected static function booted(): void
    {
        static::creating(function (Perfume $perfume) {
            $perfume->slug ??= Str::slug($perfume->name.'-'.Str::random(5));
        });

        static::updating(function (Perfume $perfume) {
            if ($perfume->isDirty('name')) {
                $perfume->slug = Str::slug($perfume->name.'-'.Str::random(5));
            }
        });
    }
}
