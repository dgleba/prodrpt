<?php

class tables_vw_edit_prdowntime1 {

    function __sql__() {
        return
            "SELECT *, ( concat_ws('_', SUBSTRING(machinenum, 1, 18), SUBSTRING(problem, 1, 72)))  as record_ref
            FROM `vw_edit_prdowntime1` 
            order by completedtime asc, called4helptime desc
            ";
    }
//where completedtime is null
    
    function getTitle(&$record) {
        return str_pad(mb_substr($record->val('machinenum'), 0, 8), 8, " ") . " -- " . str_pad(mb_substr($record->val('problem'), 0, 14), 14, " ") . " -- " . $record->strval('completedtime');
        //return str_pad (mb_substr($record->val('problem'),0,35),35," ") ; 
        //return str_pad( mb_substr($record->val('note_fld'),0,22),22,"_") . " -- ". $record->strval('updatedtime');
    }

//end of class...     
}
