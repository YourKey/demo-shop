<label for="{{ $filter->id() }}" class="font-bold mt-4">{{ $filter->label() }}</label>
<div class="form-control w-full max-w-xs">
    <input
        id="{{ $filter->id() }}"
        name="{{ $filter->name() }}"
        value="{{ $filter->requestValue() }}"
        type="{{ $filter->type() }}"
        placeholder="{{ $filter->attribute('placeholder') }}"
        class="input input-bordered w-full max-w-xs"
    />
</div>
