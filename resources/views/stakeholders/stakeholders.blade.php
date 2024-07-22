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
                            <h2><b>Clearance Approval Requested Status</b></h2>
                        </div>
                        <div class="col-sm-6">
                        </div>
                    </div>
                </div>
                @if ($stake->Priority=='HIGH')
                <table class="table table-striped table-hover">
                    <thead>

                        <tr>

                            <th>ClearanceForm</th>
                            <th>Requester</th>
                            <th>Check</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($hasrequest as $request)
                        <tr>
                            <td>
                                <a href="{{ route('clean_update.show', $request->ClearanceFormID) }}">
                                    <i class="material-icons">visibility</i> View
                                </a>
                            </td>
                            <td>
                                <a href="{{ route('employees.show', $request->EmployeeID) }}">
                                    <i class="material-icons">visibility</i> View
                                </a>
                            </td>
                            <td>
                                <a href="{{ route('set-employee-id-in-session', $request->EmployeeID) }}/" class="btn btn-primary">View Request</a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                @else
                <table class="table table-striped table-hover">
                    <thead>
                        @if(count($clearanceApproval) > 0)
                        <tr>
                            <th>ClearanceFormID</th>
                            <th>RequestDate</th>
                            <th>Substake status</th>
                            <th>ApprovalStatus</th>
                            <th>Comments</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($clearanceApproval as $cl)
                        <tr>
                            <td><a href="{{ route('clean_update.show', $cl->ClearanceFormID) }}">View</a></td>
                            <td>{{$cl->created_at}}</td>
                            @php
                            $cont = $substakeapproval->filter(function($item) {
                            return $item->ApprovalStatus == "Approved";
                            })->count();
                            $cont1 = count($substakeapproval);
                            @endphp

                            @if ($cont1 == $cont && $cont1 > 0)
                            <td><button class="btn btn-success btn-sm">Approved</button></td>
                            @elseif ($cont1 == 0)
                            <td><button class="btn btn-warning btn-sm">NOT SEND</button></td>
                            @else

                            <td><button class="btn btn-warning btn-sm">Waiting</button></td>
                            @endif
                            <td>{{$cl->ApprovalStatus}}</td>
                            <td>{{ $cl->Comments }}</td>
                            <td>
                                <form action="{{ route('substakeapprovals.store') }}" method="POST">
                                    @csrf <!-- CSRF protection token -->
                                    @foreach ($substake as $stake)
                                    <input type="hidden" name="ClearanceFormID" value="{{ $cl->ClearanceFormID }}" class="form-control" readonly required>
                                    <input type="hidden" name="ApprovalStatus" value="Pending">
                                    <input type="hidden" name="SubstakesID[]" value="{{ $stake->SubstakesID }}">
                                    <input type="hidden" name="StakeholderLocationID[]" value="{{ $stake->StakeholderLocationID }}">
                                    @endforeach
                                    @if(count($substakeapproval) == 0)
                                    <button id="applyButton" type="submit" class="btn btn-success btn-sm">Send for Review</button>
                                    @elseif ($cont1 == $cont && $cont1 > 0)
                                    <a href="#editEmployeeModal" class="edit" data-toggle="modal" data-id="{{ $cl->ApprovalID }}"> <button id="applyButton" type="submit" class="btn btn-success">Update Review</button></a>
                                    @else

                                    <button class="btn btn-warning btn-sm">Waiting</button>
                                    @endif
                                </form>

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
                @endif
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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
        function setEmployeeIdInSession(employeeId) {
            $.ajax({
                type: 'POST',
                url: '/set-employee-id-in-session',
                data: {
                    employeeId: employeeId
                },
                success: function(data) {
                    console.log('Employee ID set in session successfully!');
                }
            });
        }
    </script>
    <script src="su/script.js"></script>
</body>

</html>