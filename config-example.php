<?php 
/**
 * @var array $_CONFIG
 */

# PLEASE READ ALL THE COMMENTS TO HELP YOU LEARN HOW TO CONFIGURE MythicalPics Node
# NO HELP WILL BE PROVIDED IF THE QUESTION CAN BE ANSWERED IN THIS CONFIG FILE.
# ============================================
# Thanks for installing MythicalPics!
# This is your configuration file. You can learn
# more about what you can do in the documentation.
#
# This file is included in 90% of the pages. You can access them using the '$_CONFIG' variable. 
#
# <!> This is not the place to edit the name.
# There should be a script that will download it from your main MythicalPics panel installation.
#
# Node Configuration: 
# Here you will configure the hole node part
$_CONFIG['panel_url'] = 'https://yourpanel.com'; #  This shall be your main MythicalPics installation!
# <!> Please do not add the / after the URL shall look like this: https://yourpanel.com not https://yourpanel.com/
$_CONFIG['node_key']  = 'test'; # This shall be the auth key for the panel to connect to the node
# <!> Please do not share this key or use a weak key like 1234  
$_CONFIG['ssh_host'] = 'localhost'; # This shall be the IP for the ssh connection
$_CONFIG['ssh_port'] = '22'; # This shall be the ssh port for the user
$_CONFIG['ssh_username'] = 'mythicalpics'; # This shall be the user for the ssh user
$_CONFIG['ssh_password'] = ''; # This shall be the password for the ssh user

# Cache database:
# We are using this database to store our cache 
$_CONFIG['mysql_host'] = '127.0.0.1';
$_CONFIG['mysql_port'] = '3306';
$_CONFIG['mysql_username'] = 'MythicalPics-Node';
$_CONFIG['mysql_password'] = '<strongpassword>';
$_CONFIG['mysql_database'] = 'mythicalpics_cache';

#DANGER ZONE
$_CONFIG['version'] = '1.0.3'; # Do not edit this if you don't know what this does
$_CONFIG['debug'] = false; # Do not edit this if you don't know what this does
?>