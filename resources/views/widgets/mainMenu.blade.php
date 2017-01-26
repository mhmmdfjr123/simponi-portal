<ul class="nav navbar-nav navbar-right">
    @foreach($listMenu as $m1)
        @if(count($m1['children']) == 0)
            <li>
                <a href="{{ menuUrl($m1['data'], $m1['related']) }}">{{ $m1['data']->menu_name }}</a>
            </li>
        @else
            <li class="dropdown">
                <a href="#">{{ $m1['data']->menu_name }}</a>
                <ul class="dropdown-menu">
                    @foreach($m1['children'] as $m2)
                        <li>
                            <a href="{{ menuUrl($m2['data'], $m2['related']) }}">{{ $m2['data']->menu_name }}</a>
                        </li>
                    @endforeach
                </ul>
            </li>
        @endif
    @endforeach

    <li>
        <a class="login"><i class="material-icons">launch</i>MASUK</a>
    </li>
</ul>