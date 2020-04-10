# Opencart Developer

This is a combination of all the Opencart 3 releases for module testing.
A handler page is provided to switch between versions.

## Getting Started

Copy index.php, .htaccess, setup.sh and all folders to the location you want in your
Development Environment. By default this is `{webroot}/ocdeveloper/`.
If you use a different location, it will be neccesary to update the .htaccess files.
In the .htaccess file in your base directory, change *ocdeveloper* in the `rewrite_base`  
setting to the directory on your server. Delete the .htaccess file from each of the version folders.
They will be regenerated when you run the setup script.
If you would like to share sessions between versions (so you will stay logged in when switching versions),
copy ocdeveloper.ocmod.xml to your install location.

Run the setup.sh script to set permissions and generate config files. This will also create links to
ocdeveloper.ocmod.xml.

In your web browser, go to `{your_server}/ocdeveloper` (or whatever subfolder you used).
The handler page will load the first version. Install it and switch to the next version.
If using the same database for all versions, make sure to set a unique
database prefix (I use the version number without punctuation, followed by an underscore;
eg, 3011_).

Repeat this process to install all the versions you require.

## Enabling shared sessions

To enable shared sessions, you will need to apply the modifications in ocdeveloper.ocmod.xml.
In the store admin, go to **Extensions > Modifications** and click the **Refresh** button.
This must be done for each version. When it is complete, you will be able to switch between these versions
and keep your login status.
Note: For this to work, the user id's must be the same on all stores.

### Installing a new version

Create a folder named the version number you are installing. Download the source for the new
version you want to install. Extract and copy the contents of the **upload** folder to this
new folder.
Run the setup.sh script to set permissions and create empty config files.

Nevigate to this new version in your web browser and complete the install process.

## Authors

* **Joe Rothrock** - *Initial work* - [akmjoe](https://github.com/akmjoe)


