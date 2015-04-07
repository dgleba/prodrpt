<?php

// Continuation of mobile custom form

class actions_create_dtime {

    function handle(&$params) {

        // ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ get posted info
        if (isset($_POST['submit'])) {
            // ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ retrieve correct record by id
            //echo "urlsave= ", $_POST['urlsave'], "<br/>";
            //echo "recid= ", $_POST['recid'], "<br/>";
            //echo "state= ", $_POST['state'], "<br/>";
            //echo "dtetime= ", $_POST['datetime-l'], "<br/>";

            $rrecord = new Dataface_Record('vw_edit_prdowntime1', array());
            $rrecord->setValues(array(
                'problem'           => $_POST['problem'],
                'machinenum'        => $_POST['machinenum_n'],
                'called4helptime'   => $_POST['datetime-l'],
                'whoisonit'         => $_POST['who_is_on_it'],
                'down'              => $_POST['down2']
            ));
            //$res = $record->save();   // Doesn't check permissions
            $res = $rrecord->save(null, true);  // checks permissions

            if (PEAR::isError($res)) {
                // An error occurred
                throw new Exception($res->getMessage());
            }

            // If there was an auto increment  id field, it will now be populated
            $rrecord->val('id');
            //echo "id= ", $rrecord->val('idnumber'), "<br/> <br/>";
            //echo "result of save= ", $res, "<br/> <br/>";

            echo "<span style='font-size:60px;'><br/>Record Submitted<br/><br/></span>";
            // no bootstrap styling. need to use urlsave. ... echo '<a href=" . {$ENV.DATAFACE_SITE_HREF}?-table=dashboard" class="btn btn-lg btn-warning">Dashboard</a> ';
            echo " <span style='font-size:80px;'> <a href=" . $_POST['urlsave'] . ">Dashboard...</a></span>";
            //////echo " <span style='font-size:80px;'> <a  Go  Back...</a></span>";
            
        } else {
            // ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ prepare record for form

            $app = &Dataface_Application::getInstance();
            // reference to Dataface_Application object
            $auth = &Dataface_AuthenticationTool::getInstance();
            // reference to Dataface_Authentication object
            $user = &$auth->getLoggedInUser();
            // Dataface_Record object of currently logged in user.
            $rrecord = &$app->getRecord();
            // Currently selected noterecord (Dataface_Record object)
            //$query = &$app->getQuery();
            //$url = $app->url('-action=list');
            //$rid = $rrecord->val('idnumber');
            //echo "rid 1= ", $rid;
            
             //just a blank screen... getPermissions(&$rrecord);
             //check permissions...
             //this needs to be improved. some more feedback to the user would be nice.
             if (!isset($user))
                 return Dataface_PermissionsTool::NO_ACCESS();
             // if the user is null then nobody is logged in... no access.
             // This will force a login prompt.
             $role = $user->val('Role');
             Dataface_PermissionsTool::getRolePermissions($role);
             // Returns all of the permissions for the user's current role.


            //$url = $app->url('-action=list');
            $url = $app->url('-table=dashboard&-action=list');
            
            // ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ display form
            include 'actions/create_dtime-frm.php';
        }
    }

}
