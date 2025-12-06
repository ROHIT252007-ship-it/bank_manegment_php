<?php
include "bankconn.php";
$obj=new BankConnect();
$obj->connect();

$custEmail=$_POST['custEmail'];
$custPassword=$_POST['custPassword'];
$logindata=$obj->logindata($custEmail,$custPassword);
if($logindata){
    session_start();
    $_SESSION['logindata']=$logindata;
    echo "<script>window.location.href='wlecome.php'</script>";
}else{
    echo "mahajan";
}
?>