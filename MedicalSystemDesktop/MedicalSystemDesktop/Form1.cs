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
    public partial class Form1 : Form
    {
        public Form1()
        {
            InitializeComponent();
        }

        // 🔥 PATIENT MODEL
        public class Patient
        {
            public string first_name { get; set; }
            public string last_name { get; set; }
            public string doctor_name { get; set; }
            public string diagnosis { get; set; }
        }

        // 🔥 LOAD FORM INSIDE panelMain
        private void LoadForm(Form form)
        {
            // 🔥 CLEAR OLD FORM
            panelMain.Controls.Clear();

            // 🔥 FORM SETTINGS
            form.TopLevel = false;
            form.FormBorderStyle = FormBorderStyle.None;
            form.Dock = DockStyle.Fill;

            // 🔥 ADD TO PANEL
            panelMain.Controls.Add(form);
            panelMain.Tag = form;

            form.Show();
        }

        // 🔥 ADD BUTTON
        private void btnAdd_Click(object sender, EventArgs e)
        {
            LoadForm(new AddPatient());
        }

        // 🔥 LOGOUT BUTTON
        private void btnLogout_Click(object sender, EventArgs e)
        {
            DialogResult result = MessageBox.Show(
                "Are you sure you want to logout?",
                "Logout",
                MessageBoxButtons.YesNo,
                MessageBoxIcon.Question
            );

            if (result == DialogResult.Yes)
            {
                // 🔥 OPEN LOGIN FORM
                loginForm loginForm = new loginForm();
                loginForm.Show();

                // 🔥 CLOSE CURRENT FORM
                this.Hide();
            }
        }

        private void btnAddDoc_Click(object sender, EventArgs e)
        {
            LoadForm(new AddDoctor());
        }
    }
}