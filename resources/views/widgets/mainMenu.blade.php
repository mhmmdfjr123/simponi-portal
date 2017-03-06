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

    @if(!$auth->check())
        <li>
            <a class="login" href="{{ route('portal-login') }}"><i class="fa fa-sign-in" style="margin-right: 5px"></i> LOGIN</a>
            {{--<a class="login" href="/register"><i class="material-icons">launch</i>LOGIN</a>--}}
        </li>
    @else
        <li class="dropdown">
            <a class="dropdown-toggle dropdown-menu-dashboard" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false" href="{{ route('portal-dashboard') }}">Akun Saya  <span class="caret"></span></a>
            <ul class="dropdown-menu dropdown-menu-right">
                <li><a href="{{ route('portal-profile') }}">{{ $user->accountPerson->accountName }}</a></li>
                <li role="separator" class="divider"></li>
                <li><a href="{{ route('portal-dashboard') }}">Inquiry Saldo</a></li>
                <li><a href="{{ route('portal-logout') }}"><i class="ion-log-out" style="margin-right: 3px"></i> Keluar</a></li>
            </ul>
        </li>
    @endif
</ul>