@include('partials.header')

<body>
  <nav class="sidebar close">
    <header>
      <div class="image-text">
        <span class="image">
         
        <img src="{{ route('boss.image') }}" alt="Employee Image">

        </span>
        <div class="text logo-text">
          <span class="name">habtamu bitew</span>
          <span class="profession">BOSS {{ session('boss_id') }}</span>
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
            <a href="{{url('bossprofile')}}">
              <i class='material-icons icon'>account_circle</i>
              <span class="text nav-text">My profile</span>
            </a>
          </li>
          <li class="nav-link">
            <a href="{{url('boss')}}">
              <i class='material-icons icon'>assignment</i>
              <span class="text nav-text">Requested Form</span>
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
    <div class="conprofile">
      <div class="profile-box">
        @if (session('success'))
        <div class="alert alert-success">
          {{ session('success') }}
        </div>
        @endif
        @if ($errors->any())
        <div class="alert alert-danger">
          <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
          </ul>
        </div>
        @endif
        <div class="center">
          <img src="{{ route('boss.image') }}" class="pimg" alt="Employee Image">
        </div>
        <div class="profile-info">

          <h3>Name:</h3>
          <div class="value">{{ $boss->Full_name }}</div>

          <h3>Responsibility:</h3>
          <div class="value">{{ $boss->Responsibility }}</div>

          <h3>Email:</h3>
          <div class="value">{{ $boss->Email }}</div>

          <h3>Password:</h3>
          <div class="value">*******</div>
        </div>
        <div class="center" style="margin-top: 25px;">
          <button data-toggle="modal" data-target="#changePasswordModal" class="upbtn">Change Password</button>
        </div>
      </div>
    </div>
  </section>

  <!-- Change Password Modal -->
  <div id="changePasswordModal" class="modal fade">
    <div class="modal-dialog">
      <div class="modal-content">
        <form action="{{ route('bosschangepassword') }}" method="POST">
          @csrf <!-- CSRF protection -->
          <div class="modal-header">
            <h4 class="modal-title">Change Password</h4>
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          </div>
          <div class="modal-body">
            <div class="form-group">
              <label for="current_password">Current Password</label>
              <input type="password" id="current_password" name="current_password" class="form-control" required>
            </div>
            <div class="form-group">
              <label for="new_password">New Password</label>
              <input type="password" id="new_password" name="new_password" class="form-control" required>
            </div>
            <div class="form-group">
              <label for="confirm_password">Confirm New Password</label>
              <input type="password" id="confirm_password" name="confirm_password" class="form-control" required>
            </div>
            <input type="hidden" name="EmployeeID" value="{{ session('employee_id') }}">
            <input type="hidden" name="Status" value="pending">
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
            <input type="submit" class="btn btn-success" value="Change Password">
          </div>
        </form>
      </div>
    </div>
  </div>
</body>
<script>
  document.addEventListener('DOMContentLoaded', function() {
    var deleteButtons = document.querySelectorAll('.delete');
    deleteButtons.forEach(function(button) {
      button.addEventListener('click', function() {
        var id = button.getAttribute('data-id');
        var form = document.getElementById('deleteEmployeeForm');
        form.action = '/clearanceForms/' + id;

        document.getElementById('delete-employee-id').innerText = id;
      });
    });
  });
</script>
<script src="su/script.js"></script>
</body>

</html>