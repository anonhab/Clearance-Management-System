<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>Certificate</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;700&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="print.css" />
</head>

<body>
    <div class="container">
        <div class="inv-title">
            <h1>BahirDar University Clearance Form</h1>
        </div>
        <img src="./logo.png" class="inv-logo" alt="University Logo" />
        <div class="inv-header">
            
            <div>
                <h2>About Employee</h2>
                <ul>
                    <li>Full Name: {{$employees->FirstName}} {{$employees->LastName}}</li>
                    <li>File Number: {{$employees->File_number}}</li>
                    <li>Work Department: {{$employees->Workdep}}</li>
                    <li>Work Name: {{$employees->Workname}}</li>
                    @foreach($clearanceForms as $cl)
                    <li>Leaving Case: {{$cl->Leaving_case}}</li>
                    @endforeach
                </ul>
            </div>
            <div>
                <h2>Allowder Boss</h2>
                <ul>
                    @foreach($bossname as $cl)
                    @foreach($clearanceForms as $clf)
                    @if($cl->BossID==$clf->BossID)
                    <li>Boss ID Number: {{$cl->BossID}}</li>
                    <li>Full Name: {{$cl->Full_name}}</li>
                    <li>Responsibility: {{$cl->Responsibility}}</li>
                    @endif
                    @endforeach
                    @endforeach
                   
                </ul>
            </div>
        </div>
        <div class="inv-body">
            <table>
                <thead>
                    <tr>
                        <th>Stakeholders</th>
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
    <div class="print-button no-print">
        <button onclick="window.print()">Print</button>
    </div>
    <script>
        function printPage() {
            window.print();
        }
    </script>
</body>

</html>