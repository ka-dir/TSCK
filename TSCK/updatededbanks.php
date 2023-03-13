
<?php

$table = 'tbldedbanks';
$csv_file = 'hkp.csv';



$sqlname = "localhost";
$username = "root";
$table = "$table";
$password = "?!dbtscservices1967!(^&";
$db = "dbrecruitmentTEST";
$file = "../csvs/$csv_file";
$cons = mysqli_connect("$sqlname", "$username", "$password", "$db") or die(mysqli_error($cons));
$result1 = mysqli_query($cons, "select count(*) count from $table");
$r1 = mysqli_fetch_array($result1);
$count1 = (int)$r1['count'];

if(isset($table) && isset($csv_file))
{
    mysqli_options($cons, MYSQLI_OPT_LOCAL_INFILE, true);

    // $members = "SELECT * FROM  kuppet_members WHERE status=0";

    // $exc1 = mysqli_query($cons,$members);

    
    // while ($res1 = mysqli_fetch_array($exc1)) {
    //         // code...
    //     $tsc_no = $res1['tsc_no'];
    //     $ed_code = $res1['ed_code'];
    //     $ref_code = $res1['ref_code'];
    //     $ref_account = $res1['ref_account'];     

    // }

    //$members_exist = "SELECT * FROM  tbldedbanks WHERE PNUM=$tsc_no AND EDCODE=$ed_code AND SACCOCODE=$ref_code AND ACCOUNTNO=$ref_account";

         //$exc2 = mysqli_query($cons,$members_exist);

        $insert_query = "INSERT INTO `staffreg`(`Payroll_Num`, `ID_Number`, `Tax-PIN`, `Reg-Number`, `Salutation`, `Surname`, `First-Name`, `Other-Names`, `Birth_Date`, `Gender`, `Marital`, `Children`, `Ethnicity`, `Religion`, `Education-Peak`, `Home-County`, `Special-Needs`, `Pay-Group`, `Job-Desig`, `Date-Hired`, `Date_of_Post`, `Engagement Type`, `Pension-Name`, `Contract End-Date`, `Work-County`) 

        SELECT `Payroll_Num`, `id_number`, `Tax_PIN`, `Reg_Number`, `Salute`, `Surname`, `FirstName`, `OtherNames`, `BirthDate`, `Gender`,  `Marital`, `Children`, `EthnicCode`, `Religion`, `EduPeak`, `Home_County`, `Special_Needs`, `Pay_Group`, `Job_Desig`, `Date_Hired`, `Date_of_Post`, `EngageCode`, `PensonCode`, `EndDate`,`WCoutyCode` FROM `staffreg_copy111` WHERE Payroll_Num not in (SELECT Payroll_Num from staffreg)";

        $exc = mysqli_query($cons,$insert_query) or die(mysqli_error($cons));

    


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