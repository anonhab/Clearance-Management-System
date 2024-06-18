@include('partials.header')
@include('partials.sidebar')
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
            <h2><b>ADMINS</b></h2>
          </div>
          <div class="col-sm-6">
            <a href="#addAdminModal" class="btn btn-success" data-toggle="modal">
              <i class="material-icons">&#xE147;</i>
              <span>Add new ADMIN</span>
            </a>
          </div>
        </div>
      </div>
      <table class="table table-striped table-hover">
        <thead>
          <tr>
            <th>ID</th>
            <th>Full Name</th>
            <th>Email</th>
            <th>Created At</th>
            <th>Updated At</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($admins as $admin)
            <tr>
              <td>{{ $admin->id }}</td>
              <td>{{ $admin->full_name }}</td>
              <td>{{ $admin->email }}</td>
              <td>{{ $admin->created_at }}</td>
              <td>{{ $admin->updated_at }}</td>
              <td>
                <a href="#editAdminModal" class="edit" data-toggle="modal" data-id="{{ $admin->id }}">
                  <i class="material-icons" data-toggle="tooltip" title="Edit">&#xE254;</i>
                </a>
                <a href="#deleteAdminModal" class="delete" data-toggle="modal" data-id="{{ $admin->id }}">
                  <i class="material-icons" data-toggle="tooltip" title="Delete">&#xE872;</i>
                </a>
              </td>
            </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>

  <!-- Add Modal HTML -->
  <div id="addAdminModal" class="modal fade">
    <div class="modal-dialog">
      <div class="modal-content">
        <form action="{{ route('admin.store') }}" method="POST">
          @csrf <!-- CSRF protection -->
          <div class="modal-header">
            <h4 class="modal-title">Add New</h4>
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          </div>
          <div class="modal-body">
            <div class="form-group">
              <label for="full_name">Full Name</label>
              <input type="text" id="full_name" name="full_name" class="form-control" required>
            </div>
            <div class="form-group">
              <label for="email">Email</label>
              <input type="email" id="email" name="email" class="form-control" required>
            </div>
            <div class="form-group">
              <label for="password">Password</label>
              <input type="password" id="password" name="password" class="form-control" required>
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

  <!-- Delete Modal HTML -->
  <div id="deleteAdminModal" class="modal fade">
    <div class="modal-dialog">
      <div class="modal-content">
        <form id="deleteAdminForm" method="POST">
          @csrf
          @method('DELETE')
          <div class="modal-header">
            <h4 class="modal-title">Delete Admin</h4>
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          </div>
          <div class="modal-body">
            <p>Are you sure you want to delete the record with ID <span id="delete-admin-id"></span>?</p>
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

  <!-- Edit Modal HTML -->
  <div id="editAdminModal" class="modal fade">
    <div class="modal-dialog">
      <div class="modal-content">
        <form id="editAdminForm" method="POST">
          @csrf
          @method('PUT')
          <div class="modal-header">
            <h4 class="modal-title">Edit Admin</h4>
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          </div>
          <div class="modal-body">
            <input type="hidden" id="edit_id" name="id">
            <div class="form-group">
              <label for="edit_full_name">Full Name</label>
              <input type="text" id="edit_full_name" name="full_name" class="form-control" required>
            </div>
            <div class="form-group">
              <label for="edit_email">Email</label>
              <input type="email" id="edit_email" name="email" class="form-control" required>
            </div>
            <div class="form-group">
              <label for="edit_password">Password</label>
              <input type="password" id="edit_password" name="password" class="form-control">
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
</section>
</body>
<script>
  document.addEventListener('DOMContentLoaded', function() {
    var editButtons = document.querySelectorAll('.edit');
    editButtons.forEach(function(button) {
      button.addEventListener('click', function() {
        var id = button.getAttribute('data-id');
        var form = document.getElementById('editAdminForm');
        form.action = '/admin/' + id;
        var row = button.closest('tr');
        document.getElementById('edit_full_name').value = row.cells[1].innerText;
        document.getElementById('edit_email').value = row.cells[2].innerText;
      });
    });

    var deleteButtons = document.querySelectorAll('.delete');
    deleteButtons.forEach(function(button) {
      button.addEventListener('click', function() {
        var id = button.getAttribute('data-id');
        var form = document.getElementById('deleteAdminForm');
        form.action = '/admin/' + id;
        document.getElementById('delete-admin-id').innerText = id;
      });
    });
  });
</script>
<script src="su/script.js"></script>
</html>
