<nav class="main-header navbar navbar-expand navbar-white navbar-light">
  <!-- Left navbar links -->
  <ul class="navbar-nav">
    <li class="nav-item">
      <a class="nav-link d-flex align-items-center" data-widget="pushmenu" href="#" role="button">
        <i class="fas fa-bars"></i>
      </a>
    </li>
    @foreach ($menus as $menu )
    @if ($menu['menu_id']==0)
    @if ( $menu['id'] != 1)
    <li class="nav-item d-none d-sm-inline-block dropdown dropdown-hover">
      @if ( $menu['id'] == $menus[$data['url']]['menu_id'])

      <a class="nav-link active" data-toggle="dropdown">{{$menu['title']}}</a>
      @else
      <a class="nav-link" data-toggle="dropdown">{{$menu['title']}}</a>
      @endif
      <ul class="border-0 shadow dropdown-menu">
        @foreach ( $menus as $subMenu)
        @if ( $subMenu['menu_id'] == $menu['id'])
        <li>
          <a href="" class="dropdown-item">{{$subMenu['title']}}</a>
        </li>
        @endif
        @endforeach
      </ul>
    </li>
    @else
    @if ( $menus[$data['url']]['menu_id']==0)
    <li class="nav-item d-none d-sm-inline-block active">
      <a href=" {{ route('dashboard.home') }}" class="nav-link">{{$menu['title']}}</a>
    </li>
    @else
    <li class="nav-item d-none d-sm-inline-block">
      <a href=" {{ route('dashboard.home') }}" class="nav-link">{{$menu['title']}}</a>
    </li>
    @endif

    @endif

    @endif
    @endforeach
  </ul>

  <!-- Right navbar links -->
  <ul class="ml-auto navbar-nav">
    <!-- Notifications Dropdown Menu -->
    <li class="nav-item dropdown">
      <a class="nav-link d-flex align-items-center" data-toggle="dropdown" href="#">
        <i class="far fa-bell"></i>
        <span class="badge badge-warning navbar-badge">15</span>
      </a>
      <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
        <span class="dropdown-header">15 Notifications</span>
        <div class="dropdown-divider"></div>
        <a href="#" class="dropdown-item">
          <i class="mr-2 fas fa-envelope"></i> 4 new messages
          <span class="float-right text-sm text-muted">3 mins</span>
        </a>
        <div class="dropdown-divider"></div>
        <a href="#" class="dropdown-item">
          <i class="mr-2 fas fa-users"></i> 8 friend requests
          <span class="float-right text-sm text-muted">12 hours</span>
        </a>
        <div class="dropdown-divider"></div>
        <a href="#" class="dropdown-item">
          <i class="mr-2 fas fa-file"></i> 3 new reports
          <span class="float-right text-sm text-muted">2 days</span>
        </a>
        <div class="dropdown-divider"></div>
        <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>
      </div>
    </li>

    <!-- Setting Dropdown Menu -->
    <li class="nav-item dropdown">
      <a class="nav-link d-flex align-items-center" data-toggle="dropdown" href="#">
        <i class="fas fa-cog"></i>
      </a>
      <ul class="border-0 shadow dropdown-menu">
        @foreach ( $menus as $menu)
        @if ($menu['menu_id']==99 && $menu['url']!= 'ad_permit')
        <li><a href="{{ route($menu['url'].'.index') }}" class="dropdown-item">{{ $menu['title'] }}</a></li>
        @endif
        @endforeach
      </ul>
    </li>
    <li class="nav-item">
      <form class="mb-0" method="POST" action="{{ route('logout') }}">
        @csrf
        <a class="nav-link d-flex align-items-center" href="{{ route('logout') }}"
          onclick="event.preventDefault();this.closest('form').submit();">
          <i class="fas fa-sign-out-alt"></i>
        </a>
      </form>
    </li>
  </ul>
</nav>
<!-- /.navbar -->
<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
  <!-- Brand Logo -->
  <a href="{{ url('dashboard') }}" class="brand-link">
    <img src="{{ asset('assets/dist/img/AdminLTELogo.png') }}" alt="AdminLTE Logo"
      class="brand-image img-circle elevation-3" style="opacity: .8">
    <span class="brand-text font-weight-light">Adbook</span>
  </a>

  <!-- Sidebar -->
  <div class="sidebar">
    <!-- Sidebar user panel (optional) -->
    <div class="pb-3 mt-3 mb-3 user-panel d-flex">
      <div class="image">
        @if (!empty(Auth::user()->photofile))

        <img src="{{ asset('/storage/images/'.Auth::user()->photofile) }}" class="img-circle elevation-2"
          alt="User Image">
        @else

        <img src="{{ asset('assets/dist/img/user4-128x128.jpg') }}" class="img-circle elevation-2" alt="User Image">
        @endif

      </div>
      <div class="info">
        <a href="#" class="d-block">{{ Auth::user()->name }}</a>
      </div>
    </div>
    <!-- Sidebar Menu -->
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
        @foreach ( $menus as $key => $mainMenu)
        @if ($mainMenu['menu_id']==0 && $mainMenu['id']!=1)
        @if ($mainMenu['id']==$menus[$data['url']]['menu_id'])
        <li class="nav-item menu-open">
          <a class="nav-link active">
            <i class="nav-icon fas fa-dot-circle"></i>
            <p>
              {{ $mainMenu['title'] }}
              <i class="right fas fa-angle-left"></i>
            </p>
          </a>

          <ul class="nav nav-treeview">
            @foreach ( $menus as $subMenu )
            @if ( $subMenu['menu_id']==$mainMenu['id'] )
            <li class="nav-item">
              @if ( $subMenu['url'] == $menus[$data['url']]['url'] )
              <a href="" class="nav-link active">
                <i class="far fa-circle nav-icon"></i>
                <p>{{ $subMenu['title'] }}</p>
              </a>
              @else
              <a href="{{ route($subMenu['url'].'.index') }}" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>{{ $subMenu['title'] }}</p>
              </a>
              @endif

            </li>
            @endif
            @endforeach
          </ul>
        </li>
        @else
        <li class="nav-item">
          <a class="nav-link">
            <i class="nav-icon fas fa-dot-circle"></i>
            <p>
              {{ $mainMenu['title'] }}
              <i class="right fas fa-angle-left"></i>
            </p>
          </a>

          <ul class="nav nav-treeview">
            @foreach ( $menus as $subMenu )
            @if ( $subMenu['menu_id']==$mainMenu['id'] )
            <li class="nav-item">
              @if ( $subMenu['url'] == $menus[$data['url']]['url'] )
              <a href="" class="nav-link active">
                <i class="far fa-circle nav-icon"></i>
                <p>{{ $subMenu['title'] }}</p>
              </a>
              @else
              <a href="" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>{{ $subMenu['title'] }}</p>
              </a>
              @endif

            </li>
            @endif
            @endforeach
          </ul>
        </li>
        @endif

        @elseif ( $mainMenu['id']==1 )
        @if ( $menus[$data['url']]['url']=='home' )
        <li class="nav-item menu-open">
          <a href="{{ url('dashboard') }}" class="nav-link active">
            <i class="nav-icon fas fa-home"></i>
            <p>
              {{$mainMenu['title']}}
            </p>
          </a>
        </li>
        @else
        <li class="nav-item">
          <a href="{{ url('dashboard') }}" class="nav-link">
            <i class="nav-icon fas fa-home"></i>
            <p>
              {{$mainMenu['title']}}
            </p>
          </a>
        </li>
        @endif

        @endif

        @endforeach
      </ul>
    </nav>
    <!-- /.sidebar-menu -->
  </div>
  <!-- /.sidebar -->
</aside>
