<?php
//���ݿ�������Ϣ
$servername = "localhost";
$username = "root";
$password = "2080";
$dbname = "student";
 
// ��������
$conn = mysqli_connect($servername, $username, $password, $dbname);
mysqli_query($conn,'set names utf8');
 
// �������
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}


class User{
	function checklogin(){
	 	session_start();
        if(isset($_SESSION['studentid'])&&isset($_COOKIE['studentid'])){
        	return 1;
            }else{
                  return 0;
            }
        }
}
?>
