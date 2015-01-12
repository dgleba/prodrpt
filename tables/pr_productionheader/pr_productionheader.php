<?php
class tables_pr_productionheader
{
    
    function __sql__()
    {
        return "SELECT *       FROM `pr_productionheader`       order by phid desc";
    }
    

}


