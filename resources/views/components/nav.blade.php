<nav class="mt-2">
    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

        <li class="nav-item menu-open">

            <ul class="nav nav-treeview">
                @foreach ($items as $item)
                    <li class="nav-item">
                        <a href="{{ route($item['route']) }}" class="nav-link {{ Route::is($item['active']) ? 'active':'' }}">
                            <i class="far fa-circle nav-icon"></i>
                            <p>{{ $item['title'] }}</p>
                            @isset($item['badge'])
                        <span class="right badge badge-danger">{{ $item['badge'] }}</span>
                            @endisset
                        </a>
                    </li>
                @endforeach

                {{-- <li class="nav-item">
                    <a href="./index2.html" class="nav-link @yield('nav-item-2','active')">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Products</p>
                    </a>
                </li> --}}

            </ul>
        </li>


    </ul>
</nav>
