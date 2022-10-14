<?php

namespace App\Models;

use App\Filters\Filters;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Product extends Model
{
    use HasFactory;


    protected array $casts = [
        'weight' => 'float',
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
    ];

    public int $amount = 1;


    public function meals(): belongsToMany
    {
        return $this->belongsToMany(Meal::class);
    }

    public function category(): belongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function scopeFiltered(Builder $query): Builder
    {
        foreach (app(Filters::class)->all() as $filter) {
            $query = $filter->apply($query);
        }

        return $query;
    }


}
