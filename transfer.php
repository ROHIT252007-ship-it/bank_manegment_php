<?php
session_start();
include "bankconn.php";
$obj=new BankConnect();
$conn=$obj->connect();
if(isset($_SESSION['logindata'])){
    $logindata=$_SESSION['logindata'];
     $acc_no=$_SESSION['acc_data'];
}

$custid=$logindata['custid'];
$acco_no=$acc_no['accno'];

$find_acc="SELECT * FROM `acc_ta` WHERE `custid` = $custid";
$fix_acc=mysqli_query($conn,$find_acc);
$acc_data=mysqli_fetch_assoc($fix_acc);
$_SESSION['acc_data']=$acc_data;
$acc_no=$_SESSION['acc_data'];

$amt=$_POST['transferAmt'];
$acc2=$_POST['toAcc'];


$logindata=$obj->trancation($custid,$amt,$acc2,$acco_no);


if($logindata){

}else{
    echo "error";
    exit();
}
if($logindata){
    $_SESSION['logindata']=$logindata;
    echo "<script>window.location.href='wlecome.php'</script>";
}else{
    echo "mahajan";
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Success</title>
    <style>
        body {
            margin: 0;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            background: radial-gradient(circle at center, #1e293b, #0f172a);
            font-family: "Segoe UI", sans-serif;
            overflow: hidden;
        }

        .success-container {
            text-align: center;
            color: white;
            animation: fadeIn 1.2s ease-in-out;
        }

        .circle {
            width: 120px;
            height: 120px;
            margin: auto;
            border-radius: 50%;
            background: linear-gradient(145deg, #22c55e, #16a34a);
            position: relative;
            display: flex;
            justify-content: center;
            align-items: center;
            box-shadow: 0 0 30px rgba(34, 197, 94, 0.8);
            animation: pulse 1.5s infinite;
        }

        .circle::before {
            content: "✔";
            font-size: 60px;
            color: white;
            font-weight: bold;
            animation: popIn 0.8s ease-in-out;
        }

        h1 {
            margin-top: 20px;
            font-size: 26px;
            letter-spacing: 1px;
            background: linear-gradient(90deg, #22c55e, #a3e635);
            background-clip: text;
            /* Standard (newer browsers) */
            -webkit-background-clip: text;
            /* For Chrome/Safari */
            color: transparent;
            /* Standard way */
            -webkit-text-fill-color: transparent;
            /* Needed for WebKit */
            animation: glowText 1.5s infinite alternate;
        }


        /* Particles */
        .particle {
            position: absolute;
            width: 8px;
            height: 8px;
            background: #22c55e;
            border-radius: 50%;
            animation: floatUp 3s linear infinite;
            opacity: 0.8;
        }

        @keyframes pulse {

            0%,
            100% {
                transform: scale(1);
            }

            50% {
                transform: scale(1.1);
            }
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: scale(0.8);
            }

            to {
                opacity: 1;
                transform: scale(1);
            }
        }

        @keyframes popIn {
            0% {
                transform: scale(0);
                opacity: 0;
            }

            100% {
                transform: scale(1);
                opacity: 1;
            }
        }

        @keyframes glowText {
            from {
                text-shadow: 0 0 5px #22c55e;
            }

            to {
                text-shadow: 0 0 20px #bbf7d0;
            }
        }

        @keyframes floatUp {
            from {
                transform: translateY(0) scale(1);
                opacity: 1;
            }

            to {
                transform: translateY(-150px) scale(0.5);
                opacity: 0;
            }
        }
    </style>
</head>

<body>
    <div class="success-container">
        <div class="circle"></div>
        <h1>Success! Redirecting...</h1>
    </div>

    <!-- Particles -->
    <script>
        for (let i = 0; i < 20; i++) {
            let particle = document.createElement("div");
            particle.classList.add("particle");
            particle.style.left = Math.random() * window.innerWidth + "px";
            particle.style.top = (window.innerHeight - 50) + "px";
            particle.style.animationDuration = (2 + Math.random() * 2) + "s";
            document.body.appendChild(particle);
        }

        // Redirect after 5 seconds
        setTimeout(() => {
            window.location.href = "wlecome.php"; // change to your page
        }, 5000);
    </script>
</body>

</html>