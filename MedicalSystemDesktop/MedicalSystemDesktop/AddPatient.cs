using Newtonsoft.Json;
using System;
using System.Collections.Generic;
using System.Net.Http;
using System.Text;
using System.Windows.Forms;
using static MedicalSystemDesktop.Form1;

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

        // 🔥 FORM LOAD
        private async void AddPatient_Load(object sender, EventArgs e)
        {
            try
            {
                // 🔥 HIDE GRID FIRST
                dataGridView1.Visible = false;

                using (HttpClient client = new HttpClient())
                {
                    string url = "http://localhost/medical_system/api/doctors/get.php";

                    var json = await client.GetStringAsync(url);

                    List<Doctor> doctors =
                        JsonConvert.DeserializeObject<List<Doctor>>(json);

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

        //SAVE BUTTON
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

        //LOAD BUTTON
        private async void btnLoad_Click(object sender, EventArgs e)
        {
            try
            {
                // 🔥 SHOW GRID
                dataGridView1.Visible = true;

                // 🔥 HIDE ADD CONTROLS
                label1.Visible = false;
                label2.Visible = false;
                label3.Visible = false;
                label4.Visible = false;
                label5.Visible = false;
                label6.Visible = false;
                label7.Visible = false;
                label8.Visible = false;
                label9.Visible = false;
                label10.Visible = false;
                label11.Visible = false;
                label12.Visible = false;
                label13.Visible = false;
                label14.Visible = false;
                txtFname.Visible = false;
                txtMname.Visible = false;
                txtLname.Visible = false;
                txtPhil.Visible = false;
                txtAge.Visible = false;
                txtAddress.Visible = false;
                txtDiagnosis.Visible = false;
                txtRemarks.Visible = false;
                txtContact.Visible = false;

                cbSex.Visible = false;
                cbCivil.Visible = false;
                cbDoctor.Visible = false;

                dtAdmit.Visible = false;
                dtDischarged.Visible = false;

                btnSave.Visible = false;

                HttpClient client = new HttpClient();

                string url =
                    "http://localhost/medical_system/api/patients/get.php";

                var response = await client.GetStringAsync(url);

                List<Patient> patients =
                    JsonConvert.DeserializeObject<List<Patient>>(response);

                dataGridView1.DataSource = patients;

                // 🔥 AUTO FIT COLUMNS
                dataGridView1.AutoSizeColumnsMode =
                    DataGridViewAutoSizeColumnsMode.Fill;

                // 🔥 HIDE ID
                if (dataGridView1.Columns["id"] != null)
                {
                    dataGridView1.Columns["id"].Visible = false;
                }
            }
            catch (Exception ex)
            {
                MessageBox.Show("❌ ERROR: " + ex.Message);
            }
        }

        private void btnClose_Click(object sender, EventArgs e)
        {
            this.Close();
        }
    }
}