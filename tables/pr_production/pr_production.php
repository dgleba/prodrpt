<?php
class tables_pr_production
{
    
    function __sql__()
    {
        return "SELECT *       FROM `pr_production`       order by pid desc";
    }
    

}


