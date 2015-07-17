<?php

class tables_vw_pr_downtime1_qry1 {

    function __sql__() {
        return
          "SELECT machinenum, COUNT(idnumber) FROM vw_pr_downtime1_qry1 GROUP BY machinenum ORDER BY COUNT(idnumber) DESC
          ";
        
	 /**
	 notes: 
	 
	 xataface will not do this. see readme-thistable.txt, 2015-07-17_Fri_10.08-AM.
	 
	 It can be done in an action.
	 
   */ 
       
    }
	
        
}
