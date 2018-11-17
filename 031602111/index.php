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
                  if(isset($_GET['print'])&&$_GET['print'] == "1"){
                        $user_id = $_GET['user_id'];
                  }

                  // 获取用户资料
                  $studentid = $_COOKIE['studentid'];
            	  $sql = "SELECT * FROM student WHERE studentid = \"".$studentid."\"";
            	  $result = $conn->query($sql);
            	  $s = 0;
            	  if ($result->num_rows > 0) {
            	  while($row = $result->fetch_assoc()) {
                        $user_data[$s]=$row;
                        $s++;
                        }
            	  }else{
            	  echo "<script>alert('获取用户资料失败！');</script>";
            	  echo "<script>location.href='login.php';</script>";
            	  exit();
            	  }
            	  // print("年级：".$user_data[0]['grade'].$user_data[0]['class'])
            	  $grade = $user_data[0]['grade'];
            	  $class = $user_data[0]['class'];
                    $major = $user_data[0]['major'];
            	  if(empty($grade) || empty($class)){
            	  }else{
            	  $sql = "SELECT * FROM student WHERE grade = \"".$grade."\" AND class = \"".$class."\"  AND  major = \"".$major."\" AND  studentid != \"".$studentid."\"";
            	  $result = $conn->query($sql);
            	  $s = 0;
            	  if ($result->num_rows > 0 ) {
            	  while($row = $result->fetch_assoc()) {
                        $users[$s]=$row;
                        $s++;}
            	  }
            	}
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
		    <div class="col-sm-11 logo">
		    <a href="index.php">校友录</a>
		    </div>
		    <div class="col-sm-1 logo">
		    <a href="add.php"><img src="images/add.png"></a>
                <a href="login.php"><img src="images/logout.png"></a>
                <a href="<?php echo "print.php?grade=".$grade."&class=".$class."&major=".$major; ?>"><img src="images/print.png"></a>
                
		    </div>
			<div class="clearfix"> </div>
	    </div>
	    <div class="content">
	    <div class="box_2">
	    <span><?php echo $user_data[0]["major"]."专业".$user_data[0]["grade"]."级".$user_data[0]["class"]."班"?></span>
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
            <td>
			<span>操作</span>
            </td>
            </tr>
            <tr>
             <td><span style="color: red"><?php echo $user_data[0]["name"]?>(当前用户)</span></td>
             <td><span style="color: red"><?php echo $user_data[0]["studentid"]?></span></td>
             <td><span style="color: red"><?php echo $user_data[0]["sex"]?></span></td>
             <td><span style="color: red"><?php echo $user_data[0]["email"]?></span></td>
             <td><a href="update.php?id=<?php echo $user_data[0]["studentid"]?>"><span>点击操作</span></a></td>
             </tr>

            <?php $num = count($users);
                  $i = 0;
                  while($i != $num){
             ?>
             <tr>
             <td><span><?php echo $users[$i]["name"]?></span></td>
             <td><span><?php echo $users[$i]["studentid"]?></span></td>
             <td><span><?php echo $users[$i]["sex"]?></span></td>
             <td><span><?php echo $users[$i]["email"]?></span></td>
             <td><a href="update.php?id=<?php echo $users[$i]["studentid"]?>"><span>点击操作</span></a></td>
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