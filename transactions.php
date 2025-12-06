<?php
include "bankconn.php";
$obj=new BankConnect();
$conn=$obj->connect();
session_start();

if (isset($_SESSION['logindata'])) {
    $logindata = $_SESSION['logindata'];
}

 $acc_no=$_SESSION['acc_data'];
 $acco_no=$acc_no['accno'];
 $custid = $logindata['custid'];

$data_q="SELECT * FROM `tran_ta` WHERE `custid` = $custid ";
$data_an=mysqli_query($conn,$data_q);

// $data = mysqli_fetch_assoc($data_an);
$i=1;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Transaction Details</title>
    <style>
        /* Table Styles */
        table {
            width: 100%;
            border-collapse: collapse;
            font-family: Arial, sans-serif;
            margin-top: 20px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
            background-color: #fff;
        }

        thead tr {
            background-color: #6657D7;
            color: #fff;
            text-align: left;
        }

        thead th {
            padding: 12px 15px;
            font-weight: 600;
            font-size: 14px;
        }

        tbody tr {
            border-bottom: 1px solid #ddd;
        }

        tbody tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        tbody td {
            padding: 10px 15px;
            font-size: 14px;
            color: #333;
        }

        tbody tr:hover {
            background-color: #f1f1f1;
        }

        /* Buttons */
        button.edit, button.delete {
            padding: 5px 10px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 12px;
            margin-right: 5px;
        }

        button.edit {
            background-color: #6657D7;
            color: #fff;
        }

        button.delete {
            background-color: #FF4B5C;
            color: #fff;
        }
    </style>
</head>
<body>

<h2>Transaction Details</h2>

<table>
    <thead>
        <tr>
            <th>Transaction No</th>
            <th>Amount</th>
            <th>Operation</th>
            <th>Balance</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach($data_an as $data): ?>
            <tr>
                <td><?php echo $i++; ?></td>
                <td><?php echo htmlspecialchars($data['tranamt']); ?></td>
                <td><?php echo htmlspecialchars($data['operation']); ?></td>
                <td><?php echo htmlspecialchars($data['currentbal']); ?></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

</body>
</html>