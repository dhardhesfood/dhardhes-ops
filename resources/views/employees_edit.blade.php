<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>Edit Karyawan</title>

<style>
body{font-family:Arial;background:#f4f6fb}

.container{
max-width:600px;
margin:auto;
margin-top:80px;
background:white;
padding:30px;
border-radius:10px;
box-shadow:0 8px 25px rgba(0,0,0,0.08);
}

input{
width:100%;
padding:8px;
margin-top:5px;
margin-bottom:15px;
border:1px solid #ccc;
border-radius:6px;
}

button{
background:#2563eb;
color:white;
border:none;
padding:8px 16px;
border-radius:6px;
}

</style>
</head>

<body>

<div class="container">

<h2>Edit Karyawan</h2>

<form method="POST" action="/employees/{{ $employee->id }}">

@csrf
@method('PUT')

<label>Nama</label>
<input type="text" name="name" value="{{ $employee->name }}">

<label>Gaji Harian</label>
<input type="number" name="daily_salary" value="{{ $employee->daily_salary }}">

<label>Jobdesk Tambahan</label>
<input type="number" name="extra_job_salary"
value="{{ $employee->extra_job_salary }}">

<label>Uang Makan</label>
<input type="number" name="meal_allowance"
value="{{ $employee->meal_allowance }}">

<button type="submit">Update</button>

</form>

</div>

</body>
</html>