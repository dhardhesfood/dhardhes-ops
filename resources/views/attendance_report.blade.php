<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>Laporan Absensi Bulanan</title>

<style>
body{font-family:Arial;margin:20px;}
table{border-collapse:collapse;width:100%;}
th,td{border:1px solid #000;padding:6px;text-align:center;}
th{background:#eee;}
.header{margin-bottom:15px;}
</style>

</head>
<body>

<div class="header">
<h2>Laporan Absensi Bulanan</h2>
Karyawan: {{ $employee }}
<br>
Bulan: {{ $month }}
</div>

<table>
<thead>
<tr>
<th>Tanggal</th>
<th>Masuk</th>
<th>Pulang</th>
<th>Kerja (menit)</th>
<th>Lembur</th>
<th>Terlambat</th>
<th>Total</th>
</tr>
</thead>

<tbody>

@foreach($rows as $r)

<tr>
<td>{{ $r->date }}</td>

<td>
@if($r->check_in)
{{ $r->check_in }}
@else
-
@endif
</td>

<td>
@if($r->check_out)
{{ $r->check_out }}
@else
-
@endif
</td>

<td>{{ $r->work_minutes }}</td>
<td>{{ $r->overtime_minutes }}</td>
<td>{{ $r->late_minutes }}</td>
<td>{{ number_format($r->daily_total) }}</td>

</tr>

@endforeach

</tbody>

</table>

<br><br>

<h3>Ringkasan Bulanan</h3>

<table style="width:400px">

<tr>
<td>Total Hari Kerja</td>
<td>{{ $totalWorkDays }}</td>
</tr>

<tr>
<td>Total Lembur (menit)</td>
<td>{{ $totalOvertime }}</td>
</tr>

<tr>
<td>Total Terlambat (menit)</td>
<td>{{ $totalLate }}</td>
</tr>

<tr>
<td>Total Gaji Bulan</td>
<td>{{ number_format($totalSalary) }}</td>
</tr>

</table>

<br>

<button onclick="window.print()">Print</button>

</body>
</html>