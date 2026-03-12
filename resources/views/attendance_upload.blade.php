<!DOCTYPE html>
<html>
<head>

<meta charset="utf-8">

<title>Upload Absensi</title>

<style>

body{
font-family:Arial;
margin:20px;
}

</style>

</head>

<body>

<h2>Upload Absensi Excel</h2>

<form method="POST" action="/attendance/import" enctype="multipart/form-data">

@csrf

Karyawan :

<select name="employee_id">

@foreach($employees as $e)

<option value="{{ $e->id }}">
{{ $e->name }}
</option>

@endforeach

</select>

<br><br>

File Excel :

<input type="file" name="file" required>

<br><br>

<button type="submit">
Upload Absensi
</button>

</form>

</body>

</html>