<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>图片上传</title>
</head>
<body>
	<form action="/ThinkPHP/wode7.13/img/index.php/Home/Index/add" enctype="multipart/form-data" method="post" >
	商品名称:<input type="text" name="shopname" /><br />
	商品图片:<input type="file" name="pic1" /><br />
	商品图片:<input type="file" name="pic2" /><br />
	商品图片:<input type="file" name="pic3" /><br />
	商品图片:<input type="file" name="pic4" /><br />

	<input type="submit" value="提交" ><br />
	</form>
</body>
</html>