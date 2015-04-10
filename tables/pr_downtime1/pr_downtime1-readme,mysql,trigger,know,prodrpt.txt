
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
>>  .
-----------------------------
2015-01-09[Jan-Fri]10-53AM

added trigger to set closed to 1 if completedtime is set to a value. set to null otherwise.

this allows a sort where neweest open items are first followed by newest closed items.

_____________

This way we can sort open items first decending date, then closed items decending date.

function __sql__() {
        return
            "SELECT *, ( concat_ws('_', SUBSTRING(machinenum, 1, 14), SUBSTRING(problem, 1, 26), (completedtime)) )  as record_ref
            FROM `pr_downtime1` 
            order by closed asc, completedtime desc, called4helptime desc
            ";
            
_____________


I think this is it:
Check in the mysql file for the latest:


DELIMITER //
CREATE TRIGGER closed_trigger
BEFORE Update
   ON pr_downtime1 FOR EACH ROW
BEGIN
  
   IF (NEW.completedtime is not null) THEN
        SET NEW.closed = 1;
   ELSE Set New.closed = Null;	
   END IF;
   
END; //
DELIMITER ;



_____________


reference:

good article.

see
bookmarks webdev mysql bootstrap notes know.gsht
mysql notes  cell i6

http://vancelucas.com/blog/mysql-series-return-null-values-first-with-descending-order/

need movies with no release date first - they are the newest movies. then newest release date after that.

~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
