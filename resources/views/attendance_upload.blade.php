<!DOCTYPE html>
<html>
<head>

<meta charset="utf-8">
<meta name="csrf-token" content="{{ csrf_token() }}">
<title>Upload Absensi</title>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&display=swap" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">

<style>

body{
font-family:'Inter', sans-serif;
background:linear-gradient(135deg,#eef2ff,#f8fafc);
margin:0;
padding:40px;
}

.container{
max-width:1000px;
margin:auto;
background:white;
padding:35px;
border-radius:16px;
box-shadow:0 20px 40px rgba(0,0,0,0.08);
}

.header{
display:flex;
justify-content:space-between;
align-items:center;
margin-bottom:25px;
}

.back-btn{
background:#f1f5f9;
padding:8px 14px;
border-radius:8px;
text-decoration:none;
color:#334155;
font-size:13px;
transition:0.2s;
}

.back-btn:hover{
background:#e2e8f0;
}

.form-grid{
grid-template-columns:1fr 1fr 1fr auto;
gap:20px;
align-items:end;
margin-bottom:30px;
padding:20px;
background:#f8fafc;
border-radius:12px;
border:1px solid #e5e7eb;
}

label{
font-size:14px;
color:#555;
}

select,
input[type=file],
input[type=month]{
width:100%;
padding:10px;
border:1px solid #d1d5db;
border-radius:8px;
background:white;
font-size:14px;
height:40px;
box-sizing:border-box;
}

button{
background:linear-gradient(135deg,#2563eb,#1d4ed8);
color:white;
border:none;
padding:10px 18px;
border-radius:8px;
cursor:pointer;
font-size:14px;
font-weight:500;
transition:0.2s;
}

button:hover{
transform:translateY(-1px);
box-shadow:0 5px 15px rgba(37,99,235,0.3);
}

button:hover{
background:#1d4ed8;
}

table{
width:100%;
border-collapse:separate;
border-spacing:0;
margin-top:20px;
overflow:hidden;
border-radius:12px;
}

th{
background:#f1f5f9;
padding:12px;
text-align:left;
font-size:13px;
color:#475569;
}

td{
padding:10px;
border-bottom:1px solid #eee;
font-size:14px;
}

tr:nth-child(even){
background:#fafafa;
}

tr:hover{
background:#eef2ff;
transition:0.2s;
}

.badge{
background:#e0e7ff;
color:#3730a3;
padding:4px 8px;
border-radius:6px;
font-size:12px;
}

.link{
color:#2563eb;
text-decoration:none;
font-weight:500;
}

.download{
background:#22c55e;
color:white;
padding:6px 12px;
border-radius:8px;
font-size:12px;
text-decoration:none;
}

.download:hover{
background:#059669;
}

.delete-btn{
background:#ef4444;
color:white;
padding:6px 12px;
border-radius:8px;
font-size:12px;
border:none;
cursor:pointer;
}

.delete-btn:hover{
background:#dc2626;
}

.status-paid{
background:#dcfce7;
color:#166534;
padding:5px 10px;
border-radius:999px;
font-size:12px;
font-weight:600;
}

.status-unpaid{
background:#fee2e2;
color:#991b1b;
padding:5px 10px;
border-radius:999px;
font-size:12px;
font-weight:600;
}

input[type=month]::-webkit-calendar-picker-indicator {
cursor: pointer;
opacity: 0.6;
}

input[type=month]:hover::-webkit-calendar-picker-indicator {
opacity: 1;
}

</style>

</head>

<body>

<div class="container">

<div class="header">

<h2 style="margin:0;font-weight:600;">
<i class="fa-solid fa-file-excel" style="color:#16a34a;"></i>
Upload Absensi Excel
</h2>

<div class="header-actions">

<a href="/dashboard" class="back-btn">🏠 Dashboard</a>

<a href="/attendance/upload" class="back-btn">← Kembali</a>

</div>

</div>

<form method="POST" action="{{ url('/attendance/import') }}" enctype="multipart/form-data">

@csrf

<div class="form-grid">

<div>

<label>Karyawan</label>

<select name="employee_id">

@foreach($employees as $e)

<option value="{{ $e->id }}">
{{ $e->name }}
</option>

@endforeach

</select>

</div>

<div>
<label>Bulan</label>
<input type="month" name="month" required>
</div>


<div>

<label>File Excel</label>

<input type="file" name="file" required>

</div>

<div style="display:flex;align-items:end;">
<button type="submit">⬆ Upload</button>
</div>
</div>

</form>

<h3>Data Absensi Yang Sudah Diupload</h3>

<table>

<thead>
<tr>
<th>No</th>
<th>Karyawan</th>
<th>Bulan</th>
<th>Status</th>
<th>Tanggal Dibayar</th>
<th>Slip</th>
<th>Excel</th>
<th>Aksi</th>
</tr>
</thead>

<tbody>

@forelse($uploads as $index => $row)

<tr>

<td>{{ $index + 1 }}</td>

<td>{{ $row->name }}</td>

<td>
<span class="badge">
{{ $row->month }}
</span>
</td>

<td>
@if($row->salary_paid)
<span class="status-paid">✔ Sudah Dibayar</span>
@else
<span class="status-unpaid">✖ Belum Dibayar</span>
@endif
</td>

<td>
@if($row->salary_paid_at)
{{ date('d-m-Y H:i', strtotime($row->salary_paid_at)) }}
@else
-
@endif
</td>

<td>
<a class="link" href="/attendance/report-view/{{ $row->employee_id }}/{{ $row->month }}">
Lihat Slip
</a>
</td>

<td>
<a class="download" href="/storage/attendance/{{ $row->month }}/{{ strtolower(str_replace(' ','_',$row->name)) }}_{{ $row->month }}.xlsx">
Download
</a>
</td>

<td>

<form method="POST"
action="{{ route('attendance.destroy',[$row->employee_id,$row->month]) }}"
onsubmit="return confirm('Yakin ingin menghapus data ini?')">

@csrf
@method('DELETE')

<button class="delete-btn">
Hapus
</button>

</form>

</td>

</tr>

@empty

<tr>
<td colspan="8" style="text-align:center;color:#777">
Belum ada data absensi
</td>
</tr>

@endforelse

</tbody>

</table>

</div>

</body>

</html>