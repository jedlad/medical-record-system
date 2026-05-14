using Newtonsoft.Json;
using System;
using System.Collections.Generic;
using System.Linq;
using System.Net.Http;
using System.Threading.Tasks;
using System.Windows.Forms;

namespace MedicalSystemDesktop
{
    public partial class AddDoctor : Form
    {
        public AddDoctor()
        {
            InitializeComponent();
        }

        // 🔥 DOCTOR MODEL
        public class Doctor
        {
            public int id { get; set; }

            public string name { get; set; }

            public string type { get; set; }
        }

        // 🔥 FORM LOAD
        private async void AddDoctor_Load_1(object sender, EventArgs e)
        {
            await LoadTypes();

            await LoadDoctors();
        }

        // 🔥 LOAD TYPES TO COMBOBOX
        private async Task LoadTypes()
        {
            try
            {
                using (HttpClient client = new HttpClient())
                {
                    string url =
                        "http://localhost/medical_system/api/doctors/get.php";

                    var response =
                        await client.GetStringAsync(url);

                    List<Doctor> doctors =
                        JsonConvert.DeserializeObject<List<Doctor>>(response);

                    // 🔥 CLEAR COMBOBOX
                    cbType.Items.Clear();

                    // 🔥 GET DISTINCT TYPES
                    var types = doctors
                        .Select(x => x.type)
                        .Distinct()
                        .ToList();

                    // 🔥 ADD TO COMBOBOX
                    foreach (var item in types)
                    {
                        cbType.Items.Add(item);
                    }

                    cbType.SelectedIndex = -1;
                }
            }
            catch (Exception ex)
            {
                MessageBox.Show(
                    "❌ Error loading types: "
                    + ex.Message);
            }
        }

        // 🔥 LOAD DOCTORS TO GRID
        private async Task LoadDoctors()
        {
            try
            {
                using (HttpClient client = new HttpClient())
                {
                    string url =
                        "http://localhost/medical_system/api/doctors/get.php";

                    var response =
                        await client.GetStringAsync(url);

                    List<Doctor> doctors =
                        JsonConvert.DeserializeObject<List<Doctor>>(response);

                    dataGridView1.DataSource = doctors;

                    // 🔥 AUTO SIZE
                    dataGridView1.AutoSizeColumnsMode =
                        DataGridViewAutoSizeColumnsMode.Fill;

                    // 🔥 HIDE ID
                    if (dataGridView1.Columns["id"] != null)
                    {
                        dataGridView1.Columns["id"].Visible = false;
                    }
                }
            }
            catch (Exception ex)
            {
                MessageBox.Show(
                    "❌ Error loading doctors: "
                    + ex.Message);
            }
        }

        // 🔥 CLEAR FORM
        private void ClearForm()
        {
            txtDoctorName.Clear();

            cbType.SelectedIndex = -1;
        }

        // 🔥 SAVE BUTTON
        private async void btnSave_Click(object sender, EventArgs e)
        {
            try
            {
                // 🔥 VALIDATION
                if (txtDoctorName.Text.Trim() == "" ||
                    cbType.Text == "")
                {
                    MessageBox.Show(
                        "⚠ Please fill all fields!");
                    return;
                }

                using (HttpClient client = new HttpClient())
                {
                    // 🔥 SEND DATA
                    var values = new Dictionary<string, string>
                    {
                        { "name", txtDoctorName.Text },
                        { "type", cbType.Text }
                    };

                    var content =
                        new FormUrlEncodedContent(values);

                    var response = await client.PostAsync(
                        "http://localhost/medical_system/api/doctors/add.php",
                        content
                    );

                    string result =
                        await response.Content.ReadAsStringAsync();

                    // 🔥 CHECK RESPONSE
                    if (result.Contains("success"))
                    {
                        MessageBox.Show(
                            "✅ Doctor added successfully!");

                        ClearForm();

                        // 🔥 REFRESH GRID
                        await LoadDoctors();

                        // 🔥 REFRESH TYPES
                        await LoadTypes();
                    }
                    else
                    {
                        MessageBox.Show(
                            "❌ Failed:\n" + result);
                    }
                }
            }
            catch (Exception ex)
            {
                MessageBox.Show(
                    "❌ Error: " + ex.Message);
            }
        }

    }
}