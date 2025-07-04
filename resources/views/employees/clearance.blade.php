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
          <span class="profession">Employee {{ session('employee_id') }}</span>
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
          <li class="nav-link">
            <a href="{{url('clearance')}}">
              <i class='material-icons icon'>check_circle</i>
              <span class="text nav-text">My Clearance</span>
            </a>
          </li>
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
            @foreach($clearanceForms as $clear)
            @if($clear->hasRequest=='Approved')
            <div class="col-sm-6 text-right">
             
              <button  class="btn btn-success" >
                 No need to Apply
              </button>
            </div>
            @else
            <div class="col-sm-6 text-right">
              <button id="applyButton" class="btn btn-success" data-toggle="modal" data-target="#addEmployeeModal">
                <i class="material-icons">&#xE147;</i> Apply
              </button>
            </div> 
            @endif
            @endforeach
          </div>
        </div>
        @php
        $count =0;
        $stakecount=0;
        @endphp

        <table class="table table-striped table-hover table-bordered">
          <thead class="thead-dark">
            <tr>
              <th scope="col">Departmental Clearances</th>
              <th scope="col">Location</th>
              <th scope="col">Status</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($stakeholderLocations as $stakeloc)
            @if ($stakeloc->Priority !== 'HIGH')
            <tr>
              @php
              $stakeholder = $stakeholders->firstWhere('StakeholderID', $stakeloc->StakeholderID);
              $location = $locations->firstWhere('LocationID', $stakeloc->LocationID);
              $stakeholderName = $stakeholder ? $stakeholder->Workdep : '';
              $locationName = $location ? $location->LocationName : '';
              $stakecount++;
              @endphp
              <td>{{ $stakeholderName }}</td>
              <td>{{ $locationName }}</td>
              <td>
                @foreach ($clearanceForms as $clearanceForm)
                @foreach ($clearanceApprovals as $cp)
                @if ($cp->StakeholderLocationID == $stakeloc->StakeholderLocationID && $cp->ClearanceFormID == $clearanceForm->ClearanceFormID)
                @switch($cp->ApprovalStatus)
                @case('Approved')
                <button class="btn btn-success btn-sm">
                  <span>{{ $cp->ApprovalStatus }}</span>
                  @php $count++ @endphp
                </button>
                @break
                @case('Denied')
                <button class="btn btn-danger btn-sm">
                  <span>{{ $cp->ApprovalStatus }}</span>
                </button>
                @break
                @case('Pending')
                <button class="btn btn-warning btn-sm">
                  <span>{{ $cp->ApprovalStatus }}</span>
                </button>
                @break
                @default
                <button class="btn btn-secondary btn-sm">
                  <span>{{ $cp->ApprovalStatus }}</span>
                </button>
                @endswitch
                @endif
                @endforeach
                @endforeach
              </td>
            </tr>
            @endif
            @endforeach
          </tbody>

        </table>
      </div>
      @if($count==$stakecount)
      @foreach($clearanceForms as $clear)
      @if($clear->hasRequest=='true')
      <div class="btn" class="text nav-text"><button class="btn btn-warning btn-sm"><b>Waiting for Review</b></button></div>
      @elseif($clear->hasRequest=='Approved')
<div class="nav-text">
  <button class="btn btn-success btn-sm">
    <a href="{{url('print')}}">
      <b>Congrats, you can leave now and get certificate!</b>
    </a>
  </button>
</div>      @else
      <div class="btn" class="text nav-text"><button class="btn btn-success btn-sm"> <a href="{{url('hasrequest')}}"> <b>Send for Review</b></a></button></div>

      @endif
      @endforeach
      @endif
      @if($count!=$stakecount)
      <div class="btn" class="text nav-text"><button class="btn btn-warning btn-sm"><b>Waiting for Generate Certificate </b></button></div>
      @endif
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
            @if ($stakeloc->Priority !== 'HIGH')
            <div class="form-group">
              <input type="hidden" id="clearanceFormID" name="ClearanceFormID" value="{{ $clearanceForm->ClearanceFormID }}" class="form-control" readonly required>
              <input type="hidden" name="ApprovalStatus" value="Pending">
              <input type="hidden" name="StakeholderLocationID[]" value="{{ $stakeloc->StakeholderLocationID }}">
            </div>
            @endif
            @endforeach
          </div>

          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
            <button id="applyButton" type="submit" class="btn btn-success">Apply for all</button>
          </div>
        </form>

      </div>
    </div>
  </div>
  <script src="su/script.js"></script>

  </html>