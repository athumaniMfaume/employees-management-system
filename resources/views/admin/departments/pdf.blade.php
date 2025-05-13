<!DOCTYPE html>
<html>
<head>
    <title>department Slip</title>
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
    <center><h2>All Department Slip</h2></center>
    


  

    <table>
            <tr>
                <th>Number</th>
            <th>Department:</th>
               </tr>
        
        @foreach($departments as $department)
                        
            <tr>
                <td>{{ $loop->iteration }}</td>
            <td>{{ $department->name }}</td>
        </tr>
         @if (!$loop->last)
        <div class="page-break"></div>
    @endif
        @endforeach
    </table>
</body>
</html>
