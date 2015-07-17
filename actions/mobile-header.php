
<head>
    <title>Downtime Status App</title>

    <meta name = "viewport" content = "width=device-width, initial-scale=1">
    <link rel = "stylesheet" href = "assets/jqmobile/jquery.mobile-1.3.2.min.css" />
    <link rel = "stylesheet" type = "text/css" href = "assets/jqueryui/redmond/jquery-ui.min.css">
    <script src = "assets/jquery-1.11.3.min.js"></script>
    <script src="assets/jquery-migrate-1.2.1.js"></script>
    <script src="assets/jquery-ui.min.js"></script>
    <script type="text/javascript" src="assets/jqmobile/jquery.mobile-1.3.2.min.js"></script>
    <link rel="stylesheet" href="style-xf1.css" />
    <script type="text/javascript" src="assets/jquery.validate.min.js"></script>


    <script type="text/javascript">
        $(function () {
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
        $(function () {
            function split(val) {
                return val.split(/,\s*/);
            }
            function extractLast(term) {
                return split(term).pop();
            }
            $("#whos_on_it_cid")
                    // don't navigate away from the field on tab when selecting an item
                    .bind("keydown", function (event) {
                        if (event.keyCode === $.ui.keyCode.TAB &&
                                $(this).data("ui-autocomplete").menu.active) {
                            event.preventDefault();
                        }
                    })
                    .autocomplete({
                        source: function (request, response) {
                            $.getJSON("actions/pr_who_list_ac.php", {
                                term: extractLast(request.term)
                            }, response);
                        },
                        search: function () {
                            // custom minLength
                            var term = extractLast(this.value);
                            if (term.length < 2) {
                                return false;
                            }
                        },
                        focus: function () {
                            // prevent value inserted on focus
                            return false;
                        },
                        select: function (event, ui) {
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
