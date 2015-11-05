package calc

import util.parsing.combinator._

sealed trait E
case class EInt(a:Int) extends E
case class EVar(a:String) extends E
case class EBin(a:E, op:String, b:E) extends E

object parse extends RegexParsers {
  override val whiteSpace = """(\s|/\*.*?\*/)+""".r
  val int = "[0-9]+".r ^^ { a => EInt(a.toInt) }
  val id = "[a-zA-Z_][a-zA-Z_0-9]*".r ^^ { EVar(_) }

  def fact:Parser[E] = id | int | "(" ~> exp <~ ")"

  def mul = fact ~ rep(("*" | "/") ~ fact) ^^ {
    case a ~ b =>
      b.foldLeft(a) { case (a, op ~ b) => EBin(a, op, b) }
  }

  def add = mul ~ rep(("+" | "-") ~ mul) ^^ {
    case a ~ b =>
      b.foldLeft(a) { case (a, op ~ b) => EBin(a, op, b) }
  }

  def exp = add

  def apply(p:Parser[E], str:String):E = parseAll(p, str) match {
  	case Success(t, _) => t
  	case e => throw new Exception(e.toString)
  }

  def apply(str:String): E = apply(exp, str)
}

object main extends App {
  assert(parse(parse.int, "123")==EInt(123))
  assert(parse(parse.int, "0")==EInt(0))
  assert(parse(parse.fact, "0")==EInt(0))
  assert(parse(parse.fact, "a")==EVar("a"))
  assert(parse(parse.add, "a+b")==EBin(EVar("a"),"+",EVar("b")))
  assert(parse(parse.add, "a-b")==EBin(EVar("a"),"-",EVar("b")))
  assert(parse(parse.add, "a-b-c")==EBin(EBin(EVar("a"),"-",EVar("b")),"-", EVar("c")))
  assert(parse(parse.add, "a-(b-c)")==EBin(EVar("a"),"-",EBin(EVar("b"),"-", EVar("c"))))
  assert(parse("a*b-c")==EBin(EBin(EVar("a"),"*",EVar("b")),"-", EVar("c")))
  assert(parse("/*aaa*/a-b/c")==EBin(EVar("a"),"-",EBin(EVar("b"),"/", EVar("c"))))
}
