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
                        <a href="#">
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
                            <h2><b>Clearance Approval Requested Status</b></h2>
                        </div>
                        <div class="col-sm-6">
                        </div>
                    </div>
                </div>
                <table class="table table-striped table-hover">
                    <thead>
                        @if(count($clearanceApproval) > 0)
                        <tr>
                            <th>ClearanceFormID</th>
                            <th>ApprovalDate</th>
                            <th>RequestDate</th>
                            <th>ApprovalStatus</th>
                            <th>Comments</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($clearanceApproval as $cl)
                        <tr>
                            <td><a href="{{ route('clean_update.show', $cl->ClearanceFormID) }}">View</a></td>
                            <td>{{$cl->updated_at}}</td>
                            <td>{{$cl->created_at}}</td>
                            <td>{{$cl->ApprovalStatus}}</td>
                            <td>{{$cl->Comments}}</td>
                            <td>
                                <a href="#editEmployeeModal" class="edit" data-toggle="modal" data-id="{{ $cl->ApprovalID }}"><i class="material-icons" data-toggle="tooltip" title="Edit">&#xE254;</i></a>
                            </td>
                        </tr>
                        @endforeach
                        @else

                        <h3 style="background-color: rgba(11, 46, 83, 0.872);color:aliceblue; width:180px; " colspan="5">No data found</h3>

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
                            <select id="ApprovalStatus" name="ApprovalStatus" class="form-control" required>
                                <option value="Pending">Pending</option>
                                <option value="Approved">Approved</option>
                                <option value="Denied">Denied</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="leaving_case">Comment</label>
                            <input type="Comment" id="Comment" name="Comments" class="form-control" required>
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
                    form.action = '/cleanapp_update/' + id;
                    var row = button.closest('tr');
                    // Assuming you want to display the current status in the modal
                    var status = row.cells[3].innerText;
                    var status2 = row.cells[4].innerText;
                    document.getElementById('ApprovalStatus').value = status;
                    document.getElementById('Comment').value = status2;
                });
            });
        });
        //         document.getElementById('replaceButton').addEventListener('click', function() {
        //             const clearanceForm = {
        //          ClearanceFormID: $c,
        //          EmployeeID: 456,
        //          BossID: 789,
        //          Leaving_case: 'Resigned',
        //         RequestDate: '2024-06-01',
        //         Status: 'Approved',
        //         created_at: '2024-06-10'
        //     };

        //     const content = document.getElementById('content');
        //     content.innerHTML = `
        //         <div class="container">
        //             <div class="employee-details">
        //                 <h2>Clearance Information</h2>
        //                 <ul class="employee-list">
        //                     <li><strong>ID:</strong> ${clearanceForm.ClearanceFormID}</li>
        //                     <li><strong>Employee ID number:</strong> ${clearanceForm.EmployeeID} <a href="/employees/show/${clearanceForm.EmployeeID}">View</a></li>
        //                     <li><strong>Boss ID:</strong> ${clearanceForm.BossID}</li>
        //                     <li><strong>Leaving case:</strong> ${clearanceForm.Leaving_case}</li>
        //                     <li><strong>Requested Date:</strong> ${clearanceForm.RequestDate}</li>
        //                     <li><strong>Status:</strong> ${clearanceForm.Status}</li>
        //                     <li><strong>Registered date:</strong> ${clearanceForm.created_at}</li>
        //                 </ul>
        //             </div>
        //         </div>
        //     `;
        // });
    </script>
    <script src="su/script.js"></script>
</body>

</html>