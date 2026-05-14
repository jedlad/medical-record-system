using Newtonsoft.Json;
using System;
using System.Net.Http;
using System.Text;
using System.Threading.Tasks;
using System.Windows.Forms;

namespace MedicalSystemDesktop
{
    public partial class loginForm : Form
    {
        public loginForm()
        {
            InitializeComponent();
        }

        private async Task LoginUser()
        {
            try
            {
                if (txtUsername.Text.Trim() == "" ||
                    txtPassword.Text.Trim() == "")
                {
                    MessageBox.Show("⚠ Please fill all fields");
                    return;
                }

                using (HttpClient client = new HttpClient())
                {
                    var data = new
                    {
                        username = txtUsername.Text,
                        password = txtPassword.Text
                    };

                    string json =
                        JsonConvert.SerializeObject(data);

                    var content =
                        new StringContent(
                            json,
                            Encoding.UTF8,
                            "application/json"
                        );

                    string url =
                        "http://localhost/medical_system/api/login.php";

                    var response =
                        await client.PostAsync(url, content);

                    string result =
                        await response.Content.ReadAsStringAsync();

                    dynamic res =
                        JsonConvert.DeserializeObject(result);

                    // 🔥 DEBUG
                    // MessageBox.Show(result);

                    if (res.status == "success")
                    {
                        MessageBox.Show("✅ Login successful");

                        Form1 dashboard = new Form1();

                        dashboard.Show();

                        this.Hide();
                    }
                    else
                    {
                        MessageBox.Show("❌ " + res.message);
                    }
                }
            }
            catch (Exception ex)
            {
                MessageBox.Show("❌ Error: " + ex.Message);
            }
        }

        // 🔥 LOGIN BUTTON
        private async void btnLogin_Click(object sender, EventArgs e)
        {
            await LoginUser();
        }
    }
}
