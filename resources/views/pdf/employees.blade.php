<!DOCTYPE html>
<html>
<head>
    <title>Employee List</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 14px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        table, th, td {
            border: 1px solid black;
        }
        th, td {
            padding: 10px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <h2>Employee List</h2>
    <table>
        <thead>
            <tr>
                <th>Name</th>
                <th>Contact Number</th>
                <th>Email</th>
                <th>Date of Birth</th>
                <th>Address</th>
                <th>Employee Register Number</th>
            </tr>
        </thead>
        <tbody>
            @foreach($employees as $employee)
                <tr>
                    <td>{{ $employee->name }}</td>
                    <td>{{ $employee->contact_number }}</td>
                    <td>{{ $employee->email }}</td>
                    <td>{{ $employee->date_of_birth }}</td>
                    <td>{{ $employee->address }}</td>
                    <td>{{ $employee->employee_register_number }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
