using Newtonsoft.Json;
using System;
using System.Collections.Generic;
using System.Net.Http;
using System.Windows.Forms;

namespace MedicalSystemDesktop
{
    public partial class Form1 : Form
    {
        public Form1()
        {
            InitializeComponent();
        }

        // 🔥 PATIENT MODEL
        public class Patient
        {
            public int id { get; set; } // ✅ IMPORTANT FOR DELETE

            public string first_name { get; set; }

            public string last_name { get; set; }

            public string doctor_name { get; set; }

            public string diagnosis { get; set; }
        }

        // 🔥 LOAD PATIENTS
        private async void btnLoad_Click(object sender, EventArgs e)
        {
            try
            {
                using (HttpClient client = new HttpClient())
                {
                    string url = "http://localhost/medical_system/api/patients/get.php";

                    var response = await client.GetStringAsync(url);

                    // 🔥 JSON → OBJECT
                    List<Patient> patients =
                        JsonConvert.DeserializeObject<List<Patient>>(response);

                    // 🔥 DISPLAY TO GRID
                    dataGridView1.DataSource = patients;

                    // 🔥 HIDE ID COLUMN
                    if (dataGridView1.Columns["id"] != null)
                    {
                        dataGridView1.Columns["id"].Visible = false;
                    }

                    // 🔥 OPTIONAL COLUMN TITLES
                    dataGridView1.Columns["first_name"].HeaderText = "First Name";
                    dataGridView1.Columns["last_name"].HeaderText = "Last Name";
                    dataGridView1.Columns["doctor_name"].HeaderText = "Doctor";
                    dataGridView1.Columns["diagnosis"].HeaderText = "Diagnosis";

                    // 🔥 AUTO SIZE
                    dataGridView1.AutoSizeColumnsMode =
                        DataGridViewAutoSizeColumnsMode.Fill;
                }
            }
            catch (Exception ex)
            {
                MessageBox.Show("❌ ERROR: " + ex.Message);
            }
        }

        // 🔥 OPEN ADD PATIENT FORM
        private void btnAdd_Click(object sender, EventArgs e)
        {
            AddPatient form = new AddPatient();

            form.ShowDialog();

            // 🔥 AUTO REFRESH AFTER ADD
            btnLoad.PerformClick();
        }

        // 🔥 DELETE PATIENT
        private async void btnDelete_Click(object sender, EventArgs e)
        {
            try
            {
                // 🔥 CHECK IF ROW SELECTED
                if (dataGridView1.CurrentRow == null)
                {
                    MessageBox.Show("⚠ Please select a patient first.");
                    return;
                }

                // 🔥 GET ID
                int id = Convert.ToInt32(
                    dataGridView1.CurrentRow.Cells["id"].Value
                );

                // 🔥 CONFIRM DELETE
                DialogResult result = MessageBox.Show(
                    "Are you sure you want to delete this patient?",
                    "Confirm Delete",
                    MessageBoxButtons.YesNo,
                    MessageBoxIcon.Warning
                );

                if (result != DialogResult.Yes)
                    return;

                using (HttpClient client = new HttpClient())
                {
                    string url =
                        "http://localhost/medical_system/api/patients/delete.php?id="
                        + id;

                    var response = await client.GetAsync(url);

                    string responseText =
                        await response.Content.ReadAsStringAsync();

                    MessageBox.Show("✅ Patient deleted successfully!");

                    // 🔥 AUTO REFRESH
                    btnLoad.PerformClick();
                }
            }
            catch (Exception ex)
            {
                MessageBox.Show("❌ Error: " + ex.Message);
            }
        }
    }
}