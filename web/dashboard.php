<?php
session_start();
if(!isset($_SESSION['user'])){
    header("Location: login.php");
}

include $_SERVER['DOCUMENT_ROOT'] . "/medical_system/api/db.php";

// COUNTS
$patients = $conn->query("SELECT COUNT(*) as total FROM patients")->fetch_assoc()['total'];
$doctors = $conn->query("SELECT COUNT(*) as total FROM doctors")->fetch_assoc()['total'];

// RECENT PATIENTS
$recent = $conn->query("SELECT first_name, last_name, diagnosis FROM patients ORDER BY id DESC LIMIT 5");
?>

<?php
include $_SERVER['DOCUMENT_ROOT'] . "/medical_system/web/layout/header.php";
include $_SERVER['DOCUMENT_ROOT'] . "/medical_system/web/layout/sidebar.php";
?>

<div class="content">

<div class="topbar">
    <img src="assets/img/system-logo.png" class="logo">
    <h5>Dashboard</h5>

    <div class="ms-auto">
        <a href="logout.php" class="btn btn-danger btn-sm">Logout</a>
    </div>
</div>

<div class="mt-4">

<!-- 🔥 STATS -->
<div class="row g-4">

<!-- PATIENTS -->
<div class="col-md-6">
<div class="stat-box bg-gradient-primary">
    <div>
        <h6>Total Patients</h6>
        <h1><?php echo $patients; ?></h1>
        <small>Registered patients</small>
    </div>
    <div class="icon">👥</div> <!-- 🔄 CHANGED ICON -->
</div>
</div>

<!-- DOCTORS -->
<div class="col-md-6">
<div class="stat-box bg-gradient-success">
    <div>
        <h6>Total Doctors</h6>
        <h1><?php echo $doctors; ?></h1>
        <small>Active doctors</small>
    </div>
    <div class="icon">👨‍⚕️</div>
</div>
</div>

</div>

<!-- 🧾 CONTENT -->
<div class="row mt-4 g-4">

<!-- RECENT PATIENTS -->
<div class="col-md-12"> <!-- 🔄 FULL WIDTH NA -->
<div class="card p-3">

<h5>Recent Patients</h5>

<table class="table table-hover mt-2">
<thead>
<tr>
<th>Name</th>
<th>Diagnosis</th>
</tr>
</thead>

<tbody>
<?php while($r = $recent->fetch_assoc()): ?>
<tr>
<td><?php echo $r['first_name']." ".$r['last_name']; ?></td>
<td><?php echo $r['diagnosis']; ?></td>
</tr>
<?php endwhile; ?>
</tbody>

</table>

</div>
</div>

</div>

</div>

</div>

<style>

/* 🔥 MODERN STATS */
.stat-box{
    display:flex;
    justify-content:space-between;
    align-items:center;
    padding:25px;
    border-radius:15px;
    color:white;
    transition:0.3s;
}

/* ❌ REMOVED CURSOR POINTER (NO CLICKABLE) */
.stat-box:hover{
    transform:translateY(-4px);
    box-shadow:0 8px 20px rgba(0,0,0,0.2);
}

.icon{
    font-size:50px;
}

/* GRADIENTS */
.bg-gradient-primary{
    background: linear-gradient(135deg, #007bff, #00c6ff);
}

.bg-gradient-success{
    background: linear-gradient(135deg, #28a745, #5cd65c);
}

.card{
    border-radius:12px;
    border:none;
    box-shadow:0 4px 10px rgba(0,0,0,0.1);
}

</style>

<?php include $_SERVER['DOCUMENT_ROOT'] . "/medical_system/web/layout/footer.php"; ?>