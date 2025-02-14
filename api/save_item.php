<?php include_once "db.php";

if(isset($_FILES['img']['tmp_name'])){
    move_uploaded_file($_FILES['img']['tmp_name'],"../img/".$_FILES['img']['name']);
    $_POST['img']=$_FILES['img']['name'];
}
    
// 如果他沒有id，代表是新增的，那就給他一個sh
if(!isset($_POST['id'])){
    $_POST['sh']=1;
}

$Item->save($_POST);

to("../back.php?do=add_item");