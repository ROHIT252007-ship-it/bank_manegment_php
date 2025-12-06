<?php
class BankConnect
{
    public $SERVER_NAME = "localhost";
    public $USER_NAME = "root";
    public $PASSWORD = "";
    public $DB_NAME = "bank";
    public $conn;
    public $logindata;

    public function connect()
    {
        $this->conn = new mysqli($this->SERVER_NAME, $this->USER_NAME, $this->PASSWORD, $this->DB_NAME);
        if (mysqli_connect_error()) {
            echo mysqli_connect_error();
        } else {
            return $this->conn;
        }
    }

    public function insert_res_data($custName, $custContact, $custCity, $custState, $custAddress, $kyc, $services, $custPassword, $custEmail, $accType, $balance)
    {
        $insert = "INSERT INTO `cust_d` (`custid`, `custname`, `custcont`, `custstate`, `custcity`, `custadd`, `custkyc`, `email`, `nob`, `password`)
         VALUES (NULL,'$custName','$custContact','$custState','$custCity','$custAddress','$kyc','$custEmail','$services','$custPassword')";
        $result = mysqli_query($this->conn, $insert);
        if ($result) {
            $find_id = mysqli_insert_id($this->conn);
            $insert2 = "INSERT INTO `acc_ta` (`custid`, `accno`, `acctype`, `bal`)
                VALUES ($find_id,NULL,' $accType', $balance); ";
            $r = mysqli_query($this->conn, $insert2);
            if ($result && $r) {
                return true;
            } else {
                echo "error";
            }
        } else {
            echo "error";
        }
    }

    public function logindata($custEmail, $custPassword)
    {
        $select = "SELECT * FROM `cust_d` WHERE `email` = '$custEmail' AND `password` = '$custPassword' ";
        $data = mysqli_query($this->conn, $select);
        $this->logindata = mysqli_fetch_assoc($data);
        return $this->logindata;
    }
    public function getlogindata()
    {
        return $this->logindata;
    }

    public function deposit($custid, $amt,$acco_no)
    {
        $find_bal = "SELECT `bal` FROM `acc_ta` WHERE `custid` = $custid;";
        $bal_q = mysqli_query($this->conn, $find_bal);
        $fix_bal=mysqli_fetch_assoc($bal_q);
        $bal=$fix_bal['bal'];
        if ($bal) {
            $d_bal = $bal + $amt;
            $add_deposit = "UPDATE `acc_ta` SET `bal`=$d_bal WHERE `custid` = $custid; ";
            mysqli_query($this->conn,$add_deposit);
        }
        $find_bal2 = "SELECT `bal` FROM `acc_ta` WHERE `custid` = $custid;";
        $bal_q2 = mysqli_query($this->conn, $find_bal2);
        $fix_bal2=mysqli_fetch_assoc($bal_q2);
        $bal2=$fix_bal2['bal'];
        $add_tran="INSERT INTO `tran_ta` (`tranno`, `tranamt`, `operation`, `currentbal`, `accno`, `custid`) 
        VALUES (NULL, $amt, 'deposit',$bal2 , $acco_no, $custid);";
        mysqli_query($this->conn,$add_tran);

        return true;
    }
    public function withdraw($custid, $amt,$acco_no)
    {
        $find_bal = "SELECT `bal` FROM `acc_ta` WHERE `custid` = $custid;";
        $bal_q = mysqli_query($this->conn, $find_bal);
        $fix_bal=mysqli_fetch_assoc($bal_q);
        $bal=$fix_bal['bal'];
        if ($bal<$amt) {
            $d_bal = $bal - $amt;
            $add_deposit = "UPDATE `acc_ta` SET `bal`=$d_bal WHERE `custid` = $custid; ";
            mysqli_query($this->conn,$add_deposit);
        }
         $find_bal2 = "SELECT `bal` FROM `acc_ta` WHERE `custid` = $custid;";
        $bal_q2 = mysqli_query($this->conn, $find_bal2);
        $fix_bal2=mysqli_fetch_assoc($bal_q2);
        $bal2=$fix_bal2['bal'];
        $add_tran="INSERT INTO `tran_ta` (`tranno`, `tranamt`, `operation`, `currentbal`, `accno`, `custid`) 
        VALUES (NULL, $amt, 'withdraw',$bal2 , $acco_no, $custid);";
        mysqli_query($this->conn,$add_tran);
        return true;
    }
    public function trancation($custid, $amt,$acc2,$acco_no)
    {   

        $find_bal = "SELECT `bal` FROM `acc_ta` WHERE `custid` = $custid;";
        $bal_q = mysqli_query($this->conn, $find_bal);
        $fix_bal=mysqli_fetch_assoc($bal_q);
        $bal=$fix_bal['bal'];
        $find_bal2 = "SELECT `bal` FROM `acc_ta` WHERE `accno` = $acc2;";
        $bal_q2 = mysqli_query($this->conn, $find_bal2);
        $fix_bal2=mysqli_fetch_assoc($bal_q2);
        $bal2=$fix_bal2['bal'];

      
            $d_bal = $bal - $amt;
            if($d_bal>1000){
            $tran1 = "UPDATE `acc_ta` SET `bal`=$d_bal WHERE `custid` = $custid; ";
            mysqli_query($this->conn,$tran1);
            $d_bal2 = $bal2 + $amt;
            $tran2 = "UPDATE `acc_ta` SET `bal`=$d_bal2 WHERE `accno` = $acc2; ";
            mysqli_query($this->conn,$tran2);
            }else{
                echo "yuor balnece is less to 1000 plase deposit a amout";
            }
         $find_bal2 = "SELECT `bal` FROM `acc_ta` WHERE `custid` = $custid;";
        $bal_q2 = mysqli_query($this->conn, $find_bal2);
        $fix_bal2=mysqli_fetch_assoc($bal_q2);
        $bal2=$fix_bal2['bal'];
        $trans="tran from $acco_no to $acc2";
        $add_tran="INSERT INTO `tran_ta` (`tranno`, `tranamt`, `operation`, `currentbal`, `accno`, `custid`) 
        VALUES (NULL, $amt, '$trans',$bal2 , $acco_no, $custid);";
        mysqli_query($this->conn,$add_tran);
        return true;
    }

    function disaact($custid){
         $insert2 = "SELECT * FROM `acc_ta` WHERE `custid` = 22";
            $r = mysqli_query($this->conn, $insert2);
            if($r){
                return $r;
            }else{
                echo "acc_table";
            }

    }
}
