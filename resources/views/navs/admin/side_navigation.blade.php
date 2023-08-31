<aside
    class="max-w-62.5 ease-nav-brand z-990 fixed inset-y-0 my-4 ml-4 block w-full -translate-x-full flex-wrap items-center justify-between overflow-y-auto rounded-2xl border-0 bg-white p-0 antialiased shadow-none transition-transform duration-200 xl:left-0 xl:translate-x-0 xl:bg-transparent">
    <div class="h-19.5">
        <i class="absolute top-0 right-0 hidden p-4 opacity-50 cursor-pointer fas fa-times text-slate-400 xl:hidden"
           sidenav-close></i>
        <a class="block px-8 py-6 m-0 text-sm whitespace-nowrap text-slate-700" href="{{ route('home') }}">
            @env('local')
                <img src="{{ Vite::asset('resources/images/admin/logo-ct.png') }}"
                     class="inline h-full max-w-full transition-all duration-200 ease-nav-brand max-h-8"
                     alt="main_logo"/>
            @endenv
            <span class="ml-1 font-semibold transition-all duration-200 ease-nav-brand">Go to Website</span>
        </a>
    </div>

    <hr class="h-px mt-0 bg-transparent bg-gradient-to-r from-transparent via-black/40 to-transparent"/>

    <div class="items-center block w-auto max-h-screen overflow-auto h-sidenav grow basis-full">
        <ul class="flex flex-col pl-0 mb-0">
            <x-side-nav-link link="{{ route('admin.dashboard') }}" icon="fa-home" name="Dashboard" />

            <li class="w-full mt-4">
                <h6 class="pl-6 ml-2 text-xs font-bold leading-tight uppercase opacity-60"><i class="fa fa-tags" aria-hidden="true"></i> Categories</h6>
            </li>

            <x-side-nav-link link="{{ route('admin.categories.index') }}" icon="fa-list" name="All Categories" />

            <x-side-nav-link link="{{ route('admin.categories.create') }}" icon="fa-plus" name="Add Categories" />

            <li class="w-full mt-4">
                <h6 class="pl-6 ml-2 text-xs font-bold leading-tight uppercase opacity-60"><i class="fa fa-gift" aria-hidden="true"></i> Products</h6>
            </li>

            <x-side-nav-link link="{{ route('admin.products.index') }}" icon="fa-list" name="All Products" />

            <x-side-nav-link link="{{ route('admin.products.create') }}" icon="fa-plus" name="Add Products" />

            <li class="w-full mt-4">
                <h6 class="pl-6 ml-2 text-xs font-bold leading-tight uppercase opacity-60">Account pages</h6>
            </li>

            <x-side-nav-link link="{{ route('admin.dashboard') }}" icon="fa-user" name="Profile" />
        </ul>
    </div>
</aside>
