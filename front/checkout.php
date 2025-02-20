<?php

/* if(empty($_SESSION['cart'])){
    to("index.php?do=buycart&err=1");
    exit();
} */

$user=$Mem->find(['acc'=>$_SESSION["Mem"]]);
?>
<h2 class="ct">填寫資料</h2>

<!-- table.all>tr*5>td.tt.ct+td.pp>input:text -->
<table class="all" style="margin-bottom:0px">
    <tr>
        <td class="tt ct" style="width: 39.7%;">登入帳號</td>
        <td class="pp"><?=$user['acc'];?></td>
    </tr>
    <tr>
        <td class="tt ct">姓名</td>
        <td class="pp"><input type="text" name="name" id="name" value='<?=$user['name'];?>'></td>
    </tr>
    <tr>
        <td class="tt ct">電子信箱</td>
        <td class="pp"><input type="text" name="email" id="email" value='<?=$user['email'];?>'></td>
    </tr>
    <tr>
        <td class="tt ct">聯絡地址</td>
        <td class="pp"><input type="text" name="addr" id="addr"  value='<?=$user['addr'];?>'></td>
    </tr>
    <tr>
        <td class="tt ct">聯絡電話</td>
        <td class="pp"><input type="text" name="tel" id="tel" value='<?=$user['tel'];?>'></td>
    </tr>
</table>

<!-- table.all>tr*2>td*5 -->
<table class="all" style="margin-top: 0;margin-bottom: 0;">
    <tr class="tt ct">
        <td style="width: 40%;">商品名稱</td>
        <td>編號</td>
        <td>數量</td>
        <td>單價</td>
        <td>小計</td>
    </tr>
    <?php 
    $sum=0;
    foreach($_SESSION['cart'] as $id => $qt):
        $item=$Item->find($id);
    ?>
    <tr class="pp ct">
        <td ><?=$item['name'];?></td>
        <td class="ct"><?=$item['no'];?></td>
        <td class="ct"><?=$qt;?></td>
        <td class="ct"><?=$item['price'];?></td>
        <td class="ct">
            <?php
                echo $item['price']*$qt;
                $sum=$sum+($item['price']*$qt);
            ?>
        </td>
    </tr>
    <?php
    endforeach;
    ?>
</table>
<div class="all tt ct" style="padding:5px;margin-top:0;width: 88.3%;">總價:<?=$sum;?></div>
<div class="ct">
    <button onclick="checkout()">確定送出</button>
    <button onclick="location.href='?do=buycart'">返回修改訂單</button>
</div>
<script>
function checkout(){
    let data={
        name:$("#name").val(),
        email:$("#email").val(),
        addr:$("#addr").val(),
        tel:$("#tel").val(),
        total:<?=$sum;?>,
    }

    // 不對對空的購物車進行儲存前的檢查(檢定用此版即可)
    // $.post("./api/checkout.php",data,function(){
    //     alert("訂購成功\n感謝您的選購");
    //     location.href='?do=main';
    
    // 以下為補充:對空的購物車進行儲存前的檢查
    $.post("./api/checkout.php",data,function(res){
        if(res=='1'){
            alert("購物車尚無商品，不需結帳");
            return;
        }
        alert("訂購成功\n感謝您的選購");
        location.href='?do=main';
    })
}


</script>