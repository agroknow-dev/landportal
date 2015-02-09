# Landportal Drupal (v7.x)

This repository contain the theme and modules used to setup the Landportal website.

Theme: landportal

Features:
 - landportal_taxonomy
 - landportal_field_base
 - landportal_content_type

Modules:
 - landbook
 - landdebate
 - landportal_homepage
 - landportal_extra

Original work for the new Landportal version (as of 2014) and development of the Landbook was made by WESO (http://github.com/weso) and SBC4D (http://sbc4d.com). The Drupal refactoring have been done by Jules Clement (http://jcpc.ker.bz).


# Installation

This GIT repository is meant to be clone/checked-out in a "standard" Drupal 7 [Drupal]/sites/ directory named after the host.

Example (on a Debian-based distro):
```
~# ls -l /usr/share/drupal7
  ...
  sites -> /etc/drupal/7/sites
  ...
~# ls /etc/drupal/7
  apache2.conf
  htaccess
  sites/
~# cd /etc/drupal/7/sites
/etc/drupal/7/sites# git clone https://github.com/landportal/drupal [SITENAME]
/etc/drupal/7/sites# ls -l
  all/
  default/
  [SITENAME]/
```

## Environment

Aside of the Drupal 7.x install you need to have the following services accessible:
 - DB: mysql, postgresql, virtuoso
 - Caching: memcached
 - Search: SOLR
 - Landportal services: api, receiver
 - Web based service: CKAN, Wesby (by WESO)

Refer to the Landportal Administrator handbook for further details.


## Configuration

To have the website up and running:
 - Create a database for the drupal instance.
 - Configure [...]drupal7/sites/HOSTNAME/dbconfig.php and local.settings.php
 - Run the default drupal install process(?)
   http://HOSTNAME/install.php
 - Enable and set default theme to landportal
 - Enable: landportal_extra
 - This should already have enabled the following features:
   - landportal_taxonomy
   - landportal_field_base
   - landportal_content_type
 - Enable modules:
   - landportal_homepage
   - landdebate
   - landbook

# Components

## Theme

Implements the new Landportal design style.

## Modules

### landportal_extra

Pulls dependencies for the landportal base modules and theme.
Set default configuration for menus and few other things.
This module should be enabled first.
### landportal_homepage

Provides views and configuration for the landing page.

### landbook

Before enabling this module, you need to have a dump of the 'landportal' MySQL
 database up and running. You also need to configure it in the drupal settings
 or dbconfig.php as follow:
```
$databases['default']['default'] = array(
        // drupal7 database
);
$databases['default']['landbook'] = array(
	'driver' => 'mysql',
	'database' => 'landportal',
	'username' => 'USERNAME',
	'password' => 'USERPASS',
	'host' => 'localhost',
	'port' => '',
	'prefix' => ''
);
```
### landdebate

Provide views and blocks for the landdebate section of the portal.

## Features

Features are (normally) exported directly from the drupal backoffice Structure > Features page.

Each of them holds specific
 - landportal_taxonomy
 - landportal_field_base
 - landportal_content_type

# More information

You can find some more details on the Landportal infrastructures and services in the handbooks.
 - the Editor one on how to manage the landportal website
 - the Administrator one about the Landportal stack and environment.
