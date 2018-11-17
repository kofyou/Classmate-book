<?php
header('Content-Type:text/html;charset=utf-8');
require ('config.php');
                  // 检测登录状态
                  $user = new User();
                  if(!$user->checklogin()){
                  echo   "<script>alert('请先登录！');</script>";
            	  echo "<script>location.href='login.php';</script>";
            	  exit();
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
            	  $grade = $user_data[0]['grade'];
            	  $class = $user_data[0]['class'];
                    $major = $user_data[0]['major'];
if(isset($_POST['Submit'])){
      if(isset($_POST['studentid'])&&$_POST['studentid']!=NULL){        
       }else{
        echo "<script>alert('学号不能为空！');</script>";
        echo "<script>location.href='index.php';</script>";
        exit();
       }
       if(isset($_POST['sex'])&&$_POST['sex']!=NULL){
       }else{
            echo "<script>alert('性别不能为空！');</script>";
        echo "<script>location.href='index.php';</script>";
        exit();
       }
       if(isset($_POST['name'])&&$_POST['name']!=NULL){
       }else{
            echo "<script>alert('姓名不能为空！');</script>";
        echo "<script>location.href='index.php';</script>";
        exit();
       }
       if(isset($_POST['email'])&&$_POST['email']!=NULL){
       }else{
            echo "<script>alert('邮箱不能为空！');</script>";
        echo "<script>location.href='index.php';</script>";
        exit();
       }
       $sql = "SELECT id FROM student WHERE studentid = \"".$_POST['studentid']."\" AND password != \"NULL\"";
       $result = $conn->query($sql);
       if ($result->num_rows > 0) {
        echo "<script>alert('该学号已经添加过了！');</script>";
        echo "<script>location.href='index.php';</script>";
        exit();
       }else{
        $sql = "INSERT INTO student (id,studentid,sex,email,name,major,grade,class) VALUES "."(NULL,"."'{$_POST['studentid']}',"."'{$_POST['sex']}',"."'{$_POST['email']}',"."'{$_POST['name']}',"."'{$major}',"."'{$grade}',"."'{$class}');";
        $result = $conn->query($sql); 
     }
     if (!$result) {   
        echo "<script>alert('插入数据失败！');</script>";
        echo "<script>location.href='index.php';</script>";
        exit();
     }else{
        echo "<script>alert('添加成功！');</script>";
        echo "<script>location.href='index.php';</script>";
        exit();
    }
}
?>
<!DOCTYPE HTML>
<html>
<head>
<title>添加页面</title>
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
		<div class="clearfix"> </div>
	    </div>
	    <div class="content">
	    <div class="box_2">
	    <span><?php echo $user_data[0]["major"]."专业".$user_data[0]["grade"]."级".$user_data[0]["class"]."班"?></span>
	    <div class="clearfix"> </div>
		<div class="row">
		    <div class="custom-check goleft mt">
                  <form action="add.php" method="post">
                  <div class="register-top-grid">
                        <div>
                        <span>学号<label>*</label></span>
                        <input type="text" name='studentid' placeholder="请输入您要添加的学号"> 
                        </div>
                        
                        <div>
                        <span>性别<label>*</label></span>
                        <label class="radio"><input type="radio" name="sex" value="男生" checked=""><i> </i>男生</label>
                        <label class="radio"><input type="radio" name="sex" value="女生"><i> </i>女生</label>
                        </div>
                        <div>
                        <span>姓名<label>*</label></span>
                        <input type="text" name='name' placeholder="请输入您要添加的姓名"> 
                        </div>
                        <div>
                        <span>Email<label>*</label></span>
                        <input type="text" name='email' placeholder="请输入您要添加的邮箱"> 
                        </div>
                        <div class="clearfix"> </div>
                        <div>
                        <input type="submit" class="btn btn-primary" name="Submit" value="确认添加">
                        </div>
                        <div class="clearfix"> </div>
                   </div>
                  </form>
                  <div class="clearfix"> </div>
	      </div>
          </div>
          </div>
          </div>
          </div>
          </div>

</body>
</html>