namespace MedicalSystemDesktop
{
    partial class AddPatient
    {
        /// <summary>
        /// Required designer variable.
        /// </summary>
        private System.ComponentModel.IContainer components = null;

        /// <summary>
        /// Clean up any resources being used.
        /// </summary>
        /// <param name="disposing">true if managed resources should be disposed; otherwise, false.</param>
        protected override void Dispose(bool disposing)
        {
            if (disposing && (components != null))
            {
                components.Dispose();
            }
            base.Dispose(disposing);
        }

        #region Windows Form Designer generated code

        /// <summary>
        /// Required method for Designer support - do not modify
        /// the contents of this method with the code editor.
        /// </summary>
        private void InitializeComponent()
        {
            this.txtFname = new System.Windows.Forms.TextBox();
            this.txtMname = new System.Windows.Forms.TextBox();
            this.txtLname = new System.Windows.Forms.TextBox();
            this.txtPhil = new System.Windows.Forms.TextBox();
            this.txtAge = new System.Windows.Forms.TextBox();
            this.txtContact = new System.Windows.Forms.TextBox();
            this.txtAddress = new System.Windows.Forms.TextBox();
            this.txtDiagnosis = new System.Windows.Forms.TextBox();
            this.txtRemarks = new System.Windows.Forms.TextBox();
            this.cbSex = new System.Windows.Forms.ComboBox();
            this.cbCivil = new System.Windows.Forms.ComboBox();
            this.cbDoctor = new System.Windows.Forms.ComboBox();
            this.dtAdmit = new System.Windows.Forms.DateTimePicker();
            this.dtDischarged = new System.Windows.Forms.DateTimePicker();
            this.btnSave = new System.Windows.Forms.Button();
            this.SuspendLayout();
            // 
            // txtFname
            // 
            this.txtFname.Location = new System.Drawing.Point(79, 38);
            this.txtFname.Name = "txtFname";
            this.txtFname.Size = new System.Drawing.Size(235, 26);
            this.txtFname.TabIndex = 0;
            // 
            // txtMname
            // 
            this.txtMname.Location = new System.Drawing.Point(79, 97);
            this.txtMname.Name = "txtMname";
            this.txtMname.Size = new System.Drawing.Size(235, 26);
            this.txtMname.TabIndex = 1;
            // 
            // txtLname
            // 
            this.txtLname.Location = new System.Drawing.Point(79, 159);
            this.txtLname.Name = "txtLname";
            this.txtLname.Size = new System.Drawing.Size(235, 26);
            this.txtLname.TabIndex = 2;
            // 
            // txtPhil
            // 
            this.txtPhil.Location = new System.Drawing.Point(79, 224);
            this.txtPhil.Name = "txtPhil";
            this.txtPhil.Size = new System.Drawing.Size(235, 26);
            this.txtPhil.TabIndex = 3;
            // 
            // txtAge
            // 
            this.txtAge.Location = new System.Drawing.Point(79, 278);
            this.txtAge.Name = "txtAge";
            this.txtAge.Size = new System.Drawing.Size(235, 26);
            this.txtAge.TabIndex = 4;
            // 
            // txtContact
            // 
            this.txtContact.Location = new System.Drawing.Point(79, 346);
            this.txtContact.Name = "txtContact";
            this.txtContact.Size = new System.Drawing.Size(235, 26);
            this.txtContact.TabIndex = 5;
            // 
            // txtAddress
            // 
            this.txtAddress.Location = new System.Drawing.Point(79, 410);
            this.txtAddress.Name = "txtAddress";
            this.txtAddress.Size = new System.Drawing.Size(235, 26);
            this.txtAddress.TabIndex = 6;
            // 
            // txtDiagnosis
            // 
            this.txtDiagnosis.Location = new System.Drawing.Point(79, 477);
            this.txtDiagnosis.Name = "txtDiagnosis";
            this.txtDiagnosis.Size = new System.Drawing.Size(235, 26);
            this.txtDiagnosis.TabIndex = 7;
            // 
            // txtRemarks
            // 
            this.txtRemarks.Location = new System.Drawing.Point(79, 545);
            this.txtRemarks.Name = "txtRemarks";
            this.txtRemarks.Size = new System.Drawing.Size(235, 26);
            this.txtRemarks.TabIndex = 8;
            // 
            // cbSex
            // 
            this.cbSex.FormattingEnabled = true;
            this.cbSex.Items.AddRange(new object[] {
            "Male",
            "Female"});
            this.cbSex.Location = new System.Drawing.Point(424, 97);
            this.cbSex.Name = "cbSex";
            this.cbSex.Size = new System.Drawing.Size(242, 28);
            this.cbSex.TabIndex = 9;
            // 
            // cbCivil
            // 
            this.cbCivil.FormattingEnabled = true;
            this.cbCivil.Items.AddRange(new object[] {
            "Single",
            "Married"});
            this.cbCivil.Location = new System.Drawing.Point(424, 168);
            this.cbCivil.Name = "cbCivil";
            this.cbCivil.Size = new System.Drawing.Size(242, 28);
            this.cbCivil.TabIndex = 10;
            // 
            // cbDoctor
            // 
            this.cbDoctor.FormattingEnabled = true;
            this.cbDoctor.Location = new System.Drawing.Point(424, 243);
            this.cbDoctor.Name = "cbDoctor";
            this.cbDoctor.Size = new System.Drawing.Size(242, 28);
            this.cbDoctor.TabIndex = 11;
            // 
            // dtAdmit
            // 
            this.dtAdmit.Location = new System.Drawing.Point(439, 335);
            this.dtAdmit.Name = "dtAdmit";
            this.dtAdmit.Size = new System.Drawing.Size(284, 26);
            this.dtAdmit.TabIndex = 12;
            // 
            // dtDischarged
            // 
            this.dtDischarged.Location = new System.Drawing.Point(451, 408);
            this.dtDischarged.Name = "dtDischarged";
            this.dtDischarged.Size = new System.Drawing.Size(284, 26);
            this.dtDischarged.TabIndex = 13;
            // 
            // btnSave
            // 
            this.btnSave.Location = new System.Drawing.Point(631, 502);
            this.btnSave.Name = "btnSave";
            this.btnSave.Size = new System.Drawing.Size(174, 52);
            this.btnSave.TabIndex = 14;
            this.btnSave.Text = "Save";
            this.btnSave.UseVisualStyleBackColor = true;
            this.btnSave.Click += new System.EventHandler(this.btnSave_Click);
            // 
            // AddPatient
            // 
            this.AutoScaleDimensions = new System.Drawing.SizeF(9F, 20F);
            this.AutoScaleMode = System.Windows.Forms.AutoScaleMode.Font;
            this.ClientSize = new System.Drawing.Size(1028, 625);
            this.Controls.Add(this.btnSave);
            this.Controls.Add(this.dtDischarged);
            this.Controls.Add(this.dtAdmit);
            this.Controls.Add(this.cbDoctor);
            this.Controls.Add(this.cbCivil);
            this.Controls.Add(this.cbSex);
            this.Controls.Add(this.txtRemarks);
            this.Controls.Add(this.txtDiagnosis);
            this.Controls.Add(this.txtAddress);
            this.Controls.Add(this.txtContact);
            this.Controls.Add(this.txtAge);
            this.Controls.Add(this.txtPhil);
            this.Controls.Add(this.txtLname);
            this.Controls.Add(this.txtMname);
            this.Controls.Add(this.txtFname);
            this.Name = "AddPatient";
            this.Text = "AddPatient";
            this.Load += new System.EventHandler(this.AddPatient_Load);
            this.ResumeLayout(false);
            this.PerformLayout();

        }

        #endregion

        private System.Windows.Forms.TextBox txtFname;
        private System.Windows.Forms.TextBox txtMname;
        private System.Windows.Forms.TextBox txtLname;
        private System.Windows.Forms.TextBox txtPhil;
        private System.Windows.Forms.TextBox txtAge;
        private System.Windows.Forms.TextBox txtContact;
        private System.Windows.Forms.TextBox txtAddress;
        private System.Windows.Forms.TextBox txtDiagnosis;
        private System.Windows.Forms.TextBox txtRemarks;
        private System.Windows.Forms.ComboBox cbSex;
        private System.Windows.Forms.ComboBox cbCivil;
        private System.Windows.Forms.ComboBox cbDoctor;
        private System.Windows.Forms.DateTimePicker dtAdmit;
        private System.Windows.Forms.DateTimePicker dtDischarged;
        private System.Windows.Forms.Button btnSave;
    }
}