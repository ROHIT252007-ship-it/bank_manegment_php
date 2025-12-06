<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Bank Login</title>
  <style>
    :root {
      --bg: #011535;
      --card: #11254c;
      --accent: #ffa500;
      --muted: #cbd5e1;
      --radius: 12px;
      --pad: 20px;
      --shadow: rgba(0, 0, 0, 0.5);
      font-family: Inter, Arial, sans-serif;
    }

    body {
      margin: 0;
      min-height: 100vh;
      display: flex;
      justify-content: center;
      align-items: center;
      background: linear-gradient(180deg, var(--bg), #081534);
      color: #fff;
    }

    .login-container {
      background: var(--card);
      padding: var(--pad);
      border-radius: var(--radius);
      width: 350px;
      box-shadow: 0 10px 30px var(--shadow);
      animation: fadeIn 0.5s ease forwards;
    }

    @keyframes fadeIn {
      0% { opacity: 0; transform: translateY(20px); }
      100% { opacity: 1; transform: translateY(0); }
    }

    .login-container h2 {
      text-align: center;
      margin-bottom: 20px;
      color: var(--accent);
      font-size: 22px;
    }

    .form-group {
      margin-bottom: 15px;
    }

    label {
      display: block;
      font-size: 14px;
      margin-bottom: 5px;
      color: var(--muted);
    }

    input[type="email"],
    input[type="password"] {
      width: 93%;
      padding: 10px 12px;
      border-radius: 8px;
      border: 1px solid #1e2f5c;
      background: #0f1f3a;
      color: #fff;
      font-size: 14px;
      outline: none;
      transition: box-shadow 0.2s, border-color 0.2s;
    }

    input:focus {
      border-color: var(--accent);
      box-shadow: 0 0 8px rgba(255,165,0,0.4);
    }

    button {
      width: 100%;
      padding: 12px;
      background: var(--accent);
      color: #0b1d3f;
      font-size: 16px;
      font-weight: 600;
      border: none;
      border-radius: 8px;
      cursor: pointer;
      transition: background 0.3s, transform 0.2s, box-shadow 0.2s;
      box-shadow: 0 6px 18px rgba(255,165,0,0.3);
    }

    button:hover {
      background: #ffb84d;
      transform: translateY(-2px);
      box-shadow: 0 10px 20px rgba(255,165,0,0.4);
    }

    .extra {
      text-align: center;
      margin-top: 12px;
    }

    .extra a {
      text-decoration: none;
      color: var(--accent);
      font-size: 14px;
      transition: color 0.2s;
    }

    .extra a:hover {
      color: #ffb84d;
    }

    @media(max-width:400px){
      .login-container{
        width: 90%;
        padding: 16px;
      }
    }
  </style>
</head>
<body>
  <div class="login-container">
    <h2>Bank Login</h2>
    <form action="loginback.php" method="POST" autocomplete="on">
      <div class="form-group">
        <label for="custEmail">Email</label>
        <input type="email" id="custEmail" name="custEmail" required placeholder="name@example.com">
      </div>
      <div class="form-group">
        <label for="custPassword">Password</label>
        <input type="password" id="custPassword" name="custPassword" required placeholder="Enter your password">
      </div>
      <button type="submit">Login</button>
      <div class="extra">
        <a href="from.php">New User? Register</a>
      </div>
    </form>
  </div>
</body>
</html>
