<?php
header('Content-Type:text/html;charset=utf-8');
require ('config.php');
// 检测登录状态
                  $user = new User();
                  if(!$user->checklogin()){
                  echo "<script>alert('请先登录！');</script>";
            	  echo "<script>location.href='login.php';</script>";
            	  exit();
                  }
                  

                  // 获取用户资料
                  $studentid = $_COOKIE['studentid'];
            	  $sql = "SELECT * FROM student WHERE studentid = \"".$studentid."\"";
            	  $result = $conn->query($sql);
            	  if ($result->num_rows > 0) {
            	  $user_data = $result->fetch_assoc();
            	  }else{
            	  echo "<script>alert('获取用户资料失败！');</script>";
            	  echo "<script>location.href='login.php';</script>";
            	  exit();
            	  }
            	  print("年级：".$user_data[0]['grade'].$user_data[0]['class'])
            	  // $grade = $user_data[0]['grade'];
            	  // $class = $user_data[0]['class'];
            	  // if(empty($grade) || empty($class)){
            	  // 	echo "<script>alert('还未添加班级或者年级！');</script>";
            	  // 	echo "<script>location.href='login.php';</script>";
            	  // 	exit();
            	  // }else{
            	  $sql = "SELECT * FROM student WHERE grade = \"".$grade."\" AND class = \"".$class."\"  ";
            	  $result = $conn->query($sql);
            	  if ($result->num_rows == 1) {
            	  $users = $result->fetch_assoc();
            	  }else{
            	  echo "<script>alert('获取班级信息失败！');</script>";
            	  echo "<script>location.href='login.php';</script>";
            	  exit();
            	  }
            	  // }
?>
<!DOCTYPE HTML>
<html>
<head>
<title>校友通讯录</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<link href="css/bootstrap.css" rel='stylesheet' type='text/css' />
<link href="css/style.css" rel="stylesheet" type="text/css" media="all" />
<script type="text/javascript" src="js/jquery-1.11.1.min.js">
</script>
<script src="js/responsiveslides.min.js"></script>
</head>
<body>
<div class="container">
	<div class="container_wrap">
		<div class="header_top">
		    <div class="col-sm-3 logo">
		    <a href="index.php">圆桌</a>
		    </div>
			<div class="clearfix"> </div>
	    </div>
	    <div class="content">
	    <div class="box_2">
	    <span></span>
	    <div class="clearfix"> </div>
		<div class="row">
		    <div class="custom-check goleft mt">
			<table id="todo" class="table table-hover custom-check">
			<tbody>
			<tr>
			<td>
			<span>姓名</span>
            </td>
            <td>
			<span>学号</span>
            </td>
            <td>
			<span>性别</span>
            </td>
            <td>
			<span>邮箱</span>
            </td>
            </tr>

            <?php $num = count($users);
                  $i = 0;
                  while($i != $num){
             ?>
             <tr>
             <span><?php echo $users[$i]["name"]?></span>
             <span><?php echo $users[$i]["studentid"]?></span>
             <span><?php echo $users[$i]["sex"]?></span>
             <span><?php echo $users[$i]["email"]?></span>
             </tr>
             <?php  
                  $i++;
                  } 
             ?>
            </tbody>
            </table>

			<div class="clearfix"> </div>
	    </div>
	</div>
</div>

</body>
</html>