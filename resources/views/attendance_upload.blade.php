<!DOCTYPE html>
<html>
<head>

<meta charset="utf-8">
<meta name="csrf-token" content="{{ csrf_token() }}">
<title>Upload Absensi</title>

<style>

body{
font-family:'Segoe UI', Arial, sans-serif;
background:#f4f6fb;
margin:0;
padding:40px;
}

.container{
max-width:950px;
margin:auto;
background:white;
padding:30px;
border-radius:10px;
box-shadow:0 8px 25px rgba(0,0,0,0.08);
}

.header{
display:flex;
justify-content:space-between;
align-items:center;
margin-bottom:25px;
}

.back-btn{
background:#e5e7eb;
padding:8px 14px;
border-radius:6px;
text-decoration:none;
color:#333;
font-size:14px;
}

.form-grid{
display:grid;
grid-template-columns:1fr 1fr auto;
gap:15px;
align-items:end;
margin-bottom:25px;
}

label{
font-size:14px;
color:#555;
}

select,input[type=file]{
width:100%;
padding:8px;
border:1px solid #ccc;
border-radius:6px;
background:white;
}

button{
background:#2563eb;
color:white;
border:none;
padding:10px 16px;
border-radius:6px;
cursor:pointer;
font-size:14px;
}

button:hover{
background:#1d4ed8;
}

table{
width:100%;
border-collapse:collapse;
margin-top:15px;
}

th{
background:#f1f5f9;
padding:10px;
text-align:left;
font-size:14px;
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
background:#f3f4f6;
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
background:#10b981;
color:white;
padding:6px 10px;
border-radius:6px;
font-size:12px;
text-decoration:none;
}

.download:hover{
background:#059669;
}

.delete-btn{
background:#ef4444;
color:white;
padding:6px 10px;
border-radius:6px;
font-size:12px;
border:none;
cursor:pointer;
}

.delete-btn:hover{
background:#dc2626;
}

</style>

</head>

<body>

<div class="container">

<div class="header">

<h2>Upload Absensi Excel</h2>

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

<label>File Excel</label>

<input type="file" name="file" required>

</div>

<div>

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
<span style="color:#16a34a;font-weight:600;">Sudah Dibayar</span>
@else
<span style="color:#dc2626;font-weight:600;">Belum Dibayar</span>
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