<?php

class tables_vw_edit2_prdowntime1 {

    function __sql__() {
        return
         "SELECT *
         FROM `vw_edit2_prdowntime1` order by openitem desc,  completedtime desc, called4helptime desc
         limit 0,30  ";

	 /**
	 notes: 
	 
	  "SELECT *
        FROM `pr_downtime1` , IF(completedtime IS NULL OR completedtime = '0000-00-00', 1, 0) AS openitem
        order by openitem Desc,  called4helptime desc, completedtime desc
        limit 0,30  ";

		Fatal error: Failed parsing SQL query on select: SELECT * FROM `pr_downtime1` , IF(completedtime IS NULL OR completedtime = '0000-00-00', 1, 0) AS openitem order by openitem Desc, called4helptime desc, completedtime desc limit 0,30 . The Error was Parse error: Unexpected clause on line 2 FROM `pr_downtime1` , IF(completedtime IS NULL OR completedtime = '0000-00-00', 1, 0) AS openitem ^ found: "IF" in C:\p2\xampp\htdocs\xataface\lib\SQL\Parser.php on line 1773
		
        works:
		"SELECT * 
        FROM `pr_downtime1`  order by completedtime asc, called4helptime desc
        limit 0,30 ";
		
    	I may try a strategy where closed items are 1 and open items are 0
	 
	 So if the release date has a NULL value or has been inserted as a blank string and formatted to 0000-00-00, it is given a value of 1, and 0 otherwise. We then sort descending by our new in_production alias in the ORDER BY clause to get the NULL or empty values on top (assigned a 1 value), and then by release date and other criteria second.
	 SELECT m.*, IF(m.date_released IS NULL OR m.date_released = '0000-00-00', 1, 0) AS in_production FROM movies AS m ORDER BY in_production DESC, m.date_released DESC
     http://vancelucas.com/blog/mysql-series-return-null-values-first-with-descending-order/
     */
    }
	
    /**
     * Trigger that is called after a record is inserted.
     * @param $record Dataface_Record object that has just been inserted.
      function afterInsert(&$record){
     */
    function getTitle(&$record) {
        return str_pad(mb_substr($record->val('machinenum'), 0, 8), 8, " ") . " -- " . str_pad(mb_substr($record->val('problem'), 0, 14), 14, " ") . " -- " . $record->strval('completedtime');
        //return str_pad (mb_substr($record->val('problem'),0,35),35," ") ; 
        //return str_pad( mb_substr($record->val('note_fld'),0,22),22,"_") . " -- ". $record->strval('updatedtime');
    }

    function after_action_new($params = array()) {
        $record = & $params['record'];

        $to1 = 'stratford.reports@stackpole.com';
        $subject1 = 'Downtime Status App Record Submitted';

        $headers1 = "From: " . "prdowntime1" . "\r\n";
        $headers1 .= "bcc: " . "dgleba@gmail.com, davidgleba@hotmail.com" . "\r\n";
        //$headers1 .= "bcc: ". "dgleba@gmail.com," . "\r\n";

        $headers1 .= "Reply-To: " . "Do-not@reply" . "\r\n";
        $headers1 .= "MIME-Version: 1.0\r\n";
        $headers1 .= "Content-Type: text/html; charset=ISO-8859-1\r\n";

        $message1 = '<html><body>';
        $message1 .= 'This record was CREATED:' . "<br>";
        //$message1 .= '<table rules="all" style="border-color: #666;" cellpadding="10">';
        //$message1 .= '<table rules="all" style="border-color: #1E186E;" cellpadding="10">';
        $message1 .= '<table rules="all" border="1" style="border: 1px solid #211D57;" cellpadding="5">';

        $rrecord = df_get_record('pr_downtime1', array('idnumber' => $record->val('idnumber')));

        $message1 .= "<tr style='background: #eee;'><td><strong>Machine:</strong> </td><td>" . $rrecord->val('machinenum') . "</td></tr>";
        $message1 .= "<tr style='background: #eee;'><td><strong>Called 4 Help Time:</strong> </td><td>" . $rrecord->strval('called4helptime') . "</td></tr>";
        $message1 .= "<tr style='background: #eee;'><td><strong>Down:</strong> </td><td>" . $rrecord->strval('down') . "</td></tr>";
        $message1 .= "<tr style='background: #eee;'><td><strong>Who Is On It:</strong> </td><td>" . $rrecord->strval('whoisonit') . "</td></tr>";
        $message1 .= "<tr style='background: #eee;'><td><strong>Problem:</strong> </td><td>" . $rrecord->val('problem') . "</td></tr>";
        $message1 .= "<tr style='background: #eee;'><td><strong>Created-time:</strong> </td><td>" . $rrecord->strval('createdtime') . "</td></tr>";
        $message1 .= "<tr style='background: #eee;'><td><strong>Completed-Time:</strong> </td><td>" . $rrecord->strval('completedtime') . "</td></tr>";
        $message1 .= "<tr style='background: #eee;'><td><strong>Id-number:</strong> </td><td>" . $rrecord->strval('idnumber') . "</td></tr>";

        $message1 .= "</table>";
        $message1 .= "</body></html>";

        if (mail($to1, $subject1, $message1, $headers1)) {
            echo 'Your message has been sent.';
        } else {
            echo 'There was a problem sending the email.';
        }
    }
}
