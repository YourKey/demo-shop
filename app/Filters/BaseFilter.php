<?php

namespace App\Filters;

use App\Contracts\FilterInterface;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;
use Illuminate\Support\Stringable;

class BaseFilter implements FilterInterface
{
    protected string $view = 'input';

    protected string $type = 'text';

    protected string $placeholder = '...';

    protected ?string $relatedField;

    protected string $label;

    protected string $field;

    protected array $values = [];

    protected array $attributes = [];

    protected bool $multiply = false;

    protected $customQuery = null;

    public function __construct(string $label, string $field, ?string $relatedField = null, array $values = [])
    {
        $this->setLabel($label);
        $this->setField($field);
        $this->setRelatedField($relatedField);
        $this->setValues($values);
    }

    // Создаем фильтр с параметрами
    public static function make(string $label, string $field, ?string $relatedField = null, array $values = []): static
    {
        return new static($label, $field, $relatedField, $values);
    }

    // Выводим blade
    public function render(): View
    {
        return view("filters.{$this->view()}", ['filter' => $this]);
    }

    public function getCustomQuery()
    {
        return $this->customQuery;
    }

    public function hasCustomQuery(): bool
    {
        return !is_null($this->customQuery);
    }

    public function customQuery($customQuery): static
    {
        $this->customQuery = $customQuery;

        return $this;
    }

    // Берем примененные фильтры из GET-запроса
    public function requestValue(?string $param = null): string|array|null
    {
        $pathDot = (string) Str::of('filters')
            ->append(".{$this->field()}")
            ->when($param, fn(Stringable $str) => $str->append(".$param"));
        return request($pathDot);
    }

    // Применяем запросы к Query Builder
    public function apply(Builder $query): Builder
    {
        if (is_null($this->requestValue())) return $query;

        if ($this->hasCustomQuery()):
            $query = $query->where($this->getCustomQuery());
        elseif ($this->relatedField()):
            $query = $this->relatedFieldQuery($query);
        elseif (is_array($this->requestValue())):
            $query = $query->whereIn($this->field(), $this->requestValue());
        else:
            $query = $query->where($this->field(), '=', $this->requestValue());
        endif;

        return $query;
    }

    private function relatedFieldQuery(Builder $query): Builder
    {
        return $query->whereHas($this->field(), function (Builder $q) {
            return is_array($this->requestValue())
                ? $q->whereIn($this->relatedField(), $this->requestValue())
                : $q->where($this->relatedField(), '=', $this->requestValue());
        });
    }

    // blade template name
    public function view(): string
    {
        return $this->view;
    }

    public function setLabel(string $label): static
    {
        $this->label = $label;

        return $this;
    }

    public function label(): string
    {
        return Str::ucfirst($this->label);
    }

    public function setField(string $field): static
    {
        $this->field = $field;

        return $this;
    }

    public function field(): string
    {
        return $this->field;
    }

    public function setValues($values): static
    {
        $this->values = $values;

        return $this;
    }

    public function values(): Collection
    {
        return collect($this->values);
    }

    public function hasValues(): bool
    {
        return $this->values()->isNotEmpty();
    }

    public function id(?string $value = null): string
    {
        return (string) Str::of($this->field())
            ->snake()
            ->prepend('filters_')
            ->when($value, fn(Stringable $str) => $str->append("_$value"));
    }

    public function name(): string
    {
        return (string) Str::of("filters[$this->field]")
            ->when($this->isMultiply(), fn(Stringable $str) => $str->append('[]'));
    }

    public function placeholder(): string
    {
        return $this->placeholder;
    }

    // можем добавить любые дополнительные html-атрибуты для blade
    public function attributes(array $attributes): static
    {
        $this->attributes = $attributes;

        return $this;
    }

    public function attribute(string $name): string
    {
        return $this->attributes[$name] ?? '';
    }

    public function setRelatedField(?string $relatedField): static
    {
        $this->relatedField = $relatedField;

        return $this;
    }

    // Поле в базе, по которому делаем выборку
    public function relatedField(): ?string
    {
        return $this->relatedField;
    }

    // Если нужен множественный выбор select, checkbox
    public function multiply(): static
    {
        $this->multiply = true;

        return $this;
    }

    public function isMultiply(): bool
    {
        return $this->multiply;
    }

    public function type(): string
    {
        return $this->type;
    }
}
