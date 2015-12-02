# h_sakuraiの日記

ひっそりと日記を書きたいので、ここに書く。

# <a name="2"></a> [2015/12/2](#2)

## <a name="2-1"></a> [gitの一部だけ取り出してリポジトリを作る](http://hsk.github.io/diary/201512#2-1)

今、docsというリポジトリがあります。
この中から一部分(ocaml/tasc)というフォルダだけ取り出して、新しいgitリポジトリを作りたいと思います。

	git clone docs jasc
	cd jasc
	git filter-branch --subdirectory-filter ocaml/jasc HEAD

git filter-branchを使う事でocaml/jascがルートディレクトリになり、ocaml/jasc内の変更履歴のみが残ります。
理由は分かりませんが、cloneのほうがcp -rfするよりも高速でした。


----

[201512.md](201512.md)

[201511.md](201511.md)

[201510.md](201510.md)

[201509.md](201509.md)

[201508.md](201508.md)
