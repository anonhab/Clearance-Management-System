<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Employee</title>
   <style> /* Reset styles */
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }
    
    /* Global styles */
    body {
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        background-color: #f9f9f9;
        color: #333;
        line-height: 1.6;
    }
    
    .container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 0 20px;
    }
    
    /* Header styles */
    header {
        background-color: #4CAF50;
        color: #fff;
        padding: 20px 0;
        text-align: center;
    }
    
    header h1 {
        font-size: 36px;
    }
    
    /* Navigation styles */
  

    
    /* Main content styles */
    .main-content {
        padding: 50px 0;
    }
    
    .employee-details {
        background-color: #fff;
        padding: 30px;
        border-radius: 10px;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
    }
    
    .employee-details h2 {
        font-size: 24px;
        margin-bottom: 20px;
        color: #4CAF50;
    }
    
    .employee-list {
        list-style: none;
    }
    
    .employee-list li {
        margin-bottom: 15px;
    }
    
    .employee-list strong {
        font-weight: bold;
        margin-right: 5px;
    }
    
    /* Footer styles */
    footer {
        background-color: #333;
        color: #fff;
        padding: 20px 0;
        text-align: center;
    }
    
    footer p {
        font-size: 14px;
    }
    
    footer a {
        color: #4CAF50;
        text-decoration: none;
    }
    
    footer a:hover {
        text-decoration: underline;
    }
    
    /* Styles for employee not found */
    .not-found {
        text-align: center;
        font-style: italic;
        color: #999;
        margin-top: 30px;
    }
    
    </style>
</head>
<body>
    <header>
        <div class="container">
            <h1>About Employee</h1>
        </div>
    </header>

    <section class="main-content">
        <div class="container">
            @if ($employee)
            <div class="employee-details">
                <h2>Employee Information</h2>
                <ul class="employee-list">
                    <li><strong>ID:</strong> {{ $employee->EmployeeID }}</li>
                    <li><strong>File number:</strong> {{ $employee->File_number }}</li>
                    <li><strong>First Name:</strong> {{ $employee->FirstName }}</li>
                    <li><strong>Last Name:</strong> {{ $employee->LastName }}</li>
                    <li><strong>Work department:</strong> {{ $employee->Workdep }}</li>
                    <li><strong>Work name:</strong> {{ $employee->Workname }}</li>
                    <li><strong>Email:</strong> {{ $employee->email }}</li>
                    <li><strong>Registered date:</strong> {{ $employee->created_at }}</li>
                </ul>
            </div>
            @else
            <p class="not-found">Employee not found</p>
            @endif
        </div>
    </section>
    
</body>
</html>
