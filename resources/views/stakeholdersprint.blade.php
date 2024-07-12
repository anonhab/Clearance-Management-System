
@include('head');
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
        
        <div class="inv-title">

        <h3>Following Departmental Clearance Approved in order of Requester</h3>
        </div>
       
        <div class="inv-body">
            <table>
                <thead>
                    <tr>
                        <th>Departmental Clearances</th>
                        <th>Location</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($stakeholderLocations as $stakeloc)
                    <tr>
                        @php
                        $stakeholder = $stakeholders->firstWhere('StakeholderID', $stakeloc->StakeholderID);
                        $location = $locations->firstWhere('LocationID', $stakeloc->LocationID);
                        $stakeholderName = $stakeholder ? $stakeholder->Workdep : '';
                        $locationName = $location ? $location->LocationName : '';
                        @endphp
                        <td>{{ $stakeholderName }}</td>
                        <td>{{ $locationName }}</td>
                        <td>
                            @foreach ($clearanceForms as $clearanceForm)
                            @foreach ($clearanceApprovals as $cp)
                            @if ($cp->StakeholderLocationID == $stakeloc->StakeholderLocationID && $cp->ClearanceFormID == $clearanceForm->ClearanceFormID)
                            @switch($cp->ApprovalStatus)
                            @case('Approved')
                            <p class="btn btn-success btn-sm">
                                <span>{{ $cp->ApprovalStatus }}</span>
                                @php

                                @endphp
                            </p>
                            @break
                            @case('Denied')
                            <p class="btn btn-danger btn-sm">
                                <span>{{ $cp->ApprovalStatus }}</span>
                            </p>
                            @break
                            @case('Pending')
                            <p class="btn btn-warning btn-sm">
                                <span>{{ $cp->ApprovalStatus }}</span>
                            </p>
                            @break
                            @default
                            <p class="btn btn-secondary btn-sm">
                                <span>{{ $cp->ApprovalStatus }}</span>
                            </p>
                            @endswitch
                            @endif
                            @endforeach
                            @endforeach
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="inv-footer">
            <div></div>
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
    </script>
</body>

</html>