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