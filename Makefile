all:
	php README.php > README.md
	php index.php > diary/index.html
	git commit -a
	git push

