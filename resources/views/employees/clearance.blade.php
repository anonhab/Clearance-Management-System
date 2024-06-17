@include('partials.header')
<body>
<nav class="sidebar close">
  <header>
    <div class="image-text">
      <span class="image">
        <img src="su/v.png" alt="">
      </span>
      <div class="text logo-text">
        <span class="name">habtamu bitew </span>
        <span class="profession">Employee {{ session('employee_id') }}</span>
      </div>
    </div>
    <i class='bx bx-chevron-right toggle'></i>
  </header>
  <div class="menu-bar">
    <div class="menu">
      <ul class="menu-links">
        <li class="nav-link">
          <a href="#">
            <i class='bx bx-home-alt icon'></i>
            <span class="text nav-text">Home</span>
          </a>
        </li>
        <li class="nav-link">
          <a href="#">
            <i class='bx bx-home-alt icon'></i>
            <span class="text nav-text">My profile</span>
          </a>
        </li>
        <li class="nav-link">
          <a href="{{url('emp')}}">
            <i class='bx bx-home-alt icon'></i>
            <span class="text nav-text">Request Form</span>
          </a>
        </li>
        <li class="nav-link">
          <a href="{{url('clearance')}}">
            <i class='bx bx-home-alt icon'></i>
            <span class="text nav-text">My Clearance</span>
          </a>
        </li>
        <li class="nav-link">
          <a href="#">
            <i class='bx bx-home-alt icon'></i>
            <span class="text nav-text">Requirements</span>
          </a>
        </li>
        <li class="nav-link">
          <a href="#">
            <i class='bx bx-home-alt icon'></i>
            <span class="text nav-text">Help</span>
          </a>
        </li>
      </ul>
    </div>
    <div class="bottom-content">
      <li class="">
        <a href="{{url('/logout')}}">
          <i class='bx bx-log-out icon'></i>
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
                    <h2><b>Clearance Status</b></h2>
                </div>
                <div class="col-sm-6">
                  <td>
                    <a id="applyButton" href="#addEmployeeModal" class="btn btn-success" data-toggle="modal">
                        <i class="material-icons">&#xE147;</i> <span>Apply</span>
                    </a>
                </td>
                                </div>
            </div>
        </div>
        
        <table class="table table-striped table-hover">
          <thead>
              <tr> 
                  <th>Stakeholder </th>
                  <th>Location </th>
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
                    @foreach ($clearanceForms as $clearanceForm)
                    
                        <td>
                            @foreach ($clearanceApprovals as $cp)
                                @if ($cp->StakeholderLocationID == $stakeloc->StakeholderLocationID && $cp->ClearanceFormID == $clearanceForm->ClearanceFormID)
                                    @switch($cp->ApprovalStatus)
                                        @case('Approved')
                                            <a href="#addEmployeeModal" class="btn btn-success" data-toggle="modal">
                                                <span>{{ $cp->ApprovalStatus }}</span>
                                            </a>
                                            @break
                                        @case('Denied')
                                            <a href="#addEmployeeModal" class="btn btn-danger" data-toggle="modal">
                                                <span>{{ $cp->ApprovalStatus }}</span>
                                            </a>
                                            @break
                                        @case('Pending')
                                            <a href="#addEmployeeModal" class="btn btn-warning" data-toggle="modal">
                                                <span>{{ $cp->ApprovalStatus }}</span>
                                            </a>
                                            @break
                                        
                                    @endswitch
                                    
                                @endif
                            @endforeach
                            
                        </td>
                    @endforeach
                </tr>
            @endforeach
           
        </tbody>
        
    </div>
</div>

</section>
<div id="addEmployeeModal" class="modal fade">
  <div class="modal-dialog">
      <div class="modal-content">
          <form action="{{ route('clearanceFormApprovals.store') }}" method="POST">
              @csrf <!-- CSRF protection token -->

              <div class="modal-header">
                  <h4 class="modal-title">Apply New Clearance Form Approval</h4>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                  </button>
              </div>

              <div class="modal-body">
                  <label for="clearanceFormID">APPLY FOR ALL Stakeholders</label>
                  @foreach ($stakeholderLocations as $stakeloc)
                      <div class="form-group">
                          <input type="hidden" id="clearanceFormID" name="ClearanceFormID"
                                 value="{{ $clearanceForm->ClearanceFormID }}" class="form-control"
                                 readonly required>
                          <input type="hidden" name="ApprovalStatus" value="Pending">
                      </div>
                      <input type="hidden" name="StakeholderLocationID[]"
                             value="{{ $stakeloc->StakeholderLocationID }}">
                  @endforeach
              </div>

              <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                  <button id="applyButton" type="submit" class="btn btn-success">Applay for all</button>
              </div>
          </form>
      </div>
  </div>
</div>
<script  src="su/script.js"></script>
</html>