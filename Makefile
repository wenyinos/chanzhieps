VERSION=$(shell head -n 1 VERSION)

all: zip

clean:
	rm -fr chanzhieps
	rm -fr *.zip
zip:
	mkdir chanzhieps
	cp -frv system chanzhieps/
	rm -fr chanzhieps/system/config/my.php
	cp -frv www chanzhieps && rm -fr chanzhieps/www/data/* && mkdir -p chanzhieps/www/data/upload/ && mkdir -p chanzhieps/www/data/slides/
	mkdir -p chanzhieps/www/data/css/default/default
	mkdir -p chanzhieps/www/data/css/default/blue
	mkdir -p chanzhieps/www/data/css/default/brightdark
	mkdir -p chanzhieps/www/data/css/default/flat
	mkdir -p chanzhieps/www/data/css/default/tartan
	mkdir -p chanzhieps/www/data/css/default/tree
	mkdir -p chanzhieps/www/data/css/default/wide
	mkdir -p chanzhieps/www/data/css/default/colorful
	touch chanzhieps/www/robots.txt && rm chanzhieps/www/robots.txt && touch chanzhieps/www/robots.txt  && chmod 777 chanzhieps/www/robots.txt
	rm -frv chanzhieps/system/tmp/cache/* 
	rm -frv chanzhieps/system/tmp/extension/*
	rm -frv chanzhieps/system/tmp/log/*
	rm -frv chanzhieps/system/tmp/model/*
	# combine js and css files.
	mkdir -pv chanzhieps/system/build/ && cp system/build/minifyfront.php chanzhieps/system/build/
	cd chanzhieps/system/build/ && php ./minifyfront.php && php ./createcustomercss.php
	rm -frv chanzhieps/system/build
	# delee the unused files.
	find chanzhieps -name '.git*' |xargs rm -frv
	find chanzhieps -name '.svn*' |xargs rm -frv
	find chanzhieps -name tests |xargs rm -frv
	for path in `find chanzhieps/ -type d`; do touch "$$path/index.php"; done	
	# change mode.
	chmod 777 -R chanzhieps/system/tmp/
	chmod 777 -R chanzhieps/www/data
	chmod 777 -R chanzhieps/www/template
	chmod 777 -R chanzhieps/system/config
	chmod 777 chanzhieps/system/module
	chmod a+rx chanzhieps/system/bin/*
	#find chanzhieps/ -name ext |xargs chmod 777 -R
	# zip it.
	zip -r -9 chanzhiEPS.$(VERSION).zip chanzhieps
	rm -fr chanzhieps
