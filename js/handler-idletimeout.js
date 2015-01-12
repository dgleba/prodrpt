
// http://stackoverflow.com/questions/667555/detecting-idle-time-in-javascript-elegantly
// http://forums.devshed.com/showpost.php?p=1965136&postcount=10
// reload browser after x minutes of inactivity
// kdg54 2013-09-03_Tue_09.51-AM
//document.onmousemove = resetTimer;

//prodrpt


jQuery(document).ready(function ($){
 
var t;
var cnt1, cnt2, cnt3;
cnt1=51150;  //# seconds to reload
cnt2=cnt1*.7
cnt3=cnt1*1000;

window.onload=resetTimer;
document.onmousemove=resetTimer;
document.onkeypress=resetTimer;

function reload()
{
	alert("Enough inactivity has been detected so the page will refresh")
	//location.reload();
}

function resetTimer()
{
	//document.getElementById("timeoutdg2").innerHtml="My new text!";
	clearTimeout(t);
  t=setTimeout(reload,cnt3); // 1800000 reloads browser in 30 minutes. 5,400,000=90 min, 3,720,100=62min
	//window.status=document.write(t);
	//$("#timeoutdg2").html(t);
	countDown(cnt1);
}

function countDown (count) {
      if (count > 0) {
       var d = document.getElementById("timeoutdg2");
       d.innerHTML = count;
       setTimeout (function() { countDown(count-1); }, 800);  //using 800 rather than 1000. 1000 seemed too slow to match the timeout in seconds.
       }            
    }
    

});

