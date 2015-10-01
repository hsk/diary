# h_sakuraiの日記

ひっそりと日記を書きたいので、ここに書く。

# 2015/10/02

## とりあえず目標

- [ ] first class polymorphism
- [ ] gradual typing

この２つを進める。
refined typingももうちょっと把握するとよいのかな。
移植すると結構満足感高いのだけど、深い理解が出来ているのかというと、それは別な話なので理解しやすくまとめたいと思う。
様々な、型システムの理解をより簡単にしたいけど、本当に難しいなと感じる。

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
