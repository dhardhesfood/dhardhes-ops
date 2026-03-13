<!DOCTYPE html>
<html>
<head>

<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">

<title>Dhardhes OPS</title>

<style>

<style>

body{
font-family:Arial;
background:linear-gradient(135deg,#0f172a,#1e293b,#111827);
margin:0;
color:white;
}

.header{
background:#020617;
color:white;
padding:18px;
font-size:22px;
text-align:center;
font-weight:bold;
letter-spacing:1px;
}

/* CONTAINER */

.container{
max-width:1000px;
margin:auto;
margin-top:40px;
display:grid;
grid-template-columns:repeat(auto-fit,minmax(260px,1fr));
gap:20px;
padding:20px;
}

/* CARD */

.card{
padding:40px;
text-align:center;
border-radius:14px;
text-decoration:none;
color:white;
font-size:20px;
font-weight:bold;
box-shadow:0 10px 25px rgba(0,0,0,0.4);
transition:all 0.25s;
}

.card:hover{
transform:scale(1.05);
}

/* WARNA CARD */

.card.absensi{
background:linear-gradient(135deg,#ef4444,#f97316);
}

.card.produksi{
background:linear-gradient(135deg,#3b82f6,#6366f1);
}

.card.master{
background:linear-gradient(135deg,#10b981,#059669);
}

.card.performa{
background:linear-gradient(135deg,#a855f7,#ec4899);
}

.card.kasbon{
background:linear-gradient(135deg,#f59e0b,#d97706);
}

/* RESPONSIVE HP */

@media (max-width:768px){

.container{
grid-template-columns:1fr;
margin-top:30px;
}

.card{
padding:30px;
font-size:18px;
}

.header{
font-size:20px;
}

}

</style>

</head>

<body>

<div class="header">
Dhardhes OPS Dashboard
</div>

<div class="container">

<a class="card absensi" href="/attendance/upload">
Absensi Karyawan
</a>

<a class="card produksi" href="#">
Produksi
</a>

<a class="card master" href="/employees">
Master Karyawan
</a>

<a class="card performa" href="#">
Performa Karyawan
</a>

<a class="card kasbon" href="/cash-loans">
Kasbon Karyawan
</a>

</div>

</body>
</html>