```php
<?php
include $_SERVER['DOCUMENT_ROOT'] . "/medical_system/web/layout/header.php";
include $_SERVER['DOCUMENT_ROOT'] . "/medical_system/web/layout/sidebar.php";
?>

<div class="content">

<!-- ✅ MESSAGE BOX -->
<div id="msgBox"></div>

<div class="topbar">
    <img src="assets/img/system-logo.png" class="logo">
    <h3>Doctors</h3>
</div>

<div class="mt-3">

<!-- ➕ ADD DOCTOR -->
<div class="card p-3 mb-3 shadow">
    <input id="name" class="form-control mb-2" placeholder="Doctor Name">

    <select id="type" class="form-control mb-2">
        <option value="">Select Type</option>
        <option>Baby Doctor</option>
        <option>Adult Doctor</option>
        <option>X-Ray</option>
        <option>Eye</option>
        <option>Internal Organs</option>
    </select>

    <button onclick="addDoctor()" class="btn btn-primary w-100">
        Add Doctor
    </button>
</div>

<!-- 📋 LIST -->
<div class="card p-3 shadow">
<table class="table table-hover">
<thead class="table-light">
<tr>
<th>Name</th>
<th>Type</th>
</tr>
</thead>

<tbody id="tbl"></tbody>

</table>
</div>

</div>
</div>

<script>

// 🔥 MESSAGE FUNCTION (same as patients)
function showMessage(type, message){

    let color = type === "success" ? "success" : "danger";

    let html = `
    <div class="alert alert-${color} alert-dismissible fade show mt-2" role="alert">
        ${message}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>`;

    document.getElementById("msgBox").innerHTML = html;

    setTimeout(()=>{
        document.getElementById("msgBox").innerHTML = "";
    },3000);
}


// 🔥 LOAD DOCTORS
function loadDoctors(){
    fetch('../api/doctors/get.php')
    .then(res=>res.json())
    .then(data=>{

        let html="";

        if(data.length === 0){
            html = `<tr><td colspan="2" class="text-center text-muted">No doctors found</td></tr>`;
        } else {
            data.forEach(d=>{

                let name = d.name ? d.name : "No Name";

                html += `
                <tr>
                    <td>${name}</td>
                    <td>${d.type}</td>
                </tr>`;
            });
        }

        document.getElementById("tbl").innerHTML = html;
    });
}


// 🔥 ADD DOCTOR
function addDoctor(){

    const nameInput = document.getElementById("name");
    const typeInput = document.getElementById("type");

    const name = nameInput.value.trim();
    const type = typeInput.value.trim();

    // VALIDATION
    if(name === "" || type === ""){
        showMessage("error","❌ Please fill all fields");
        return;
    }

    fetch('/medical_system/api/doctors/add.php',{
        method:'POST',
        headers:{'Content-Type':'application/x-www-form-urlencoded'},
        body:`name=${encodeURIComponent(name)}&type=${encodeURIComponent(type)}`
    })
    .then(res => res.json())
    .then(data=>{
        if(data.status === "success"){

            showMessage("success","✅ Doctor Added Successfully");

            // RESET
            nameInput.value = "";
            typeInput.value = "";

            loadDoctors();

        } else {
            showMessage("error","❌ " + (data.message || "Error adding doctor"));
        }
    })
    .catch(()=>{
        showMessage("error","❌ Server error");
    });
}


// 🔥 INIT
loadDoctors();

</script>

<?php include $_SERVER['DOCUMENT_ROOT'] . "/medical_system/web/layout/footer.php"; ?>
```
