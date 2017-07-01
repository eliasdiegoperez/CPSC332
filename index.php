<?php
$link = mysql_connect('ecsmysql','cs332a15','xadaihae');
if(!$link){
    die ('could not connect:'.mysql_error());
}
echo ' Connected successfully<p>';

mysql_select_db("cs332a15",$link);

$PN = $_POST["PN"];
$CN = $_POST["CN"];
$SN = $_POST["SN"];
$CAN = $_POST["CAN"];
$CI = $_POST["CI"];

if ($PN) {

$queryProfA="SELECT C.TITLE, CLASSROOM, MEETING_DAYS,START_TIME,END_TIME
    FROM PROFESSOR, COURSE_SECTION, COURSE C
    WHERE PSSN =$PN AND CS_PSSN = PSSN AND 
    CSNum = CNum";

$resultProfA=mysql_query($queryProfA,$link);	

$fields_num = mysql_num_fields($resultProfA);

echo "<table border='1'><tr>";
// printing table headers
for($i=0; $i<$fields_num; $i++)
{
    $field = mysql_fetch_field($resultProfA);
    echo "<td>{$field->name}</td>";
}
echo "</tr>\n";

// printing table rows
while($row = mysql_fetch_row($resultProfA))
{
    echo "<tr>";

    echo "<td>$row[0]</td>";
    echo "<td>$row[1]</td>";
    echo "<td>$row[2]</td>";
    echo "<td>$row[3]</td>";
    echo "<td>$row[4]</td>";
    echo "</tr>\n";
}
}
else if ($CN && $SN){

$queryProfB="SELECT GRADE, COUNT(*) AS NUM_OF_STUDENT 
    FROM COURSE, COURSE_SECTION, ENROLL 
    WHERE CNUM = $CN AND SNUM = $SN AND CSNUM = CNUM AND CSNUM = ECSNUM 
    AND SNUM = ESNUM 
    GROUP BY GRADE";

$resultProfB=mysql_query($queryProfB,$link);	
$fields_num = mysql_num_fields($resultProfB);
echo "<table border='1'><tr>";
// printing table headers
for($i=0; $i<$fields_num; $i++)
{
    $field = mysql_fetch_field($resultProfB);
    echo "<td>{$field->name}</td>";
}
echo "</tr>\n";
// printing table rows
while($row = mysql_fetch_row($resultProfB))
{
    echo "<tr>";

    echo "<td>$row[0]</td>";
    echo "<td>$row[1]</td>";
    echo "</tr>\n";
}
}
else if ($CAN){
$queryStudA="SELECT C.CNUM, CS.SNUM, CS.CLASSROOM, CS.MEETING_DAYS, CS.START_TIME, CS.END_TIME, COUNT(*) AS NUM_OF_STUDENT
    FROM COURSE C, COURSE_SECTION CS, ENROLL E 
    WHERE C.CNUM=$CAN AND C.CNUM=CS.CSNUM AND C.CNUM=E.ECSNUM AND CS.SNUM=E.ESNUM 
    GROUP BY E.ECSNUM, E.ESNUM"; 

$resultStudA=mysql_query($queryStudA,$link);	

$fields_num = mysql_num_fields($resultStudA);

echo "<table border='1'><tr>";
// printing table headers
for($i=0; $i<$fields_num; $i++)
{
    $field = mysql_fetch_field($resultStudA);
    echo "<td>{$field->name}</td>";
}
echo "</tr>\n";

// printing table rows
while($row = mysql_fetch_row($resultStudA))
{
    echo "<tr>";

    echo "<td>$row[0]</td>";
    echo "<td>$row[1]</td>";
    echo "<td>$row[2]</td>";
    echo "<td>$row[3]</td>";
    echo "<td>$row[4]</td>";
    echo "<td>$row[5]</td>";
    echo "<td>$row[6]</td>";
    echo "</tr>\n";
}
}
else if($CI){
$queryStudB="SELECT C.CNUM, C.TITLE, C.TEXTBOOK, C.UNITS, E.GRADE
    FROM COURSE C, ENROLL E, STUDENT S, COURSE_SECTION CS
    WHERE S.CWID=$CI AND S.CWID=E.ECWID AND CS.CSNUM=E.ECSNUM AND CS.SNUM=E.ESNUM AND C.CNUM=CS.CSNUM"; 

$resultStudB=mysql_query($queryStudB,$link);	

$fields_num = mysql_num_fields($resultStudB);

echo "<table border='1'><tr>";
// printing table headers
for($i=0; $i<$fields_num; $i++)
{
    $field = mysql_fetch_field($resultStudB);
    echo "<td>{$field->name}</td>";
}
echo "</tr>\n";

// printing table rows
while($row = mysql_fetch_row($resultStudB))
{
    echo "<tr>";

    echo "<td>$row[0]</td>";
    echo "<td>$row[1]</td>";
    echo "<td>$row[2]</td>";
    echo "<td>$row[3]</td>";
    echo "<td>$row[4]</td>";
    echo "</tr>\n";
}
}

mysql_close($link);

?>


</body>
</html>
