<html>
<head>
<style>
table, th, td {
    border: 1px solid black;
    border-collapse: collapse;
	padding:0.3em;
}
</style>
</head>
<body>

<?php

//style='border: 1px solid; border-collapse: collapse; padding:0.3em;'

require_once "configdbphp.dbc";

echo ("<p> 
Number of calls to Machines Report - Top 30. 
Hint: Copy this to Excel. 
It will paste properly into columns. 
Ctrl-A Ctrl-C here then Ctrl-V in excel.
</p>");
 
echo "<table  >";
  echo "<tr><th>Machine</th><th>CallCount</th></tr>";

class TableRows extends RecursiveIteratorIterator { 
     function __construct($it) { 
         parent::__construct($it, self::LEAVES_ONLY); 
     }
     function current() {
         return "<td >" . parent::current(). "</td>";
     }
     function beginChildren() { 
         echo "<tr>"; 
     } 
     function endChildren() { 
         echo "</tr>" . "\n";
     } 
} 

try {
     $conn = new PDO("mysql:host=$dbhost;dbname=$dbname", $dbuser, $dbpass);
     $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	 
     $stmt = $conn->prepare(" SELECT machinenum, COUNT(*) FROM pr_downtime1 GROUP BY machinenum ORDER BY COUNT(*) DESC limit 0,30 "); 
     $stmt->execute();

     // set the resulting array to associative
     $result = $stmt->setFetchMode(PDO::FETCH_ASSOC); 

     foreach(new TableRows(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) { 
         echo $v;
     }
}
catch(PDOException $e) {
     echo "Error: " . $e->getMessage();
}
$conn = null;
echo "</table>";

?>

</body>

