<ul class="nav navbar-nav navbar-right">
    @foreach($listMenu as $m1)
        @if(count($m1['children']) == 0)
            <li>
                <a href="{{ menuUrl($m1['data'], $m1['related']) }}">{{ $m1['data']->menu_name }}</a>
            </li>
        @else
            <li class="dropdown">
                <a class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false" href="{{ menuUrl($m1['data'], $m1['related']) }}">{{ $m1['data']->menu_name }}  <span class="caret"></span></a>
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
        <!-- <a class="login" href="{{ route('portal-login') }}"><i class="material-icons">launch</i> MASUK</a> -->
        <a class="login" href="/register"><i class="material-icons">launch</i>MASUK</a>
    </li>
</ul>