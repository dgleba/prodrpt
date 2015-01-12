
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
>>  .
-----------------------------
2015-01-09[Jan-Fri]10-53AM

added trigger to set closed to 1 if completedtime is set to a value. set to null otherwise.


I think this is it:
Check in the mysql file for the lates:

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

~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
