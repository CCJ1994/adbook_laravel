<nav class="main-header navbar navbar-expand navbar-white navbar-light">
  <!-- Left navbar links -->
  <ul class="navbar-nav">
    <li class="nav-item">
      <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
    </li>
    @foreach ($menus['allMenu'] as $menu )
    @if ($menu['menu_id']==0)
    <li class="nav-item d-none d-sm-inline-block">

      <a href="" class="nav-link">{{$menu['name']}}</a>
    </li>
    @endif
    @endforeach
  </ul>

  <!-- Right navbar links -->
  <ul class="ml-auto navbar-nav">
    <!-- Messages Dropdown Menu -->
    <li class="nav-item dropdown">
      <a class="nav-link d-flex align-items-center" data-toggle="dropdown" href="#">
        <i class="far fa-comments"></i>
        <span class="badge badge-danger navbar-badge">3</span>
      </a>
      <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
        <a href="#" class="dropdown-item">
          <!-- Message Start -->
          <div class="media">
            <img src="dist/img/user1-128x128.jpg" alt="User Avatar" class="mr-3 img-size-50 img-circle">
            <div class="media-body">
              <h3 class="dropdown-item-title">
                Brad Diesel
                <span class="float-right text-sm text-danger"><i class="fas fa-star"></i></span>
              </h3>
              <p class="text-sm">Call me whenever you can...</p>
              <p class="text-sm text-muted"><i class="mr-1 far fa-clock"></i> 4 Hours Ago</p>
            </div>
          </div>
          <!-- Message End -->
        </a>
        <div class="dropdown-divider"></div>
        <a href="#" class="dropdown-item">
          <!-- Message Start -->
          <div class="media">
            <img src="dist/img/user8-128x128.jpg" alt="User Avatar" class="mr-3 img-size-50 img-circle">
            <div class="media-body">
              <h3 class="dropdown-item-title">
                John Pierce
                <span class="float-right text-sm text-muted"><i class="fas fa-star"></i></span>
              </h3>
              <p class="text-sm">I got your message bro</p>
              <p class="text-sm text-muted"><i class="mr-1 far fa-clock"></i> 4 Hours Ago</p>
            </div>
          </div>
          <!-- Message End -->
        </a>
        <div class="dropdown-divider"></div>
        <a href="#" class="dropdown-item">
          <!-- Message Start -->
          <div class="media">
            <img src="dist/img/user3-128x128.jpg" alt="User Avatar" class="mr-3 img-size-50 img-circle">
            <div class="media-body">
              <h3 class="dropdown-item-title">
                Nora Silvester
                <span class="float-right text-sm text-warning"><i class="fas fa-star"></i></span>
              </h3>
              <p class="text-sm">The subject goes here</p>
              <p class="text-sm text-muted"><i class="mr-1 far fa-clock"></i> 4 Hours Ago</p>
            </div>
          </div>
          <!-- Message End -->
        </a>
        <div class="dropdown-divider"></div>
        <a href="#" class="dropdown-item dropdown-footer">See All Messages</a>
      </div>
    </li>
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
        <img src="{{ asset('assets/dist/img/user2-160x160.jpg') }}" class="img-circle elevation-2" alt="User Image">
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
        @foreach ( $menus['allMenu'] as $key => $mainMenu)
        @if ($mainMenu['menu_id']==0 && $mainMenu['idad_menu']!=1)
        @if ($mainMenu['idad_menu']==$menus['idad_menu'])
        <li class="nav-item menu-open">
          <a href="" class="nav-link active">
          <i class="nav-icon fas fa-dot-circle"></i>
            <p>
              {{ $mainMenu['name'] }}
              <i class="right fas fa-angle-left"></i>
            </p>
          </a>

          <ul class="nav nav-treeview">
            @foreach ( $menus['allMenu'] as $subMenu )
            @if ( $subMenu['menu_id']==$mainMenu['idad_menu'] )
            <li class="nav-item">
              @if ( $subMenu['url'] == $menus['url'] )
              <a href="{{ route('dashboard.getMenu',['page'=>$subMenu['url'] ]) }}" class="nav-link active">
                <i class="far fa-circle nav-icon"></i>
                <p>{{ $subMenu['name'] }}</p>
              </a>
              @else
              <a href="{{ route('dashboard.getMenu',['page'=>$subMenu['url'] ]) }}" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>{{ $subMenu['name'] }}</p>
              </a>
              @endif

            </li>
            @endif
            @endforeach
          </ul>
        </li>
        @else
        <li class="nav-item">
          <a href="" class="nav-link">
          <i class="nav-icon fas fa-dot-circle"></i>
            <p>
              {{ $mainMenu['name'] }}
              <i class="right fas fa-angle-left"></i>
            </p>
          </a>

          <ul class="nav nav-treeview">
            @foreach ( $menus['allMenu'] as $subMenu )
            @if ( $subMenu['menu_id']==$mainMenu['idad_menu'] )
            <li class="nav-item">
              @if ( $subMenu['url'] == $menus['url'] )
              <a href="{{ route('dashboard.getMenu',['page'=>$subMenu['url'] ]) }}" class="nav-link active">
                <i class="far fa-circle nav-icon"></i>
                <p>{{ $subMenu['name'] }}</p>
              </a>
              @else
              <a href="{{ route('dashboard.getMenu',['page'=>$subMenu['url'] ]) }}" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>{{ $subMenu['name'] }}</p>
              </a>
              @endif

            </li>
            @endif
            @endforeach
          </ul>
        </li>
        @endif

        @elseif ( $mainMenu['idad_menu']==1 )
        @if ( $menus['url']=='home' )
        <li class="nav-item menu-open">
          <a href="{{ url('dashboard') }}" class="nav-link active">
          <i class="nav-icon fas fa-home"></i>
            <p>
              {{$mainMenu['name']}}
            </p>
          </a>
        </li>
        @else
        <li class="nav-item">
          <a href="{{ url('dashboard') }}" class="nav-link">
          <i class="nav-icon fas fa-home"></i>
            <p>
              {{$mainMenu['name']}}
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
