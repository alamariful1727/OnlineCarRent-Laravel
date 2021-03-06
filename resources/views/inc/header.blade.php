<!-- navbar-->
<header class="header">
  <nav class="navbar">
    <div class="container-fluid">
      <div class="navbar-holder d-flex align-items-center justify-content-between">
        <div class="navbar-header"><a id="toggle-btn" href="#" class="menu-btn"><i class="icon-bars"> </i></a>
          <a href="{{ route('home.index') }}" class="navbar-brand">
            <div class="brand-text d-none d-md-inline-block"><span>Online </span><strong class="text-primary">Car</strong><span>Rent</span></div>
          </a>
        </div>
        <ul class="nav-menu list-unstyled d-flex flex-md-row align-items-md-center">
          <!-- Notifications dropdown-->
          <li class="nav-item dropdown"> <a id="notifications" rel="nofollow" data-target="#" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"
              class="nav-link"><i class="fa fa-bell"></i><span class="badge badge-warning">12</span></a>
            <ul aria-labelledby="notifications" class="dropdown-menu">
              <li>
                <a rel="nofollow" href="#" class="dropdown-item">
                  <div class="notification d-flex justify-content-between">
                    <div class="notification-content"><i class="fa fa-envelope"></i>You have 6 new messages </div>
                    <div class="notification-time"><small>4 minutes ago</small></div>
                  </div>
                </a>
              </li>
              <li>
                <a rel="nofollow" href="#" class="dropdown-item">
                  <div class="notification d-flex justify-content-between">
                    <div class="notification-content"><i class="fa fa-twitter"></i>You have 2 followers</div>
                    <div class="notification-time"><small>4 minutes ago</small></div>
                  </div>
                </a>
              </li>
              <li>
                <a rel="nofollow" href="#" class="dropdown-item">
                  <div class="notification d-flex justify-content-between">
                    <div class="notification-content"><i class="fa fa-upload"></i>Server Rebooted</div>
                    <div class="notification-time"><small>4 minutes ago</small></div>
                  </div>
                </a>
              </li>
              <li>
                <a rel="nofollow" href="#" class="dropdown-item">
                  <div class="notification d-flex justify-content-between">
                    <div class="notification-content"><i class="fa fa-twitter"></i>You have 2 followers</div>
                    <div class="notification-time"><small>10 minutes ago</small></div>
                  </div>
                </a>
              </li>
              <li>
                <a rel="nofollow" href="#" class="dropdown-item all-notifications text-center"> 
                  <strong> <i class="fa fa-bell"></i>view all notifications</strong>
                </a>
              </li>
            </ul>
          </li>
          <!-- Log out-->
          <li class="nav-item">
            <a class="nav-link logout" href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();"><span class="d-none d-sm-inline-block">{{ __('Logout') }}</span><i class="fa fa-sign-out"></i>
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
              @csrf
            </form>
          </li>
        </ul>
      </div>
    </div>
  </nav>
</header>