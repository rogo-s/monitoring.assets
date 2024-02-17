<?php
session_start();

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>PT Masaji Tatanan Kontainer Indonesia</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background: url('assets/Samuderacontainer.jpg') center/1200px 550px;
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
    }

    .login-container {
      background-color: rgba(255, 255, 255, 0.7);
      border-radius: 10px;
      padding: 20px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
    }

    .login-container h2 {
      text-align: center;
      margin-bottom: 30px;
    }

    .login-container input[type="text"],
    .login-container input[type="password"] {
      width: 95%;
      padding: 10px;
      margin-bottom: 20px;
      border: none;
      border-radius: 5px;
      outline: none;
    }

    .login-container input[type="submit"] {
      width: 100%;
      padding: 10px;
      border: none;
      border-radius: 5px;
      outline: none;
      cursor: pointer;
      background-color: #4ca1af;
      color: #fff;
      font-weight: bold;
    }

    .login-container input[type="submit"]:hover {
      background-color: #357d8c;
    }
  </style>

</head>

<body>
  <div class="login-container">
    <h2>Login</h2>
    <form class="login100-form validate-form" action="functions/functions_login.php" method="POST">
      <input type="text" name="TXTuname" placeholder="Username" required>
      <input type="password" name="TXTpass" placeholder="Password" required>
      <input type="submit" value="Login">
    </form>
  </div>
</body>

</html>