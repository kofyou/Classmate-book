<?php
header('Content-type: text/html; charset=utf-8');
header("Content-type:application/vnd.ms-excel");
header("Content-Disposition:filename=test.xls");

$conn = mysqli_connect("localhost","root","2080") or die("无法连接数据库");
mysqli_select_db($conn,"test");
mysqli_set_charset($conn,'utf8');
$sql = "SELECT * FROM student";
$result = mysqli_query($conn,$sql);
echo "ID号\t姓名\t分数\t\n";
while ($row = mysqli_fetch_array($result)){
    echo $row[0]."\t".$row[1]."\t".$row[2]."\t\n";
}
?>