<!DOCTYPE html>
<!-- edit9note-frm.php version 2013-09-16 pmds-data -- 50 -->
<!-- 2013-09-16_Mon_14.44-PM added autocorrect="off" in input so that iphone will not autocorrect the state.-->	

<html>
    <head>
        <title>Edit Form Mobile</title>

        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="http://code.jquery.com/mobile/1.3.2/jquery.mobile-1.3.2.min.css" />
        <link rel="stylesheet" type="text/css" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1/themes/redmond/jquery-ui.css">
        <link rel="stylesheet" href="css/styleXF2.css" />
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1/jquery-ui.min.js"></script>
        <!-- <script src="http://code.jquery.com/jquery-1.10.1.min.js"></script> -->
        <!-- <script src="http://code.jquery.com/jquery-migrate-1.2.1.min.js"></script> -->
        <script type="text/javascript" src="http://code.jquery.com/mobile/1.3.2/jquery.mobile-1.3.2.min.js"></script>
        <script type="text/javascript" src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.min.js"></script>

    </head>

    <body>

        <div data-role="page" id="c_editpage">

            <div data-role="navbar">
                <ul>
                    <li><a href="?-table=dashboard" class="ui-btn-active" data-ajax="false">Dashboard</a></li>
                </ul>
            </div>  

            <div data-role="navbar">
                <ul>
                    <li><a href="?-action=create_dtime" class="ui-btn-active" data-ajax="false">New Downtime</a></li>
                </ul>
            </div>  

            <div data-role="navbar">
                <ul>
                    <li><a href="?-table=vw_edit_prdowntime1" class="ui-btn-active" data-ajax="false">Edit Downtime</a></li>
                </ul>
            </div>  
                        
            <div>
                <select onchange="window.location.href = this.options[this.selectedIndex].value" id="dash-select1">
                    <option value="">Select ...</option>
                     {foreach from=$pr_downtime1 item=$record}
                    <option value="<?php $record->strval('machinenum'); ?>">
                        {$record->getTitle()}
                    </option>
                    {/foreach}
                </select>
            </div>

            <!-- -->
            <!-- pass some reference info to the php file getting the posted info... -->
            <input type="hidden" name="recid" value="<?php echo $rid ?>" />
            <input type="hidden" name="urlsave" value="<?php echo $url ?>" />
            <input type="hidden" name="-action" value="edit_dtime" />
            <input type="submit" value="Submit" id="submit" name="submit" data-theme="a" />
        </form>
    </div>
</body>

</html>
