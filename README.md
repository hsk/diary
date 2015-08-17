# h_sakuraiの日記

ひっそりと日記を書きたいので、ここに書く。

# 2015/8/17 (月)

日記をここに書くことにする。
ニッチな話をググって検索すると、ダダだーっと出て来てしまって困る。叩かれたりもする。
だからといって、検索出来ないと困る。
日記として纏めておきたい。
他の技術者が検索しやすいと嬉しい。

githubなら検索しやすい。他の技術者も見つけやすいかもしれないw

そんなこんなで、githubで日記書こうと思ったのでした。

やる気は無いので、Markdownで書いて、日付付きの20150817.mdのようなファイルを作って、ファイル一覧をphpで取り出して、
最新、１０件くらいをREADME.mdに直接張っとけば良いっしょ。位の気軽さで行こうと思います。

毎月更新してけば良いか。


### README.php

	# h_sakuraiの日記

	ひっそりと日記を書きたいので、ここに書く。

	<?php
	$arr = glob("*.md");
	rsort($arr);

	echo file_get_contents($arr[1]);
	echo "\n\n----\n";

	foreach($arr as $f) {
	  if($f == "README.md") continue;
	?>

	[<?php echo $f ?>](<?php echo $f ?>)
	<?php } ?>


### Makefile

	all:
		php README.php > README.md
		git commit -a
		git push

こんなファイルを作っておきます。
月ごとに１つのファイルにマークダウンでメモ書きを残して行きます。
201508.mdに何か書くと。

で、

	make

とすると、README.phpが動いて、README.mdが更新され、git commitされるのでコメント書いて、git pushは自動的に行われる。
便利？良くわからないですけど。
最新の日付の物はPHPにして、ソースコードはincludeすると楽とかあるかもしれないけどまぁ、いいっしょ。
ってことで。



----

[201508.md](201508.md)
