<?php
class actions_send_email_production_insp {

    function handle(&$params) {

        echo "<br><h2>Email send process Production Report...</h2><br>";
        
        // give it some time to send the email. i think set_time_limit(30) is default. May need 60 sec. 2013-11-15
        // http://php.net/manual/en/function.set-time-limit.php
        set_time_limit(55);

        $app = & Dataface_Application::getInstance();  // reference to Dataface_Application object
        $auth = & Dataface_AuthenticationTool::getInstance(); // reference to Dataface_Authentication object
        $user = & $auth->getLoggedInUser();  // Dataface_Record object of currently logged in user.
        $rrecord = & $app->getRecord();  // Currently selected noterecord (Dataface_Record object)
		$relatedRecords = & $rrecord->getRelatedRecords('pr_productions');

        //$to1      = 'dgleba@stackpole.com';
        $to1      = 'stratford.reports@stackpole.com'; // in the final version only this one is needed
		//$to1      = 'azhou@stackpole.com';	// fill in your own email here for testing purposes
        $subject1 = 'Production Report Submitted';
			
        $headers1 = "From: " . "stratford.reports@stackpole.com" . "\r\n";
		  //$headers1 = "From: " . "stackpole.stratford@gmail.com" . "\r\n";
        $headers1 .= "Reply-To: " . "Do-not-reply-here" . "\r\n";
        $headers1 .= "MIME-Version: 1.0\r\n";
        $headers1 .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
		
		$message1 .= '<html><body>';
        $message1 .= '<p><b>Date: </b>' . $rrecord->strval('prdate') . '';
		$message1 .= '<b>     Shift/Time: </b>' . $rrecord->strval('prshift') . '';
		$message1 .= '<b>     Reported By: </b>' . $rrecord->strval('reportedby') . '</p><br>';
		$message1 .= '<table cellpadding="5" cellspacing="0" border="1" bgcolor="#FFFFFF" style="background: #FEE5DF">';
		$message1 .= '<tr><th>Cell</th>';
		$message1 .= '<th>Number of Operators</th>';
		$message1 .= '<th>Actual Production</th>';
		$message1 .= '<th>Scrap Quantity</th>';
		$message1 .= '<th>Comments</th></tr>';
	
		foreach ($relatedRecords as $foobar){
			$message1 .= '<tr><td style="background: #FEE5DF">' . $foobar['cell'] . '</td>';
			$message1 .= '<td style="background: #FEE5DF">' . $foobar['num_operators'] . '</td>';
			$message1 .= '<td style="background: #FEE5DF">' . $foobar['actual_production'] . '</td>';
			$message1 .= '<td style="background: #FEE5DF">' . $foobar['scrap_qty'] . '</td>';
			$message1 .= '<td style="background: #FEE5DF">' . $foobar['comments'] . '</td></tr>';
		}
		
		//$message1 .= "<p>" . $relatedRecords->strval('cell') . "</p>";
		$message1 .= "</body></html>";
		
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
		
	