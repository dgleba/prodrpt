<?php

class tables_tkb_prodtrak {

    function __sql__() {
        return
            "SELECT *,  from_unixtime(time)  as Part_made_at
             FROM `tkb_prodtrak` 
             order by id desc
            ";
    }
	
	      //Restrict Non-admin users to read only on the Users table
      function getPermissions(){
          $auth =& Dataface_AuthenticationTool::getInstance();
          $user =& $auth->getLoggedInUser();
          if ( $user and  $user->val('Role') != 'ADMIN' ){
          return Dataface_PermissionsTool::READ_ONLY();
      }
    }

 }
 