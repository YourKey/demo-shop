<?php

namespace App\Contracts;

use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Builder;

interface FilterInterface
{
    public function __construct(string $label, string $field, ?string $relatedField = null, array $values = []);

    public static function make(string $label, string $field, ?string $relatedField = null, array $values = []): static;

    public function render(): View;

    public function apply(Builder $query): Builder;
}
