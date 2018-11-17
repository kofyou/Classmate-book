<?php
header('Content-Type:text/html;charset=utf-8');
require ('config.php');

if(isset($_POST['Submit'])){
	if($_POST['studentid'] == NULL){
	    echo "<script>alert('学号不能为空！');</script>";
		echo "<script>location.href='login.php';</script>";	
		exit();
	}
	if($_POST['password'] == NULL){
	    echo "<script>alert('密码不能为空！');</script>";
		echo "<script>location.href='login.php';</script>";	
		exit();
	}

	// 获取用户资料
    $studentid = $_POST['studentid'];
    $sql = "SELECT password FROM student WHERE studentid = \"".$studentid."\"";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
    	$user_data = $result->fetch_assoc();
        if(md5($_POST['password']) == $user_data['password']){
	         session_start();
		     //设置登录成功标识 $_SESSION['login']=true;			
             $_SESSION['studentid']=$_POST['studentid'];
             setcookie('studentid',$_POST['studentid'],time()+(60*60*24*3));
             echo "<script>alert('登录成功！');</script>";
		     echo "<script>location.href='index.php';</script>";
		     exit();
	}else{
		echo "<script>alert('账号或者密码错误！');</script>";
		echo "<script>location.href='login.php';</script>";
		exit();
	}
    }else{
        echo "<script>alert('学号出错,请先注册！');</script>";
		echo "<script>location.href='login.php';</script>";	
		exit();
    }
}
?>
<!DOCTYPE HTML>
<html>
<head>
<title>登录页面</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
<link href="css/bootstrap.css" rel='stylesheet' type='text/css' />
<link href="css/style.css" rel="stylesheet" type="text/css" media="all" />
<!-- start plugins -->
<script type="text/javascript" src="js/jquery-1.11.1.min.js"></script>
</head>
<body>
<div class="container">
	<div class="container_wrap">
		<div class="header_top">
		    <div class="col-sm-3 logo"><a href="index.php"><img src="images/logo.png" alt=""/></a></div>
			<div class="clearfix"> </div>
	      </div>
	      <div class="content">
      	     <div class="register">
			   <div class="col-md-6 login-left">
			  	 <h3>注册用户</h3>
				 <p>通过学号和邮箱创建账号</p>
				 <a class="acount-btn" href="register.php">创建 账号</a>
			   </div>
			   <div class="col-md-6 login-right">
			  	<h3>登录</h3>
				<p>如果您已经创建账号，请输入账号和密码登录</p>
				<form action="login.php" method="post">
				  <div>
					<span>学号<label>*</label></span>
					<input type="text" name='studentid'> 
				  </div>
				  <div>
					<span>密码<label>*</label></span>
					<input type="password" name='password'> 
				  </div>
				  <a class="forgot" href="#">忘记密码?</a>
				  <input type="submit" name="Submit" value="登录">
			    </form>
			   </div>	
			   <div class="clearfix"> </div>
		     </div>
           </div>
    </div>
</div>		
</body>
</html>