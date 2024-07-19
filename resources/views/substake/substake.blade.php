@include('partials.header')
<body>
<nav class="sidebar close">
    <header>
      <div class="image-text">
        <span class="image">
         
        <img src="{{ route('sub.image') }}" alt="Employee Image">

        </span>
        <div class="text logo-text">
          <span class="name">habtamu bitew</span>
          <span class="profession">Sub Employee {{ session('boss_id') }}</span>
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
            <a href="{{url('subprofile')}}">
              <i class='material-icons icon'>account_circle</i>
              <span class="text nav-text">My profile</span>
            </a>
          </li>
          <li class="nav-link">
            <a href="{{url('subs')}}">
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
                        <h2><b>Clearance Form Requested Status</b></h2>
                    </div>
                </div>
            </div>
            <table class="table table-striped table-hover">
                @if(count($subapproval) > 0)
                <thead>
                    <tr>
                        <th>ClearanceForm</th>
                        <th>Review</th>
                        <th>Request Date</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($subapproval as $cl)
                    <tr>
                        <td>
                            <a href="{{ route('clean_update.show', $cl->ClearanceFormID) }}">
                                <i class="material-icons">visibility</i> View
                            </a>
                        </td>
                        <td>{{$cl->Comments}}</td>
                        <td>{{$cl->created_at}}</td>
                        <td>{{$cl->ApprovalStatus}}</td>
                        <td>
                            <a href="#editEmployeeModal" class="edit" data-toggle="modal" data-id="{{ $cl->ApprovalID }}">
                                <i class="material-icons" data-toggle="tooltip" title="Edit">edit</i>
                            </a>
                        </td>
                    </tr>
                    @endforeach
                @else
                    <tr>
                        <td style="background-color: rgb(146, 125, 125); color: aliceblue;" colspan="5">
                            <i class="material-icons">info</i> No data found
                        </td>
                    </tr>
                @endif
                </tbody>
            </table>
        </div>
    </div>
</section>


<div id="editEmployeeModal" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="editEmployeeForm" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-header">
                    <h4 class="modal-title">Update the status</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="Status">Status</label>
                        <select id="Status" name="Status" class="form-control" required>
                            <option value="Pending">Pending</option>
                            <option value="Approved">Approved</option>
                            <option value="Denied">Denied</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                    <input type="submit" class="btn btn-info" value="Save">
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        var editButtons = document.querySelectorAll('.edit');
        editButtons.forEach(function(button) {
            button.addEventListener('click', function() {
                var id = button.getAttribute('data-id');
                var form = document.getElementById('editEmployeeForm');
                form.action = '/subs/' + id; // Sets the action dynamically
                var row = button.closest('tr');
                var status = row.cells[1].innerText; // Adjust the cell index as necessary
                document.getElementById('Status').value = status;
            });
        });
    });
</script>
    <script src="su/script.js"></script>
</body>

</html>
