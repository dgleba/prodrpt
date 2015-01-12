
//require <jquery.packed.js>

//Disable the save button after it's been pressed. (Prevents multiple clicks)
jQuery(document).ready(function($){
	$("input[name='--session:save']").click(function(){
		alert("Save Button was pressed..\n\nThis message is displayed to help prevent pressing save twice.");
		//$(this).attr("disabled","disabled");
	});
});
