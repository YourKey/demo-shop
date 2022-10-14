<?php

namespace App\Filters;

use Illuminate\Database\Eloquent\Builder;

class InputRangeFilter extends BaseFilter
{
    protected string $view = 'input_range';
    protected string $type = 'number';

    protected float|null $min = null;
    protected float|null $max = null;

    public function __construct(string $label, string $field, ?string $relatedField = null, array $values = [])
    {
        parent::__construct($label, $field, $relatedField, $values);
        $this->setRange();
    }

    private function setRange(): void
    {
        if (isset($this->requestValue()['min'])
            && $this->requestValue()['min'] !== ''
            && $this->requestValue()['min'] > 0
        ) $this->min = floatval($this->requestValue()['min']);

        if (isset($this->requestValue()['max'])
            && $this->requestValue()['max'] !== ''
            && $this->requestValue()['max'] > 0
        ) $this->max = floatval($this->requestValue()['max']);

        if ($this->min > $this->max) $this->min = $this->max;
    }

    public function apply(Builder $query): Builder
    {
        if (is_null($this->min) && is_null($this->max)) return $query;

        if (!is_null($this->min)) $query = $query->where($this->field(), '>=', $this->min);
        if (!is_null($this->max)) $query = $query->where($this->field(), '<=', $this->max);

        return $query;
    }
}
