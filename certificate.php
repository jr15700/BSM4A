<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Certificate of Appreciation</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: 'Arial', sans-serif;
            background-color: #0f1122;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 100vh;
        }

        .certificate-container {
            width: 100%;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            position: relative;
            display: none; /* Hide the certificate initially */
        }

        .certificate {
            background-color: #0a0d1a;
            border: 2px solid #1e2e50;
            width: 70%;
            padding: 40px;
            box-shadow: 0px 0px 20px rgba(0, 0, 0, 0.8);
            text-align: center;
            color: #fff;
            position: relative;
        }

        .certificate h1 {
            font-size: 48px;
            color: #00aaff;
        }

        .certificate h2 {
            font-size: 24px;
            margin: 20px 0;
            color: #fff;
        }

        .certificate .certificate-text {
            font-size: 18px;
            margin: 20px 0;
            color: #9ba4b0;
        }

        .certificate .student-name {
            font-size: 32px;
            color: #00aaff;
            margin-bottom: 10px;
        }

        .certificate-footer {
            display: flex;
            justify-content: space-between;
            margin-top: 50px;
        }

        .certificate-footer div {
            width: 40%;
        }

        .certificate-footer p {
            margin: 10px 0;
            font-size: 18px;
        }

        .footer-signature {
            border-top: 1px solid #9ba4b0;
            padding-top: 10px;
            font-size: 16px;
        }

        .footer-title {
            color: #00aaff;
        }

        .globe-icon {
            position: absolute;
            top: 20px;
            left: 20px;
            width: 80px;
        }

        .globe-icon-right {
            position: absolute;
            top: 20px;
            right: 20px;
            width: 80px;
        }

        .form-container {
            margin-bottom: 20px;
            text-align: center;
        }

        .form-container input {
            padding: 10px;
            font-size: 16px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        .form-container button {
            padding: 10px 20px;
            font-size: 16px;
            background-color: #00aaff;
            border: none;
            border-radius: 4px;
            color: #fff;
            cursor: pointer;
        }

        .form-container button:hover {
            background-color: #0088cc;
        }
    </style>
</head>
<body>
    <div class="form-container">
        <input type="text" id="studentName" placeholder="Enter Student Name" required>
        <button onclick="generateCertificate()">Generate Certificate</button>
    </div>

    <div class="certificate-container" id="certificateContainer">
        <div class="certificate">
            <img src="left-globe.png" class="globe-icon" alt="globe icon left">
            <img src="right-globe.png" class="globe-icon-right" alt="globe icon right">

            <h1>CERTIFICATE</h1>
            <h2>OF APPRECIATION</h2>
            <p class="certificate-text">This award was given to</p>
            <p class="student-name" id="studentNameDisplay">[Student Name]</p>
            
            <p class="certificate-text">Seminar 2024</p>
            <p class="certificate-text">"Navigating the Digital Frontier: Evolving Marketing Strategies in the Age of Data and AI"</p>

            <div class="certificate-footer">
                <div>
                    <p class="footer-title">Mrs. Ronna Endrozo</p>
                    <p class="footer-signature">Adviser</p>
                </div>
                <div>
                    <p class="footer-title">Xyrah Nel Capablanca</p>
                    <p class="footer-signature">Class President</p>
                </div>
            </div>
        </div>
    </div>

    <script>
        function generateCertificate() {
            const studentName = document.getElementById('studentName').value;
            document.getElementById('studentNameDisplay').innerText = studentName;

            const certificateContainer = document.getElementById('certificateContainer');
            certificateContainer.style.display = 'flex'; // Show the certificate
        }
    </script>
</body>
</html>
