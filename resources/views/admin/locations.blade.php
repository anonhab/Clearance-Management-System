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
              <h2><b>Locations</b></h2>
            </div>
            <div class="col-sm-6">
              <a href="#addEmployeeModal" class="btn btn-success" data-toggle="modal"><i class="material-icons">&#xE147;</i> <span>Add new Location</span></a>
            </div>
          </div>
        </div>
        <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Location name</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($locations as $si)
                        <tr>
                            <td>{{ $si->LocationID }}</td>
                            <td>{{ $si->LocationName }}</td>
                            <td>
                                <a href="#editEmployeeModal" class="edit" data-toggle="modal"
                                    data-id="{{ $si->LocationID }}"><i class="material-icons" data-toggle="tooltip"
                                        title="Edit">&#xE254;</i></a>
                                <a href="#deleteEmployeeModal" class="delete" data-toggle="modal"
                                    data-id="{{ $si->LocationID }}"><i class="material-icons" data-toggle="tooltip"
                                        title="Delete">&#xE872;</i></a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
      </div>
    </div>
    <!-- Add Modal HTML -->
    <div id="addEmployeeModal" class="modal  fade">
      <div class="modal-dialog">
        <div class="modal-content">
          <form action="{{url('locations')}}" method="POST">
            @csrf <!-- CSRF protection -->
            <div class="modal-header">
              <h4 class="modal-title">Add New</h4>
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            </div>
            <div class="modal-body">
              <div class="form-group">
                <label for="worker_name">Work Location</label>
                <input type="text" id="Workdep" name="LocationName" class="form-control" required>
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
    <div id="deleteEmployeeModal" class="modal  ">
      <div class="modal-dialog">
        <div class="modal-content">
          <form id="deleteEmployeeForm" method="POST">
            @csrf
            @method('DELETE')
            <div class="modal-header">
              <h4 class="modal-title">Delete Location</h4>
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
    <div id="editEmployeeModal" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <form id="editEmployeeForm" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="modal-header">
                        <h4 class="modal-title">Edit Location</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" id="edit_id" name="id">
                        <div class="form-group">
                            <label for="edit_full_name">Work Location</label>
                            <input type="text" id="edit_full_name" name="LocationName" class="form-control" required>
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
			var form = document.getElementById('editEmployeeForm');
			form.action = '/locations/' + id;
			var row = button.closest('tr');
			document.getElementById('edit_full_name').value = row.cells[1].innerText;
		});
	});
});
document.addEventListener('DOMContentLoaded', function() {
	var deleteButtons = document.querySelectorAll('.delete');
	deleteButtons.forEach(function(button) {
		button.addEventListener('click', function() {
			var id = button.getAttribute('data-id');
			var form = document.getElementById('deleteEmployeeForm');
			form.action = '/locations/' + id; // This sets the form action URL to /ses/{id}
			// Set the ID in the confirmation message
			document.getElementById('delete-employee-id').innerText = id;
		});
	});
});
  </script>
<script  src="su/script.js"></script>
</html>