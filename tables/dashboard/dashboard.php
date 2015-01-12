<?php

class tables_dashboard {

    //Restrict Non-admin users to read only on the Users table
    function getPermissions() {
        $auth = & Dataface_AuthenticationTool::getInstance();
        $user = & $auth->getLoggedInUser();
        if ($user and $user->val('Role') != 'ADMIN') {
            return Dataface_PermissionsTool::READ_ONLY();
        }
    }

    //function block__custom_javascripts(){
    //  echo '<script src="javascripts.js" type="text/javascript" language="javascript"></script>';
    //}
    // ---- custom css ...
    //  function block__custom_javascripts(){
    //   echo '<link rel="stylesheet" type="text/css" href="%s"/>' 
    //      htmlspecialchars(DATAFACE_SITE_URL.'/css/dashboard1.css');
    //}
    // ---- custom css ...
    //  function block__after_header(){
    //   sprintf('<link rel="stylesheet" type="text/css" href="%s"/>',
    //       htmlspecialchars(DATAFACE_SITE_URL.'/css/dashboard1.css')
    //   );
    //}
}

