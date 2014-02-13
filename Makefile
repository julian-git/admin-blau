all: admin_blau.png

admin_blau.png: admin_blau.sql
	sqlt-diagram -d=MySQL admin_blau.sql -o admin_blau.png --color

admin_blau.sql: .FORCE
	mysqldump --skip-opt -u admin_blau -padmin_blau admin_blau > admin_blau.sql

.PHONY: .FORCE
