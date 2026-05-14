<!DOCTYPE html>
<html>
<head>
    <title>Receipt</title>

    <style>
        body {
            font-family: Arial;
            width: 300px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        td {
            padding: 4px;
        }
    </style>
</head>
<body>

    <center>
        <h2>Warung Pak Toni</h2>

        <p>
            Pesanggrahan
        </p>
    </center>

    <hr>

    <p>
        Invoice:
        {{ $transaction->invoice_number }}
    </p>

    <p>
        Date:
        {{ $transaction->transaction_date }}
    </p>

    <p>
        Cashier:
        {{ $transaction->user->name }}
    </p>

    <hr>

    <table>

        @foreach($transaction->details as $detail)

        <tr>
            <td>
                {{ $detail->product->name }}
            </td>

            <td>
                {{ $detail->quantity }}x
            </td>

            <td align="right">
                Rp {{ $detail->subtotal }}
            </td>
        </tr>

        @endforeach

    </table>

    <hr>

    <p>
        Total:
        Rp {{ $transaction->total_price }}
    </p>

    <p>
        Paid:
        Rp {{ $transaction->paid_amount }}
    </p>

    <p>
        Change:
        Rp {{ $transaction->change_amount }}
    </p>

    <hr>

    <center>
        Terima Kasih
    </center>

</body>
</html>