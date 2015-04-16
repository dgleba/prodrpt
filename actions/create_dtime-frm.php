
<!--<!DOCTYPE html>-->
<!-- kdg54 red9c ver 2013-09-17 ver 61 -->
<!-- kdg54 pmds-data ver 2013-09-17 ver 61 added validation per ray camden example - class="required" -->

<html>
    <head>
        <title>Downtime Status App</title>

        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="http://code.jquery.com/mobile/1.3.2/jquery.mobile-1.3.2.min.css" />
        <link rel="stylesheet" type="text/css" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1/themes/redmond/jquery-ui.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1/jquery-ui.min.js"></script>
        <script type="text/javascript" src="http://code.jquery.com/mobile/1.3.2/jquery.mobile-1.3.2.min.js"></script>
        <link rel="stylesheet" href="css/styleXF2.css" />
        <script type="text/javascript" src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.min.js"></script>

        <script type="text/javascript">
            // ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ initialize validation plugin jquery.validate.min.js
            $(document).on("pageshow", "#cDowntimePage", function() {
                $("#cdtime").validate();
            });
        </script>

        <script type="text/javascript">
            $(function() {
                $("#machinenum_cid").autocomplete({
                    source: "actions/machinenum_ac.php",
                    minLength: 2,
                    //select: function(event, ui) {
                    //     $('#machinenum_cid').val(ui.item.id) 
                    // }
                });
            });
        </script>


        <script type="text/javascript">
            // multiple autocomplete for "who is on it" field.
            // multiple-remote autocomplete http://jqueryui.com/autocomplete/#multiple-remote   2013-11-07_Thu_15.55-PM
            // php from: http://www.jensbits.com/2010/03/29/jquery-ui-autocomplete-widget-with-php-and-mysql/
            $(function() {
                function split(val) {
                    return val.split(/,\s*/);
                }
                function extractLast(term) {
                    return split(term).pop();
                }
                $("#whos_on_it_cid")
                        // don't navigate away from the field on tab when selecting an item
                        .bind("keydown", function(event) {
                    if (event.keyCode === $.ui.keyCode.TAB &&
                            $(this).data("ui-autocomplete").menu.active) {
                        event.preventDefault();
                    }
                })
                        .autocomplete({
                    source: function(request, response) {
                        $.getJSON("actions/pr_who_list_ac.php", {
                            term: extractLast(request.term)
                        }, response);
                    },
                    search: function() {
                        // custom minLength
                        var term = extractLast(this.value);
                        if (term.length < 2) {
                            return false;
                        }
                    },
                    focus: function() {
                        // prevent value inserted on focus
                        return false;
                    },
                    select: function(event, ui) {
                        var terms = split(this.value);
                        // remove the current input
                        terms.pop();
                        // add the selected item
                        terms.push(ui.item.value);
                        // add placeholder to get the comma-and-space at the end
                        terms.push("");
                        this.value = terms.join(", ");
                        return false;
                    }
                });
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
