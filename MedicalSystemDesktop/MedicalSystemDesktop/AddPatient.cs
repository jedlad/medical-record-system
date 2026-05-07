using Newtonsoft.Json;
using System;
using System.Collections.Generic;
using System.Net.Http;
using System.Text;
using System.Windows.Forms;

namespace MedicalSystemDesktop
{
    public partial class AddPatient : Form
    {
        public AddPatient()
        {
            InitializeComponent();
        }

        // 🔥 MODEL
        public class Doctor
        {
            public int id { get; set; }
            public string name { get; set; }
        }

        // 🔥 LOAD DOCTORS (ONLY ONE)
        private async void AddPatient_Load(object sender, EventArgs e)
        {
            try
            {
                using (HttpClient client = new HttpClient())
                {
                    string url = "http://localhost/medical_system/api/doctors/get.php";

                    var json = await client.GetStringAsync(url);

                    List<Doctor> doctors = JsonConvert.DeserializeObject<List<Doctor>>(json);

                    cbDoctor.DataSource = doctors;
                    cbDoctor.DisplayMember = "name";
                    cbDoctor.ValueMember = "id";
                }
            }
            catch (Exception ex)
            {
                MessageBox.Show("❌ Error loading doctors: " + ex.Message);
            }
        }

        // 🔥 SAVE PATIENT
        private async void btnSave_Click(object sender, EventArgs e)
        {
            try
            {
                // ✅ VALIDATION
                if (txtFname.Text.Trim() == "" ||
                    txtLname.Text.Trim() == "" ||
                    txtPhil.Text.Trim() == "")
                {
                    MessageBox.Show("⚠ Please fill required fields");
                    return;
                }

                using (HttpClient client = new HttpClient())
                {
                    var data = new
                    {
                        first_name = txtFname.Text,
                        middle_name = txtMname.Text,
                        last_name = txtLname.Text,
                        philhealth_id = txtPhil.Text,
                        age = txtAge.Text,
                        address = txtAddress.Text,
                        sex = cbSex.Text,
                        civil_status = cbCivil.Text,
                        diagnosis = txtDiagnosis.Text,
                        remarks = txtRemarks.Text,
                        contact_number = txtContact.Text,
                        doctor_id = cbDoctor.SelectedValue,
                        date_admitted = dtAdmit.Value.ToString("yyyy-MM-dd"),
                        date_discharged = dtDischarged.Value.ToString("yyyy-MM-dd") // ✅ FIXED
                    };

                    string json = JsonConvert.SerializeObject(data);

                    var content = new StringContent(json, Encoding.UTF8, "application/json");

                    var response = await client.PostAsync(
                        "http://localhost/medical_system/api/patients/add.php",
                        content
                    );

                    string result = await response.Content.ReadAsStringAsync();

                    // 🔥 CHECK RESPONSE
                    if (result.Contains("success"))
                    {
                        MessageBox.Show("✅ Patient added successfully!");

                        ClearForm(); // 🔥 CLEAR INPUTS
                    }
                    else
                    {
                        MessageBox.Show("❌ Failed to add patient:\n" + result);
                    }
                }
            }
            catch (Exception ex)
            {
                MessageBox.Show("❌ Error: " + ex.Message);
            }
        }

        // 🔥 CLEAR FORM FUNCTION (ENHANCED)
        private void ClearForm()
        {
            txtFname.Clear();
            txtMname.Clear();
            txtLname.Clear();
            txtPhil.Clear();
            txtAge.Clear();
            txtAddress.Clear();
            txtDiagnosis.Clear();
            txtRemarks.Clear();
            txtContact.Clear();

            cbSex.SelectedIndex = -1;
            cbCivil.SelectedIndex = -1;
            cbDoctor.SelectedIndex = -1;

            dtAdmit.Value = DateTime.Now;
            dtDischarged.Value = DateTime.Now;
        }
    }
}