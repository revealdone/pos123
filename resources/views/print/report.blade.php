<!DOCTYPE html>
<html>
<head>
    <title>Sales Report</title>

    <style>

        body {
            font-family: Arial;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            border: 1px solid black;
            padding: 8px;
        }

    </style>
</head>
<body>

    <h2>
        Sales Report
    </h2>

    <table>

        <thead>
            <tr>
                <th>Invoice</th>
                <th>Total</th>
                <th>Paid</th>
                <th>Change</th>
                <th>Date</th>
            </tr>
        </thead>

        <tbody>

            @foreach($transactions as $transaction)

            <tr>
                <td>
                    {{ $transaction->invoice_number }}
                </td>

                <td>
                    Rp {{ $transaction->total_price }}
                </td>

                <td>
                    Rp {{ $transaction->paid_amount }}
                </td>

                <td>
                    Rp {{ $transaction->change_amount }}
                </td>

                <td>
                    {{ $transaction->transaction_date }}
                </td>
            </tr>

            @endforeach

        </tbody>

    </table>

</body>
</html>