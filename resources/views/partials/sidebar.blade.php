<div class="drawer-side py-2 mt-2">
    <label for="my-drawer-2" class="drawer-overlay"></label>
    <form id="filter-form">
        <div class="menu block p-4 overflow-y-auto w-80 bg-base-100 text-base-content">
            <!-- Sidebar content here -->
            @include('partials.filters')
        </div>
    </form>
</div>
{{--Каждый товар имеет свойство категория (тарелки, чашки, столовые приборы), материал, вес, размеры (длина и ширина), а также привязан к приемам пищи (одному или нескольким) для которого годится товар (суп, второе, завтрак или десерт).--}}
