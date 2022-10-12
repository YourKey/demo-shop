<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Product extends Model
{
    use HasFactory;

    protected array $casts = [
        'dimensions' => 'json',
    ];

    public function meals(): belongsToMany
    {
        return $this->belongsToMany(Meal::class);
    }

    public function category(): belongsTo
    {
        return $this->belongsTo(Category::class);
    }
}
