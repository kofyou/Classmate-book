<?php 
header('Content-Type:text/html;charset=utf-8');
require ('config.php');


if(isset($_POST['Submit'])){
	 if(isset($_POST['studentid'])&&$_POST['studentid']!=NULL){	 	
	 }else{
	 	echo "<script>alert('学号不能为空！');</script>";
        echo "<script>location.href='register.php';</script>";
        exit();
	 }
	 if(isset($_POST['sex'])&&$_POST['sex']!=NULL){
	 }else{
	 	echo "<script>alert('性别不能为空！');</script>";
        echo "<script>location.href='register.php';</script>";
        exit();
	 }
	 if(isset($_POST['major'])&&$_POST['major']!=NULL){
	 }else{
	 	echo "<script>alert('专业不能为空！');</script>";
        echo "<script>location.href='register.php';</script>";
        exit();
	 }
	 if(isset($_POST['grade'])&&$_POST['grade']!=NULL){
	 }else{
	 	echo "<script>alert('年级不能为空！');</script>";
        echo "<script>location.href='register.php';</script>";
        exit();
	 }
	 if(isset($_POST['class'])&&$_POST['class']!=NULL){
	 }else{
	 	echo "<script>alert('班级不能为空！');</script>";
        echo "<script>location.href='register.php';</script>";
        exit();
	 }

	 if(isset($_POST['name'])&&$_POST['name']!=NULL){
	 }else{
	 	echo "<script>alert('姓名不能为空！');</script>";
        echo "<script>location.href='register.php';</script>";
        exit();
	 }
	 if(isset($_POST['email'])&&$_POST['email']!=NULL){
	 }else{
	 	echo "<script>alert('邮箱不能为空！');</script>";
        echo "<script>location.href='register.php';</script>";
        exit();
	 }
	 if(isset($_POST['password'])&&$_POST['password']!=NULL&&strlen($_POST['password'])>=8){
	 }else{
	 	echo "<script>alert('密码不能为空且要大于8位！');</script>";
        echo "<script>location.href='register.php';</script>";
        exit();
	 }
	 if(isset($_POST['re_password'])&&$_POST['re_password']!=NULL&&($_POST['re_password'] == $_POST['password'])){
	 }else{
	 	echo "<script>alert('两次密码不一致！');</script>";
        echo "<script>location.href='register.php';</script>";
        exit();
	 }


	 $sql = "SELECT id FROM student WHERE studentid = \"".$_POST['studentid']."\" AND password != \"NULL\"";
     $result = $conn->query($sql);
     if ($result->num_rows > 0) {
        echo "<script>alert('该学号已经注册过了！');</script>";
        echo "<script>location.href='register.php';</script>";
        exit();
     }else{
     	$passwd = md5($_POST['password']);
        $sql = "INSERT INTO student (id,studentid,sex,email,name,major,grade,class,password) VALUES "."(NULL,"."'{$_POST['studentid']}',"."'{$_POST['sex']}',"."'{$_POST['email']}',"."'{$_POST['name']}',"."'{$_POST['major']}',"."'{$_POST['grade']}',"."'{$_POST['class']}',"."'{$passwd}');";
        $result = $conn->query($sql); 
     }
     if (!$result) {   
        echo "<script>alert('插入数据失败！');</script>";
        echo "<script>location.href='register.php';</script>";
        exit();
     }else{
     	session_start();
     	$_SESSION['studentid']=$_POST['studentid'];
        setcookie('studentid',$_POST['studentid'],time()+(60*60*24*3));
        echo "<script>alert('注册成功！');</script>";
        echo "<script>location.href='index.php';</script>";
        exit();
    }
}
?>
<!DOCTYPE HTML>
<html>
<head>
<title>注册页面</title>
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
		    <div class="col-sm-3 logo">
		    <a href="index.php">校友录</a>
		    </div>
			<div class="clearfix"> </div>
	      </div>
	      <div class="content">
      	     <div class="register">
		  	  <form action="register.php" method="post"> 
				 <div class="register-top-grid">
					 <h3>个人 资料</h3>
					 <div>
						<span>学号<label>*</label></span>
						<input type="text" name='studentid' placeholder="请输入您的学号"> 
					 </div>
					 <div>
						<span>性别<label>*</label></span>
						<label class="radio"><input type="radio" name="sex" value="男生" checked=""><i> </i>男生</label>
						<label class="radio"><input type="radio" name="sex" value="女生"><i> </i>女生</label>

					 </div>
					 <div>
						<span>姓名<label>*</label></span>
						<input type="text" name='name' placeholder="请输入您的姓名"> 
					 </div>
					 <div>
						 <span>Email<label>*</label></span>
						 <input type="text" name='email' placeholder="请输入您的邮箱"> 
					 </div>
					 <div>
						<span>专业<label>*</label></span>
						<input type="text" name='major' placeholder="请输入您的专业,例计算机"> 
					 </div>
					 <div>
						<span>年级<label>*</label></span>
						<input type="text" name='grade' placeholder="请输入您的年级,例2016"> 
					 </div>
					 <div>
						 <span>班级<label>*</label></span>
						 <input type="text" name='class' placeholder="请输入您的班级,例1"> 
					 </div>
					 <div class="clearfix"> </div>
					   <a class="news-letter" href="#">
						 <label class="checkbox"><input type="checkbox" name="checkbox" checked=""><i> </i>立即登录</label>
					   </a>
					 </div>
				     <div class="register-bottom-grid">
						    <h3>登录 信息</h3>
							 <div>
								<span>密码<label>*</label></span>
								<input type="password" name='password' placeholder="请您设置长度大于八位的密码">
							 </div>
							 <div>
								<span>重复 密码<label>*</label></span>
								<input type="password" name='re_password' placeholder="请重复你设置的密码">
							 </div>
							 <div class="clearfix"> </div>
					 </div>
				<div class="clearfix"> </div>
				<div class="register-but">
					   <input type="submit" class="btn btn-info" name="Submit" value="注册">
					   <a class="forgot" href="login.php">已有账号，立即登录</a>
					   <div class="clearfix"> </div>
				</form>
				</div>
		   </div>
           </div>
    </div>
</div>
</body>
</html>