<?php include_once "db.php";
// $pr 陣列不能存在資料庫，字串才可以，所以要把pr改寫成字串形式

$_POST['pr']=serialize($_POST['pr']);
$Admin->save($_POST);

to("../back.php?do=admin");