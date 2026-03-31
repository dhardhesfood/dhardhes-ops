<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>Master Karyawan</title>

<style>

body{
font-family:Arial;
margin:20px;
}

table{
border-collapse:collapse;
width:100%;
}

th,td{
border:1px solid black;
padding:6px;
text-align:center;
}

th{
background:#eee;
}

.container{
max-width:900px;
margin:auto;
margin-top:40px;
background:white;
padding:30px;
border-radius:10px;
box-shadow:0 8px 25px rgba(0,0,0,0.08);
}

body{
background:#f4f6fb;
font-family:'Segoe UI',Arial;
}

.header{
display:flex;
justify-content:space-between;
align-items:center;
margin-bottom:20px;
}

.back-btn{
background:#e5e7eb;
padding:8px 14px;
border-radius:6px;
text-decoration:none;
color:#333;
font-size:14px;
}

.form-box{
display:block;
margin-bottom:20px;
}

.form-row{
margin-bottom:12px;
}

.form-row label{
display:block;
font-size:14px;
margin-bottom:4px;
}

.form-row input{
width:100%;
max-width:300px;
}

input{
padding:8px;
border:1px solid #ccc;
border-radius:6px;
}

.btn-add{
background:#2563eb;
color:white;
border:none;
padding:8px 16px;
border-radius:6px;
cursor:pointer;
}

.btn-add:hover{
background:#1d4ed8;
}

tr:nth-child(even){
background:#fafafa;
}

td{
padding:8px;
}

.btn-edit{
background:#3b82f6;
color:white;
padding:6px 12px;
border-radius:6px;
text-decoration:none;
margin-right:8px;
display:inline-block;
}

.btn-toggle{
padding:6px 12px;
border:none;
border-radius:6px;
cursor:pointer;
color:white;
}

.btn-toggle.active{
background:#10b981;
}

.btn-toggle.inactive{
background:#ef4444;
}

</style>

</head>

<body>

<div class="container">

<div class="header">

<h2>Master Karyawan</h2>

<a href="/dashboard" class="back-btn">← Dashboard</a>

</div>

<form method="POST" action="/employees">

@csrf

<div class="form-box">
<div class="form-row">
<label>Nama</label>
<input type="text" name="name" required>
</div>

<div class="form-row">
<label>Gaji Harian</label>
<input type="number" name="daily_salary" required>
</div>

<div class="form-row">
<label>Jobdesk Tambahan</label>
<input type="number" name="extra_job_salary">
</div>

<div class="form-row">
<label>Uang Makan</label>
<input type="number" name="meal_allowance">
</div>

<button class="btn-add" type="submit">Tambah</button>

</div>

</form>

<br><br>

<table>

<tr>
<th>ID</th>
<th>Nama</th>
<th>Gaji Harian</th>
<th>Jobdesk Tambahan</th>
<th>Uang Makan</th>
<th>Status</th>
<th>Aksi</th>
</tr>

@foreach($employees as $e)

<tr>

<td>{{ $e->id }}</td>
<td>{{ $e->name }}</td>
<td>{{ number_format($e->daily_salary) }}</td>
<td>{{ number_format($e->extra_job_salary ?? 0) }}</td>
<td>{{ number_format($e->meal_allowance ?? 0) }}</td>
<td>{{ $e->status }}</td>

<td>

<a href="/employees/{{ $e->id }}/edit"
class="btn-edit">
Edit
</a>

<form method="POST" action="/employees/{{ $e->id }}/toggle" style="display:inline">
@csrf

<button class="btn-toggle {{ $e->status }}">
{{ $e->status === 'active' ? 'Deactivate' : 'Activate' }}
</button>

</form>

</td>

<tr>

@endforeach

</table>

</div>

</body>

</html>