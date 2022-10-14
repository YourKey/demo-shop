<div class="font-bold mt-4">{{ $filter->label() }}</div>
<div class="grid grid-cols-2 gap-x-4">
    <div>
        <label for="{{ $filter->id('start') }}" class="label">
            <span class="label-text">От</span>
        </label>
        <input
            id="{{ $filter->id('start') }}"
            name="{{ $filter->name() }}[min]"
            type="{{ $filter->type() }}"
            value="{{ $filter->requestValue()['min'] ?? $filter->attribute('min') }}"
            step="{{ $filter->attribute('step') }}"
            class="input input-bordered w-full max-w-xs"
        />
    </div>
    <div>
        <label for="{{ $filter->id('end') }}" class="label">
            <span class="label-text">До</span>
        </label>
        <input id="{{ $filter->id('end') }}"
               name="{{ $filter->name() }}[max]"
               type="{{ $filter->type() }}"
               value="{{ $filter->requestValue()['max'] ?? $filter->attribute('max') }}"
               step="{{ $filter->attribute('step') }}"
               class="input input-bordered w-full max-w-xs"
        />
    </div>
</div>
