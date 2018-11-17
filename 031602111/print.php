<?php
header('Content-type: text/html; charset=utf-8');
header("Content-type:application/vnd.ms-excel");
header("Content-Disposition:filename=classmates.xls");

$conn = mysqli_connect("localhost","root","2080") or die("无法连接数据库");
mysqli_select_db($conn,"student");
mysqli_set_charset($conn,'utf8');
$grade = $_GET["grade"];
$class = $_GET["class"];
$major = $_GET["major"];
$sql = "SELECT * FROM student WHERE grade = \"".$grade."\" AND class = \"".$class."\"  AND  major = \"".$major."\" ";
$result = mysqli_query($conn,$sql);
echo "学号\t姓名\t电子邮箱\t\n";
while ($row = mysqli_fetch_array($result)){
    echo $row["studentid"]."\t".$row["name"]."\t".$row["email"]."\t\n";
}
?>