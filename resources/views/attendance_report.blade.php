<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>Laporan Absensi Bulanan</title>

<style>

.summary-table{
border-collapse:collapse;
width:400px;
}

.summary-table td{
border:none;
padding:6px 10px;
}

.summary-table td:first-child{
text-align:left;
}

.summary-table td:last-child{
text-align:right;
}

body{font-family:Arial;margin:20px;}
table{border-collapse:collapse;width:100%;}
th,td{border:1px solid #000;padding:6px;text-align:center;}
th{background:#eee;}
.header{margin-bottom:15px;}

.container{
max-width:1100px;
margin:auto;
background:white;
padding:25px;
border-radius:10px;
box-shadow:0 6px 20px rgba(0,0,0,0.08);
}

body{
background:#f4f6fb;
font-family:'Segoe UI',Arial;
}

.back-btn{
display:inline-block;
margin-bottom:10px;
background:#e5e7eb;
padding:6px 12px;
border-radius:6px;
text-decoration:none;
color:#333;
font-size:13px;
}

.table-wrapper{
overflow-x:auto;
}

table{
border-collapse:collapse;
width:100%;
min-width:850px;
}

th{
background:#f1f5f9;
}

tr:nth-child(even){
background:#fafafa;
}

/* =========================
PRINT SETTING
========================= */

@page{
size:A4 portrait;
margin:10mm;
}

@media print{

body{
background:white;
margin:0;
padding:0;
}

.container{
box-shadow:none;
padding:0;
margin:0;
max-width:100%;
}

button,
.back-btn,
.header-top{
display:none !important;
}

.bonus-form{
display:none !important;
}

.table-wrapper{
overflow:visible;
}

table{
min-width:auto;
width:100%;
font-size:11px;
}

th,td{
padding:4px;
}

.summary-table{
margin-top:20px;
width:350px;
}

tr{
page-break-inside:avoid;
}

}
</style>

</head>
<body>

<div class="container">

<div class="header">

<div class="header-top">

<h2>Laporan Absensi Bulanan</h2>

<a href="/attendance/upload" class="back-btn">← Kembali</a>

</div>

Nama: {{ $employee }}
<br>
Bulan: {{ $month }}

@if(session()->has('success'))
<div style="
background:#dcfce7;
border:1px solid #86efac;
color:#166534;
padding:12px 16px;
border-radius:6px;
margin:15px 0;
font-weight:600;
">
{{ session('success') }}
</div>
@endif

</div>

<div class="table-wrapper">
<table>
<thead>
<tr>
<th>Tanggal</th>
<th>Masuk</th>
<th>Pulang</th>
<th>Kerja (menit)</th>
<th>Tambahan Jam</th>
<th>Terlambat Jam</th>
<th>Jobdesk</th>
<th>Uang Makan</th>
<th>Tambahan (+)</th>
<th>Potongan (-)</th>
<th>Total</th>
<th>Status</th>
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

<td>
@if($r->check_in)
{{ number_format($r->extra_job_salary) }}
@else
0
@endif
</td>

<td>
@if($r->check_in)
{{ number_format($r->meal_allowance) }}
@else
0
@endif
</td>

<td>{{ number_format(($r->overtime_minutes / 60) * 6000) }}</td>
<td>{{ number_format(($r->late_minutes / 60) * 4000) }}</td>

<td>{{ number_format($r->daily_total) }}</td>

<td>

@php

$status = 'Off';

if($r->check_in){

    if($r->check_in <= '07:05:00'){
    $status = 'Tepat waktu';
   }
    elseif($r->check_in < '07:15:00'){
    $status = 'Perlu perbaikan';
   }
    else{
    $status = 'Terlambat';
   }

}

@endphp

<strong>{{ $status }}</strong>

</td>

</tr>

@endforeach

</tbody>

</table>
</div>

<br><br>

<h3>Ringkasan Bulanan</h3>

<table class="summary-table">

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
<td>Total Jobdesk Tambahan</td>
<td>{{ number_format($totalExtraJob) }}</td>
</tr>

<tr>
<td>Total Uang Makan</td>
<td>{{ number_format($totalMealAllowance) }}</td>
</tr>

<tr>
<td>Total Gaji Bulan</td>
<td>{{ number_format($totalSalary) }}</td>
</tr>

<tr>
<td>Bonus</td>
<td>

{{ number_format($bonusAmount) }}

<form class="bonus-form" method="POST" action="/attendance/set-bonus" style="margin-top:6px;">
@csrf

<input type="hidden" name="employee_id" value="{{ request()->segment(3) }}">
<input type="hidden" name="month" value="{{ $month }}">

<input
type="number"
name="bonus"
placeholder="input bonus"
value="{{ $bonusAmount }}"
style="width:120px;padding:4px;margin-right:6px;"
>

<button
type="submit"
style="padding:4px 8px;background:#2563eb;color:white;border:none;border-radius:4px;cursor:pointer;"
>
Set
</button>

</form>

</td>
</tr>

<tr>
<td>Potongan Kasbon</td>
<td style="color:red">- {{ number_format($loanDeduction) }}</td>
</tr>

<tr>
<td style="border-top:2px solid #000;"><strong>Gaji Diterima</strong></td>
<td style="border-top:2px solid #000;"><strong>{{ number_format($salaryReceived) }}</strong></td>
</tr>

</table>

<br>

<form method="POST" action="/attendance/pay-salary">
@csrf

<input type="hidden" name="employee_id" value="{{ request()->segment(3) }}">
<input type="hidden" name="month" value="{{ $month }}">

<button type="submit"

@if($salaryPaid)
disabled
@endif

style="
background:#16a34a;
color:white;
padding:10px 18px;
border:none;
border-radius:6px;
cursor:pointer;
margin-top:15px;
opacity:{{ $salaryPaid ? '0.5' : '1' }};
">

@if($salaryPaid)
Gaji Sudah Dibayar
@else
Bayar Gaji
@endif

</button>

</form>

<div style="margin-top:10px;">

<button onclick="window.print()" 
style="background:#64748b;color:white;padding:8px 14px;border:none;border-radius:6px;cursor:pointer;">
Print
</button>

<a href="/attendance/export/{{ request()->segment(3) }}/{{ $month }}"
style="background:#16a34a;color:white;padding:8px 14px;border-radius:6px;text-decoration:none;margin-left:8px;">
Export Excel
</a>

</div>

</div>
</body>
</html>