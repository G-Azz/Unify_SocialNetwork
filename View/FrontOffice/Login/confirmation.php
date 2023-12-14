


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Confirmation</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            color: #495057;
            text-align: center;
            margin: 0;
            overflow: hidden;
        }

        .background {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: -1;
            opacity: 0.3;
            animation: backgroundAnimation 10s infinite linear;
        }

        @keyframes backgroundAnimation {
            0% {
                transform: scale(1);
            }

            50% {
                transform: scale(1.1);
            }

            100% {
                transform: scale(1);
            }
        }

        h1 {
            color: #dc3545;
            font-size: 2.5em;
            margin-bottom: 20px;
            animation: fadeInUp 1s ease-out;
        }

        p {
            font-size: 1.2em;
            line-height: 1.6;
            margin-bottom: 30px;
            animation: fadeIn 1s ease-out;
        }

        a {
            color: #dc3545;
            text-decoration: none;
            font-weight: bold;
            transition: color 0.3s ease;
        }

        a:hover {
            color: #c82333;
            text-decoration: underline;
        }

        .container {
            position: relative;
            z-index: 1;
            max-width: 600px;
            margin: 0 auto;
            padding: 30px;
            background-color: #ffffff;
            border-radius: 12px;
            box-shadow: 0 0 30px rgba(0, 0, 0, 0.2);
            animation: slideIn 1s ease-out;
        }

        .accent-bg {
            background-color: #dc3545;
            color: #fff;
            padding: 15px;
            border-radius: 8px;
            margin-top: 20px;
            animation: fadeIn 1s ease-out, moveUp 1s ease-out;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
            }

            to {
                opacity: 1;
            }
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes slideIn {
            from {
                opacity: 0;
                transform: translateY(-30px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes moveUp {
            from {
                transform: translateY(20px);
            }

            to {
                transform: translateY(0);
            }
        }
    </style>
</head>

<body>
    <div class="background"></div>
    <div class="container">
        <h1>Registration Successful</h1>
        <p>Congratulations on your successful registration! An email with a verification code has been sent to your inbox.</p>
        <p>Please check your email for the verification code and click <a href="verification.php">here</a> to enter it.</p>
        <div class="accent-bg">Thank you for choosing our platform!</div>
    </div>
</body>

</html>
