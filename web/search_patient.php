```php
<?php
include $_SERVER['DOCUMENT_ROOT'] . "/medical_system/web/layout/header.php";
include $_SERVER['DOCUMENT_ROOT'] . "/medical_system/web/layout/sidebar.php";
?>

<div class="content">

<!-- MESSAGE -->
<div id="msgBox"></div>

<div class="topbar">
    <img src="assets/img/system-logo.png" class="logo">
    <h5>Search Patient</h5>
</div>

<div class="mt-3">

<!-- SEARCH -->
<div class="card p-3 mb-3 shadow">
    <input id="search" class="form-control mb-2" placeholder="Enter Last Name or PhilHealth ID">
    <button onclick="load()" class="btn btn-success">Search</button>
</div>

<!-- TABLE -->
<div class="card p-3 shadow">
<table class="table table-hover">
<thead>
<tr>
<th>Name</th>
<th>Doctor</th>
<th>Diagnosis</th>
<th width="160">Action</th>
</tr>
</thead>

<tbody id="tbl">
<tr>
<td colspan="4" class="text-center text-muted">
Search patient first
</td>
</tr>
</tbody>
</table>
</div>

<!-- EDIT FORM -->
<div id="editBox" class="card p-4 mt-3 shadow" style="display:none;">
<h5>Edit Patient</h5>

<input type="hidden" id="edit_id">

<div class="row g-2">

<div class="col-md-4"><input id="fname" class="form-control"></div>
<div class="col-md-4"><input id="mname" class="form-control"></div>
<div class="col-md-4"><input id="lname" class="form-control"></div>

<div class="col-md-4"><input id="phil" class="form-control"></div>
<div class="col-md-4"><input id="age" type="number" class="form-control"></div>
<div class="col-md-4"><input id="contact" class="form-control"></div>

<div class="col-md-6"><input id="address" class="form-control"></div>

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

<div class="col-md-6"><input id="diagnosis" class="form-control"></div>
<div class="col-md-6"><input id="remarks" class="form-control"></div>

<div class="col-md-4"><input id="admit" type="date" class="form-control"></div>
<div class="col-md-4"><input id="discharge" type="date" class="form-control"></div>

<div class="col-md-4">
<select id="doctor" class="form-control"></select>
</div>

</div>

<button onclick="update()" class="btn btn-warning mt-3 w-100">
Update Patient
</button>

</div>

</div>
</div>

<!-- DELETE MODAL -->
<div id="deleteModal" style="
display:none;
position:fixed;
top:0; left:0;
width:100%; height:100%;
background:rgba(0,0,0,0.5);
justify-content:center;
align-items:center;
z-index:9999;
">

    <div style="
    background:white;
    padding:25px;
    border-radius:15px;
    width:320px;
    text-align:center;
    box-shadow:0 10px 30px rgba(0,0,0,0.3);
    animation:scaleIn 0.3s ease;
    ">

        <h5>⚠ Confirm Delete</h5>
        <p>Are you sure you want to delete this patient?</p>

        <button onclick="confirmDelete()" class="btn btn-danger w-100 mb-2">
            Yes, Delete
        </button>

        <button onclick="closeModal()" class="btn btn-secondary w-100">
            Cancel
        </button>

    </div>
</div>

<style>
@keyframes scaleIn {
    from {transform:scale(0.8); opacity:0;}
    to {transform:scale(1); opacity:1;}
}
</style>

<script>

// MESSAGE
function showMessage(type, message){
    let color = type === "success" ? "success" : "danger";

    let html = `
    <div class="alert alert-${color} alert-dismissible fade show mt-2">
        ${message}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>`;

    document.getElementById("msgBox").innerHTML = html;

    setTimeout(()=>{ msgBox.innerHTML = ""; },3000);
}


// SEARCH
function load(){

    const key = search.value.trim();

    if(key === ""){
        showMessage("error","❌ Please enter search keyword");

        tbl.innerHTML = `
        <tr><td colspan="4" class="text-center text-muted">Search patient first</td></tr>`;
        return;
    }

    fetch('/medical_system/api/patients/get.php?key=' + encodeURIComponent(key))
    .then(res => res.json())
    .then(data => {

        let html = "";

        if(data.length === 0){
            html = `<tr><td colspan="4" class="text-danger text-center">No records found</td></tr>`;
        } else {
            data.forEach(p=>{
                html += `
                <tr>
                    <td>${p.first_name} ${p.last_name}</td>
                    <td>${p.doctor_name || 'No Doctor Assigned'}</td>
                    <td>${p.diagnosis || ''}</td>
                    <td>
                        <button onclick="edit(${p.id})" class="btn btn-warning btn-sm">Edit</button>
                        <button onclick="del(${p.id})" class="btn btn-danger btn-sm">Delete</button>
                    </td>
                </tr>`;
            });
        }

        tbl.innerHTML = html;
    });
}


// LOAD DOCTORS
function loadDoctors(selectedId = null){
    fetch('/medical_system/api/doctors/get.php')
    .then(res=>res.json())
    .then(data=>{
        let options = "<option value=''>Select Doctor</option>";

        data.forEach(d=>{
            options += `<option value="${d.id}">${d.name || 'No Name'}</option>`;
        });

        doctor.innerHTML = options;

        if(selectedId){
            doctor.value = selectedId;
        }
    });
}


// EDIT
function edit(id){
    fetch('/medical_system/api/patients/get_one.php?id=' + id)
    .then(res=>res.json())
    .then(p=>{

        editBox.style.display = "block";

        edit_id.value = p.id;
        fname.value = p.first_name;
        mname.value = p.middle_name;
        lname.value = p.last_name;
        phil.value = p.philhealth_id;
        age.value = p.age;
        contact.value = p.contact_number;
        address.value = p.address;
        sex.value = p.sex;
        civil.value = p.civil_status;
        diagnosis.value = p.diagnosis;
        remarks.value = p.remarks;
        admit.value = p.date_admitted;
        discharge.value = p.date_discharged;

        loadDoctors(p.doctor_id);
    });
}


// UPDATE
function update(){

    fetch('/medical_system/api/patients/update.php',{
        method:'POST',
        headers:{'Content-Type':'application/json'},
        body: JSON.stringify({
            id: edit_id.value,
            first_name: fname.value,
            middle_name: mname.value,
            last_name: lname.value,
            philhealth_id: phil.value,
            age: age.value,
            address: address.value,
            sex: sex.value,
            civil_status: civil.value,
            diagnosis: diagnosis.value,
            remarks: remarks.value,
            contact_number: contact.value,
            doctor_id: doctor.value,
            date_admitted: admit.value,
            date_discharged: discharge.value
        })
    })
    .then(res=>res.json())
    .then(d=>{
        if(d.status === "success"){
            showMessage("success","✅ Patient Updated");
            editBox.style.display = "none";
            load();
        } else {
            showMessage("error","❌ Update failed");
        }
    });
}


// DELETE (MODAL)
let deleteId = null;

function del(id){
    deleteId = id;
    deleteModal.style.display = "flex";
}

function closeModal(){
    deleteModal.style.display = "none";
}

function confirmDelete(){
    fetch('/medical_system/api/patients/delete.php?id=' + deleteId)
    .then(()=>{
        closeModal();
        showMessage("success","✅ Patient Deleted");
        load();
    });
}

</script>

<?php include $_SERVER['DOCUMENT_ROOT'] . "/medical_system/web/layout/footer.php"; ?>
```
