<?php

system("rm diary/*.html");
$file = "README.md";
$arr = glob("*.md");
rsort($arr);

function md2html($file) {
  $cmd ="pandoc -f markdown_github ".$file;
  ob_start();
  system($cmd);
  $contents = ob_get_contents();
  ob_end_clean();
  return $contents;
}

$arr3 = array();
$arr2 = array();
foreach($arr as $v) {
  $arr2[$v] = preg_replace("/.md\$/", ".html", $v);
  if($v == $file) $arr2[$v] = "index.html";
  $arr3[$arr2[$v]] = preg_replace("/.html/", "", $arr2[$v]);

}

foreach($arr as $v) {
  $contents = md2html($v);
  $contents = view($v, $arr3, $contents);
  $contents = convert($contents);
  echo "$v => ".$arr2[$v]."\n";
  file_put_contents("diary/".$arr2[$v], $contents);
}


function convert($html) {

  $html = preg_replace_callback(
    "|<a href=\"(\w+).md\">(\w+).md</a>|",
    function($m){
      if($m[1]==$m[2])
        return "<a href=\"".$m[1].".html\">".$m[2]."</a>";
      else
        return $m[0];
    },$html);
  return $html;
}

function view($file, $arr, $contents){
  ob_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8" >
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="viewport" content="initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=no, width=device-width">

	<title>h_sakurai's diary</title>

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
		<h1>h_sakurai's diary</h1>
	</div>
</div>
<div class="container">
		<div class="col md-3">
			<div class="sidemenu js-sidemenu">
				<h5>contents</h5>
				<div>

<?php foreach($arr as $f=>$v) { ?>
	<?php if($f == $file) { ?>
					<a href="<?php echo $f ?>"  class="active"><?php echo $v ?></a>
	<?php } else { ?>
					<a href="<?php echo $f ?>"><?php echo $v ?></a>
	<?php } ?>
<?php } ?>
				</div>
				<p></p>
				<h5>links</h5>
				<div>
					<a href="http://github.com/hsk/diary">github</a>
				</div>
			</div>
		</div>
		<div class="col md-9 float-right">
			<?php echo $contents; ?>			
		</div>

</div>
<script src="https://code.jquery.com/jquery-2.1.3.min.js"></script>
<script src="demo/js/jquery.sticky-kit.min.js"></script>
<script src="demo/google-code-prettify/prettify.js"></script>
<script src="demo/js/docs.js"></script>
</body>
</html>
<?php
  $contents = ob_get_contents();
  ob_end_clean();
  return $contents;
}

