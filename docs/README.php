
<?php
$file = "../README.md";
$arr = glob("../*.md");
rsort($arr);


$cmd ="pandoc ".$arr[1];

ob_start();
system($cmd);
$contents = ob_get_contents();
ob_end_clean();
?>




<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8" >
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="viewport" content="initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=no, width=device-width">

	<title>h_sakurai's docs</title>

	<link rel="stylesheet" href="css/skyblue.css">

	<link rel="stylesheet" href="demo/css/docs.css">
	<link rel="stylesheet" href="demo/google-code-prettify/prettify.css">


	<!--[if lt IE 9]>
		<script type="text/javascript" src="demo/ie/htmlshiv.js"></script>
		<script type="text/javascript" src="demo/ie/respond.src.js"></script>
	<![endif]-->
</head>
<body onload="prettyPrint()">

<div class="bg-dark padding-y-20">
	<div class="container text-center">
		<h1>h_sakurai's docs</h1>
	</div>
</div>
<div class="container">
		<div class="col md-3">
			<div class="sidemenu js-sidemenu">
				<h5>Docs</h5>
				<div>

<?php foreach($arr as $f) { ?>
	<?php if($f == $file) { ?>
					<a href="<?php echo $f ?>"  class="active"><?php echo $f ?></a>
	<?php } else { ?>
					<a href="<?php echo $f ?>"><?php echo $f ?></a>
	<?php } ?>
<?php } ?>

				</div>
			</div>
		</div>
		<div class="col md-9 float-right">
			<h1 id="h_sakuraiの日記">h_sakuraiの日記</h1>
			<p>ひっそりと日記を書きたいので、ここに書く。</p>
			<hr/>
			<?php echo $contents; ?>			
		</div>

</div>




<script src="https://code.jquery.com/jquery-2.1.3.min.js"></script>
<script src="demo/js/jquery.sticky-kit.min.js"></script>
<script src="demo/google-code-prettify/prettify.js"></script>
<script src="demo/js/docs.js"></script>
</body>
</html>
