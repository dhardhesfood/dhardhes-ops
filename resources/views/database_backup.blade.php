<!DOCTYPE html>
<html>
<head>
    <title>Database Backup</title>
    <style>

        body{
            font-family: Arial;
            padding:30px;
            background:#f5f5f5;
        }

        h1{
            margin-bottom:20px;
        }

        table{
            width:100%;
            border-collapse:collapse;
            background:#fff;
        }

        th,td{
            padding:10px;
            border:1px solid #ddd;
            text-align:left;
        }

        th{
            background:#eee;
        }

        .btn{
            padding:8px 14px;
            background:#2d89ef;
            color:#fff;
            text-decoration:none;
            border-radius:4px;
        }

        .btn-run{
            background:#28a745;
        }

        .topbar{
            margin-bottom:20px;
        }

        .success{
            padding:10px;
            background:#d4edda;
            margin-bottom:15px;
        }

    </style>
</head>

<body>

<h1>Database Backup</h1>

@if(session('success'))
<div class="success">
{{ session('success') }}
</div>
@endif

<div class="topbar">
<form method="POST" action="/database-backup/run">
@csrf
<button class="btn btn-run">Backup Sekarang</button>
</form>
</div>

<table>

<tr>
<th>File</th>
<th>Size</th>
<th>Tanggal</th>
<th>Download</th>
</tr>

@foreach($files as $file)

<tr>

<td>{{ $file['name'] }}</td>

<td>{{ number_format($file['size']/1024,2) }} KB</td>

<td>{{ $file['date'] }}</td>

<td>
<a class="btn"
href="/database-backup/download/{{ $file['name'] }}">
Download
</a>
</td>

</tr>

@endforeach

</table>

</body>
</html>