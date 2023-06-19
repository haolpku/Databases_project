<!DOCTYPE html>
<html>
<head>
    <title>Registration and Login Form</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            flex-direction: row; 
            margin: 0;
        }
        form {
            background-color: white;
            display: flex;
            flex-direction: column;
            width: 300px;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0px 0px 10px 0px rgba(0,0,0,0.1);
            margin: 20px;
        }
        label, input, select {
            margin-bottom: 15px;
        }
        label {
            font-weight: bold;
        }
        input, select {
            padding: 10px;
            border-radius: 5px;
            border: 1px solid #ddd;
        }
        input[type="submit"] {
            background-color: #4caf50;
            color: white;
            cursor: pointer;
        }
        input[type="submit"]:hover {
            background-color: #45a049;
        }
        h2 {
            text-align: center;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <form action="register.php" method="post">
        <h2>Register</h2>
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" required>

        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required>

        <label for="type">Type:</label>
        <select id="type" name="type" required>
            <option value="lessor">lessor</option>
            <option value="renter">renter</option>
        </select>

        <input type="submit" value="Register">
    </form>

    <form action="login.php" method="post">
        <h2>Login</h2>
        <label for="login-username">Username:</label>
        <input type="text" id="login-username" name="username" required>

        <label for="login-password">Password:</label>
        <input type="password" id="login-password" name="password" required>

        <label for="login-type">Type:</label>
        <select id="login-type" name="type" required>
            <option value="lessor">lessor</option>
            <option value="renter">renter</option>
        </select>

        <input type="submit" value="Login">
    </form>
</body>
</html>


