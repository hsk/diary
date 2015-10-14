# h_sakuraiの日記

ひっそりと日記を書きたいので、ここに書く。

# 2015/10/15

## 英語訳する

今日はずっと、英語を勉強してました。
①昨日作ったツールをつかって、２ページの論文の知らない単語を全部調べておく。
②論文から英文をコピーして英単語を日本語に置き換えるだけ置き換える。
③順番を並び替える。
④google翻訳を参考に修正する。

という感じでやってみてました。

また、phpで問題を作って練習するツールも作ったりしました。
しかし、２ページで知らない単語が１００個以上ある等して、これは全部1日で覚えられないなって事になってしまいました。

さらに、単語表が邪魔だなと思ってmarkdownで小さく表示する方法を調べて、

	<sup><sub>aaa</sub></sup>

とすると１番小さく表示され

	> <sup><sub>
	aaaa__
	bbb

と\_\_の部分はスペースにすると改行になり、元の英文と、翻訳途中の文字列を引用で表示するようにしてみたりしてました。
単語一覧の仕様が変わってしまったのだけど、まぁ、明日以降便利なほうを残そうかと考えてます。


本来やるべき事は、英文を翻訳してプログラムの動作を理解して、Scalaのプログラムのバグを取る事なんですけど、英語難しいし、
すぐに単語を覚えられる訳でもなく、翻訳能力も低いので、いろいろな文章を翻訳しまくって読みまくってみるのがよいのかな等と考えている次第です。

今日翻訳してみてたのは以下のアドレスにあります:

https://github.com/hsk/type-systems-scala/blob/master/trans/subml.md


# 2015/10/14

## 単語表作成ツール on osx for markdown

英語が読めない、よくよく考えると、圧倒的英単語力不足！
twitterで単語帳があると良いというような話を目にする。
そうだ、英単語表を作るのが面倒で嫌なのだ。macにはctrl+command+dで辞書を引く機能が付いている。
しかし、圧倒的単語力不足な俺にとって辞書を引く回数はあまりにも多く、めんどくさくて仕方がない。
そこで、command+cでコピーをすると、単語一覧に登録され、リターンキーを押すと、google翻訳が起動される。
翻訳結果を修正し、コピーすると、コピーされた内容と単語一覧を元にMarkdownの表を作成してクリップボードに保存される。
そんなツールをPHPで作って使ってみてます。とても便利です。
以下、そのようなツールです。pbcopy,pbpaste,open等のコマンドラインのコマンドを使っているので、Windowsでは動かないと思いますが、
Javaに移植する等すれば何処でも動くツールに出来るかもしれません。

```
#!/usr/local/bin/php
<?php

function non_block_read($fd, &$data) {
    $read = array($fd);
    $write = array();
    $except = array();
    $result = stream_select($read, $write, $except, 0);
    if($result === false) throw new Exception('stream_select failed');
    if($result === 0) return false;
    $data = stream_get_line($fd, 1);
    return true;
}
function keywait() {
    $x = "";
    return !(non_block_read(STDIN, $x));
}

`echo "" | pbcopy`;

$LOG="";
$PREV=`pbpaste`;
while(keywait()){
	$DATA=`pbpaste`;
	if ($PREV != $DATA){
		echo "$DATA\n";
		$LOG = "$LOG$DATA\n";
	}
	$PREV=$DATA;
	usleep(100000);
}
echo "open\n";
$LOG2 = urlencode($LOG);
shell_exec("open \"https://translate.google.co.jp/#en/ja/$LOG2\"");

`echo "" | pbcopy`;

while(`pbpaste` == "\n"){
	usleep(100000);
}

$DATA = explode("\n",`pbpaste`);
$LOG = explode("\n", rtrim($LOG,"\n"));

ob_start();

echo "|English|日本語|\n";
echo "| --- | --- |\n";

foreach($LOG as $i=>$l) {
  echo "|$LOG[$i]|$DATA[$i]|\n"; 
}

$data = ob_get_contents();
ob_end_clean();
echo $data;

$fp = popen("pbcopy","w");
fwrite($fp, $data);
fclose($fp);
```

# 2015/10/06

## Z3で関数

	z3 -smt2 -in
	(define-fun add ((a Int) (b Int)) Int (+ a b))
	(declare-const x Int)
	(assert (= x (add 1 2)))
	(check-sat)
	sat
	(get-value (x))
	((x 3))
	(exit)

# 2015/10/05

## CoPLとTAPLの式だけ見る

型理論の式をうつしてみてたのだけど、頭に入ってないので、読み慣れればって思ってる今日この頃。

CoPLの型スキームの式を追っかけて理解する。
TAPLの参照と、例外の式だけちゃんと追っかけて意味を理解した。

初めて出てきた時は特に理解が難しい。基本となる書き方を理解していれば、基本をより展開した論文を読むための基礎になるはずなので、式だけ見て大体分かるようになると良いんだろうなと思う。俺に足りなかったのはこれだなと。

いうことで、最初は読むのに時間がかかる。で、忘れないうちに何度も読み直しをする事で覚えれば楽になるはず。
英語もきっとそうだろう。

他の説明や証明も大切だけど、もっとも根幹となるものは式なのだなと。

参照はOCamlのRefで、例外はJava等でもある例外と実行時エラーについての形式化だった。
イチイチ書くのは面倒くさいので書かないけど、頭に入れば良いんだな。

でも覚えた訳じゃないので書けないw

型スキームは多相的な関数の型パラメータの話を形式化したものである。
μとΣとσとτを使う。

	τ ::= τ | σ.τ
	σ ::= 型スキーム
	Σ ::= 型スキームの型環境で

	τ | σ ->

あれあれ？ってかんじだ。でも読める。見ながら書けばかけるけど、頭に入れたい。


# 2015/10/04

TAPLの参照周りの式だけ読んでみた。
参照はCoPLのオンライン演習をやって分かったつもりになってた。でもTAPLだと書き方が違うのだった。
形式化する際は、何もない所から定義して決めるので自由なのだよなぁ。
何となく読み飛ばすと全然頭に入ってない事に気がつくという事でした。


## Z3を使って遊ぼう。

refined typesではZ3が使われているのだけど、そもそもSMTソルバを使って遊んだ事がない。
ということで、Z3を使ってみる。
例を探すと、、、。

https://github.com/Z3Prover/z3test/tree/master/regressions/smt2

この辺が良さそう。


### 連立方程式を解いてみる。

z3コマンドは、以下のようにするとsmt2のフォーマットで入力待ちになる。

	$ z3 -smt2 -in

例えば、

	a + b = 10
	b = 1

の連立方程式を解いてみよう。まず、aとbは定数なので以下のように宣言する。

	(declare-const a Int)
	(declare-const b Int)

b=1の制約を書く

	(assert (= b 1))

a + b = 10の制約を書く

	(assert (= (+ a b) 10))

論理的に正しいかチェックする

	(check-sat)

結果、satが帰って来る。

	sat

aの値を取得してみる

	(get-value (a))

結果は9である。

	((a 9))

終了はexitである。

	(exit)

### 次の問題

とりあえず、連立方程式は解けた。

	2a + 2b = 4
	5a + 5b = 10

	$ z3 -smt2 -in
	(declare-const a Int)
	(declare-const b Int)
	(assert (= (+ (* 2 a) (* 2 b)) 4))
	(assert (= (+ (* 5 a) (* 5 b)) 10))
	(check-sat)
	(get-value (a b))
	(exit)


結果

	sat
	((a 2)
	 (b 0))

次の問題

	2a + 2b = 4
	5a + 2b = 7

	$ z3 -smt2 -in
	(declare-const a Int)
	(declare-const b Int)
	(assert (= (+ (* 2 a) (* 2 b)) 4))
	(assert (= (+ (* 5 a) (* 2 b)) 7))
	(check-sat)
	(get-value (a b))
	(exit)

結果

	sat
	((a 1)
	 (b 1))

いい感じに解ける。

チュートリアルもあって読んでみた。

http://www.grammatech.com/resource/smt/SMTLIBTutorial.pdf

これちゃんとやるとよいのだろうなと。

# 2015/10/03


- [ ] extensive rows 2 だけのこってるのもアレなので移植しよう。
- [ ] first class polymorphism
- [ ] gradual typing

土曜日だけど、今日も移植する。extensive rows2のmergeの所で引っかかって止まってたので、そこをクリアにしよう。

## 唐突に、操作的意味論がさらさら書けないの良くないと思う。

という事で書いてみる。

	e ::= x | λx.e | e1 e2

っていうBNFが書ける。ここでxは変数で、eは式である。e1 e2 ... enも式である。
論文にはよくこういう記述が現れる。JavaScriptのサブセットであるMiniJavaScriptは以下のように定義出来る。

	e ::= x | function(x) { return e; } | e1(e2)

これは表示的意味論では違うが、操作的意味論は同じ事が行われる。
JavaScriptで操作的意味論を展開してみると、


	(function(x){return e1; })(e2) -> [e2/x]e1
	e1 -> e1' ならば e1(e2) -> e1'(e2)
	e2 -> e2' ならば e1(e2) -> e1(e2')
	e -> e' ならば function(x){ return e; } -> function(x) { return e'; }

ここで[e2/x]e1はe1内のxをe2に置換するという意味である。

AならばBを

	A
	----
	B

と書くとすると、以下のように書く事が出来る。

	ーーーーーーーーーーーーーーーーーー
	function(x){return e1; }(e2)
	-> [x/e2]e1

	e1 -> e1'
	ーーーーーーーーーーー
	e1(e2) -> e1'(e2)

	e2 -> e2'
	ーーーーーーーーーーー
	e1(e2) -> e1(e2')

	e -> e'
	ーーーーーーーーーーーーーーーーーー
	function(x){ return e; } ->
	function(x){ return e'; }

λ計算にtrue,falseと三項演算子を追加する。

	e ::= ... | true | false | e1 ? e2 : e3

	e1 -> true
	ーーーーーーーーーーーー
	e1 ? e2 : e3 -> e2

	e1 -> false
	ーーーーーーーーーーーー
	e1 ? e2 : e3 -> e3

などと思って書いてみたのだけど、書く力の前に読む力がない事に気がついたりする。
TAPLを何度か見てるけど、論文読むと辛過ぎる。
CoPLも目を通したはずだけど、見ると辛い。分からない。
ということで、CoPLの図だけ見ながら書いてある式を理解してみることにした。
ゲーム感覚で、毎日見ていれば良いんじゃないか。って訳である。
ということで、1回目は、２０分くらいずつで我慢の限界が来るのだけど、それを数回。難しい所は飛ばして全体に目を通してみた。
これ毎日やるとかなり基本が身に付く気がする。操作的意味論や型理論の式に慣れてしまえば、英語の論文も式だけ見れば大体分かるはずであるし、読む時間も短く済むはず。という事でしばらく毎日呼んでみようと思う。
CoPLに眼を通すのが余裕になったらTAPLに移行すれば、より高度な型理論が頭に入るはず。

# 2015/10/02

## とりあえず目標

- [ ] first class polymorphism
- [ ] gradual typing

この２つを進める。
refined typingももうちょっと把握するとよいのかな。
移植すると結構満足感高いのだけど、深い理解が出来ているのかというと、それは別な話なので理解しやすくまとめたいと思う。
様々な、型システムの理解をより簡単にしたいけど、本当に難しいなと感じる。

ずっと目指しているのは、誰にでも簡単に出来るコンパイラ作ることなのだけど、同時に最新機能は相当良いもんを積みたい。

- [ ] extensive rows 2 だけのこってるのもアレなので移植しよう。

gradual typingは型ないJavaScriptと融合するのに向いてるのかもしれないけど、目指す言語に近い訳でもない。
first class polymorphismは使いたいのかもしれないので深く読むほうがよい。

なんかやる気ないので、extensive rows 2をちょっと触って終わった。mergeが面倒くさい。

## 享保の改革の時代

どうも、この先が見えないので色々ずっと考えている。

暴れん坊将軍の時代に、人口増加は止まって停滞期に入った。
それまでは、江戸時代が始まって人口増加してたわけだけど、限界が来た訳だ。
平成の時代も、今まさに人口の増加が止まったばかりだ。
明治維新前というよりも、今はまだ享保の改革の時代のように思える。維新を起こすには色々と課題が多過ぎる。
ここで、発展を目指せば、パイを争う事になるので、気持ちいいもんじゃない。経済的な発展は諦めて楽しくやる事が重要そうだ。

ようやく先が分かった

# 2015/10/01

## first class polymorphism をScalaに移植する

処理内容は、パースして型推論して、さらにもう１段階推論する３段構成になってます。
algorithm wの改造らしいのですが、変更も多いので一から作る事にしました。

mlをscalaに変換してパッケージ宣言を書いて、飼い業を書き換えする等した後、
構文木をコンパイル後、パーサも移植しつつ、テストも移植しつつ、型推論も移植しつつとゴリゴリ進めて行って、
パーサのテストは通り、とりあえず、コンパイルは通りました。って一気に作業出来ました。
型推論のテストを通せば終わりのはずだけど、良くわからない。

https://github.com/hsk/type-systems-scala/tree/master/first_class_polymorphism

## gradual typingをScalaに移植する。

first class polymorphismの移植に飽きた。ずっとハマってると辛い。
ということで、他のgradual typingも移植してみる。
gradual typingは、簡単に言うとActionScript3みたいに、動的な型システムに静的な型システムを持ち込む。
こちらは、algorithm wと差分が少ないようなので、差分から移植してみている。
とりあえず、コンパイルは通ったけど、テストは通らない。でも、大体動いた。

1日に２つのプロジェクトの90%くらいの移植ができたけど、ここからが長いんだよなぁ。

https://github.com/hsk/type-systems-scala/tree/master/gradual_typing

## Tronについて思う事

UNIXベースを歌うのがいいと思う。


----

[201510.md](201510.md)

[201509.md](201509.md)

[201508.md](201508.md)
