@include('partials.header')

<body>
    <nav class="sidebar close">
        <header>
            <div class="image-text">
                <span class="image">
                    <img src="{{ route('stake.image') }}" alt="Employee Image">>
                </span>
                <div class="text logo-text">
                    <span class="name">habtamu bitew </span>
                    <span class="profession">Stakeholder id {{ session('stakeholder_id') }}</span>
                    <span class="profession"> location id {{ session('stakeholderlocation_id') }}</span>
                </div>
            </div>
            <i class='bx bx-chevron-right toggle'></i>
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
                        <a href="{{url('stakeprofile')}}">
                            <i class='material-icons icon'>account_circle</i>
                            <span class="text nav-text">My profile</span>
                        </a>
                    </li>
                    <li class="nav-link">
                        <a href="{{url('stake')}}">
                            <i class='material-icons icon'>assignment</i>
                            <span class="text nav-text">Requested Form</span>
                        </a>
                    </li>
                    <li class="nav-link">
                        <a href="{{url('substakes')}}">
                            <i class='material-icons icon'>people</i>
                            <span class="text nav-text">Substake</span>
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
                        <h2><b>Substake</b></h2>
                    </div>
                    <div class="col-sm-6">
                        <a href="#addEmployeeModal" class="btn btn-success" data-toggle="modal"><i class="material-icons">&#xE147;</i> <span>Add new substake</span></a>
                    </div>
                </div>
            </div>
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th>Image</th>
                        <th>FullName</th>
                        <th>Workdep</th>
                        <th>Email</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($substakes as $stake)
                    <tr>
                        <td><img src="{{ route('sub.image', ['id' => $stake->SubstakesID]) }}" alt="image" style="width: 80px; height: 50px;"></td>
                        <td>{{$stake->FullName}}</td>
                        <td>{{$stake->Workdep}}</td>
                        <td>{{$stake->email}}</td>
                        <td>
                            <a href="#editEmployeeModal" class="edit" data-toggle="modal" data-id="{{ $stake->SubstakesID }}" data-fullname="{{ $stake->FullName }}" data-workdep="{{ $stake->Workdep }}" data-email="{{ $stake->email }}"><i class="material-icons" data-toggle="tooltip" title="Edit">&#xE254;</i></a>
                            <a href="#deleteEmployeeModal" class="delete" data-toggle="modal" data-id="{{ $stake->SubstakesID }}"><i class="material-icons" data-toggle="tooltip" title="Delete">&#xE872;</i></a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</section>

<!-- Add Substake Modal -->
<div id="addEmployeeModal" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ route('substakes.store') }}" method="POST" enctype="multipart/form-data">
                @csrf <!-- CSRF protection -->
                <div class="modal-header">
                    <h4 class="modal-title">New Substake</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="SubstakesID">SubstakesID</label>
                        <input type="text" id="SubstakesID" name="SubstakesID" class="form-control">
                    </div>
                    <input type="hidden" value="{{ session('stakeholderlocation_id') }}" id="StakeholderLocationID" name="StakeholderLocationID" class="form-control" required>
                    <div class="form-group">
                        <label for="FullName">Full Name</label>
                        <input type="text" id="FullName" name="FullName" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="Workdep">Work Department</label>
                        <input type="text" id="Workdep" name="Workdep" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="image">Image</label>
                        <input type="file" id="image" name="image" class="form-control">
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

<!-- Edit Substake Modal -->
<div id="editEmployeeModal" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="editEmployeeForm" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="modal-header">
                    <h4 class="modal-title">Update Substake</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="editSubstakesID">SubstakesID</label>
                        <input type="text" id="editSubstakesID" name="SubstakesID" class="form-control">
                    </div>
                    <input type="hidden" value="{{ session('stakeholderlocation_id') }}" id="editStakeholderLocationID" name="StakeholderLocationID" class="form-control" required>
                    <div class="form-group">
                        <label for="editFullName">Full Name</label>
                        <input type="text" id="editFullName" name="FullName" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="editWorkdep">Work Department</label>
                        <input type="text" id="editWorkdep" name="Workdep" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="editImage">Image</label>
                        <input type="file" id="editImage" name="image" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="editEmail">Email</label>
                        <input type="email" id="editEmail" name="email" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="editPassword">Password</label>
                        <input type="password" id="editPassword" name="password" class="form-control" required>
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

<!-- JavaScript to handle edit button click and populate the form -->

<!-- Delete Substake Modal -->
<div id="deleteEmployeeModal" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="deleteEmployeeForm" method="POST">
                @csrf
                @method('DELETE')
                <div class="modal-header">
                    <h4 class="modal-title">Delete Substake</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                </div>
                <div class="modal-body">
                <p>Are you sure you want to delete the record with ID <span id="delete-employee-id"></span>?
                    <p class="text-warning"><small>This action cannot be undone.</small></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                    <input type="submit" class="btn btn-danger" value="Delete">
                </div>
            </form>
        </div>
    </div>
</div>
<script>
    $(document).ready(function(){
        $('.edit').on('click', function() {
            var id = $(this).data('id');
            var fullname = $(this).data('fullname');
            var workdep = $(this).data('workdep');
            var email = $(this).data('email');

            $('#editEmployeeForm').attr('action', '/substakes/' + id);
            $('#editSubstakesID').val(id);
            $('#editFullName').val(fullname);
            $('#editWorkdep').val(workdep);
            $('#editEmail').val(email);
        });
    });
</script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
    var deleteButtons = document.querySelectorAll('.delete');
    deleteButtons.forEach(function(button) {
        button.addEventListener('click', function() {
            var id = button.getAttribute('data-id');
            document.getElementById('delete-employee-id').innerText = id;
            var form = document.getElementById('deleteEmployeeForm');
            form.action = '/substakes/' + id;
        });
    });
});
    </script>
    <script src="su/script.js"></script>
</body>

</html>