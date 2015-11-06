all:
	php README.php > README.md
	php index.php
	git commit -a
	git push

test:
	php README.php > README.md
	php index.php
	open diary/index.html
pub:
	php README.php > README.md
	php index.php
	rm -rf ../hsk.github.com/diary
	cp -rf diary ../hsk.github.com/.
	cd ../hsk.github.com/diary/ ; git add .; git commit -a; git push; open http://hsk.github.io/diary
