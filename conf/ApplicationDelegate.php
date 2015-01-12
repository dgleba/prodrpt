<?php

/**
 * A delegate class for the entire application to handle custom handling of
 * some functions such as permissions and preferences.
 */
class conf_ApplicationDelegate {

    /**
     * Returns permissions array.  This method is called every time an action is
     * performed to make sure that the user has permission to perform the action.
     * @param record A Dataface_Record object (may be null) against which we check
     *               permissions.
     * @see Dataface_PermissionsTool
     * @see Dataface_AuthenticationTool
     */
    function getPermissions(&$record) {
        $auth = & Dataface_AuthenticationTool::getInstance();
        $user = & $auth->getLoggedInUser();
        if (!isset($user))
            return Dataface_PermissionsTool::NO_ACCESS();
        // if the user is null then nobody is logged in... no access.
        // This will force a login prompt.
        $role = $user->val('Role');
        return Dataface_PermissionsTool::getRolePermissions($role);
        // Returns all of the permissions for the user's current role.
    }

    function block__custom_javascripts() {
        //echo '<script src="js\javascriptsdg.js" type="text/javascript" language="javascript"></script>';
        // Dataface_JavascriptTool::getInstance()->import('submithandler1.js');
        echo '<script src="js/handler-idletimeout.js" type="text/javascript" language="javascript"></script>';
        echo '<script src="js/handler-save1a.js" type="text/javascript" language="javascript"></script>';
    }

    function block__after_left_column() {
        //block__before_fineprint()   block__after_left_column()
        echo "<div id=\"timeoutdg1\">  Timeout: </div> <div id=\"timeoutdg2\"> </div>";
    }

    public function beforeHandleRequest() {
        Dataface_Application::getInstance()
                ->addHeadContent(
                        sprintf('<link rel="stylesheet" type="text/css" href="%s"/>', htmlspecialchars(DATAFACE_SITE_URL . '/style-xf1.css')
                        )
        );

        $app = & Dataface_Application::getInstance();
        $query = & $app->getQuery();
        if ($query['-table'] == 'dashboard' and ($query['-action'] == 'browse' or $query['-action'] == 'list')) {
            $query['-action'] = 'dashboard_action';

            Dataface_Application::getInstance()->addHeadContent(
                    sprintf('<link rel="stylesheet" type="text/css" href="%s"/>', htmlspecialchars(DATAFACE_SITE_URL . '/css/dashboard1.css'))
            );
        }
    }

}

/* set default list view sort. this works with 1.3.2  but not with 1.5x . use stanza in index.php 2012-06-21
	function beforeHandleRequest(){
		$app = Dataface_Application::getInstance(); 
		$query =& $app->getQuery();
		if ( !$_POST and $query['-table'] == 'swi_log' and !@$query['-sort'] ){
			$query['-sort'] = 'Number desc';
		}
	}
	*/




