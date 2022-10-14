<div class="font-bold mt-4">{{ $filter->label() }}</div>
@if ($filter->hasValues())
    @foreach($filter->values() as $value => $label)
        <div class="form-control">
            <label class="label cursor-pointer">
                        <span class="label-text">{{ $label }}</span>
                        <input
                            type="{{ $filter->type() }}"
                            value="@if($value !== 0){{ $value }}@endif"
                            name="{{ $filter->name() }}"
                            class="radio checked:bg-blue-500"
                            @if($filter->requestValue() == $value) checked @endif
                        />
            </label>
        </div>
    @endforeach
@endif
