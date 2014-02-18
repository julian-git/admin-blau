all: DbSchemaAdminBlau.png

DbSchemaAdminBlau.png: admin_blau.sql
	sqlt-diagram -d=MySQL admin_blau.sql -o DbSchemaAdminBlau.png --color

admin_blau.sql: .FORCE
	mysqldump --skip-opt --no-data -u admin_blau -padmin_blau admin_blau > admin_blau.sql

.PHONY: .FORCE
