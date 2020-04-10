#!/bin/bash
mv config-dist.php config.php
mv admin/config-dist.php admin/config.php
chmod -R 0755 ./
chgrp -R www-data system/storage/
chgrp -R www-data image/
chgrp -R www-data config.php
chgrp -R www-data admin/config.php
chmod 0775 system/storage/cache/
chmod 0775 system/storage/logs/
chmod 0775 system/storage/download/
chmod 0775 system/storage/upload/
chmod 0775 system/storage/modification/
chmod 0775 image/
chmod 0775 image/cache/
chmod 0775 image/catalog/
chmod 0775 config.php
chmod 0775 admin/config.php
chgrp www-data admin/view/stylesheet/bootstrap.css
chmod 0775 admin/view/stylesheet/bootstrap.css
exit
