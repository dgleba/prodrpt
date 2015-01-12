<?php

// Continuation of mobile custom form
 
class actions_edit_dtime {

    function handle(&$params) {

        // ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ get posted info
        if (isset($_POST['submit'])) {

            // ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ retrieve correct record by id
            //echo "urlsave= ", $_POST['urlsave'], "<br/>";
            //echo "recid= ", $_POST['recid'], "<br/>";
            //echo "state= ", $_POST['state'], "<br/>";
            //echo "dtetime= ", $_POST['datetime-l'], "<br/>";
            //echo "dtetime2= ", $_POST['datetime-2'], "<br/>";
            //echo "dtetime3= ", $_POST['datetime-3'], "<br/>";

            $rrecord = df_get_record('vw_edit_prdowntime1', array('idnumber' => $_POST['recid']));

            $rrecord->setValues(array(
                'problem' => $_POST['problem'],
                'machinenum' => $_POST['machinenum_n'],
                'called4helptime' => $_POST['datetime-l'],
                'whoisonit' => $_POST['who_is_on_it_n'],
                'down' => $_POST['down2'],
                'completedtime' => $_POST['completed_time'],
                'remedy' => $_POST['remedy']
            ));

            // Commit the changes to the database
            //$res = $rrecord -> save();
            $res = $rrecord->save();   // Doesn't check permissions
            //$res = $rrecord->save(null, true);  // checks permissions
            if (PEAR::isError($res)) {
                // An error occurred
                throw new Exception($res->getMessage());
            }


            echo "<br/><br/><br/><span style='font-size:60px;'> Record Submitted </span><br/><br/>";
            echo "<span style='font-size:80px;'> <a href='" . $_POST['urlsave'] . "'>Dashboard...</a> </span>";
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
            $query = &$app->getQuery();
            //$url = $app->url('-action=list');
            $rid = $rrecord->val('idnumber');
            //echo "rid 1= ", $rid;
            //$url = $app->url('-action=list');
            $url = $app->url('-table=dashboard&-action=list');

            // ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ display form
            include 'actions/edit_dtime-frm.php';
        }
    }

}
