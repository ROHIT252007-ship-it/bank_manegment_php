<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width,initial-scale=1" />
  <title>Bank Customer Registration</title>
  <style>
    :root{
      --bg:#011535ff; 
      --card:#11254c;
      --accent:#ffa500;
      --muted:#cbd5e1;
      --radius:12px;
      --pad:18px;
      font-family: Inter, ui-sans-serif, system-ui, -apple-system, "Segoe UI", Roboto, "Helvetica Neue", Arial;
    }

    body{
      margin:0;
      min-height:100vh;
      background:linear-gradient(180deg,var(--bg),#081534);
      color:#fff;
      font-family:inherit;
    }

    /* Main card */
    main.card{
      width:100%;
      max-width:960px;
      margin:30px auto;
      background:var(--card);
      border-radius:var(--radius);
      box-shadow:0 10px 30px rgba(255, 89, 0, 0.5);
      padding:24px;
      box-sizing:border-box;
    }

    h1{
      margin:0 0 10px 0;
      font-size:24px;
      color:var(--accent);
      text-align: center;
    }
    p.lead{ 
      margin:0 0 20px 0; 
      color:var(--muted); 
      font-size:14px; 
      text-align: center;
    }

    form{
      display:grid;
      grid-template-columns: 1fr 1fr;
      gap:16px;
    }

    .full { grid-column: 1 / -1; }

    label{
      display:block;
      font-size:13px;
      color:#fff;
      margin-bottom:6px;
      font-weight:600;
    }

    input[type="text"],
    input[type="email"],
    input[type="password"],
    input[type="number"],
    select,
    textarea{
      width:100%;
      padding:10px 12px;
      border-radius:10px;
      border:1px solid #0162ffff;
      background:#0f1f3a;
      box-sizing:border-box;
      outline: none;
      font-size:14px;
      color:#fff;
      transition:box-shadow .15s, border-color .15s;
    }
    input:focus, select:focus, textarea:focus{
      border-color:var(--accent);
      box-shadow:0 0 0 3px rgba(255,165,0,0.25);
    }

    .row-inline { display:flex; gap:12px; align-items:center; flex-wrap:wrap; }

    .muted { color:var(--muted); font-size:13px; margin-top:6px; }

    fieldset {
      border:1px solid #0162ffff;
      padding:10px 12px;
      border-radius:10px;
      margin:0;
    }
    legend{ font-size:13px; font-weight:700; color:#fff; }

    .controls {
      display:flex;
      gap:12px;
      justify-content:flex-end;
      margin-top:8px;
      grid-column:1 / -1;
    }
    button{
      padding:10px 16px;
      border-radius:10px;
      border: none;
      font-weight:600;
      cursor:pointer;
      font-size:14px;
      transition: background .2s, border-color .2s;
    }
    .btn-primary{
      background:var(--accent);
      color:#0b1d3f;
      box-shadow:0 6px 18px rgba(255, 98, 0, 0.47);
    }
    .btn-primary:hover{ background:#ffb84d; }

    .btn-ghost{
      background:transparent;
      border:1px solid #0162ffff;
      color:#fff;
    }
    .btn-ghost:hover{ border-color:#ffa500; background:rgba(255,165,0,0.1); }

    @media (max-width:800px){
      form{
        grid-template-columns: 1fr;
      }
      .controls{ justify-content:stretch; flex-direction:column-reverse; }
      .controls button{ width:100% }
    }

    @media (max-width:480px){
      main.card{ padding:16px; }
    }
  </style>
</head>
<body>

  <main class="card" role="main">
    <h1>Bank Customer Registration</h1>
    <p class="lead">Fill customer details. Fields marked * are required.</p>

    <form action="fromback.php" method="post" autocomplete="on">
      <div>
        <label for="custName">Customer Name *</label>
        <input id="custName" name="custName" type="text" required placeholder="e.g. Rohit Mahajan">
      </div>

      <div>
        <label for="custContact">Contact No. *</label>
        <input id="custContact" name="custContact" type="text" pattern="[0-9+\s-]{7,25}" required placeholder="+91 98765 43210">
        <div class="muted">Accepts digits, +, spaces or hyphens</div>
      </div>

      <div>
        <label for="custCity">City *</label>
        <select id="custCity" name="custCity" required>
          <option value="">-- Select City --</option>
          <option>Ahmedabad</option>
          <option>Mumbai</option>
          <option>Delhi</option>
          <option>Bengaluru</option>
          <option>Other</option>
        </select>
      </div>

      <div>
        <label for="custState">State *</label>
        <select id="custState" name="custState" required>
          <option value="">-- Select State --</option>
          <option>Gujarat</option>
          <option>Maharashtra</option>
          <option>Delhi</option>
          <option>Karnataka</option>
          <option>Other</option>
        </select>
      </div>

      <div class="full">
        <label for="custAddress">Address</label>
        <textarea id="custAddress" name="custAddress" rows="3" placeholder="Street, area, pin code..."></textarea>
      </div>

      <div>
        <label for="custAccountNo">Account No.</label>
        <input id="custAccountNo" name="custAccountNo" type="text" placeholder="0001">
      </div>

      <div>
        <label for="bal">Initial Balance</label>
        <input type="text" name="balance" value="1000" readonly>
      </div>

      <div>
        <fieldset>
          <legend>Account Type</legend>
          <div class="row-inline">
            <label><input type="radio" name="accType" value="Savings" checked> Savings</label>
            <label><input type="radio" name="accType" value="Current"> Current</label>
            <label><input type="radio" name="accType" value="Recurring"> Recurring</label>
            <label><input type="radio" name="accType" value="FixedDeposit"> Fixed Deposit</label>
          </div>
        </fieldset>
      </div>

      <div>
        <fieldset>
          <legend>KYC Completed?</legend>
          <div class="row-inline">
            <label><input type="radio" name="kyc" value="Yes" checked> Yes</label>
            <label><input type="radio" name="kyc" value="No"> No</label>
          </div>
        </fieldset>
      </div>

      <div class="full">
        <fieldset>
          <legend>Nature of Business (select any)</legend>
          <div class="row-inline" style="flex-wrap:wrap;">
            <label><input type="checkbox" name="services[]" value="Stockbroker"> Stockbroker</label>
            <label><input type="checkbox" name="services[]" value="Trading"> Trading</label>
            <label><input type="checkbox" name="services[]" value="Education"> Education</label>
            <label><input type="checkbox" name="services[]" value="Transport"> Transport</label>
            <label><input type="checkbox" name="services[]" value="NGO"> NGO</label>
            <label><input type="checkbox" name="services[]" value="RealEstate"> Real Estate</label>
            <label><input type="checkbox" name="services[]" value="Manufacturing"> Manufacturing</label>
            <label><input type="checkbox" name="services[]" value="ServiceProvider"> Service Provider</label>
          </div>
        </fieldset>
      </div>

      <div>
        <label for="custEmail">Email *</label>
        <input id="custEmail" name="custEmail" type="email" required placeholder="name@example.com">
      </div>

      <div>
        <label for="custPassword">Password *</label>
        <input id="custPassword" name="custPassword" type="password" required minlength="6" placeholder="At least 6 characters">
        <div class="muted">We'll store password securely on server (hash it).</div>
      </div>

      <div class="controls">
        <button type="reset" class="btn-ghost">Reset</button>
        <button type="submit" class="btn-primary">Submit Registration</button>
      </div>
    </form>
  </main>
</body>
</html>
