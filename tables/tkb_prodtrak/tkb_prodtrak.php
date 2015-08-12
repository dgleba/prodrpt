<?php

class tables_tkb_prodtrak {

    function __sql__() {
        return
            "SELECT *,  from_unixtime(part_timestamp) , (cycletime + downtime) as last_time_delta, 
			  IF((downtime + cycletime) < 120, (downtime + cycletime) ,  NULL) as ctime, 
			  IF((downtime + cycletime) > 600, downtime,  NULL) as dtime 
			  FROM `tkb_prodtrak` 
			  order by id desc
            ";
    }
    
/*
            "SELECT *,  from_unixtime(part_timestamp) , (cycletime + downtime) as last_time_delta, 
			  IF((downtime + cycletime) < 120, (downtime + cycletime) ,  NULL) as ctime, 
			  IF((downtime + cycletime) > 600, downtime,  NULL) as dtime 
			  FROM `tkb_prodtrak` 
			  order by id desc
            ";

            "SELECT *,  from_unixtime(part_timestamp) ,  
			  if ( (last_time_diff between 40 and 120)  , (last_time_diff) ,  NULL) as ctime, 
			  IF((last_time_diff) > 600, last_time_diff,  NULL) as dtime 
			  FROM `tkb_prodtrak` 
			  order by id desc
            ";

        SELECT *,  from_unixtime(part_timestamp) ,  
			  if (  
			        (if (last_time_diff > 40) , (last_time_diff) ,  NULL)
			     (last_time_diff < 120) , (last_time_diff) ,  NULL)
			     as ctime, 
			  
			  IF((last_time_diff) > 600, last_time_diff,  NULL) as dtime 
			  FROM `tkb_prodtrak` 
			  order by id desc
			  
*/

	
	      //Restrict Non-admin users to read only on the Users table
      function getPermissions(){
          $auth =& Dataface_AuthenticationTool::getInstance();
          $user =& $auth->getLoggedInUser();
          if ( $user and  $user->val('Role') != 'ADMIN' ){
          return Dataface_PermissionsTool::READ_ONLY();
      }
    }

 }
 