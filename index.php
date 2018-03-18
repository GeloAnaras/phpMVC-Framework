<?php
define("URLROOT","/phpMVC/");
define("DOCROOT",$_SERVER["DOCUMENT_ROOT"].URLROOT);

define("APP_PATH",DOCROOT."application/");
define("CORE_PATH",DOCROOT."core/");

define("MEDIA_URL",URLROOT."media/");
define("URL_PATH",DOCROOT."media/");

define("APP_CONFIG_PATH",APP_PATH."config/");
define("CONTROLLERS_PATH",APP_PATH."controllers/");
define("MODELS_PATH",APP_PATH."models/");
define("TEMPLATES_PATH",APP_PATH."templates/");
define("VIEWS_PATH",APP_PATH."views/");

define("CLASSES_PATH",CORE_PATH."classes/");
define("CONFIG_PATH",CORE_PATH."config/");
define("MODULES_PATH",CORE_PATH."modules/");

include CORE_PATH."loader.php";
