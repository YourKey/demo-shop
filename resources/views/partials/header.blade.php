<div class="navbar bg-base-200 shadow">
    @if(!isset($without_sidebar))
        <label for="my-drawer-2" class="btn btn-primary drawer-button lg:hidden mr-4">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" class="inline-block w-6 h-6 stroke-current"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path></svg>
        </label>
    @endif
    <div class="flex-1">
        <a href="{{ route('products.index') }}" class="btn btn-ghost normal-case text-xl">Shop</a>
    </div>
    <div id="cart" class="flex-none">
        <cart></cart>
    </div>
</div>
