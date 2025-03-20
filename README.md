Google Drive + Google Colab Python File Uploader

This allows users to upload Python scripts (.py) to Google Drive and open them directly in Google Colab.

Features

- Uploads Python files (.py)
- Converts them to Jupyter Notebooks (.ipynb)
-  Opens the uploaded file in Google Colab
-  Uses Google OAuth 2.0 for authentication

 Setup Instructions

1️⃣ Clone the Repository

2️⃣ Install Dependencies

Run: 
```bash
composer install
```
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


Now, open your browser and visit:
```bash
http://server-name/login.php
```
Usage

Log in with Google (OAuth will ask for permission).

Upload a Python (.py) file.

The script will be:

Converted into a Jupyter Notebook (.ipynb).

Uploaded to Google Drive.

Opened in Google Colab for execution.

Troubleshooting

Issue: "credentials.json not found"

Make sure credentials.json is in the project root.

If missing, follow the Google OAuth setup above.

Issue: "Class Google\Client not found"

Run composer install to ensure dependencies are installed.


Laurence Liu

