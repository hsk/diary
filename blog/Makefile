all:
	hexo generate
	open http://localhost:4000/
	hexo server

publish:
	rm -rf ../../hsk.github.com/blog/*
	cp -rf public/* ../../hsk.github.com/blog/.
	open http://hsk.github.com/blog/
	cd ../../hsk.github.com/blog; git add .; git commit -a; git push;

new:
	hexo new $1

