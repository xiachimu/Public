<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>图片显示</title>
	<style>
		div{
			width: 200px;
			height: 200px;
			border: 2px solid black;
			float: left;
			margin-left:8px;
			margin-top: 8px;

		}
	</style>
</head>
<body>
	<h3><?php echo ((isset($a) && ($a !== ""))?($a):"游客"); ?></h3>
	<?php if(is_array($res)): foreach($res as $key=>$v): ?><div>
		<?php if(!empty($v["imgpath"])): ?><img src="/ThinkPHP/wode7.13/img/Img/Public/<?php echo ($v["imgpath"]); ?>" alt="" width="100%"><?php endif; ?>
		<?php if(empty($v["imgpath"])): ?>没有上传图片<?php endif; ?>
		<h3><?php echo ($v["nm"]); ?></h3>
		</div><?php endforeach; endif; ?>
</body>
</html>