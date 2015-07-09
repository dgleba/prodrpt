
<!--<!DOCTYPE html>-->
<!-- kdg54 red9c ver 2013-09-17 ver 61 -->
<!-- kdg54 pmds-data ver 2013-09-17 ver 61 added validation per ray camden example - class="required" -->

<html>

    <?php include 'actions/mobile-header.php'; ?>

    <script type="text/javascript">
        // ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ initialize validation plugin jquery.validate.min.js
        $(document).on("pageshow", "#cDowntimePage", function () {
            $("#cdtime").validate();
        });
    </script>


</head>


<body>
    <!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~   debugging           -->
    <!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~   end debugging           -->
    <div data-role="page" id="cDowntimePage">

        <div id="errorBox"><ul></ul></div>

        <!--<a href="http://localhost/prodrpt/index.php?-table=dashboard" data-role="button" data-inline="true" data-ajax="false">Text only</a>-->
        <!--            Below line will enable a button to return user to the dashboard.-->

        <div data-role="navbar">
            <ul>
                <li><a href="?-table=dashboard" class="ui-btn-active" data-ajax="false">Dashboard</a></li>
            </ul>
        </div>  

        <form action="index.php" id="cdtime" method="POST" data-ajax="false">

            <div class="control-group">
                <label for="machinenum_f">Machine Number: </label>
                <div class="controls">
                    <input type="text" id="machinenum_cid"  name="machinenum_n" autocorrect="off" class="required"  />
                    <!--<input type="hidden" id="machine_number_cid" name="machine_number_n" />-->
                    <!--<input type="hidden" id="form_submitted" name="form_submitted" value="true" />-->
                </div>
            </div>

            <div data-role="fieldcontain">
                <label for="datetime-l">Called 4 Help Time:</label>
                <input type="datetime-local" name="datetime-l" id="datetime-l" class="required" value="<?php

                //http://php.net/manual/en/function.date.php -- look for: 'If you want to use HTML5's <date> tag, the following' 
                function getDateTimeValue($intDate = null) {   //returns HTML5 date text input formatted as datetime or current date if nothing is passed.
                    $strFormat = 'Y-m-d\TH:i';
                    $strDate = $intDate ? date($strFormat, $intDate) : date($strFormat);
                    return $strDate;
                }

                echo getDateTimeValue();
                // for current date... echo getDateTimeValue();   
                ?>" />
            </div>

            <div data-role="fieldcontain">
                <label for="select" class="select">Down:</label>
                <select name="down2" id="down2" class="required">
                    <option value="">Please select...</option>
                    <option value="Yes_Down">Yes_down</option>
                    <option value="No">No</option>
                    <option value="Planned_Yes">Planned_Yes</option>
                    <option value="Yes_Down_SendEmail">Yes_Down_SendEmail</option>
                    <option value="No_SendEmail">No_SendEmail</option>
                </select>
            </div>

            <div data-role="fieldcontain">
                <label for="problem">Problem:</label>
                <input type="text"  name="problem" id="tagsf2-tag" autocorrect="off" value="" />
            </div>

            <div class="control-group">
                <label for="who_is_on_it">Who Is On It: </label>
                <div class="controls">
                    <input type="text" id="whos_on_it_cid"  name="who_is_on_it" autocorrect="off"   />
                    <!--<input type="hidden" id="machine_number_cid" name="machine_number_n" />-->
                    <!--<input type="hidden" id="form_submitted" name="form_submitted" value="true" />-->
                </div>
            </div>
            <!-- -->	


            <input type="hidden" name="recid" value=" <?php echo $rid ?>" />
            <input type="hidden" name="urlsave" value="<?php echo $url ?>" />
            <input type="hidden" name="-action" value="create_dtime" />
            <input type="submit" value="Submit" id="submit" name="submit" data-theme="a" />
        </form>
    </div>
</body>

</html>
