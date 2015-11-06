all:
	hexo generate
	open http://localhost:4000/
	hexo server

publish:
	cp -rf public/* ../../hsk.github.com/blog/.
	cd ../../hsk.github.com/blog
	git add .
	git commit -a
	git push
	open http://hsk.github.com/blog/

