```html
<!DOCTYPE html>
<html>
<head>
<title>Medical System</title>

<!-- BOOTSTRAP -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

<!-- 🔥 ICONS -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

<style>

/* GLOBAL */
body { 
    margin:0; 
    font-family:Segoe UI; 
}

/* 🔥 SIDEBAR (LIGHT MEDICAL THEME) */
.sidebar {
    width:220px;
    height:100vh;
    position:fixed;
    top:0;
    left:0;

    background: linear-gradient(180deg, #e3f2fd, #bbdefb);
    color:#0d47a1;
}

/* LOGO AREA */
.sidebar .text-center {
    border-bottom:1px solid rgba(0,0,0,0.1);
}

/* SIDEBAR LINKS */
.sidebar a {
    color:#0d47a1;
    padding:12px;
    display:block;
    text-decoration:none;
    font-weight:500;
    transition:0.3s;
}

/* HOVER EFFECT */
.sidebar a:hover {
    background: rgba(13,110,253,0.15);
    border-radius:8px;
    padding-left:18px;
}

/* ACTIVE LINK */
.sidebar a.active {
    background:#0d6efd;
    color:white;
    border-radius:8px;
}

/* CONTENT AREA */
.content {
    margin-left:220px;
    padding:20px;
    background:#f4f6f9;
    min-height:100vh;
}

/* TOPBAR */
.topbar {
    background:white;
    padding:10px 20px;
    border-bottom:1px solid #ddd;
    display:flex;
    align-items:center;
}

/* LOGO */
.logo {
    width:35px;
    margin-right:10px;
}

/* BUTTON ICONS */
.btn i {
    font-size:14px;
}

/* OPTIONAL CARD STYLE */
.card {
    border-radius:12px;
    border:none;
    box-shadow:0 4px 10px rgba(0,0,0,0.08);
}

</style>

</head>

<body>
```
