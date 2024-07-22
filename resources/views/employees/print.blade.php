<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>Clearance Letter</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;700&display=swap" rel="stylesheet" />
    <style>
        body {
            font-family: "Inter", sans-serif;
            margin: 0;
            background-color: #f9f9f9;
            color: #333;
        }

        .container {
            padding: 20px 0;
            width: 1000px;
            max-width: 90%;
            margin: 0 auto;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .inv-title {
            padding: 20px;
            border-bottom: 1px solid #ddd;
            text-align: center;
            background-color: #f1f1f1;
        }

        .inv-logo {
            width: 150px;
            display: block;
            margin: 20px auto;
        }

        .inv-header {
            display: flex;
            justify-content: space-between;
            padding: 20px;
            border-bottom: 1px solid #ddd;
        }

        .inv-header h2 {
            font-size: 20px;
            margin-bottom: 10px;
        }

        .inv-header ul {
            list-style: none;
            padding: 0;
        }

        .inv-header ul li {
            font-size: 16px;
            margin-bottom: 5px;
        }

        .inv-body {
            padding: 20px;
        }

        .inv-body table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        .inv-body table th,
        .inv-body table td {
            text-align: left;
            padding: 12px;
            border: 1px solid #ddd;
        }

        .inv-body table th {
            background-color: #f1f1f1;
        }

        .inv-footer {
            display: flex;
            justify-content: space-between;
            padding: 20px;
            border-top: 1px solid #ddd;
        }

        .print-button {
            margin: 20px;
            text-align: center;
        }

        .print-button button {
            padding: 10px 20px;
            font-size: 16px;
            cursor: pointer;
        }

        @media print {
            @page {
                size: A3;
            }

            .no-print {
                display: none;
            }
        }

        ul {
            padding: 0;
            margin: 0 0 1rem 0;
            list-style: none;
        }

        body {
            font-family: "Inter", sans-serif;
            margin: 0;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        table,
        table th,
        table td {
            border: 1px solid silver;
        }

        tr {
            padding: 0%;
        }

        td {
            font-size: small;
        }

        h1,
        h4,
        p {
            margin: 0;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="inv-title">
            <h1>Clearance and Final Settlement</h1>
        </div>
        <img src="./logo.png" class="inv-logo" alt="Company Logo" />
        <div class="inv-header">
            <div>
                <h2>About Employee</h2>
                <ul>
                    <li>Name: {{$employees->FirstName}} {{$employees->LastName}}</li>
                    <li>File Number: {{$employees->File_number}}</li>
                    <li>Department: {{$employees->Workdep}}</li>
                    <li>Position Title: {{$employees->Workname}}</li>
                    @foreach($clearanceForms as $cl)
                    <li>Reason for Departure: {{$cl->Leaving_case}}</li>
                    @endforeach
                </ul>
            </div>
            <div>
                <h2>Approving Authority</h2>
                <ul>
                    @foreach($bossname as $cl)
                    @foreach($clearanceForms as $clf)
                    @if($cl->BossID==$clf->BossID)
                    <li>Authority ID Number: {{$cl->BossID}}</li>
                    <li>Full Name: {{$cl->Full_name}}</li>
                    <li>Responsibility: {{$cl->Responsibility}}</li>
                    @endif
                    @endforeach
                    @endforeach
                </ul>
            </div>
        </div>
        <div class="inv-body">
            <p>Dear {{$employees->FirstName}} {{$employees->LastName}},</p>
            <p>We confirm that all necessary clearance procedures have been completed as of your final working day, . We have received all company property and settled any outstanding dues.</p>
            <p>Thank you for your contributions to Bahir Dar University. We wish you the best in your future endeavors.</p>
            <p>If you have any questions or need further assistance, please feel free to contact the HR department.</p>
        </div>
        <div class="inv-footer">
            <div>
                <p>Best regards,</p>
                
            </div>
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
