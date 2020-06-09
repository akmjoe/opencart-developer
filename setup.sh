#!/bin/bash

setup() {
	if [ ! -z $1 ]; then
		pushd "$1" > /dev/null
	fi
	if [ ! -f index.php ] || [ ! -f admin/index.php ]; then
		echo "$1 not a valid opencart directory, abort setup."
		popd > /dev/null
		return
	else
		echo "Setting up version $1..."
	fi
	# rename config files
	if [ ! -f config.php ]; then
        echo "Creating config file..."
		touch config.php
	fi
	if [ ! -f admin/config.php ]; then
        echo "Creating admin config file..."
		touch admin/config.php
	fi
	# Copy ocmod xml file
	if [ ! -f system/ocdeveloper.ocmod.xml ]; then
		ln -s ../../ocdeveloper.ocmod.xml system/ocdeveloper.ocmod.xml
        echo "Creating ocmod symbolic link..."
	fi
	# Copy .htaccess file
	if [ ! -f .htaccess ]; then
		#cp ../.htaccess .htaccess
		# Set rewrite base
        echo "Creating .htaccess file..."
		sed "/^RewriteBase/ s/$/$1\//" ../.htaccess > .htaccess
		#cat ../.htaccess | sed 's/^\(RewriteBase:.*\)/\1$1/' > .htaccess
	fi
	# Set group owner
	chgrp -f -R www-data system/storage/
	chgrp -f -R www-data system/library/
	chgrp -f -R www-data image/
	chgrp -f -R www-data config.php
	chgrp -f -R www-data admin/config.php
	chgrp -f www-data admin/view/stylesheet/bootstrap.css
	chgrp -f -R www-data admin/controller/extension/
	chgrp -f -R www-data admin/language/
	chgrp -f -R www-data admin/model/extension/
	chgrp -f -R www-data admin/view/image/
	chgrp -f -R www-data admin/view/javascript/
	chgrp -f -R www-data admin/view/stylesheet/
	chgrp -f -R www-data admin/view/template/extension/
	chgrp -f -R www-data catalog/controller/extension/
	chgrp -f -R www-data catalog/language/
	chgrp -f -R www-data catalog/model/extension/
	chgrp -f -R www-data catalog/view/javascript/
	chgrp -f -R www-data catalog/view/theme/
	chgrp -f -R www-data system/config/
	chgrp -f -R www-data system/library/
	chgrp -f -R www-data image/catalog/
	# Set access permissions
	chmod -f -R 0755 ./
	chmod -f -R 0775 admin/controller/extension/
	chmod -f -R 0775 admin/language/
	chmod -f -R 0775 admin/model/extension/
	chmod -f -R 0775 admin/view/image/
	chmod -f -R 0775 admin/view/javascript/
	chmod -f -R 0775 admin/view/stylesheet/
	chmod -f -R 0775 admin/view/template/extension/
	chmod -f -R 0775 catalog/controller/extension/
	chmod -f -R 0775 catalog/language/
	chmod -f -R 0775 catalog/model/extension/
	chmod -f -R 0775 catalog/view/javascript/
	chmod -f -R 0775 catalog/view/theme/
	chmod -f -R 0775 system/config/
	chmod -f -R 0775 system/library/
	chmod -f -R 0775 image/catalog/
	chmod -f 0775 system/storage/cache/
	chmod -f 0775 system/storage/logs/
	chmod -f 0775 system/storage/download/
	chmod -f 0775 system/storage/upload/
	chmod -f 0775 system/storage/modification/
	chmod -f 0775 system/storage/marketplace/
	chmod -f -R 0775 image/
	chmod -f 0775 config.php
	chmod -f 0775 admin/config.php
	chmod -f 0775 admin/view/stylesheet/bootstrap.css
	popd > /dev/null
	echo "Done"
}

# set permissions on files in this diretory
echo "Setting general permissions..."
chgrp -f www-data session
chmod -f 0775 session
chgrp -f www-data index.php
chmod -f 0755 index.php
echo "Done"
echo "Finding opencart versions"
# loop through directories setting permissions and config files
paths=()
checked=()
while IFS= read -r -d $'\0'; do
    paths+=("$REPLY")
done < <(find . -maxdepth 1 -type d -print0)
files=()
for f in "${paths[@]}"; do
	if [ $f == "." ] || [ $f == "./.git" ] || [ $f == "./session" ]; then
		continue
	fi
	# Set permissions and files in directory
	setup $f | sed 's|^./||'
done;
echo "Complete."
