# h_sakuraiの日記

ひっそりと日記を書きたいので、ここに書く。

# 2015/11/14

## <a name="14-1"></a> [C言語でWebサーバを作ってみた](http://hsk.github.io/diary/201511#14-1)

どうも、Erlangの素晴しい所は軽量プロセスにあるような気がして来ました。
GCを作ってアレコレ作っていると非常にそう感じます。
メモリ空間を分けて、計算して終わったらバッサリ消せば停止時間を限りなくなくして動かす事が出来るのです。
ErlangといえばC10k問題です。Erlangのプロセスはアクターとして通信するモデルで、非同期IOをすることが注目されていました。
でもErlangの本当に凄い所は、メモリの扱い方にあった気がするのです。
アクター毎に別のメモリ空間、そうプロセスを割り当てられ、処理が終わればメモリ領域は解放されるのです。
自分が考えているGCはアクターは存在しない同期関数として扱っています。
アクターではありません。しかし、軽量プロセスとして動かせるはず。
そう思ってちょいちょいっと書いたら動いてしまいました。<a name="r14a1"></a>[[1]](#14a1)

せっかくなので動的ローディングの機能も付けたり、面白い。
ああ、SML#がWebサーバ作ってたのも分かる気がする。
DLLとしてコンパイルして動的ロードして読み込む。
日付をみてリロードするというか、いまはリクエストごとに毎回ロードしてますが。
文字列ライブラリないので作ってみたり。
systemでpandocを呼び出してMarkdownをHTMLにしてみたり。
面白いです。

- <a name="14a1"></a>[[1]](#r14a1) webサーバ

	<https://github.com/hsk/docs/tree/master/gc/simple_gc_by_c/multi_world_http_server>

# 2015/11/11

## <a name="11-1"></a> [SICPを訳し直したの話を見て思った事](http://hsk.github.io/diary/201511#11-1)

SICPを訳し直した <a name="r11a1"></a>[[1]](#11a1) を見て、どーも面白くありません。夢にまで出てくる始末です。
なんだろうな。このイライラする気持ちはと思って色々考えてみた訳です。
能力高いのはいいし、言いたい事を言うのは良いんですけど、面白くない。
人格を否定したいってわけでもない。
自分もまぁ、いい加減な翻訳をやってみていたりして、ひっそりと公開していたりする訳です。
それが、くその山であるかのように言われている気がするのがまず面白くなかったのですが、どうもそれだけでは収まりがつきません。
翻訳のレベルが高いそうなので、それはよいのです。でも、話を見てると面白くない。腹立たしい。

翻訳する際に、参考にしながらより良くして行ったということで参考にしているのに、人格を批判している訳ではないと言いつつあまりにも言い草が悪い。
それが面白くない。能力が高い人が、翻訳をすればそれはうまくできますよ。でも、そういう人ばかりがいるわけではない。

SICPの翻訳が駄目だってだけではなく、他の話もそうなので面白くない。

### 1. 敬意を払って欲しい

俺も、OCamlやSML#は分かりにくいので、もっと使いやすくしたいと思ってますよ。
C言語も汚いしもっと奇麗にしたいと思いますよ。でも、C言語もOCamlもSMLも歴史がある言語です。
敬意を払いつつ、修正したいと考えています。

今まである物を悪者にして倒すというのは、分かりやすい話です。でも、悪者にされる側の人の事を考えると面白くない訳ですよ。
悪者にされる人もなんとか良くしようとしていた訳です。

### 2. 英語を翻訳する人に勇気を与えるようなコメントをして欲しい

なんだろうなぁ。プロ野球に例えると、楽天が非常に弱かった。そこに、野村監督が来て立て直した。あの時のぼやきは面白かったと思う訳です。
それなりにプロとしてやっている選手がいる。でも何か間違っていて弱い。それを批判してよくしようとする。でもなかなか上手く行かない。
それゆえのぼやきは、面白いですよ。それがようやく、優勝出来ました！って話な訳でそれはもう良い話なはずなのです。

でも、面白くない。翻訳をした人は相当頑張っていた訳でそれを参考にしてたのに、悪者を倒す気分でやったのはいいんだけど、悪者にしちゃいかんですよ。
悪者を作る人も大変なんですよ。ゲームを作ったわけですから。個人攻撃をしてない。感謝していますと行っても面白くないんだよな。

### 3. 英語を使う裾野を広げるような話をして欲しかった

現状の日本では、英語はあまり使われていません。これは、あまり良い状況では無さそうです。
自分は、英語に対して、日本人があまりにも完璧主義になっているのがよくないのだと考えています。
間違えばかりで駄目だというのはなんとも、話が面白くありません。
最初は、間違えてても良いんですよ。っていう話をして欲しかった。

### 4. 世界を分けたほうが良いなと

たぶん、googleで検索する世界が一つだと良くないんじゃないかと思います。
昔は、その辺で野球をして遊んで、そのボールが近所の家に飛び込んで植木鉢が割れて怒られた。
みたいなことがよくあったようです。でも、今は、野球はフェンスで囲まれた野球場でしますよね。
同じように、インターネット上も、今はプロも素人もごった返していて１つの世界の上で過ごしています。
なので、検索ワードによっては、別に植えに来て欲しくないのに、上位に表示されたりして、邪魔になります。
これなんとかならないのかなと思う訳です。

英語もそうですが、英語以外の文章もそうなのです。
最初は、ブログを書いてみてなんか、少し読者が増えて嬉しい。さらに書いてさらに増えて嬉しい。どんどん人が増えて行く間は非常に楽しい訳です。
ところが、ある程度のレベルになって来ると激しい上位争いが待っています。
何せ世界は一つです。争いたくもないのに、勝手に上に上がって来て戦わされますw
攻撃されます。嫌な話です。

ってなってしまうのを防ぎたい。
大学生のサークル活動は４年で終わって、その後は社会人になりOBとしてサークルに遊びに行っているのは最初の数年で、あとは社会人のサークルで遊ぶようになるでしょう。
社会人も年を取って行くと、徐々に付き合う年齢層も上がって行く。ところが、インターネット上はそうはいかないわけです。
みんな一緒の所を共有している。無駄な争いは避けたい。
その辺の仕組みはまだまだできてないなと思う訳でした。

- <a name="11a1"></a> [[1]](#r11a1) アスペ日記 - SICPを訳し直した

	<http://d.hatena.ne.jp/takeda25/20151030/1446174031>

## <a name="11-2"></a> [マルチVMなランタイムを作ってます。](http://hsk.github.io/diary/201511#11-2)

メモリ空間が複数あって、それを切り替えて使えるようなマシンを実装しながら作ってみています。
C言語だと、良い感じに作れる訳ですが、初めて作るものなのでモデルもゴチャゴチャしていてなかなか思い通りに行かず、イライラしております。
ま、きっと難しい事をしているんです。MS-DOSはマルチタスクではなく、Windows3.1でようやく疑似マルチタスクが実現されたわけで、簡単ではありません。
Amigaは真のマルチタスクを実現していましたが、それをPC上でするには数年かかり、95年にようやくWindows98が出来た訳です。
安定させるのに５年かかってWindows2000が出ました。スレッドはないのでWindows等のOS程複雑なものを作っている訳ではありません。
しかしやはり、メモリ空間を分けて管理するのは話が複雑なので簡単ではないんですよね。
でも、1日で出来ないようでは、駄目な気がする。ということで、気持ちが焦ってイライラしている訳でした。
でもようやくそれっぽく動くようになって来たのでホッとしている所であります。

# 2015/11/8

## <a name="8-1"></a> [リンク付けマシン](http://hsk.github.io/diary/201511#8-1)

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

## <a name="8-2"></a> [関数型ストリーム勉強会があったらしい](http://hsk.github.io/diary/201511#8-2)

関数型ストリーム勉強会<a name="r08b1"></a>[[1]](#08b1)があったらしい。
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

	<http://shamison.hatenablog.com/entry/2015/11/07/175915>

- <a name="08b2"></a>[[2]](#r08b2) Akka Streamsについて @mtoyoshi

	<https://twitter.com/mtoyoshi/status/662843334235283456>


- <a name="08b3"></a>[[3]](#r08b3) fs2(scalaz-stream) によるDBアクセス @gakuzzzz

	<https://gist.github.com/xuwei-k/6574b69abd5ed47a6743>


- <a name="08b4"></a>[[4]](#r08b4) Akka-Streamとscalaz-streamとの比較

	<https://twitter.com/mtoyoshi/status/662860032761991168>

- <a name="08b5"></a>[[5]](#r08b5) ローンパターン

	<http://www.ne.jp/asahi/hishidama/home/tech/scala/sample/using.html>

- <a name="08b6"></a>[[6]](#r08b6) ストリーム処理ライブラリはなぜ必要なのか @ffu_

	<https://twitter.com/ffu_/status/662867603707179008>

- <a name="08b7"></a>[[7]](#r08b7) pipesチュートリアルを読んだ話 @its_out_of_tune

	<http://tokiwoousaka.github.io/takahashi/contents/day20151107pipes.html>

- <a name="08b8"></a>[[8]](#r08b8) Pipes

	<https://hackage.haskell.org/package/pipes>

- <a name="08b9"></a>[[9]](#r08b9) Arrowによるストリーム処理(主にauto使用) @as_capabl

	<https://twitter.com/cohalz/status/662889753293910016>

- <a name="08b10"></a>[[10]](#r08b10) 最強のライブラリを作りたくて @fumieval

- <a name="08b11"></a>[[11]](#r08b11) Boombox

	<https://github.com/fumieval/boombox>

- <a name="08b12"></a>[[12]](#r08b12) 非同期ストリーム処理の標準化を目指す "Reactive Streams" とは - Okapies' Archive

	<http://okapies.hateblo.jp/entry/2014/04/20/212821>

# 2015/11/7

## <a name="7-1"></a> [publish してみることに](http://hsk.github.io/diary/201511#7-1)

hexoをつかってみることにしました。

<http://hsk.github.io/blog/>

でもなんかちがう。うーんなんか、面倒い。

## <a name="7-2"></a> [PHPで書き直した。](http://hsk.github.io/diary/201511#7-2)

<http://hsk.github.io/diary/>

こっちにする

## <a name="7-3"></a> [これから、やること。](http://hsk.github.io/diary/201511#7-3)

とりあえず、docsの下も公開出来る仕組みを作る。
あと、言語のページも作るといいのかなと。
ネスト付いてるのはやっぱりfindが楽な気がするんだけど。
全部公開しても困るし、ブランチ作って開発ビルドしておいての、masterに移行させて欲しいらしいのでそうする。らしいって何だって感じなのだけど、まぁそのアレw

## <a name="7-4"></a> [てすと](http://hsk.github.io/diary/201511#7-4)


# 2015/11/5

## <a name="5-1"></a> [プルリクエストをやってみる](http://hsk.github.io/diary/201511#5-1)

オンライン勉強会がどうのとikegamiさんという方がgithubを使ってプルリクエスト使えば良いんじゃみたいな話をしていて、ああ、使いこなせてないなと思ってプルリクエスト使う練習等をしてみました。
恥ずかしいけどできたのでよかった。
とりあえず、upstreamからpullしてマージするといいと教えて貰っててよかった。



----

[201511.md](201511.md)

[201510.md](201510.md)

[201509.md](201509.md)

[201508.md](201508.md)
