<!DOCTYPE html>
<html>
<head>
    <title>Salary Slip</title>
    <style>
        body { font-family: DejaVu Sans, sans-serif; font-size: 12px; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #000; padding: 8px; text-align: left; }

    .page-break {
        page-break-after: always;
    }
</style>
</head>
<body>
    <h2>All Salary Slip</h2>


  

    <table>
            <tr>
            <th>Employee Name:</th>
            <th>Department:</th>
            <th>Position:</th>
            <th>Base Salary</th>
            <th>Allowances</th>
           
            <th>Deductions</th>
            <th>Net Salary</th>
              <th>Pay Date</th>
               </tr>
        
        @foreach($salaries as $salary)
                        
            <tr>
                 <td>{{ $salary->employee->name }}</td>
            <td>{{ $salary->employee->departments->name ?? 'N/A' }}</td>
            <td>{{ $salary->employee->position }}</td>
            <td>{{ number_format($salary->basic_salary, 2) }} TZS</td>    
            <td>{{ number_format($salary->allowance, 2) }} TZS</td>
            <td>{{ number_format($salary->deductions, 2) }} TZS</td>     
            <td>{{ number_format($salary->net_salary, 2) }} TZS</td>
            <td>{{ $salary->pay_date }}</td>
        </tr>
         @if (!$loop->last)
        <div class="page-break"></div>
    @endif
        @endforeach
    </table>
</body>
</html>
