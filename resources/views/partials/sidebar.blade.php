<body>
  <nav class="sidebar close">
    <header>
      <div class="image-text">
        <span class="image">
          <img src="su/v.png" alt="">
        </span>
        <div class="text logo-text">
          <span class="name">habtamu bitew </span>
          <span class="profession">Admin {{ session('admin_id') }}</span>
        </div>
      </div>
      <i class='bx bx-chevron-right toggle'></i>
    </header>
    <div class="menu-bar">
      <div class="menu">
        <ul class="menu-links">
          <li class="nav-link">
            <a href="{{url('dashboard')}}">
              <i class='bx bx-home-alt icon'></i>
              <span class="text nav-text">Dashboard</span>
            </a>
          </li>
          <li class="nav-link">
            <a href="#">
              <i class='bx bx-home-alt icon'></i>
              <span class="text nav-text">My profile</span>
            </a>
          </li>
          <li class="nav-link">
            <a href="{{url('stakeholders')}}">
              <i class='bx bx-home-alt icon'></i>
              <span class="text nav-text">Stakeholders</span>
            </a>
          </li>
          <li class="nav-link">
            <a href="{{url('bosses')}}">
              <i class='bx bx-home-alt icon'></i>
              <span class="text nav-text">Bosses</span>
            </a>
          </li>
          <li class="nav-link">
            <a href="{{url('employees')}}">
              <i class='bx bx-home-alt icon'></i>
              <span class="text nav-text">Employees</span>
            </a>
          </li>
          <li class="nav-link">
            <a href="{{url('locations')}}">
              <i class='bx bx-home-alt icon'></i>
              <span class="text nav-text">Locations</span>
            </a>
          </li>
          <li class="nav-link">
            <a href="{{url('stakeholderLocations')}}">
              <i class='bx bx-home-alt icon'></i>
              <span class="text nav-text">Stake Locations</span>
            </a>
          </li>
          <li class="nav-link">
            <a href="#">
              <i class='bx bx-home-alt icon'></i>
              <span class="text nav-text">Employee Locations</span>
            </a>
          </li>
        </ul>
      </div>
      <div class="bottom-content">
        <li class="">
          <a href="{{url('logout')}}">
            <i class='bx bx-log-out icon'></i>
            <span class="text nav-text">Logout</span>
          </a>
        </li>
      </div>
    </div>
  </nav>