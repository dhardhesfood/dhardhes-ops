<!DOCTYPE html>
<html>
<head>

<meta charset="utf-8">
<title>Dhardhes OPS</title>

<style>

body{
font-family:Arial;
background:#f4f6f8;
margin:0;
}

.header{
background:#222;
color:white;
padding:15px;
font-size:20px;
text-align:center;
}

.container{
width:900px;
margin:auto;
margin-top:50px;
display:grid;
grid-template-columns:1fr 1fr;
gap:30px;
}

.card{
background:white;
padding:40px;
text-align:center;
border-radius:10px;
box-shadow:0 0 10px rgba(0,0,0,0.1);
text-decoration:none;
color:#333;
font-size:20px;
}

.card:hover{
background:#ff4b2b;
color:white;
}

</style>

</head>

<body>

<div class="header">
Dhardhes OPS Dashboard
</div>

<div class="container">

<a class="card" href="/attendance/upload">
Absensi Karyawan
</a>

<a class="card" href="#">
Produksi
</a>

<a class="card" href="/employees">
Master Karyawan
</a>

<a class="card" href="#">
Performa Karyawan
</a>

</div>

</body>
</html>