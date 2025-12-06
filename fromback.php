<?php
include "bankconn.php";
$obj=new BankConnect();
$obj->connect();
// Assign values with Null Coalescing Operator
$custName     = $_POST['custName']     ;
$custContact  = $_POST['custContact']  ;
$custCity     = $_POST['custCity']     ;
$custState    = $_POST['custState']    ;
$custAddress  = $_POST['custAddress']  ;
$custAccountNo= $_POST['custAccountNo'];
$balance      = $_POST['balance']      ;
$accType      = $_POST['accType']      ;
$kyc          = $_POST['kyc']          ;
$services     = $_POST['services']     ?? [];
$custPassword = $_POST['custPassword'];
$custEmail    = $_POST['custEmail'];   
// Validation Errors array
$errors = [];

// Validation rules
if (empty($custName)) {
    $errors[] = "Customer Name is required.";
}

if (!preg_match('/^[0-9]{10}$/', $custContact)) {
    $errors[] = "Mobile number must be 10 digits.";
}

if (!preg_match("/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/", $custEmail)) {
    $errors[] = "Invalid Email format.";
}

if (!is_numeric($balance) || $balance < 0) {
    $errors[] = "Balance must be a number and greater than or equal to 0.";
}

if (strlen($custPassword) < 6) {
    $errors[] = "Password must be at least 6 characters long.";
}

// If Errors exist, display them
if (!empty($errors)) {
    echo "<h3> Validation Errors:</h3><ul>";
    foreach ($errors as $err) {
        echo "<li>$err</li>";
    }
    echo "</ul>";
} else {
    // If everything is OK, display submitted data
    $nob = implode(',', $services);

    echo "<h3>Submitted Data</h3>";
    echo "Name: $custName <br>";
    echo "Contact: $custContact <br>";
    echo "City: $custCity <br>";
    echo "State: $custState <br>";
    echo "Address: $custAddress <br>";
    echo "Account No: $custAccountNo <br>";
    echo "Balance: $balance <br>";
    echo "Account Type: $accType <br>";
    echo "KYC: $kyc <br>";
    echo "Services: $nob <br>";
    echo "Email: $custEmail <br>";
    echo "Password: (hidden for security)";


$insert_data=$obj->insert_res_data($custName,$custContact,$custCity,$custState,$custAddress,$kyc,$nob,$custPassword,$custEmail,$accType,$balance);

    if ($insert_data) {
    echo "<script>alert('Registration Successful! Redirecting...');</script>";
    echo "<script>window.location.href='login.php'</script>";
} else {
    echo "<script>alert('Error inserting data!');</script>";
}


}


?>
