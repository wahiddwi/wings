<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <style>
        table.static {
            position: relative;
            border: 1px solid #543535;
        }
    </style>
    <title>Report Penjualan</title>
</head>
<body>
    <div class="form-group">
        <p align="center"><b>Laporan Penjualan</b></p>
        <table class="static" align="center" border="1px" style="width: 95%;">
            <tr>
                <th>Transaction</th>
                <th>User</th>
                <th>Total</th>
                <th>Date</th>
                <th>Item</th>
            </tr>
            @foreach ($report as $rp)
                <tr>
                    <td>TRX - {{ $loop->iteration }}</td>
                    <td>{{$rp->transactionHeaders->users->name}}</td>
                    <td>{{$rp->transactionHeaders->total}}</td>
                    <td>{{ \Carbon\Carbon::parse($rp->created_at)->format('d/m/Y')}}</td>
                    <td>{{ $rp->products->product_name }}</td>
                </tr>

            @endforeach
        </table>
    </div>
    <script type="text/javascript">
        window.print();
    </script>
</body>
</html>
