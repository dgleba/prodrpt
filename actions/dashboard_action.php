<?php
class actions_dashboard_action {
    function handle(&$params){
        $reclst = df_get_records_array('pr_downtime1', array(),0,35);
        df_display(array('pr_downtime1'=>$reclst), 'dashboard.html');
    }
}