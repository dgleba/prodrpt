
xataface will not do this group by query.
I did it in an action - see qry_callpareto1.php action.


~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
Title:  .
-----------------------2015-07-12[Jul-Sun]13-49PM

CREATE OR REPLACE VIEW `vw_pr_downtime1_qry1` AS SELECT * FROM `pr_downtime1`;

~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~


~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
Title:  .
-----------------------2015-07-12[Jul-Sun]13-49PM


Warning: Illegal offset type in isset or empty in C:\p2\xampp\htdocs\xataface\Dataface\Table.php on line 1591

Warning: ucfirst() expects parameter 1 to be string, array given in C:\p2\xampp\htdocs\xataface\Dataface\Table.php on line 1934

Warning: Illegal offset type in C:\p2\xampp\htdocs\xataface\Dataface\Table.php on line 1592

Warning: Illegal offset type in C:\p2\xampp\htdocs\xataface\Dataface\Table.php on line 1593

Warning: Illegal offset type in isset or empty in C:\p2\xampp\htdocs\xataface\Dataface\Table.php on line 1594
Uncaught exception was thrown while processing this request. Troubleshooting steps:

Refresh the APC Cache. - This may help in cases where you have changed a table column definition and your server has the APC opcode cache installed.
Clear Cache Views - This may also help in cases where you have changed a table column definition and some tables include __sql__ definitions.
Check your PHP error log for a description of the error and go from there. See this page for troubleshooting tips.

Fatal error: Uncaught exception 'Exception' with message 'Failed to load current record due to an SQL error' in C:\p2\xampp\htdocs\xataface\Dataface\QueryTool.php:532 Stack trace: #0 C:\p2\xampp\htdocs\xataface\Dataface\Application.php(1347): Dataface_QueryTool->loadCurrent() #1 C:\p2\xampp\htdocs\xataface\Dataface\Application.php(3055): Dataface_Application->getRecord() #2 C:\p2\xampp\htdocs\xataface\Dataface\Application.php(3084): Dataface_Application->getPermissions() #3 C:\p2\xampp\htdocs\xataface\Dataface\ActionTool.php(237): Dataface_Application->checkPermission('list') #4 C:\p2\xampp\htdocs\xataface\Dataface\Table.php(5593): Dataface_ActionTool->getActions(Array) #5 C:\p2\xampp\htdocs\xataface\Dataface\ActionTool.php(81): Dataface_Table->getActions(Array) #6 C:\p2\xampp\htdocs\xataface\Dataface\ActionTool.php(97): Dataface_ActionTool->_loadTableActions('vw_pr_downtime1...') #7 C:\p2\xampp\htdocs\xataface\Dataface\Application.php(2255): Dataface_ActionTool->getAction(Array) #8 C:\p2\xampp\htdocs\xataface\Dataface\Ap in C:\p2\xampp\htdocs\xataface\Dataface\QueryTool.php on line 532


~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
