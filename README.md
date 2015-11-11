# h_sakuraiの日記

ひっそりと日記を書きたいので、ここに書く。

# 2015/11/11

## マルチVMなランタイムを作ってます。

メモリ空間が複数あって、それを切り替えて使えるようなマシンを実装しながら作ってみています。
C言語だと、良い感じに作れる訳ですが、初めて作るものなのでモデルもゴチャゴチャしていてなかなか思い通りに行かず、イライラしております。
ま、きっと難しい事をしているんです。MS-DOSはマルチタスクではなく、Windows3.1でようやく疑似マルチタスクが実現されたわけで、簡単ではありません。
Amigaは真のマルチタスクを実現していましたが、それをPC上でするには数年かかり、95年にようやくWindows98が出来た訳です。
安定させるのに５年かかってWindows2000が出ました。スレッドはないのでWindows等のOS程複雑なものを作っている訳ではありません。
しかしやはり、メモリ空間を分けて管理するのは話が複雑なので簡単ではないんですよね。
でも、1日で出来ないようでは、駄目な気がする。ということで、気持ちが焦ってイライラしている訳でした。
でもようやくそれっぽく動くようになって来たのでホッとしている所であります。

# 2015/11/8

## リンク付けマシン

俺は論文に書いてあるhoge<a name="r08a1"></a>[[1]](#08a1)によるとほげだ。fuga<a name="r08a2"></a>[[2]](#08a2)によるとふがだ。
というリンクを書くのが大の苦手である。めんどくさい。
そこで、ここでリンクを付ける練習をする事にした。
しかし、sublime textの馬鹿野郎が俺を邪魔をする。全くけしからん奴だ。_を書くと固まるので注意が必要である。

リンクはこう書くとpandoc使った場合でも美味く行く。

	hoge<a name="r08a1"></a>[[1]](#08a1)
	fuga<a name="r08a2"></a>[[2]](#08a2)

	<a name="08a1"></a>
	- [[1]](#r08a1) hoge

		http://hoge
	<a name="08a2"></a>
	- [[2]](#r08a2) fuga

		http://fuga

括弧の中味ではエスケープする必要はない。日記だと複数のリンクを付けたいので、日付も書いた。これできっと大丈夫だろう。フゥだぜ。

日付は毎改革のは面倒いので、最初はref1 ref2等と書いておいて後で置き換えると楽そうだ。rは使わないほうが良さそうである。

<a name="08a1"></a>
- [[1]](#r08a1) hoge

	http://hoge
<a name="08a2"></a>
- [[2]](#r08a2) fuga

	http://fuga

## 関数型ストリーム勉強会<a name="r08b1"></a>[[1]](#08b1)があったらしい

せっかくなので練習のためにリンクだけコピらせて貰おうと思います。

とりあえず、リンクもとはメモ帳 関数型ストリーム処理勉強会<a name="r08b1"></a>[[1]](#08b1)にあります。
Akka Streamsについて @mtoyoshi<a name="r08b2"></a>[[2]](#08b2)
fs2(scalaz-stream) によるDBアクセス @gakuzzzz<a name="r08b3"></a>[[3]](#08b3)
Akka-Streamとscalaz-streamとの比較<a name="r08b4"></a>[[4]](#08b4)
ローンパターン<a name="r08b5"></a>[[5]](#08b5)
ストリーム処理ライブラリはなぜ必要なのか @ffu_<a name="r08b6"></a>[[6]](#08b6)
pipesチュートリアルを読んだ話 @its_out_of_tune<a name="r08b7"></a>[[7]](#08b7)
Pipes<a name="r08b8"></a>[[8]](#08b8)
Arrowによるストリーム処理(主にauto使用) @as_capabl<a name="r08b9"></a>[[9]](#08b9)
最強のライブラリを作りたくて @fumieval<a name="r08b10"></a>[[10]](#08b10) <a name="r08b11"></a>[[11]](#08b11)
非同期ストリーム処理の標準化を目指す<a name="r08b12"></a>[[12]](#08b12)のような内容があったようです。
よしよし、それっぽいそれっぽい。あとはなれですね。12個リンクを張った。Texだと楽なのになと思ったりもするのだけどまぁいいんです。
英語の単語調べたりした時もリンク付けて遊ぶと良いのかもしれない。習慣化が必要なので毎日慣れる事が大事だと思います。

- <a name="08b1"></a>[[1]](#r08b1) ヾ(*ﾟｰﾟ)ｼ メモ帳 関数型ストリーム処理勉強会

	http://shamison.hatenablog.com/entry/2015/11/07/175915

- <a name="08b2"></a>[[2]](#r08b2) Akka Streamsについて @mtoyoshi

	https://twitter.com/mtoyoshi/status/662843334235283456


- <a name="08b3"></a>[[3]](#r08b3) fs2(scalaz-stream) によるDBアクセス @gakuzzzz

	https://gist.github.com/xuwei-k/6574b69abd5ed47a6743


- <a name="08b4"></a>[[4]](#r08b4) Akka-Streamとscalaz-streamとの比較

	https://twitter.com/mtoyoshi/status/662860032761991168

- <a name="08b5"></a>[[5]](#r08b5) ローンパターン

	http://www.ne.jp/asahi/hishidama/home/tech/scala/sample/using.html

- <a name="08b6"></a>[[6]](#r08b6) ストリーム処理ライブラリはなぜ必要なのか @ffu_

	https://twitter.com/ffu_/status/662867603707179008

- <a name="08b7"></a>[[7]](#r08b7) pipesチュートリアルを読んだ話 @its_out_of_tune

	http://tokiwoousaka.github.io/takahashi/contents/day20151107pipes.html

- <a name="08b8"></a>[[8]](#r08b8) Pipes

	https://hackage.haskell.org/package/pipes

- <a name="08b9"></a>[[9]](#r08b9) Arrowによるストリーム処理(主にauto使用) @as_capabl

	https://twitter.com/cohalz/status/662889753293910016

- <a name="08b10"></a>[[10]](#r08b10) 最強のライブラリを作りたくて @fumieval

- <a name="08b11"></a>[[11]](#r08b11) Boombox

	https://github.com/fumieval/boombox

- <a name="08b12"></a>[[12]](#r08b12) 非同期ストリーム処理の標準化を目指す "Reactive Streams" とは - Okapies' Archive

	http://okapies.hateblo.jp/entry/2014/04/20/212821

# 2015/11/7

## publish してみることに

hexoをつかってみることにしました。

http://hsk.github.io/blog/

でもなんかちがう。うーんなんか、面倒い。

## PHPで書き直した。

http://hsk.github.io/diary/

こっちにする

## これから、やること。

とりあえず、docsの下も公開出来る仕組みを作る。
あと、言語のページも作るといいのかなと。
ネスト付いてるのはやっぱりfindが楽な気がするんだけど。
全部公開しても困るし、ブランチ作って開発ビルドしておいての、masterに移行させて欲しいらしいのでそうする。らしいって何だって感じなのだけど、まぁそのアレw

## てすと


# 2015/11/5

## プルリクエストをやってみる

オンライン勉強会がどうのとikegamiさんという方がgithubを使ってプルリクエスト使えば良いんじゃみたいな話をしていて、ああ、使いこなせてないなと思ってプルリクエスト使う練習等をしてみました。
恥ずかしいけどできたのでよかった。
とりあえず、upstreamからpullしてマージするといいと教えて貰っててよかった。



----

[201511.md](201511.md)

[201510.md](201510.md)

[201509.md](201509.md)

[201508.md](201508.md)
