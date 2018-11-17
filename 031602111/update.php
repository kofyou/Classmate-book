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
                $studentid = $_GET['id'];
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
if(isset($_POST['Submit'])){
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
       $sql = "UPDATE student SET `sex` = \"". $_POST['sex']."\", `name` = \"".$_POST['name']."\",`email` = \"".$_POST['email']."\",`address` = \"".$_POST['address']."\" ,`phonenum`=\"".$_POST['phonenum']."\",`wechat` = \"".$_POST['wechat']."\",`qq` = \"".$_POST['qq']."\",`sign` = \"".$_POST['sign']."\" WHERE  studentid = ".$studentid;
       $result = $conn->query($sql); 
     if (!$result) {   
        echo "<script>alert('修改数据失败！');</script>";
        echo "<script>location.href='index.php';</script>";
        exit();
     }else{
        echo "<script>alert('修改成功！');</script>";
        echo "<script>location.href='index.php';</script>";
        exit();
    }
}
 if(isset($_POST['Delete'])){
       if($studentid == NULL){
        echo "<script>alert('查找要删除的用户失败！');</script>";
        echo "<script>location.href='index.php';</script>";
        exit();
      }
      $sql = "DELETE FROM student WHERE studentid = ".$studentid;
      $result = $conn->query($sql); 
      if (!$result) {
        echo "<script>alert('删除用户失败！');</script>";
        echo "<script>location.href='index.php';</script>";
        exit();
      }else{
        echo "<script>alert('删除用户成功！');</script>";
        echo "<script>location.href='index.php';</script>";
        exit();
      }
}
?>
<!DOCTYPE HTML>
<html>
<head>
<title>修改页面</title>
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
	    <div class="clearfix"> </div>
		<div class="row">
		    <div class="custom-check goleft mt">
                  <form action="update.php?id=<?php echo $studentid;?>" method="post">
                  <div class="register-top-grid">
                        <div>
                        <span>学号:<?php echo $user_data[0]["studentid"];?></span>
                        </div>
                        <div>
                        <span>性别</span>
                        <label class="radio"><input type="radio" name="sex" value="男生" 
                        <?php if($user_data[0]['sex'] == "男生")
                        echo "checked=''";?>><i> </i>男生</label>
                        <label class="radio"><input type="radio" name="sex" value="女生" 
                        <?php if($user_data[0]['sex'] == "女生")
                        echo "checked=''";?>><i> </i>女生</label>
                        </div>
                        <div>
                        <span>姓名</span>
                        <input type="text" name='name' value="<?php echo $user_data[0]["name"];?>"> 
                        </div>
                        <div>
                        <span>Email</span>
                        <input type="text" name='email' value="<?php echo $user_data[0]["email"];?>"> 
                        </div>
                        <div>
                        <span>住址</span>
                        <input type="text" name='address' value="<?php echo $user_data[0]["address"];?>"> 
                        </div>
                        <div>
                        <span>电话</span>
                        <input type="text" name='phonenum' value="<?php echo $user_data[0]["phonenum"];?>"> 
                        </div>
                        <div>
                        <span>微信</span>
                        <input type="text" name='wechat' value="<?php echo $user_data[0]["wechat"];?>"> 
                        </div>
                        <div>
                        <span>QQ</span>
                        <input type="text" name='qq' value="<?php echo $user_data[0]["qq"];?>"> 
                        </div>
                        <div>
                        <span>个性签名</span>
                        <input type="text" name='sign' value="<?php echo $user_data[0]["sign"];?>"> 
                        </div>
                        <div class="clearfix"> </div>
                        <div>
                        <input type="submit" class="btn btn-primary" name="Submit" value="修改">
                        <input type="submit" class="btn btn-danger"  name="Delete" value="删除">
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