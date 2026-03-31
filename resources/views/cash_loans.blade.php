<!DOCTYPE html>
<html>

<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Kasbon Karyawan</title>

<style>

body{
font-family: Arial, Helvetica, sans-serif;
background:#f3f4f6;
margin:0;
padding:40px;
}

h1{
margin-bottom:30px;
}

.container{
max-width:1100px;
margin:auto;
}

.card{
background:white;
border-radius:10px;
box-shadow:0 4px 12px rgba(0,0,0,0.08);
padding:25px;
margin-bottom:25px;
}

.card-title{
font-size:18px;
font-weight:600;
margin-bottom:20px;
}

.grid{
display:grid;
grid-template-columns:1fr 1fr 1fr 1fr;
gap:15px;
}

/* RESPONSIVE HP */
@media (max-width:768px){

.grid{
grid-template-columns:1fr;
}

}

input,select{
padding:10px;
border:1px solid #ddd;
border-radius:6px;
width:100%;
font-size:14px;
}

button{
background:#2563eb;
border:none;
color:white;
padding:10px 18px;
border-radius:6px;
cursor:pointer;
font-size:14px;
}

button:hover{
background:#1e4ed8;
}

table{
width:100%;
border-collapse:collapse;
}

th{
background:#f1f5f9;
text-align:left;
padding:12px;
font-size:14px;
}

td{
padding:12px;
border-top:1px solid #eee;
font-size:14px;
}

.badge-active{
background:#22c55e;
color:white;
padding:4px 8px;
border-radius:4px;
font-size:12px;
}

.badge-paid{
background:#64748b;
color:white;
padding:4px 8px;
border-radius:4px;
font-size:12px;
}

.back-btn{
display:inline-block;
margin-bottom:15px;
background:#e5e7eb;
padding:8px 14px;
border-radius:6px;
text-decoration:none;
color:#333;
font-size:13px;
}

@media (max-width:768px){

body{
padding:15px;
}

.card{
padding:18px;
}

h1{
font-size:22px;
}

th,td{
font-size:13px;
padding:10px;
}

button{
padding:8px 14px;
font-size:13px;
}

}

</style>

</head>

<body>

<div class="container">

<h1>Kasbon Karyawan</h1>

<a href="/dashboard" class="back-btn">← Kembali ke Dashboard</a>

<div class="card">

<div class="card-title">Tambah Kasbon</div>

<form method="POST" action="/cash-loans">

<?php echo csrf_field(); ?>

<div class="grid">

<div>
<label>Karyawan</label>
<select name="employee_id">

<?php foreach($employees as $employee): ?>

<option value="<?php echo $employee->id; ?>">
<?php echo $employee->name; ?>
</option>

<?php endforeach; ?>

</select>
</div>

<div>
<label>Tanggal</label>
<input type="date" name="loan_date" required>
</div>

<div>
<label>Jumlah</label>
<input type="number" name="amount" required>
</div>

<div>
<label>Catatan</label>
<input type="text" name="note">
</div>

</div>

<br>

<button type="submit">Simpan Kasbon</button>

</form>

</div>



<div class="card">

<div class="card-title">Daftar Kasbon</div>

<div style="overflow-x:auto;">
<table>

<thead>
<tr>
<th>ID</th>
<th>Karyawan</th>
<th>Tanggal</th>
<th>Jumlah</th>
<th>Sudah Dibayar</th>
<th>Sisa</th>
<th>Keterangan</th>
<th>Status</th>
<th>Aksi</th>
</tr>
</thead>

<tbody>

<?php foreach($loans as $loan): ?>

<tr>

<td><?php echo $loan->id; ?></td>

<td><?php echo $loan->employee->name; ?></td>

<td><?php echo $loan->loan_date; ?></td>

<td><?php echo number_format($loan->amount); ?></td>

<td><?php echo number_format($loan->paid_amount); ?></td>

<td><?php echo number_format($loan->remaining_amount); ?></td>

<td><?php echo $loan->note; ?></td>

<td>

<?php if($loan->status == 'active'): ?>

<span class="badge-active">Active</span>

<?php else: ?>

<span class="badge-paid">Paid</span>

<?php endif; ?>

</td>

<td>

<?php if($loan->status == 'active'): ?>

<form method="POST" action="/cash-loans/pay/<?php echo $loan->id; ?>">

<?php echo csrf_field(); ?>

<input type="number" name="amount" placeholder="Bayar" required style="width:80px;max-width:80px">

<button type="submit">Bayar</button>

</form>

<?php else: ?>

-

<?php endif; ?>

</td>

</tr>

<?php endforeach; ?>

</tbody>

</table>
</div>

</div>

</div>

</body>
</html>