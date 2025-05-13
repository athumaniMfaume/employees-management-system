<!DOCTYPE html>
<html>
<head>
    <title>Salary Slip</title>
    <style>
        body { font-family: DejaVu Sans, sans-serif; font-size: 12px; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #000; padding: 8px; text-align: left; }
    </style>
</head>
<body>
    <h2>Salary Slip</h2>
    <p><strong>Employee Name:</strong> {{ $salary->employee->name }}</p>
    <p><strong>Position:</strong> {{ $salary->employee->position }}</p>
    <p><strong>Department:</strong> {{ $salary->employee->departments->name ?? 'N/A' }}</p>

    <table>
        <tr>
            <th>Base Salary</th>
            <td>{{ number_format($salary->basic_salary, 2) }} TZS</td>
        </tr>
        <tr>
            <th>Allowances</th>
            <td>{{ number_format($salary->allowance, 2) }} TZS</td>
        </tr>
        <tr>
            <th>Deductions</th>
            <td>{{ number_format($salary->deductions, 2) }} TZS</td>
        </tr>
        <tr>
            <th>Net Salary</th>
            <td>{{ number_format($salary->net_salary, 2) }} TZS</td>
        </tr>
        <tr>
            <th>Pay Date</th>
            <td>{{ $salary->pay_date }}</td>
        </tr>
    </table>
</body>
</html>
