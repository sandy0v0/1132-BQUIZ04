<!-- [傳址]讓滑鼠點下去之後，讓右邊的流行皮件大標題點下去之後，可以抓到資料傳給左邊的男用皮件 -->
<!-- 以下先做當滑鼠移到右邊的大標題之後，會跳出中標題，點擊時會顯示id這邊要用GET -->
<!-- 全部商品給他一個type=0，在index裡也有$type['name']，雖然有重複了但沒關係，因為顯示的位置不一樣，並且符合題意-->

<?php
$nav='';
$typeId=$_GET['type']??0;
if($typeId==0){
    $nav="全部商品";
}else{
    $type=$Type->find($typeId);
    if($type['big_id']==0){
        $nav=$type['name'];
    }else{
        $big=$Type->find($type['big_id']);
        $nav=$big['name'] ." > ". $type['name'];
    }  
  
}
?>
<h2><?=$nav;?></h2>

<style>
    .item{
        display: flex;
        margin: 3px auto;
        width: 85%;
    }
    .item div{
        padding: 5px;
        border: 1px solid white;
    }
    .item>div:nth-child(1){
        width:40%;
    }
    .item>div:nth-child(2){
        width:60%;
    }
</style>

<!-- 如果有$big有值代表他是中分類，如果是0代表是大分類，其餘就是全部商品 -->
<?php
    if($typeId==0){
        $rows=$Item->all();
    }else if($type['big_id']==0){
        $rows=$Item->all(['big'=>$typeId]);
    }else{
        $rows=$Item->all(['mid'=>$typeId]);
    }
    ?>
<?php
foreach($rows as $row):
?>
<div class='item'>
    <div class='pp ct'>
        <a href="?do=detail&id=<?=$row['id'];?>">
            <img src="./img/<?=$row['img'];?>" style="width:200px;height:150px">
        </a>
    </div>
    <div>
        <div class='tt ct'><?=$row['name'];?></div>
        <div class='pp'>
            價錢:<?=$row['price'];?>
            <a href="?do=buycart&id=<?=$row['id'];?>&qt=1">
                <img src="./icon/0402.jpg" style="float:right">
            </a>
        </div>
        <div class='pp'>規格:<?=$row['spec'];?></div>
        <div class='pp'>簡介:<?=mb_substr($row['intro'],0,30);?>...</div>
    </div>
</div>
<?php
endforeach;
?>