all:
	php README.php > README.md
	git commit -a
	git push

