using Newtonsoft.Json;
using System;
using System.Net.Http;
using System.Text;
using System.Threading.Tasks;
using System.Windows.Forms;

namespace MedicalSystemDesktop
{
    public partial class Signup : Form
    {
        public Signup()
        {
            InitializeComponent();
        }

        private async Task SignupUser()
        {
            try
            {
                if (txtUsername.Text.Trim() == "" ||
                   txtPassword.Text.Trim() == "")
                {
                    MessageBox.Show(
                        "⚠ Please fill all fields"
                    );

                    return;
                }

                using (HttpClient client =
                    new HttpClient())
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
                        "http://localhost/medical_system/api/signup.php";

                    var response =
                        await client.PostAsync(
                            url,
                            content
                        );

                    string result =
                        await response.Content.ReadAsStringAsync();

                    dynamic res =
                        JsonConvert.DeserializeObject(result);

                    if (res.status == "success")
                    {
                        MessageBox.Show(
                            "✅ Account created successfully"
                        );

                        txtUsername.Clear();
                        txtPassword.Clear();
                    }
                    else
                    {
                        MessageBox.Show(
                            "❌ " + res.message
                        );
                    }
                }
            }
            catch (Exception ex)
            {
                MessageBox.Show(
                    "❌ Error: " + ex.Message
                );
            }
        }

        private async void btnSignup_Click(
            object sender,
            EventArgs e)
        {
            await SignupUser();
        }

        private void btnBack_Click_1(object sender, EventArgs e)
        {
            loginForm login = new loginForm();

            login.Show();

            this.Hide();
        }
    }
}