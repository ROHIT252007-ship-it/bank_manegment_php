<?php
session_start();
include "bankconn.php";
$obj=new BankConnect();
$obj->connect();
if(isset($_SESSION['logindata'])){
    $logindata=$_SESSION['logindata'];
    $custid=$logindata['custid'];
    $acc_ta=$obj->disaact($custid);
    $acc_ta=mysqli_fetch_assoc($acc_ta);
    $_SESSION['acc_data']=$acc_ta;
    $acc_no=$_SESSION['acc_data'];
}


// ?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Welcome</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background: #011535;
      text-align: center;
      padding-top: 80px;
    }
    .welcome-box {
      background: #11254c;
      padding: 30px;
      border-radius: 12px;
      width: 450px;
      margin: auto;
      box-shadow: 0px 4px 12px rgba(0,0,0,0.2);
    }
    h1 {
      color: #ff5900ff;
    }
    .options {
      margin-top: 30px;
    }
    .options button {
      display: block;
      margin: 12px auto;
      padding: 12px;
      background: #ff5900ff;
      color: white;
      border: none;
      border-radius: 6px;
      width: 220px;
      cursor: pointer;
      transition: 0.3s;
    }
    .options button:hover {
      background: #ff5900ff;
    }
    .logout {
      margin-top: 20px;
    }
    .logout a {
      color: #e74c3c;
      text-decoration: none;
      font-weight: bold;
    }

    /* Modal Styling */
    .modal {
      display: none;
      position: fixed;
      z-index: 999;
      left: 0;
      top: 0;
      width: 100%;
      height: 100%;
      background: rgba(0,0,0,0.5);
    }
    .modal-content {
      background: #11254c;
      padding: 20px;
      margin: 10% auto;
      border-radius: 8px;
      width: 400px;
      text-align: left;
    }
    .modal-content h2 {
      margin-top: 0;
    }
    .close {
      float: right;
      font-size: 20px;
      font-weight: bold;
      cursor: pointer;
      color: #e74c3c;
    }
    input {
      width: 95%;
      padding: 8px;
      margin: 8px 0;
      border: 1px solid #ccc;
      border-radius: 5px;
    }
    .submit-btn {
      background: #ff5900ff;
      color: white;
      border: none;
      padding: 10px;
      border-radius: 5px;
      cursor: pointer;
      width: 100%;
    }
    .submit-btn:hover {
      background: #fb8748ff;
    }
    h2{
        color:#ff5900ff;
    }
  </style>
</head>
<body>
  <div class="welcome-box">
<h1>Welcome, <?=  htmlspecialchars($logindata['custname']) ?> 🎉</h1>

    <p style="color:white">Select an option:</p>

    <div class="options">
      <button onclick="openModal('depositModal')">Deposit</button>
      <button onclick="openModal('withdrawModal')">Withdraw</button>
      <button onclick="openModal('transferModal')">Transfer</button>
      <button onclick="openModal('showTransModal')">Show Transactions</button>
    </div>

    <div class="logout">
      <a href="logout.php">Logout</a>
    </div>
  </div>

  <!-- Deposit Modal -->
  <div id="depositModal" class="modal">
    <div class="modal-content">
      <span class="close" onclick="closeModal('depositModal')">&times;</span>
      <h2>Deposit Money</h2>
      <form action="deposit.php" method="POST">
        <input type="text" name="depositAmt" placeholder="Enter amount" required>
        <button type="submit" class="submit-btn">Deposit</button>
      </form>
    </div>
  </div>

  <!-- Withdraw Modal -->
  <div id="withdrawModal" class="modal">
    <div class="modal-content">
      <span class="close" onclick="closeModal('withdrawModal')">&times;</span>
      <h2>Withdraw Money</h2>
      <form action="withdraw.php" method="POST">
        <input type="text" name="withdrawAmt" placeholder="Enter amount" required>
        <button type="submit" class="submit-btn">Withdraw</button>
      </form>
    </div>
  </div>

  <!-- Transfer Modal -->
  <div id="transferModal" class="modal">
    <div class="modal-content">
      <span class="close" onclick="closeModal('transferModal')">&times;</span>
      <h2>Transfer Money</h2>
      <form action="transfer.php" method="POST">
        <input type="text" name="fromAcc" placeholder=<?=  htmlspecialchars($acc_no['accno']) ?> readonly>
        <input type="text" name="toAcc" placeholder="To Account No" required>
        <input type="text" name="transferAmt" placeholder="Amount" required>
        <button type="submit" class="submit-btn">Transfer</button>
      </form>
    </div>
  </div>

  <!-- Show Transactions Modal -->
  <div id="showTransModal" class="modal">
    <div class="modal-content">
      <span class="close" onclick="closeModal('showTransModal')">&times;</span>
      <h2>Transaction History</h2>
      <iframe src="transactions.php" style="width:100%;height:300px;border:none;"></iframe>
    </div>
  </div>

  <script>
    function openModal(id) {
      document.getElementById(id).style.display = "block";
    }
    function closeModal(id) {
      document.getElementById(id).style.display = "none";
    }
    window.onclick = function(event) {
      let modals = document.getElementsByClassName("modal");
      for (let i = 0; i < modals.length; i++) {
        if (event.target == modals[i]) {
          modals[i].style.display = "none";
        }
      }
    }
  </script>
</body>
</html>
