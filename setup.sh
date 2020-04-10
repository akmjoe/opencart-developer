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
	chgrp -f -R www-data image/
	chgrp -f -R www-data config.php
	chgrp -f -R www-data admin/config.php
	chgrp -f www-data admin/view/stylesheet/bootstrap.css
	# Set access permissions
	chmod -f -R 0755 ./
	chmod -f 0775 system/storage/cache/
	chmod -f 0775 system/storage/logs/
	chmod -f 0775 system/storage/download/
	chmod -f 0775 system/storage/upload/
	chmod -f 0775 system/storage/modification/
	chmod -f 0775 image/
	chmod -f 0775 image/cache/
	chmod -f 0775 image/catalog/
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
