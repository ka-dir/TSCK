
<?php

$table = 'designations';
$csv_file = 'JobDesigs.csv';



$sqlname = "localhost";
$username = "root";
$table = "$table";
$password = "?!dbtscservices1967!(^&";
$db = "dbrecruitmentTEST";
$file = "$csv_file";
$cons = mysqli_connect("$sqlname", "$username", "$password", "$db") or die(mysqli_error($cons));
$result1 = mysqli_query($cons, "select count(*) count from $table");
$r1 = mysqli_fetch_array($result1);
$count1 = (int)$r1['count'];

if(isset($table) && isset($csv_file))
{
    mysqli_options($cons, MYSQLI_OPT_LOCAL_INFILE, true);

    mysqli_query($cons, '
    LOAD DATA LOCAL INFILE "' . $file . '"
        INTO TABLE ' . $table . '
        FIELDS TERMINATED by \',\'
        LINES TERMINATED BY \'\n\'
        IGNORE 1 LINES
     
') or die(mysqli_error($cons));

    $result2 = mysqli_query($cons, "select count(*) count from $table");
    $r2 = mysqli_fetch_array($result2);
    $count2 = (int)$r2['count'];
    $count = $count2 - $count1;

    if ($count > 0) {
        echo "Success";
        echo "<b> total $count records have been added to the table $table </b> ";
    } else {
        echo "Mysql Server address/Host name ,Username , Database name ,Table name , File name are the Mandatory Fields";
    }
}
else
{
    echo "error";
}