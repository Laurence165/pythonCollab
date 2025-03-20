🚀 Google Drive + Google Colab Python File Uploader

This project allows users to upload Python scripts (.py) to Google Drive and open them directly in Google Colab.

📌 Features

✅ Uploads Python files (.py)✅ Converts them to Jupyter Notebooks (.ipynb)✅ Opens the uploaded file in Google Colab✅ Uses Google OAuth 2.0 for authentication

🛠️ Setup Instructions

1️⃣ Clone the Repository

2️⃣ Install Dependencies

This project uses Composer for dependency management. Run:

This will install the Google API Client Library and other dependencies.

3️⃣ Set Up Google OAuth

To connect to Google Drive, you need to set up Google OAuth credentials.

🔹 Steps to Create credentials.json

Go to the Google API Console.

Create a new project (or select an existing one).

Enable Google Drive API.

Go to Credentials → Create Credentials → OAuth 2.0 Client ID.

Under Authorized Redirect URIs, add:

Download the JSON file and rename it to credentials.json.

Place it inside the project root.

4️⃣ Run the PHP Development Server

After setting up OAuth, start a local PHP server:

Now, open your browser and visit:

🎯 Usage

Log in with Google (OAuth will ask for permission).

Upload a Python (.py) file.

The script will be:

Converted into a Jupyter Notebook (.ipynb).

Uploaded to Google Drive.

Opened in Google Colab for execution.

❓ Troubleshooting

Issue: "credentials.json not found"

Make sure credentials.json is in the project root.

If missing, follow the Google OAuth setup above.

Issue: "Class Google\Client not found"

Run composer install to ensure dependencies are installed.

🛠️ Technologies Used

PHP

Google API Client (google/apiclient)

Composer

📜 License

This project is licensed under the MIT License.

🚀 Author

👤 Your Name🔗 GitHub | Website

