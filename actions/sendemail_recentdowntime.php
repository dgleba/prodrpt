<?php
class actions_sendemail_recentdowntime {
    function handle(&$params){
	
	    echo "<br><h2>Email send process -- recent downtime...</h2><br>";
        
        // give it some time to send the email. i think set_time_limit(30) is default. May need 60 sec. 2013-11-15,2015-03-26
        // http://php.net/manual/en/function.set-time-limit.php
        set_time_limit(85);

        $app = & Dataface_Application::getInstance();  // reference to Dataface_Application object
        $auth = & Dataface_AuthenticationTool::getInstance(); // reference to Dataface_Authentication object
        $user = & $auth->getLoggedInUser();  // Dataface_Record object of currently logged in user.
        $query =& $app->getQuery();
        $query['-table'] = 'pr_downtime1';
        //$query['-search'] = 'draw';
        //$query['-called4helptime'] = '>=3/25/2015';
        $query['-limit'] = 20;
		
        if ( $query['-table'] != 'pr_downtime1' ){
            return PEAR::raiseError('This action can only be called on the True North List table.');
        }

        $to1      = 'stratford.reports@stackpole.com'; // in the final version only this one is needed
   	  //  $to1      = 'dgleba@stackpole.com';	// fill in your own email here for testing purposes
        $subject1 = 'Recent Downtime Report';
			
        $headers1 = "From: " . "stratford.reports@stackpole.com" . "\r\n";
        $headers1 .= "Reply-To: " . "Do-not-reply-here" . "\r\n";
        $headers1 .= "MIME-Version: 1.0\r\n";
        $headers1 .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
		
		$message1 = '<html><body>';
		$message1 .= 'This is the 20 most recent downtime items from the Production/Downtime Status App. <br>The open items appear first {They have no completed-time} - followed by the most recent closed items.<br><br>'; 
		$message1 .= '<table cellpadding="5" cellspacing="0" border="1" bgcolor="#FFFFFF" style="background: #FEE5DF">';
		$message1 .= '<tr><th>Called 4 help time</th>';
		$message1 .= '<th>Machine</th>';
		$message1 .= '<th>Problem</th>';
		$message1 .= '<th>Down</th>';
		$message1 .= '<th>Who Is On It</th>';
		$message1 .= '<th>Completed Time</th>';
		$message1 .= '<th>Remedy</th></tr>';
        
        $list1 = df_get_records_array('pr_downtime1', $query); 
		
		foreach ($list1 as $arecord){
			
			$message1 .= '<tr><td style="background: #FFFFC2">' . $arecord->htmlValue('called4helptime') . '</td>';
			$message1 .= '<td style="background: #FFFFC2">' . $arecord->htmlValue('machinenum') . '</td>';
			$message1 .= '<td style="background: #FFFFC2">' . $arecord->htmlValue('problem') . '</td>';
			$message1 .= '<td style="background: #FFFFC2">' . $arecord->htmlValue('down') . '</td>';
			$message1 .= '<td style="background: #FFFFC2">' . $arecord->htmlValue('whoisonit') . '</td>';
			$message1 .= '<td style="background: #FFFFC2">' . $arecord->htmlValue('completedtime') . '</td>';
			$message1 .= '<td style="background: #FFFFC2">' . $arecord->htmlValue('remedy') . '</td></tr>';
		}
		$message1 .= "</table></body></html>";
		$message1 .= 'You can see these records in the app itself by visiting the address at: http://pmds-data.stackpole.ca/menu/ <br> click on - Production Status App. <br> Login in. Press Open Status... Click Downtime.<br><br>';
		
		$body1 = isset($message1) ? preg_replace('#(\\r\\n|\\n|\\r)#', '<br/>', $message1) : false;
        $body1 = preg_replace('#(______,|______)#', '<br/>', $body1);
        $body1 = preg_replace('#(</td></tr>)#', '</td></tr>'.PHP_EOL, $body1);
				
        if (mail($to1, $subject1, $body1, $headers1)) {
            echo '<br><br><h1><span style="background-color:#00ff00;">Your email has been sent.</span></h1><br>';
        } else {
            echo '<br><br /><h1><span style="background-color:#ff0000;">There was a problem sending the email.</span></h1><br />';
        }
        echo '<br /><br /><br /><span style="font-size:16px;">Press the BACK button in your browser to go back.</span><br />';
        
        
    }
}
