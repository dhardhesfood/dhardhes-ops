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
width:500px;
}

th,td{
border:1px solid black;
padding:6px;
text-align:center;
}

th{
background:#eee;
}

</style>

</head>

<body>

<h2>Master Karyawan</h2>

<form method="POST" action="/employees">

@csrf

Nama :
<input type="text" name="name" required>

Gaji Harian :
<input type="number" name="daily_salary" required>

<button type="submit">Tambah</button>

</form>

<br><br>

<table>

<tr>
<th>ID</th>
<th>Nama</th>
<th>Gaji Harian</th>
<th>Status</th>
</tr>

@foreach($employees as $e)

<tr>

<td>{{ $e->id }}</td>

<td>{{ $e->name }}</td>

<td>{{ number_format($e->daily_salary) }}</td>

<td>{{ $e->status }}</td>

</tr>

@endforeach

</table>

</body>
</html>