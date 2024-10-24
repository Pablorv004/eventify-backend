<!DOCTYPE html>
<html>

<head>
    <title>Verify Your Email Address</title>
    <style>
        /* Add your custom styles here */

        p,
        h1,
        h3,
        h4 {
            color: #000000;
        }

        a {
            color: #ffffff;
        }

        .container {
            width: 100%;
            padding: 20px;
            background-color: #e8e2dc;
        }

        .content {
            max-width: 600px;
            margin: 0 auto;
            background-color: #ffffff;
            padding: 20px;
            border: 1px solid #454545;
            text-align: center;
        }

        .button {
            display: inline-block;
            padding: 10px 20px;
            color: #ffffff;
            background-color: #007bff;
            text-decoration: none;
            border-radius: 5px;
        }
    </style>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">
</head>

<body>
    <div class="container">
        <div class="content">
            <img src="https://i.imgur.com/VdTTujU.png" alt="Eventify">
            <p>Your account has been activated</p>

            <h1>Hello {{ $user->name }},</h1>
            <p>this email has been sent to you to notify the activation of your Eventify account.</p>

            <p>You can now log in to your account.</p>

            <p>If you did not create an account, someone could have created an account with your email address.</p>

            <p>Thanks,<br><strong>Eventify</strong></p>
        </div>
    </div>
</body>

</html>