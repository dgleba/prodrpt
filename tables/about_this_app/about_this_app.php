<?php
class tables_about_this_app {
      //Restrict Non-admin users to read only on the Users table
      function getPermissions(){
          $auth =& Dataface_AuthenticationTool::getInstance();
          $user =& $auth->getLoggedInUser();
          if ( $user and  $user->val('Role') != 'ADMIN' ){
          return Dataface_PermissionsTool::READ_ONLY();
      }
      }
}

