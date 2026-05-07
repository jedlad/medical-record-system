using Newtonsoft.Json;
using System;
using System.Collections.Generic;
using System.ComponentModel;
using System.Data;
using System.Drawing;
using System.Linq;
using System.Net.Http;
using System.Text;
using System.Threading.Tasks;
using System.Windows.Forms;

namespace MedicalSystemDesktop
{
    public partial class Form1: Form
    {
        public Form1()
        {
            InitializeComponent();
        }

        public class Patient
        {
            public string first_name { get; set; }
            public string last_name { get; set; }
            public string doctor_name { get; set; }
            public string diagnosis { get; set; }
        }

        private async void btnLoad_Click(object sender, EventArgs e)
        {
            try
            {
                HttpClient client = new HttpClient();

                string url = "http://localhost/medical_system/api/patients/get.php";

                var response = await client.GetStringAsync(url);

                // 🔥 Convert JSON to C# object
                List<Patient> patients = JsonConvert.DeserializeObject<List<Patient>>(response);

                // 🔥 Display in DataGridView
                dataGridView1.DataSource = patients;
            }
            catch (Exception ex)
            {
                MessageBox.Show("ERROR: " + ex.Message);
            }
        }

        private void btnAdd_Click(object sender, EventArgs e)
        {
            AddPatient form = new AddPatient();
            this.Hide();
            form.ShowDialog(); // 🔥 open as modal
        }
    }
}
