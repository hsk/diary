# h_sakuraiの日記

ひっそりと日記を書きたいので、ここに書く。

<?php
$arr = glob("*.md");
rsort($arr);

echo file_get_contents($arr[0]);
echo "\n\n----\n";

foreach($arr as $f) {
  if($f == "README.md") continue;
?>

[<?php echo $f ?>](<?php echo $f ?>)
<?php } ?>
