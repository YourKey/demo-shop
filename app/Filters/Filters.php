<?php

namespace App\Filters;

class Filters
{
    protected array $filters = [];

    public function registerFilters(array $filters): void
    {
        $this->filters = $filters;
    }

    public function all(): array
    {
        return $this->filters;
    }
}
