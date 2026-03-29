<!DOCTYPE html>
<html>

<head>

<meta charset="UTF-8">
<title>Dashboard OPS</title>

<meta name="viewport" content="width=device-width, initial-scale=1">

<style>

*{
box-sizing:border-box;
}

body{
font-family:Arial, Helvetica, sans-serif;
background:#f1f5f9;
margin:0;
}

/* TOPBAR */

.topbar{
background:white;
padding:15px 25px;
display:flex;
justify-content:space-between;
align-items:center;
box-shadow:0 2px 6px rgba(0,0,0,0.05);
}

.topbar h1{
font-size:18px;
margin:0;
}

.user-menu{
display:flex;
gap:15px;
align-items:center;
}

.user-menu a{
text-decoration:none;
color:#111827;
font-size:14px;
}

.logout-btn{
background:#ef4444;
color:white;
padding:6px 10px;
border-radius:6px;
font-size:13px;
}

/* CONTENT */

.container{
max-width:1100px;
margin:auto;
padding:30px 20px;
}

h2{
margin-bottom:25px;
color:#111827;
}

/* GRID */

.grid{
display:grid;
grid-template-columns:repeat(auto-fit,minmax(230px,1fr));
gap:20px;
}

/* CARD */

.menu{
display:block;
padding:22px;
border-radius:12px;
color:white;
text-decoration:none;
font-size:17px;
font-weight:600;
box-shadow:0 6px 14px rgba(0,0,0,0.08);
transition:all .2s ease;
}

.menu span{
display:block;
font-size:13px;
opacity:0.85;
margin-top:4px;
font-weight:normal;
}

.menu:hover{
transform:translateY(-3px);
box-shadow:0 10px 22px rgba(0,0,0,0.15);
}

/* COLORS */

.blue{
background:linear-gradient(135deg,#3b82f6,#1d4ed8);
}

.purple{
background:linear-gradient(135deg,#a855f7,#6d28d9);
}

.orange{
background:linear-gradient(135deg,#f97316,#c2410c);
}

.dark{
background:linear-gradient(135deg,#475569,#1e293b);
}

</style>

</head>

<body>

<div class="topbar">

<h1>OPS Dhardhes</h1>

<div class="user-menu">

<span>{{ Auth::user()->name }}</span>

<a href="/profile">Profile</a>

<form method="POST" action="/logout" style="display:inline;">
@csrf
<button class="logout-btn">Logout</button>
</form>

</div>

</div>


<div class="container">

<div class="grid">

<a class="menu blue" href="/cash-loans">
Kasbon Karyawan
<span>Kelola kasbon karyawan</span>
</a>

<a class="menu purple" href="/attendance/upload">
Laporan Absensi
<span>Upload & lihat laporan</span>
</a>

<a class="menu orange" href="/employees">
Data Karyawan
<span>Master data karyawan</span>
</a>

<a class="menu dark" href="/database-backup">
Backup Database
<span>Backup manual database</span>
</a>

</div>

</div>

</body>
</html>