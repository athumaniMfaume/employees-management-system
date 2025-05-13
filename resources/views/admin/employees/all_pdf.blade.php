<!DOCTYPE html>
<html>
<head>
    <title>All Employees</title>
    <style>
        body { font-family: DejaVu Sans, sans-serif; font-size: 10px; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #000; padding: 4px 6px; text-align: left; white-space: nowrap }

    .page-break {
        page-break-after: always;
    }

    @media print{
        body{
            zoom: 80%;
        }

        table{
            width:100%;
            font-size: 10px;

        }
    }


</style>
</head>
<body>
    <center><h2>All Employees </h2></center>
    


  

    <table>
            <tr>
                <th>S/N</th>
            <th>Employee Name:</th>
            <th>Department:</th>
            <th>Position</th>
            <th>Email</th>
            <th>Phone</th>          
            <th>Birthday</th>
            <th>Join Date</th>
            <th>Net Salary</th>
               </tr>
        
        @foreach($employees as $employee)
                        
            <tr>
                <td>{{ $loop->iteration }}</td>
                 <td>{{ $employee->name }}</td>
            <td>{{ $employee->departments->name ?? 'N/A' }}</td>
            <td>{{ $employee->position }}</td>
            <td>{{ $employee->email }}</td>
            <td>{{ $employee->phone }}</td>
            <td>{{ $employee->dob }}</td> 
            <td>{{ $employee->created_at }}</td>
            <td>{{ ($employee->salaries->net_salary) ?? 'N/A' }} </td>
            
        </tr>
         @if (!$loop->last)
        <div class="page-break"></div>
    @endif
        @endforeach
    </table>
</body>
</html>
