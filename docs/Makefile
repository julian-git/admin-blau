MAKEFLAGS=-L  # follow symbolic links

all: DbSchemaAdminBlau.png requisits.pdf

DbSchemaAdminBlau.png: admin_blau.sql
	sqlt-diagram -d=MySQL admin_blau.sql -o DbSchemaAdminBlau.png --color

admin_blau.sql: \
	2014_02_11_124400_create_castellers.php \
	2014_02_13_001137_pinyes.php \
	2014_02_20_225631_messages.php
	mysqldump --skip-opt --no-data -u admin_blau -padmin_blau admin_blau > admin_blau.sql

requisits.pdf: requisits.tex DbSchemaAdminBlau.png
	pdflatex requisits
