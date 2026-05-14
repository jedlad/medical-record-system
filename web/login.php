<?php
session_start();
include "../api/db.php";

if($_SERVER['REQUEST_METHOD'] == 'POST'){

    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    if($username == "" || $password == ""){
        $error = "Please fill all fields!";
    } else {

        $stmt = $conn->prepare("SELECT * FROM users WHERE username=?");
        $stmt->bind_param("s", $username);
        $stmt->execute();

        $res = $stmt->get_result();

        if($res->num_rows > 0){

            $user = $res->fetch_assoc();

            if(
                $user['password'] === md5($password) || 
                $user['password'] === $password
            ){
                $_SESSION['user'] = $username;
                header("Location: dashboard.php");
                exit();
            } else {
                $error = "❌ Invalid password!";
            }

        } else {
            $error = "❌ User not found!";
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Login</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

<!-- 🔥 ICONS -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

<style>
body {
    margin: 0;
    height: 100vh;
    background: url('assets/img/bg-medical.png') no-repeat center center/cover;
    position: relative;
}

body::before {
    content: "";
    position: fixed;
    top: 0; left: 0;
    width: 100%; height: 100%;
    backdrop-filter: blur(1px);
    background: rgba(255,255,255,0.1);
    z-index: 0;
}

.container {
    position: relative;
    z-index: 1;
}

.card {
    border-radius: 15px;
    backdrop-filter: blur(10px);
    background: rgba(255,255,255,0.15);
    color: white;
}

.btn-primary {
    background: linear-gradient(135deg, #007bff, #00c6ff);
    border: none;
    border-radius: 10px;
    padding: 12px;
    font-weight: bold;
}

.input-group-text {
    cursor: pointer;
}

/* 🔥 ICON SPACING */
.btn i {
    margin-right: 6px;
}
</style>

</head>

<body>

<div class="container mt-5">
<div class="card p-4 col-md-4 mx-auto shadow">

<div class="text-center mb-3">
    <img src="assets/img/system-logo.png" width="90">
</div>

<h4 class="text-center mb-3">Medical Record Login</h4>

<?php if(isset($error)): ?>
<div class="alert alert-danger text-center">
    <?php echo $error; ?>
</div>
<?php endif; ?>

<form method="POST">

<input name="username" class="form-control mb-2" placeholder="Username" required>

<div class="input-group mb-3">
    <input name="password" type="password" id="password" class="form-control" placeholder="Password" required>

    <span class="input-group-text" onclick="togglePassword()" id="eyeBtn">
        👁
    </span>
</div>

<!-- 🔥 UPDATED BUTTON WITH ICON -->
<button class="btn btn-primary w-100">
    <i class="fa fa-right-to-bracket"></i> Login
</button>

</form>

</div>
</div>

<script>
function togglePassword(){

    const pass = document.getElementById("password");
    const btn = document.getElementById("eyeBtn");

    if(pass.type === "password"){
        pass.type = "text";
        btn.innerHTML = "🙈";
    } else {
        pass.type = "password";
        btn.innerHTML = "👁";
    }
}
</script>

</body>
</html>
```
