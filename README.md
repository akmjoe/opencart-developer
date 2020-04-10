# Opencart Developer

This is a combination of all the Opencart 3 releases for module testing.
A handler page is provided to switch between versions.

## Getting Started

Copy the index.php, .htaccess, bash and all folders to the location you want in your
development Environment. By default this is `{webroot}/ocdeveloper/`.
If you use a different location, it will be neccesary to modify the .htaccess file in each
folder. Change *ocdeveloper* in the `rewrite_base`  setting to the directory on your server.

In your web browser, go to `{your_server}/ocdeveloper` (or whatever subfolder you used).
The handler page will show all available versions. Click on a version to be redirected to
the install page. if using the same database for all versions, make sure to set a unique
database prefix (I use the version number without punctuation, followed by an underscore;
eg, 3011_).

Repeat this process to install all the versions you require.

### Installing a new version

Create a folder named the version number you are installing. Download the source for the new
version you want to install. Extract and copy the contents of the **upload** folder to this
new folder.
Upen a terminal inside this directory and run the `bash` script to set file permissions.
Copy the .htaccess file to this new directory, open and append the folder name to the
`rewrite_base` line.

Nevigate to this new version in your web browser and complete the install process.

## Authors

* **Joe Rothrock** - *Initial work* - [akmjoe](https://github.com/akmjoe)


