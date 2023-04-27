<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Constituents</title>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    </head>
    <body>
        <div class="row">
            <div class="col">
                <h5>Constituents List</h5>
            </div>
        </div>
        <div class="row">
            <div class="col" style="font-size: 12px;">
                <p>Generated at: {{ date('Y-m-d H:i:s') }} by {{ $LoggedEmployee->employee_name }}</p>
            </div>
            <div class="col" style="font-size: 12px;">
                <p>Number of Constituents: {{ $constituents->count() }}</p>
            </div>
        </div>
        <table class="table table-bordered" style="width: 100%; font-size: 12px;">
            <thead>
                <tr>
                    <th>Household ID</th>
                    <th>Name</th>
                    <th>Birthdate</th>
                    <th>Address</th>
                    <th>Email Address</th>
                    <th>Number</th>
                </tr>
            </thead>
            <tbody>
                @foreach($constituents as $constituent)
                <tr>
                    <td>{{ $constituent->household_id }}</td>
                    <td>{{ $constituent->constituent_name }}</td>
                    <td>{{ $constituent->constituent_birthdate }}</td>
                    <td>{{ $constituent->constituent_address }}</td>
                    <td>{{ $constituent->constituent_email }}</td>
                    <td>{{ $constituent->constituent_phone }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <!-- show the total number of constituents -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    </body>
</html>