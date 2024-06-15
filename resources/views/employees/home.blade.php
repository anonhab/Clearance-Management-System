@include('partial.header')
<body>
<nav class="sidebar close">
  <header>
    <div class="image-text">
      <span class="image">
        <img src="su/v.png" alt="">
      </span>
      <div class="text logo-text">
        <span class="name">habtamu bitew </span>
        <span class="profession">Web developer</span>
      </div>
    </div>
    <i class='bx bx-chevron-right toggle'></i>
  </header>
  <div class="menu-bar">
    <div class="menu">
      <ul class="menu-links">
        <li class="nav-link">
          <a href="{{route('home')}}">
            <i class='bx bx-home-alt icon'></i>
            <span class="text nav-text">Home</span>
          </a>
        </li>
        <li class="nav-link">
          <a href="#">
            <i class='bx bx-home-alt icon'></i>
            <span class="text nav-text">My profile</span>
          </a>
        </li>
        <li class="nav-link">
          <a href="{{route('show')}}">
            <i class='bx bx-home-alt icon'></i>
            <span class="text nav-text">My Clearance</span>
          </a>
        </li>
        <li class="nav-link">
          <a href="#">
            <i class='bx bx-home-alt icon'></i>
            <span class="text nav-text">Requirements</span>
          </a>
        </li>
        <li class="nav-link">
          <a href="#">
            <i class='bx bx-home-alt icon'></i>
            <span class="text nav-text">Help</span>
          </a>
        </li>
      </ul>
    </div>
    <div class="bottom-content">
      <li class="">
        <a href="#">
          <i class='bx bx-log-out icon'></i>
          <span class="text nav-text">Logout</span>
        </a>
      </li>
    </div>
  </div>
</nav>
<section class="home"><div class="text">Home Dashboard </div></section>
<script  src="su/script.js"></script>
</body>
</html>