<div class="font-bold mt-4">{{ $filter->label() }}</div>
@if ($filter->hasValues())
    @foreach($filter->values() as $value => $label)
        <div class="form-control">
            <label for="{{ $filter->id($value) }}" class="label cursor-pointer">
                <span class="label-text">{{ $label }}</span>
                <input
                    id="{{ $filter->id($value) }}"
                    name="{{ $filter->name() }}"
                    value="{{ $value }}"
                    type="{{ $filter->type() }}"
                    class="checkbox"
                    @if($filter->isMultiply() && !is_null($filter->requestValue()) && in_array($value, $filter->requestValue()))
                        checked
                    @elseif($filter->requestValue() == $value)
                        checked
                    @endif
                />
            </label>

        </div>
    @endforeach
@endif
