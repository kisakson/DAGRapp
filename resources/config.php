<?php
 
/*
 STRUCTURE FROM https://code.tutsplus.com/tutorials/organize-your-next-php-project-the-right-way--net-5873
*/

/*
    The important thing to realize is that the config file should be included in every
    page of your project, or at least any page you want access to these settings.
    This allows you to confidently use these settings throughout a project because
    if something changes such as your database credentials, or a path to a specific resource,
    you'll only need to update it here.
*/
 
$config = array(
    "db" => array(
        "dbname" => "nanfevar_MMDAGR",
        "username" => "nanfevar_seed",
        "password" => "7$BLW9_!V$",
        "host" => "localhost"
    ),
    "urls" => array(
        "homeUrl" => "http://www.baglecron.com"
    )/*,
    "paths" => array(
        "resources" => "/",
        "js" => $_SERVER["DOCUMENT_ROOT"] . "/js/",
        "css" => $_SERVER["DOCUMENT_ROOT"] . "/css/"
    )*/
);
 
/*
    I will usually place the following in a bootstrap file or some type of environment
    setup file (code that is run at the start of every page request), but they work 
    just as well in your config file if it's in php (some alternatives to php are xml or ini files).
*/
 
/*
    Creating constants for heavily used paths makes things a lot easier.
    ex. require_once(LIBRARY_PATH . "Paginator.php")
*/
defined("BASE_PATH")
    or define("BASE_PATH", realpath(dirname(__FILE__) . "/../"));

defined("CSS_PATH")
    or define("CSS_PATH", realpath(dirname(__FILE__) . "/../public_html/css/"));

defined("JS_PATH")
    or define("JS_PATH", realpath(dirname(__FILE__) . "/../public_html/js/"));

defined("PHP_PATH")
    or define("PHP_PATH", realpath(dirname(__FILE__) . "/../public_html/php/"));

defined("LIBRARY_PATH")
    or define("LIBRARY_PATH", realpath(dirname(__FILE__) . "/library/"));
     
defined("TEMPLATES_PATH")
    or define("TEMPLATES_PATH", realpath(dirname(__FILE__) . "/templates/"));
 
/*
    Error reporting.
*/
ini_set("error_reporting", "true");
error_reporting(E_ALL|E_STRCT);
 
?>
