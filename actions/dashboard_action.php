<?php
class actions_dashboard_action {
    function handle(&$params){
        $reclst = df_get_records_array('vw_edit2_prdowntime1', array());
        df_display(array('vw_edit2_prdowntime1'=>$reclst), 'dashboard.html');
    }
}