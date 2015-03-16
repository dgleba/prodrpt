<?php 

//report all errors for debugging...
//error_reporting(E_ALL);
//ini_set('display_errors', 'on');
//
//don't show strict warnings.  xataface group.. Re: Getting messages: Strict Standards: Only variables should be assigned by reference errors
ini_set('display_errors', '0');     # don't show any errors...
error_reporting(E_ALL | E_STRICT);  # ...but do log them

//Main Application access point
if (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN') {
    //echo 'This is a server using Windows!';
    require_once "C:\\p2\\xampp\\htdocs\\xataface\\dataface-public-api.php";
} else {
    echo 'This is a server not using Windows!';
    require_once "../xataface/dataface-public-api.php";
}

//set default sort order. this is needed in 1.5x. to get it to work. 2012-06-21
// 
if ( !isset($_REQUEST['-sort']) and @$_REQUEST['-table'] == 'vw_all_prdowntime1' ){
    $_REQUEST['-sort'] = $_GET['-sort'] = 'completedtime desc';
   }
   
if ( !isset($_REQUEST['-sort']) and @$_REQUEST['-table'] == 'about_this_app' ){
    $_REQUEST['-sort'] = $_GET['-sort'] = 'sort_order desc';
   }

df_init(__FILE__, "/xataface");
//df_init(__FILE__, "/xataface30801");
$app =& Dataface_Application::getInstance();

//default filter: this works in index.php ,but not in applicationdelegate class.  David Gleba kdg54 2013-04-24
$query =& $app->getQuery();
if ( !$_POST and $query['-table'] == 'vw_open' and !isset($query['completedtime'])) {
    $query['completedtime'] = '=' ;
}

//default filter: this works in index.php ,but not in applicationdelegate class.  David Gleba kdg54 2013-04-24
$query =& $app->getQuery();
if ( !$_POST and $query['-table'] == 'vw_edit_prdowntime1' and !isset($query['completedtime'])) {
    $query['completedtime'] = '=' ;
}

$app->display();
