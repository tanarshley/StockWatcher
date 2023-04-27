<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Requests History</title>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    </head>
    <body>
        <div class="row">
            <div class="col">
                <h5>Requests History List</h5>
            </div>
            <div class="col">
                <p>Generated at: {{ date('Y-m-d H:i:s') }} by {{ $LoggedEmployee->employee_name }}</p>
            </div>
        </div>
        <table class="table table-bordered" style="width: 100%; font-size: 12px;">
            <thead>
                <tr>
                    <th>Household ID</th>
                    <th>Constituent</th>
                    <th>Medicine</th>
                    <th>Quantity</th>
                    <th>Status</th>
                    <th>Processed By</th>
                </tr>
            </thead>
            <tbody>
                @foreach($medicine_requests as $requests)
                    @foreach($medicineInfo as $medicine)
                        @foreach($constituentInfo as $constituent)
                            <tr>
                                <td>{{ $constituent->household_id }}</td>
                                <td>{{ $constituent->constituent_name }}</td>
                                <td>{{ $medicine->medicine_name }}</td>
                                <td>{{ $requests->quantity_of_request }}</td>
                                <td>{{ $requests->request_status }}</td>
                                <td>{{ $requests->processed_by }}</td>
                            </tr>
                        @endforeach
                    @endforeach
                @endforeach
            </tbody>
        </table>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    </body>
</html>