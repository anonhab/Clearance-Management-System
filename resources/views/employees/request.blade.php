@include('partials.header')

<body>
<nav class="sidebar close">
  <header>
    <div class="image-text">
      <span class="image">
      <img src="{{ route('employee.image') }}" alt="Employee Image">
      </span>
      <div class="text logo-text">
        <span class="name">habtamu bitew</span>
        <span class="profession">
          Employee {{ session('employee_id') }}
        </span>
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
        @foreach($clearanceForm as $cl)
                    @if($cl->Status=="Approved")
                    <li class="nav-link">
                        <a href="{{url('clearance')}}">
                            <i class='material-icons icon'>check_circle</i>
                            <span class="text nav-text">My Clearance</span>
                            <span style="background-color: red;" class="badge badge-danger">1</span>
                        </a>
                    </li>
                    @endif
                    @endforeach
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

  <div id="addEmployeeModal" class="modal  fade">
    <div class="modal-dialog">
      <div class="modal-content">
        <form action="{{route('clearanceForms.store')}}" method="POST">
          @csrf <!-- CSRF protection -->
          <div class="modal-header">
            <h4 class="modal-title">New request for clearance form</h4>
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          </div>
          <div class="modal-body">
            <div class="form-group">
              <label for="EmployeeID">EmployeeID</label>
              <input type="text" id="EmployeeID" name="EmployeeID" value="{{ session('employee_id') }}" class="form-control" readonly required>
            </div>

            <div class="form-group">
              <label for="BossID">BossID</label>
              <select readonly  id="BossID" name="BossID" class="form-control" required>
                
                <option value="{{$boss->BossID}}">{{$boss->BossID}}-> {{$boss->Full_name}}</option>
              </select>
            </div>
            <div class="form-group">
              <label for="leaving_case">Reason for Departure</label>
              <input type="text" id="leaving_case" name="Leaving_case" class="form-control" required>
              <input type="hidden" id="leaving_case" name="Status" value="pending" class="form-control">
            </div>

          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
            <input type="submit" class="btn btn-success" value="Request">
          </div>
        </form>
      </div>
    </div>
  </div>
  <section class="home">
    @if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
  @elseif(session('error'))
    <div class="alert alert-danger">{{ session('error') }}</div>
  @endif
    <div class="container">
      <div class="table-wrapper">
        <div class="table-title">
          <div class="row">
            <div class="col-sm-6">
              <!-- employee bosses clearanceform -->
              <h2><b>Clearance Form Request Status</b></h2>
            </div>
            <div class="col-sm-6">
            </div>
            <div class="col-sm-6">
            @if(count($clearanceForm) == 0)
              <a href="#addEmployeeModal" class="btn btn-success" data-toggle="modal"><i class="material-icons">&#xE147;</i> <span>New Request</span></a>
              @endif
            </div>
          </div>
        </div>
        <table class="table table-striped table-hover">
    @if(count($clearanceForm) > 0)
        <thead>
            @foreach ($clearanceForm as $cl)
                @if($cl->Status == 'Approved')
                    <tr>
                        <th colspan="5">Your boss approves your requests 👍. See the clearance page, please 📄.</th>
                    </tr>
                    @break
                @endif
            @endforeach
            @foreach ($clearanceForm as $cl)
            @if($cl->Status != 'Approved')
            <tr>
                <th>BossID</th>
                <th>Reason for Departure</th>
                <th>Request Date</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
            @endif
            @endforeach
        </thead>
        <tbody>
            @foreach ($clearanceForm as $cl)
                @if($cl->Status != 'Approved')
                    <tr>
                        <td>{{ $cl->BossID }}</td>
                        <td>{{ $cl->Leaving_case }}</td>
                        <td>{{ $cl->created_at }}</td>
                        <td>{{ $cl->Status }}</td>
                        <td>
                            <a href="#deleteEmployeeModal" class="delete" data-toggle="modal" data-id="{{ $cl->ClearanceFormID }}">
                                <i class="material-icons" data-toggle="tooltip" title="Delete">&#xE872;</i>
                            </a>
                        </td>
                    </tr>
                @endif
            @endforeach
        </tbody>
    @else
        <tbody>
            <tr>
                <td style="background-color: rgb(146, 125, 125); color: aliceblue;" colspan="5">No data found. Request New</td>
            </tr>
        </tbody>
    @endif
</table>

      </div>
    </div>
  </section>
  <!-- Delete Modal HTML -->
  <div id="deleteEmployeeModal" class="modal  ">
    <div class="modal-dialog">
      <div class="modal-content">
        <form id="deleteEmployeeForm" method="POST">
          @csrf
          @method('DELETE')
          <div class="modal-header">
            <h4 class="modal-title">Delete Boss</h4>
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          </div>
          <div class="modal-body">
            <p>Are you sure you want to delete the record with ID <span id="delete-employee-id"></span>?
            </p>
            <p class="text-warning"><small>This action cannot be undone.</small></p>
          </div>
          <div class="modal-footer">
            <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
            <input type="submit" class="btn btn-danger" value="Delete">
          </div>
        </form>
      </div>
    </div>
  </div>
  </section>
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