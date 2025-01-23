<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Weather Project</title>
    <!-- Local CSS for DataTables -->
  
    <link href="{{ asset('css/jquery.dataTables.min.css') }}" rel="stylesheet">
    <style>
        body {
            font-family: Arial, sans-serif;
            background: linear-gradient(to right, #74ebd5, #acb6e5);
            min-height: 100vh;
            margin: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 0 10px;
        }

        .container {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 800px;
            box-sizing: border-box;
        }

        h1 {
            text-align: center;
            margin-bottom: 20px;
            color: #333;
        }

        label {
            font-weight: bold;
            display: block;
            margin-bottom: 8px;
        }

        input {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }

        button {
            width: 100%;
            background-color: #007bff;
            color: white;
            padding: 10px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            box-sizing: border-box;
        }

        button:hover {
            background-color: #0056b3;
        }

        .alert {
            display: none;
            margin-top: 10px;
            padding: 10px;
            border-radius: 4px;
        }

        .alert.error {
            background-color: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }

        .table-wrapper {
            width: 100%;
            overflow-x: auto;
            margin-top: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
            min-width: 600px; /* Prevent table from shrinking too much */
        }

        th, td {
            padding: 10px;
            text-align: left;
            border: 1px solid #ddd;
        }

        th {
            background-color: #f2f2f2;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .container {
                padding: 15px;
            }

            input, button {
                padding: 8px;
            }

            table {
                margin-top: 15px;
            }

            th, td {
                padding: 8px;
            }
        }

        @media (max-width: 480px) {
            .container {
                width: 100%;
                padding: 10px;
            }

            h1 {
                font-size: 18px;
            }

            input, button {
                padding: 6px;
            }

            table {
                margin-top: 10px;
            }

            th, td {
                padding: 6px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Weather Project</h1>
        <div class="alert error" id="error"></div>
        <form id="weather-form">
            <label for="city">City Name:</label>
            <input type="text" id="city" placeholder="Enter city name">
            <button type="submit">Get Weather</button>
        </form>
        <div class="table-wrapper">
            <table id="tblData" style="display: none;">
                <thead></thead>
                <tbody></tbody>
            </table>
        </div>
    </div>

    <!-- Local jQuery -->
    <script src="{{ asset('js/jquery-3.6.0.min.js') }}"></script>

    <!-- Local DataTables JS -->
    <script src="{{ asset('js/jquery.dataTables.min.js') }}"></script>
    <script>
        $(document).ready(function () {
            function loadData(weatherData) {
                // Handle single object vs array
                if (!Array.isArray(weatherData)) {
                    weatherData = [weatherData];
                }

                if (weatherData.length === 0) {
                    $('#error').text('No data found for the specified city.').show();
                    $('#tblData').hide();
                    return;
                }

                // Clear existing table data before inserting new data
                
                 if ($.fn.dataTable.isDataTable('#tblData')) {
                    console.log("Clicked");
                      $('#tblData').DataTable().destroy();
                    }

                // Show the table
                $('#tblData').show();
                $('#tblData thead').empty();
                $('#tblData tbody').empty();

                // Generate headers dynamically
                const headers = Object.keys(weatherData[0]);
                let headerHTML = '<tr>';
                headers.forEach(header => {
                    headerHTML += `<th>${header}</th>`;
                });
                headerHTML += '</tr>';
                $('#tblData thead').append(headerHTML);

                // Generate rows dynamically
                let rowsHTML = '';
                weatherData.forEach(item => {
                    rowsHTML += '<tr>';
                    headers.forEach(key => {
                        rowsHTML += `<td>${item[key]}</td>`;
                    });
                    rowsHTML += '</tr>';
                });
                $('#tblData tbody').append(rowsHTML);

                // Initialize DataTable
                $('#tblData').DataTable({
                    destroy: true,
                    responsive: true,
                    paging: false,
                    searching: false
                });
            }

            $('#weather-form').submit(function (e) {
                e.preventDefault();
                const city = $('#city').val().trim();

                $('#error').hide();

                $.ajax({
                    url: '/api',
                    type: 'POST',
                    data: JSON.stringify({ city }),
                    contentType: 'application/json',
                    success: function (response) {
                        console.log(response); // Debugging purposes
                        loadData(response);
                    },
                    error: function () {
                        $('#error').text('City not found or error occurred.').show();
                    }
                });
            });
        });
    </script>
</body>
</html>
