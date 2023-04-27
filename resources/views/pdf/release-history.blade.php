<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Release History</title>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    </head>
    <body>
        <div class="row">
            <div class="col">
                <h5>Release Medicines History List</h5>
            </div>
            <div class="col">
                <p>Generated at: {{ date('Y-m-d H:i:s') }} by {{ $LoggedEmployee->employee_name }}</p>
            </div>
        </div>
        <table class="table table-bordered" style="width: 100%; font-size: 12px;">
            <thead>
                <tr>
                    <th>Release #</th>
                    <th>Medicine</th>
                    <th>Quantity</th>
                    <th>Processed By</th>
                    <th>Processed At</th>
                </tr>
            </thead>
            <tbody>
                @foreach($release_history as $release)
                    @foreach($medicineInfo as $medicine_info)
                        @foreach($employeeInfo as $employee_info)
                            <tr>
                                <td>{{ $release->release_history_id }}</td>
                                <td>{{ $medicine_info->medicine_name }} ({{ $medicine_info->medicine_no_of_milligrams }} {{ $medicine_info->medicine_measurement }})</td>
                                <td>{{ $release->release_quantity }}</td>
                                <td>{{ $employee_info->employee_name }}</td>
                                <td>{{ $release->created_at }}</td>
                            </tr>
                        @endforeach
                    @endforeach
                @endforeach
            </tbody>
        </table>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    </body>
</html>