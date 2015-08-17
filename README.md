# h_sakuraiの日記

ひっそりと日記を書きたいので、ここに書く。

# 2015/8/17 (月)

## 今やろうとしてること

- [ ] ATSのコードフォーマッタを作る。
- [ ] Prologを覚える。
- [ ] Coqっぽい言語を作りたい。
- [ ] TAPLの後半を読むぞ。

ってところ。ATSのコードフォーマッタは、パーサコンビネータを書くといい感じにネストを付けてくれるような仕組みを作って、
ATSのパーサを作ってみてる所。Sublime Textで動かすことを念頭に、pythonで書いている。
コンパイルしなくても動くのでtry & errorでの開発が楽でよい。
でも、スピードが遅いなと思うのが問題だ。

emacsでも動かしたいとなったときを考えると、elisp版もつくらないと行けなくなりそうとか思ったのだけど、emacs的には
外部コマンド呼べるようにするのが良いんじゃね？みたいな話を見つけたので、ATSで最終的に動かせばATS速いし、ATSでなんでもできれば良いだろうと思う。
ということで詳しくは https://github.com/hsk/docs/tree/master/ats/beautify を参照ということでw

prologを覚えようって思って、

https://github.com/hsk/docs/tree/master/prolog にそれなりに関数型言語的にPrologを使ってみようって思ったのだけど、

http://qiita.com/mandel59/items/0111154e5dbeb537ec32

この辺に同じこと考えている人がやってたりしたので、ああそう思ったりするよなぁなどと思ったりしている。


## 日記をgitで書くことにしたぞ！

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

何が嫌かというと例えば、 scala taplでググると、

https://www.google.co.jp/webhp?sourceid=chrome-instant&ion=1&espv=2&es_th=1&ie=UTF-8#q=scala%20tapl&es_th=1

な感じで、自分のブログが大量に上に出てくるのが嫌なわけです。



----

[201508.md](201508.md)
