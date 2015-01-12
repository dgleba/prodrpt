<?php
class tables_vw_pr_productionhdr_insp
{
    
    function __sql__()
    {
        return "SELECT *       FROM `pr_productionheader`       order by phid desc";
    }
    

}


