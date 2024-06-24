@include('partials.header')

<head>
  <style>
    body {
      font-family: 'Poppins', sans-serif;
      background-color: #f6f6f9;
      color: #677483;
      margin: 0;
      padding: 0;
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
    }

    .container {
      max-width: 800px;
      background-color: #fff;
      padding: 40px;
      border-radius: 20px;
      box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
    }

    h1 {
      font-size: 2rem;
      font-weight: 800;
      color: #7380ec;
      margin-bottom: 20px;
      text-align: center;
    }

    .info-section {
      margin-top: 30px;
    }

    h2 {
      font-size: 1.5rem;
      color: #111e88;
      margin-bottom: 10px;
    }

    p {
      font-size: 1rem;
      line-height: 1.6;
      margin-bottom: 20px;
    }
  </style>
</head>

<body>
  <nav class="sidebar close">
    <header>
      <div class="image-text">
        <span class="image">
          <img src="su/v.png" alt="">
        </span>
        <div class="text logo-text">
          <span class="name">habtamu bitew</span>
          <span class="profession">Employee {{ session('employee_id') }}</span>
        </div>
      </div>
      <i class='material-icons toggle'>chevron_right</i>
    </header>
    <div class="menu-bar">
      <div class="menu">
        <ul class="menu-links">
          <li class="nav-link">
            <a href="#">
              <i class='material-icons icon'>home</i>
              <span class="text nav-text">Home</span>
            </a>
          </li>
          <li class="nav-link">
            <a href="{{url('profile')}}">
              <i class='material-icons icon'>account_circle</i>
              <span class="text nav-text">My profile</span>
            </a>
          </li>
          <li class="nav-link">
            <a href="{{url('emp')}}">
              <i class='material-icons icon'>assignment</i>
              <span class="text nav-text">Request Form</span>
            </a>
          </li>
          <li class="nav-link">
            <a href="{{url('clearance')}}">
              <i class='material-icons icon'>check_circle</i>
              <span class="text nav-text">My Clearance</span>
            </a>
          </li>
          <li class="nav-link">
            <a href="{{url('clearance-info')}}">
              <i class='material-icons icon'>info</i>
              <span class="text nav-text">Requirements</span>
            </a>
          </li>

        </ul>
      </div>
      <div class="bottom-content">
        <li class="">
          <a href="{{url('/logout')}}">
            <i class='material-icons icon'>logout</i>
            <span class="text nav-text">Logout</span>
          </a>
        </li>
      </div>
    </div>
  </nav>

  <section class="home">
    <div class="container">
      <h1>Employee Clearance Process</h1>
      <div class="info-section">
        <h2>Step 1: Request Approval from Your Boss</h2>
        <p>To start the clearance process, you need to get approval from your immediate boss. This involves submitting a formal request for approval, which should include your details and the reason for the clearance.</p>

        <h2>Step 2: Await Approval</h2>
        <p>Once the request is submitted, wait for your boss to review and approve your request. This might take some time, depending on your boss's schedule and workload.</p>

        <h2>Step 3: Obtain the Clearance Form</h2>
        <p>If your boss approves your request, you will be provided with a clearance form. This form will include all necessary details about your clearance.</p>

        <h2>Step 4: Send the Clearance Form to Stakeholders</h2>
        <p>Finally, send the approved clearance form to the relevant stakeholders for final approval. Ensure that all required information is filled out correctly to avoid any delays.</p>
      </div>
    </div>
  </section>
  <script src="su/script.js"></script>
</body>

</html>