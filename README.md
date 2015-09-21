# h_sakuraiの日記

ひっそりと日記を書きたいので、ここに書く。

# 2015/9/22 (土)

## パーサ作成ウォーミングアップメニュー

ここのところ、パーサを書くのに飽き飽きしてしまってパーサ書くのが嫌で嫌で仕方なくなってしまいました。
パーサを作るのをやめて、パーサ作りを忘れてみても、いざパーサを作ろうとすると嫌な気持ちがよみがえってきます。
オーマイッガッ！どうしたらいいんだ！祈っても、世界平和の解決法を考えてみても、いっこうにパーサが嫌なままです。
フラッシュバックしているのを止めたい。薬は使いたくない。一体どういう事なんだ！！
鎌倉時代の武士は祈るだけでは駄目だといって、禅を始めたという。迷走をして心を落ち着け、掃除をし、素振りをした。
基本は大事である。おそらく武士もまた剣の道で心が折れたとき、スランプに陥った事であろう。
私もまた、パーサ作成スランプである。

脳の事を考えると次のようなことが起こっているのではないだろうか。
脳内にはパーサを司る領域の記憶領域があるはずである。
脳がパーサの事を考えるとその思考のコンテキストにあわせて脳内のパーサ処理領域が呼び出される。
初期化ルーチンではCPUのコンテキストきりかえのように脳状態が記憶されていてそれが再生される。
パーサを作っていた時の記憶が嫌で嫌で仕方なくなっていると、思い出しただけで嫌になる。

この長期記憶内のコンテキストを書き換える事が出来れば、スランプから脱出することができるであろう。

このScalaでパーサ作成ウォーミングアップメニューはパーサ造の基本であり、素振りである。
パーサ作るのがめんどくさくなってたまらなくてスランプに陥った。
あるいは、パーサを自分で作ってみようとしてパーサ作成アレルギーのようになってしまった。
以下のメニューを何度もこなせば、パーサ作成は苦でなくなるであろう。

### 構文木を書く

まずは、構文木を作ります。

    package calc
    sealed trait E
    case class EBin(a:E, op:String, b:E) extends E
    case class EInt(a:Int) extends E
    case class EVar(a:String) extends E

    object main extends App {
      println(EBin(EInt(1),"+",EVar("s"))
    }

コマンドラインから、sbt等でテストすると楽でしょう。

    $ sbt ~ run

`EBin(EInt(1),"+",EVar("s"))`は`1+s`の式を表します。

### int対応パーサを書く


次に、int用のパーサを作ってテストしてみます。ユーティル、パーシング、コンビネータのレジェックスパーサーズを使うのです。って頭で覚えなくても、これ見てコピペすればオッケーです。

    import util.parsing.combinator._
    object parse extends RegexParsers {

      def int = """[0-9]+""".r ^^ { a => EInt(a.toInt) }
      def apply(parser:Parser[E], str:String) = parseAll(parser, str) match {
        case Success(tree,_) => tree
        case e => throw new Exception(""+e)
      }
    }

    object main extends App {
      println(parse(parse.int, "1"))
    }

出来たら、変数用のパーサを作ってテストしてみます。

### 変数のパーサを書く

変数のパーサの名前はid等としましょう。

    def id = "[a-zA-Z_][a-zA-Z_0-9]*".r ^^ { EVar(_) }

メイン関数には以下を書いてテストします。

      println(parse(parse.id, "a"))

### 変数とintをまとめて括弧も対応する

次に、factというパーサを、intとidと括弧に対応させたパーサを作りましょう。

    def fact:Parser[E] = int | id | "("~>fact<~")"

      println(parse(parse.fact, "abc"))
      println(parse(parse.fact, "123"))
      println(parse(parse.fact, "(abc)"))
      println(parse(parse.fact, "(123)"))

これでいいはずです。

### かけ算と割算に対応する。

mulという文法名でパーサを書いて

      def mul = fact ~ rep(("*" | "/") ~ fact) ^^ {
        case a ~ b => b.foldLeft(a) {
          case (a, op ~ r) => EBin(a, op, r)
        }
      }

factの括弧の中味も書き換えましょう。

    def fact:Parser[E] = int | id | "("~> mul <~")"

以下のようにテストしてみます。

      println(parse(parse.mul, "2*2"))
      println(parse(parse.mul, "2/3"))



### 足し算と引き算に対応する。

addという文法名でパーサ書いて

      def add = mul ~ rep(("+" | "-") ~ mul) ^^ {
        case a ~ b => b.foldLeft(a) {
          case (a, op ~ r) => EBin(a, op, r)
        }
      }

factの括弧の中味も書き換えましょう。

    def fact:Parser[E] = int | id | "("~> add <~")"

以下のようにテストします。

    println(parse(parse.add, "1+2+3"))
    println(parse(parse.add, "1*2-3/2"))

factも書き換えましょう。

### 右再帰に対応してみましょう。

assignとexpを追加して、

      def assign = repsep(add, "=") ^^ {
        _.reduceRight[E] {
          (a, b) => EBin(a, "=", b)
        }
      }

      def exp = repsep(assign, ",") ^^ {
        _.reduceRight[E] {
          (a, b) => EBin(a, ",", b)
        }
      }

factの括弧の中味も書き換えましょう。

      def fact:Parser[E] = int | id | "("~> add <~")"

      def apply(str:String):E = apply(exp, str)

テストは

    println(parse(parse.exp, "a=1+2,b=2*3,a*b"))


### 評価器を作りましょう。

evalという関数を作って評価します。

      def eval(env:Map[String,Int], e:E):(Map[String,Int], Int) = {
        e match {
          case EInt(a) => (env,a)
          case EVar(a) => (env,env(a))
          case EBin(EVar(a), "=", b) => 
            val (env1, b1) = eval(env, b)
            (env + (a->b1), b1)
          case EBin(a, ",", b) =>
            val (env1, a1) = eval(env, a)
            eval(env1, b)
          case EBin(a, op, b) =>
            val (env1, a1) = eval(env, a)
            val (env2, b1) = eval(env, b)
            op match {
              case "+" => (env2, a1 + b1)
              case "-" => (env2, a1 - b1)
              case "*" => (env2, a1 * b1)
              case "/" => (env2, a1 / b1)
            }
        }
      }

実行のテストは以下のような感じで

    var v = parse(parse.exp, "a=1+2,b=2*3,a*b")
    println(v)
    println(eval(Map(), v))

`1+2=3`で`2*3=6` `a=3`で`b=6`なので、`a*b`は18です。

### まとめ

調子を崩したときに、是非お試しあれ。
テストと言いつつ、実行して結果は目で確認してますが、assertでテストするようにしたり、
しっかりテスティングフレームワークを使うと良いでしょう。


## lambda計算

同じようにlambda計算も作ってみましょう。

	package calc

	sealed trait E
	case class EVar(a:String) extends E
	case class EInt(a:Int) extends E
	case class ELam(a:String, b:E) extends E
	case class EApp(a:E, b:E) extends E
	case class ELet(a:String, b:E, c:E) extends E
	case class EBin(a:E, op:String, b:E) extends E

	import util.parsing.combinator._

	object parse extends RegexParsers {
	  override protected val whiteSpace = """((/\*(?:.|\r|\n)*?\*/)|//.*|\s+)+""".r

	  val keywords = Set("let","in","fun")
	  val int = """[0-9]+""".r ^^ { a => EInt(a.toInt) }
	  val id = """[a-zA-Z_][a-zA-Z0-9_]*""".r ^? { case a if !keywords.contains(a) => a }
	  def lam = ("fun" ~> rep1(id)) ~ ("->" ~> exp) ^^ {
	    case a~b => a.foldRight(b) {(a,b)=>ELam(a, b)}
	  }
	  def let = ("let" ~> id) ~ ("=" ~> exp) ~ ("in" ~> exp) ^^ {
	    case a~b~c => ELet(a, b, c)
	  }
	  def fact:Parser[E] = let | lam | int | id ^^ { EVar(_) } | "(" ~> exp <~ ")"

	  def add = fact ~ rep(("+" | "-") ~ fact) ^^ { case a~b =>
	    b.foldLeft(a) { case(a, op~b) => EBin(a, op, b) }
	  }
	  def mul = add ~ rep(("*" | "/") ~ add) ^^ { case a~b =>
	    b.foldLeft(a) { case(a, op~b) => EBin(a, op, b) }
	  }

	  def app = rep1(mul) ^^ { _.reduceLeft{EApp(_, _)} }

	  def exp:Parser[E] = app

	  def apply(p:Parser[E], s:String) = parseAll(p, s) match {
	    case Success(t, _) => t
	    case e => throw new Exception("" + e)
	  }
	  def apply(s:String):E = apply(exp, s)
	}

	object main extends App {
	  println(parse(parse.int, "/*a*/123"))
	  println(parse(parse.fact, "a"))
	  println(parse(parse.fact, "123"))
	  println(parse("let f = fun a -> a in f 10"))
	  println(parse("(fun a b -> a + b) 1 2"))
	}


----

[201509.md](201509.md)

[201508.md](201508.md)
