<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Welcome to Task & Finance Manager</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
        }

        .container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
        }

        .header {
            background: #4f46e5;
            color: white;
            padding: 20px;
            text-align: center;
        }

        .content {
            background: #f9f9f9;
            padding: 20px;
        }

        .button {
            display: inline-block;
            padding: 12px 24px;
            background: #4f46e5;
            color: white;
            text-decoration: none;
            border-radius: 5px;
        }

        .footer {
            text-align: center;
            padding: 20px;
            font-size: 12px;
            color: #666;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="header">
            <h1>Welcome to Task & Finance Manager! 🎉</h1>
        </div>

        <div class="content">
            <h2>Hello, {{ $user->name }}!</h2>

            <p>Thank you for joining our Task & Finance Manager application. We're excited to help you organize your
                tasks and manage your finances efficiently.</p>

            <h3>What you can do:</h3>
            <ul>
                <li>📝 Create and manage tasks with due dates</li>
                <li>💰 Track your expenses by categories</li>
                <li>📊 View detailed reports and analytics</li>
                <li>🔔 Get reminders and notifications</li>
            </ul>

            <p>If you have any questions, feel free to reply to this email.</p>

            <p>Best regards,<br>Task & Finance Manager Team</p>
        </div>

        <div class="footer">
            <p>&copy; {{ date('Y') }} Task & Finance Manager. All rights reserved.</p>
            <p>You're receiving this email because you signed up for our service.</p>
        </div>
    </div>
</body>

</html>
