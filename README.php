# h_sakuraiの日記

ググると出て来られると、邪魔だ。ひっそりと日記を書きたいので、ここに書いてみることにします。

<?php
$arr = glob("*.md");
rsort($arr);

foreach($arr as $f) {
  if($f == "README.md") continue;
?>

[<?php echo $f ?>](<?php echo $f ?>)
<?php } ?>
