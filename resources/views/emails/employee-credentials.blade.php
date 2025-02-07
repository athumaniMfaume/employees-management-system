<!DOCTYPE html>
<html>
<head>
    <title>Welcome to the Company</title>
</head>
<body>
    <h1>Welcome to the Team!</h1>
    <p>Dear Employee,</p>
    <p>Your account has been created successfully. Below are your login credentials:</p>
    <p>
        <strong>Email:</strong> {{ $email }}<br>
        <strong>Password:</strong> {{ $password }}
    </p>
    <p>Please log in and change your password after your first login for security purposes.</p>
    <p>Thank you,<br>Employee Management Team</p>
</body>
</html>
