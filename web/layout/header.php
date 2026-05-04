```html
<!DOCTYPE html>
<html>
<head>
<title>Medical System</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

<style>
body { 
    margin:0; 
    font-family:Segoe UI; 
}

/* 🔥 SIDEBAR (LIGHT + GRADIENT) */
.sidebar {
    width:220px;
    height:100vh;
    position:fixed;
    top:0;
    left:0;

    /* ✅ LIGHT MEDICAL GRADIENT */
    background: linear-gradient(180deg, #e3f2fd, #bbdefb);

    color:#0d47a1;
}

/* 🔥 LOGO AREA */
.sidebar .text-center {
    border-bottom:1px solid rgba(0,0,0,0.1);
}

/* 🔥 LINKS */
.sidebar a {
    color:#0d47a1;
    padding:12px;
    display:block;
    text-decoration:none;
    font-weight:500;
}

/* 🔥 HOVER */
.sidebar a:hover {
    background: rgba(13,110,253,0.1);
    border-radius:8px;
}

/* 🔥 ACTIVE */
.sidebar a.active {
    background:#0d6efd;
    color:white;
    border-radius:8px;
}

/* 🔥 CONTENT */
.content {
    margin-left:220px;
    padding:20px;
    background:#f4f6f9;
    min-height:100vh;
}

/* 🔥 TOPBAR */
.topbar {
    background:white;
    padding:10px 20px;
    border-bottom:1px solid #ddd;
    display:flex;
    align-items:center;
}

/* 🔥 LOGO */
.logo {
    width:35px;
    margin-right:10px;
}
</style>

</head>
<body>
```
