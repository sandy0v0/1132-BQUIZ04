<?php include_once "db.php";

// 補充:對空的購物車進行儲存前的檢查
if(empty($_SESSION['cart'])){
    echo "1";
       exit();
   }


$_POST['acc']=$_SESSION['Mem'];
$_POST['no']=date("Ymd") . rand(100000,999999);
$_POST['cart']=serialize($_SESSION['cart']);

$Order->save($_POST);

unset($_SESSION['cart']);