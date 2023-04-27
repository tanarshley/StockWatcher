<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Medicines</title>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    </head>
    <body>
        <div class="row">
            <div class="col">
                <h5>Medicines List</h5>
            </div>
            <div class="col">
                <p>Generated at: {{ date('Y-m-d H:i:s') }} by {{ $LoggedEmployee->employee_name }}</p>
            </div>
        </div>
        <table class="table table-bordered" style="width: 100%; font-size: 12px;">
            <thead>
                <tr>
                    <th>Medicine</th>
                    <th>Category</th>
                    <th>Quantity</th>
                    <th>Lot No.</th>
                    <th>Date of Manufacture</th>
                    <th>Date of Expiry</th>
                </tr>
            </thead>
            <tbody>
                @foreach($medicines as $medicine)
                <tr>
                    <td>{{ $medicine->medicine_name }} {{ $medicine->medicine_no_of_milligrams }}{{ $medicine->medicine_measurement }}
                    <td>{{ $medicine->medicine_category }}</td>
                    <td>{{ $medicine->medicine_quantity }}</td>
                    <td>{{ $medicine->medicine_lot_number }}</td>
                    <td>{{ $medicine->medicine_date_of_manufacture }}</td>
                    <td>{{ $medicine->medicine_date_of_expiry }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    </body>
</html>