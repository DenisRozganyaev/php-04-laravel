<?php

namespace App\Models\Attributes;

use App\Models\Image;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphOne;

class Brand extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'country'
    ];

    public function products(): HasMany
    {
        return $this->hasMany(Product::class);
    }

    public function logo(): MorphOne
    {
        return $this->morphOne(Image::class, 'imageable');
    }
}
