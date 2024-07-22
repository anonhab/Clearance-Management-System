<body>
<nav class="sidebar close">
  <header>
    <div class="image-text">
      <span class="image">
        <img src="su/v.png" alt="">
      </span>
      <div class="text logo-text">
        <span class="name">habtamu bitew</span>
        <span class="profession">Admin {{ session('admin_id') }}</span>
      </div>
    </div>
    <i class='material-icons toggle'>chevron_right</i>
  </header>
  <div class="menu-bar">
    <div class="menu">
      <ul class="menu-links">
      <li class="nav-link">
          <a href="{{url('/')}}">
          <i class='material-icons icon'>home</i>
          <span class="text nav-text">Home</span>
          </a>
        </li>
        <li class="nav-link">
          <a href="{{url('dashboard')}}">
            <i class='material-icons icon'>dashboard</i>
            <span class="text nav-text">Dashboard</span>
          </a>
        </li>
        
        <li class="nav-link">
          <a href="#">
            <i class='material-icons icon'>account_circle</i>
            <span class="text nav-text">My profile</span>
          </a>
        </li>
        <li class="nav-link">
          <a href="{{url('stakeholders')}}">
            <i class='material-icons icon'>people</i>
            <span class="text nav-text">Stakeholders</span>
          </a>
        </li>
        <li class="nav-link">
          <a href="{{url('bosses')}}">
            <i class='material-icons icon'>supervisor_account</i>
            <span class="text nav-text">Bosses</span>
          </a>
        </li>
        <li class="nav-link">
          <a href="{{url('employees')}}">
            <i class='material-icons icon'>group</i>
            <span class="text nav-text">Employees</span>
          </a>
        </li>
        <li class="nav-link">
          <a href="{{url('locations')}}">
            <i class='material-icons icon'>location_on</i>
            <span class="text nav-text">Locations</span>
          </a>
        </li>
        <li class="nav-link">
          <a href="{{url('stakeholderLocations')}}">
            <i class='material-icons icon'>place</i>
            <span class="text nav-text">Stake Locations</span>
          </a>
        </li>
      </ul>
    </div>
    <div class="bottom-content">
      <li class="">
        <a href="{{url('logout')}}">
          <i class='material-icons icon'>logout</i>
          <span class="text nav-text">Logout</span>
        </a>
      </li>
    </div>
  </div>
</nav>
