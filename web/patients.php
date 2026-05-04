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
    <h5>Add Patient</h5>
</div>

<div class="mt-3">
<div class="card p-4 shadow">

<h4 class="mb-3">Patient Information</h4>

<div class="row g-2">

<div class="col-md-4"><input id="fname" class="form-control" placeholder="First Name"></div>
<div class="col-md-4"><input id="mname" class="form-control" placeholder="Middle Name"></div>
<div class="col-md-4"><input id="lname" class="form-control" placeholder="Last Name"></div>

<div class="col-md-4"><input id="phil" class="form-control" placeholder="PhilHealth ID"></div>
<div class="col-md-4"><input id="age" type="number" class="form-control" placeholder="Age"></div>
<div class="col-md-4"><input id="contact" class="form-control" placeholder="Contact"></div>

<div class="col-md-6"><input id="address" class="form-control" placeholder="Address"></div>

<div class="col-md-3">
<select id="sex" class="form-control">
<option value="">Sex</option>
<option>Male</option>
<option>Female</option>
</select>
</div>

<div class="col-md-3">
<select id="civil" class="form-control">
<option value="">Civil Status</option>
<option>Single</option>
<option>Married</option>
</select>
</div>

<div class="col-md-6"><input id="diagnosis" class="form-control" placeholder="Diagnosis"></div>
<div class="col-md-6"><input id="remarks" class="form-control" placeholder="Remarks"></div>

<div class="col-md-4">
<label>Date Admitted</label>
<input id="admit" type="date" class="form-control">
</div>

<div class="col-md-4">
<label>Date Discharged</label>
<input id="discharge" type="date" class="form-control">
</div>

<div class="col-md-4">
<label>Doctor</label>
<select id="doctor" class="form-control"></select>
</div>

</div>

<button onclick="add()" class="btn btn-primary mt-3 w-100">
Save Patient
</button>

</div>
</div>

</div>

<script>

// 🔥 LOAD DOCTORS
function loadDoctors(){
    fetch('../api/doctors/get.php')
    .then(res=>res.json())
    .then(data=>{
        let opt = "<option value=''>Select Doctor</option>";
        data.forEach(d=>{
            let name = d.name ? d.name : "No Name";
            opt += `<option value="${d.id}">${name}</option>`;
        });
        document.getElementById("doctor").innerHTML = opt;
    });
}


// 🔥 MESSAGE FUNCTION
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


// 🔥 ADD PATIENT
function add(){

    // VALIDATION
    if(fname.value === "" || lname.value === "" || phil.value === ""){
        showMessage("error", "❌ Please fill all required fields");
        return;
    }

    fetch('../api/patients/add.php',{
        method:'POST',
        headers:{'Content-Type':'application/json'},
        body:JSON.stringify({
            first_name:fname.value,
            middle_name:mname.value,
            last_name:lname.value,
            philhealth_id:phil.value,
            age:age.value,
            address:address.value,
            sex:sex.value,
            civil_status:civil.value,
            diagnosis:diagnosis.value,
            remarks:remarks.value,
            contact_number:contact.value,
            doctor_id:doctor.value,
            date_admitted:admit.value,
            date_discharged:discharge.value
        })
    })
    .then(res=>res.json())
    .then(d=>{
        if(d.status==="success"){

            showMessage("success","✅ Patient Added Successfully");

            // RESET FORM (clean)
            document.querySelectorAll("input").forEach(i=>{
                if(i.type !== "date") i.value="";
            });
            document.querySelectorAll("select").forEach(s=>s.value="");

        } else {
            showMessage("error","❌ " + (d.message || "Error saving patient"));
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
