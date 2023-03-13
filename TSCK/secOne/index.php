<?php
ob_start();
include('header.php');
session_start();
//Insert New Record
if (isset($_POST['btnInsertVacancy'])) {
    $VarYesNo = $_POST['yesno'];
    $varTscNo = $_POST['tscNo'];
    $varVacancy_id = $_POST['vacancy_id'];
    $varAdvert_no = $_POST['advert_no'];
    $varPost_vacancy = $_POST['post_vacancy'];
    $id_number = $_SESSION['id_number'];

$sql11 = "SELECT * FROM tblappliedjobs where id_number='$id_number' and advert_no='$varAdvert_no'";
$result11 = $conn->query($sql11) or die(mysqli_error($conn));
$count1 = mysqli_num_rows($result11);
if ($count1 == 0) {

    $sql = "SELECT * FROM `staffreg` WHERE ID_Number='" . $id_number . "'";
    $result = $conn->query($sql);

    if ($result) {
        $row = mysqli_fetch_array($result);
        $payroll = $row['Payroll_Num'];
        $ID_Number = $row['ID_Number'];

        if ($payroll != $varTscNo) {
            echo '<div>';
            //echo"no match found";
            echo "<script>alert('ERROR: TSC NUMBER MISMATCH!!');
					window.location.href='secOne.php';
					</script>";
            echo '</div>';


        } elseif ($payroll == $varTscNo) {
            $status = "InComplete";
            $sql = "INSERT INTO tblappliedjobs (id_number,tscNo, vacancy_id, advert_no, post_vacancy,status)
					VALUES ('$id_number','$varTscNo','$varVacancy_id','$varAdvert_no','$varPost_vacancy','$status')";
            mysqli_query($conn, $sql) or die(mysqli_error($conn));
            //$_SESSION['vacancy_id']=$varVacancy_id;
            //$_SESSION['Advert_no']=$varAdvert_no;
            $_SESSION['TscNo'] = $varTscNo;


            $sql1 = "SELECT * FROM applicant_details WHERE id_no='" . $id_number . "'";
            $result1 = $conn->query($sql1) or die(mysqli_error($conn));
            $count1 = mysqli_num_rows($result1);
            if ($count1 == 1) {
                //echo"you are already in our system hence we redirect you to summary page";
                header("location: secTwo.php");
                //header("location:../TSCK/secTen.php");
                //header("location:../TSCK/secTwo.php");
            } else {
                //echo"you are new to our system hence we redirect you to profile page";
                header("location: secTwo.php");
            }


        }


    } else {
        $sql = "INSERT INTO tblappliedjobs (id_number,tscNo, vacancy_id, advert_no, post_vacancy)
					VALUES ('$id_number','$varTscNo','$varVacancy_id','$varAdvert_no','$varPost_vacancy')";
        $result = $conn->query($sql);
        //$_SESSION['vacancy_id']=$varVacancy_id;
        //$_SESSION['Advert_no']=$varAdvert_no;
        $_SESSION['TscNo'] = $varTscNo;


        $sql1 = "SELECT * FROM applicant_details WHERE id_no='" . $id_number . "'";
        $result1 = $conn->query($sql1) or die(mysqli_error($conn));
        $count1 = mysqli_num_rows($result1);
        if ($count1 == 1) {
            //echo"you are already in our system hence we redirect you to summary page";
            header("location: secTwo.php");
            //header("location:../TSCK/secTen.php");
            //header("location:../TSCK/secTwo.php");
        } else {
            //echo"you are new to our system hence we redirect you to profile page";
            header("location: secTwo.php");
        }

    }
}
else
{
    $sql = "SELECT * FROM `staffreg` WHERE ID_Number='" . $id_number . "'";
    $result = $conn->query($sql);

    if ($result) {
        $row = mysqli_fetch_array($result);
        $payroll = $row['Payroll_Num'];
        $ID_Number = $row['ID_Number'];

        if ($payroll != $varTscNo) {
            echo '<div>';
            //echo"no match found";
            echo "<script>alert('ERROR: TSC NUMBER MISMATCH!!');
					window.location.href='secOne.php';
					</script>";
            echo '</div>';


        } elseif ($payroll == $varTscNo) {
            $_SESSION['TscNo'] = $varTscNo;


            $sql1 = "SELECT * FROM applicant_details WHERE id_no='" . $id_number . "'";
            $result1 = $conn->query($sql1) or die(mysqli_error($conn));
            $count1 = mysqli_num_rows($result1);
            if ($count1 == 1) {
                //echo"you are already in our system hence we redirect you to summary page";
                header("location: secTwo.php");
                //header("location:../TSCK/secTen.php");
                //header("location:../TSCK/secTwo.php");
            } else {
                //echo"you are new to our system hence we redirect you to profile page";
                header("location: secTwo.php");
            }


        }


    } else {
        $_SESSION['TscNo'] = $varTscNo;


        $sql1 = "SELECT * FROM applicant_details WHERE id_no='" . $id_number . "'";
        $result1 = $conn->query($sql1) or die(mysqli_error($conn));
        $count1 = mysqli_num_rows($result1);
        if ($count1 == 1) {
            //echo"you are already in our system hence we redirect you to summary page";
            header("location: secTwo.php");
            //header("location:../TSCK/secTen.php");
            //header("location:../TSCK/secTwo.php");
        } else {
            //echo"you are new to our system hence we redirect you to profile page";
            header("location: secTwo.php");
        }

    }
}



}


//close first if
// user is editing stuff:
elseif (isset($_POST['btnEdit'])) {
    $no_of_records_per_page = 10;
    $offset = ($pageno - 1) * $no_of_records_per_page;
    $id = $_POST['btnEdit'];
    $id_number = $_SESSION['id_number'];
    $sql = "SELECT * FROM `staffreg` WHERE ID_Number='" . $id_number . "'";
    $result = $conn->query($sql);
    if ($result) {
        $row = mysqli_fetch_array($result);
        $payroll = $row['Payroll_Num'];
        $ID_Number = $row['ID_Number'];
        $VoteCode = $row['VoteCode'];
        $Job_Desig = $row['Job-Desig'];
        $Date_of_Post = $row['Date_of_Post'];
    }
    if (isset($payroll) && $payroll > 0) {
        if ($VoteCode == "14702") {
            $query = "select * from vacancy where vacancy_id = '$id'  ";
        } else {
            $query = "select * from vacancy where vacancy_id = '$id' ";
        }
    } else {
        $query = "select * from vacancy where vacancy_id = '$id' ";

    }
    $result_vacancy = mysqli_query($conn, $query);
    if ($result_vacancy) {
        $row_vacancy = mysqli_fetch_array($result_vacancy);
        $id = $row_vacancy['vacancy_id'];
        $category = $row_vacancy['category'];
        $is_secretariate = $row_vacancy['is_secretariate'];
    }

    if (isset($VoteCode) && $VoteCode != "14702") {
        if ($category == 'INTERNAL' && $VoteCode == "14701" && $is_secretariate == 1) {
            echo("<script LANGUAGE='JavaScript'>
    window.alert('This post is for secretariat only!');
    window.location.href='secOne.php';
    </script>");
        } else {
            include('edit.php');
        }
    } elseif (isset($VoteCode) && $VoteCode == "14702") {
        include('edit.php');
    } else {

        if ($category == 'INTERNAL') {
            echo("<script LANGUAGE='JavaScript'>
    window.alert('This post is for internal users only!');
    window.location.href='secOne.php';
    </script>");

        } else {
            include('edit.php');
        }
    }

// verify if meets criteria
    $query_criteria = "select * from advert_criteria where vacancy_id = '$id' and criteria_type_id=7";
//$result_criteria = mysqli_query($conn, $query_criteria);
    $result_criteria = $conn->query($query_criteria);
        $required_desigs = array();
        $required_period = array();
        $confirm_if_meets_required_period = 0;
        $count = mysqli_num_rows($result_criteria);

        if ($count > 0) {
            while ($row_criteria = mysqli_fetch_array($result_criteria)) {
            $criteria_id = $row_criteria['vacancy_id'];
            $grade_id = $row_criteria['grade_id'];
            $period = $row_criteria['period'];
            $query_designations = "SELECT * FROM designations where id = '$grade_id' ";
            $result_designations = mysqli_query($conn, $query_designations);
            if ($result_designations) {
                $result_designations = mysqli_fetch_array($result_designations);
                $desig_code = $result_designations['Desigcode'];

                if ($Job_Desig == $desig_code) {
                    $confirm_if_meets_required_period = verifyPeriodOkay($Date_of_Post, $period);

                    if ($confirm_if_meets_required_period > 0) {

                        echo("<script LANGUAGE='JavaScript'>
    window.alert('You must have served in your current grade for a period of not less than specified period. Kindly check requirements!');
    window.location.href='secOne.php';
    </script>");
                    }
                }

                array_push($required_desigs, $desig_code);
            }


        }
        if (!in_array($Job_Desig, $required_desigs)) {
            echo("<script LANGUAGE='JavaScript'>
    window.alert('You do not meet required grade for this post. Kindly check required criteria!');
    window.location.href='secOne.php';
    </script>");
        }

    }

} //Edit Save
elseif (isset($_POST['btnEditSave'])) {
    $varVacancy_id = $_POST['vacancy_id'];
    $varAdvert_no = $_POST['advert_no'];
    $varPost_vacancy = $_POST['post_vacancy'];
    $varDirectorate = $_POST['directorate'];
    $varTscNo = $_POST['tscNo'];

    $N = count($member_id);
    for ($i = 0; $i < $N; $i++) {
        $result = mysqli_query($dbconnection, "UPDATE $varTableName SET firstname='$firstname[$i]', lastname='$lastname[$i]', middlename='$middlename[$i]' ,address='$address[$i]' , email='$email[$i]'  where member_id='$member_id[$i]'") or die(mysql_error());
    }
    header("location:" . $varPageName . ".php");
} // user is deleting stuff:
elseif (isset($_POST['delete'])) {
    // 1: do some error checking here
    // 2: throw an error or do DB DELETE here
    // 3: set variable that displays "add" button:
    $display_button_valu = "add";
    $display_button_name = "add";
    // 4: set a confirmation message:
    $msg = "Your stuff has been DELETED";
} // user is doing nothing, it's his/her first time (ooer)
else {

    ?>
    <head>
        <script>

            function validateRadio(radios) {
                for (i = 0; i < radios.length; ++i) {
                    if (radios [i].checked) return true;
                }
                return false;
            }

            function validateForm() {
                if (validateRadio(document.forms["survey1"]["radioBtn1"])) {
                    return true;
                } else {
                    alert('Please select a vacancy');
                    return false;
                }
            }

        </script>
    </head>

    <body style="margin-top: -25px;">


    <?php
    //pagination
    if (isset($_GET['pageno'])) {
        $pageno = $_GET['pageno'];
    } else {
        $pageno = 1;
    }

    $no_of_records_per_page = 10;
    $offset = ($pageno - 1) * $no_of_records_per_page;

    $result = mysqli_query($dbconnection, "SELECT COUNT(*) FROM vacancy  ORDER BY created_at desc ") or die(mysqli_error());
    $total_rows = mysqli_fetch_array($result)[0];
    $total_pages = ceil($total_rows / $no_of_records_per_page);

    ?>
    <h4> 1. Vacancies </h4>
    <div>
        <ul class="pagination">
            <li><a href="?pageno=1">First</a></li>
            <li class="<?php if ($pageno <= 1) {
                echo 'disabled';
            } ?>">
                <a href="<?php if ($pageno <= 1) {
                    echo '#';
                } else {
                    echo "?pageno=" . ($pageno - 1);
                } ?>">Prev</a>
            </li>
            <li class="<?php if ($pageno >= $total_pages) {
                echo 'disabled';
            } ?>">
                <a href="<?php if ($pageno >= $total_pages) {
                    echo '#';
                } else {
                    echo "?pageno=" . ($pageno + 1);
                } ?>">Next</a>
            </li>
            <li><a href="?pageno=<?php echo $total_pages; ?>">Last</a></li>
        </ul>


        <div>

            <form class="form-inline" method="POST" action="">
                <div class="input-group col-md-12">
                    <input type="text" class="form-control" placeholder="Search Advert no here..." name="keyword"
                           required="required"/>
                    <span class="input-group-btn">
    						<button class="btn btn-primary" name="search"><span
                                        class="glyphicon glyphicon-search"></span></button>
    					</span>
                </div>
            </form>


        </div>
    </div>


    <div class="container" style="width:94%; margin-left:-5px;">
        <form name="survey1" action="secOne.php" method="post" onsubmit="return validateForm()">
            <table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="example">
                <thead style="background-color:#314C95; color:#FFFFFF;">
                <tr>

                    <th style="text-align:center;  font-size:14px;">ADVERT NO.</th>
                    <th style="text-align:left;  font-size:14px; ">POSITION</th>
                    <th style="text-align:left; font-size:14px; ">CATEGORY</th>
                    <th style="text-align:center; font-size:14px; width:10%;">DUE DATE</th>
                    <th style="text-align:center;  font-size:14px; ">JOB DESCRIPTION</th>
                    <th style="text-align:center; font-size:14px; ">SELECT</th>
                </tr>
                </thead>
                <tbody>
                <?php
                if (isset($_POST['search'])) {
                    $stringRemovedLashes = stripslashes($_POST['keyword']);//The stripslashes() function is a built-in function in PHP. This function removes backslashes in a string.
                    $keyword = $dbconnection->real_escape_string(trim($stringRemovedLashes));

                    $query = mysqli_query($dbconnection, "select * from vacancy WHERE is_Closed=0 and advert_no='" . $keyword . "'ORDER BY created_at desc ") or die(mysqli_error());


                    while ($row = mysqli_fetch_array($query)) {
                        $id = $row['vacancy_id'];
                        $advert_number = $row['advert_no'];
                        $var_is_closed = $row['is_Closed'];
                        $_SESSION['vacancy_id'] = $id;
                        $due_date = $row['duDate'];
                        $date = date('d-m-Y', strtotime($due_date));
                        $encode_advertno = base64_encode(urlencode($advert_number));

                        ?>

                        <tr>

                            <td style="text-align:center;  font-size:14px;"><?php echo $row['advert_no'] ?></td>
                            <td style="text-align:left;  font-size:14px;"><?php echo $row['post_vacancy'] ?></td>
                            <td style="text-align:left;  font-size:14px;"><?php echo $row['category'] ?></td>
                            <td style="text-align:center; font-size:14px;"><?php echo $date ?></td>
                            <form name="bb" method="POST" action="jobdetails.php">
                                <td style="text-align:center;  font-size:14px;">
                                    <input type="hidden" name="advert_no" value="<?php echo $advert_number; ?>">
                                    <input style="width:54px; align:center;" type="submit" value="Details">
                                    <!--a href="jobdetails.php?advert_no=<? php// echo $encode_advertno
                                    ?>">Details</a>-->
                                </td>
                            </form>
                            <?php
                            if ($var_is_closed == 0) {

                                ?>

                                <!--	<td style="text-align:center;  font-size:14px;"><input name="selector[]" id="radioBtn1" type="radio" value="<? php// echo $id;
                                ?>"></td-->
                                <td style="text-align:center;  font-size:14px;">
                                    <button name="btnEdit" value="<?php echo $id; ?>" class="btn btn-success pull-right"
                                            style="background-color:#314C95;" type="submit">
                                        Apply
                                    </button>
                                </td>
                                <?php
                            } elseif ($var_is_closed == 2) {
                                ?>

                                <td style="text-align:center;  font-size:14px;">ADVERT TO OPEN</td>

                                <?php
                            } else {
                                ?>

                                <td style="text-align:center;  font-size:14px;">ADVERT CLOSED</td>

                                <?php
                            }
                            ?>


                        </tr>

                    <?php }
                } else {

//....................................................end of search.............................................................

                    //$varTableName = 'testmember';
                    //SELECT * FROM `vacancy` WHERE is_Closed=0   order by `created_at` DESC
                    $id_number = $_SESSION['id_number'];
                    $sql = "SELECT * FROM `staffreg` WHERE ID_Number='" . $id_number . "'";
                    $result = $conn->query($sql);
                    if ($result) {
                        $row = mysqli_fetch_array($result);
                        $payroll = $row['Payroll_Num'];
                        $ID_Number = $row['ID_Number'];
                        $VoteCode = $row['VoteCode'];
                    }
                    if (isset($payroll) && $payroll > 0) {
//                        if ($VoteCode == "14702") {
//                            $query = "select * from vacancy where is_Closed=0  ORDER BY created_at desc LIMIT $offset, $no_of_records_per_page";
//                        } else {
//                            $query = "select * from vacancy where is_Closed=0  ORDER BY created_at desc LIMIT $offset, $no_of_records_per_page";
//                        }
//                    } else {
//                        $query = "select * from vacancy where is_Closed=0 ORDER BY created_at desc LIMIT $offset, $no_of_records_per_page";
                        if ($VoteCode == "14702") {
                            $query = "select * from vacancy where is_Closed=0 AND category in ('INTERNAL','EXTERNAL') ORDER BY created_at desc LIMIT $offset, $no_of_records_per_page";
                        } else {
                            $query = "select * from vacancy where is_Closed=0 AND category in ('EXTERNAL') AND is_secretariate = 0 ORDER BY created_at desc LIMIT $offset, $no_of_records_per_page";
                        }
                    } else {
                        $query = "select * from vacancy where is_Closed=0 AND category='EXTERNAL' ORDER BY created_at desc LIMIT $offset, $no_of_records_per_page";

                    }


                    $q_result = mysqli_query($dbconnection, $query) or die(mysqli_error());


                    while ($row = mysqli_fetch_array($q_result)) {
                        $id = $row['vacancy_id'];
                        $advert_number = $row['advert_no'];
                        $var_is_closed = $row['is_Closed'];
                        $_SESSION['vacancy_id'] = $id;
                        $due_date = $row['duDate'];
                        $date = date('d-m-Y', strtotime($due_date));
                        $encode_advertno = base64_encode(urlencode($advert_number));


                        ?>

                        <tr>

                            <td style="text-align:center;  font-size:14px;"><?php echo $row['advert_no'] ?></td>
                            <td style="text-align:left;  font-size:14px;"><?php echo $row['post_vacancy'] ?></td>
                            <td style="text-align:left;  font-size:14px;"><?php echo $row['category'] ?></td>
                            <td style="text-align:center; font-size:14px;"><?php echo $date ?></td>
                            <form name="bb" method="POST" action="jobdetails.php">
                                <td style="text-align:center;  font-size:14px;">
                                    <input type="hidden" name="advert_no" value="<?php echo $advert_number; ?>">
                                    <!--input style="width:54px; align:center;" type="submit"  value="Details"-->
                                    <a href="jobdetails.php?n=<?php echo $encode_advertno; ?>">Details</a>
                                </td>
                            </form>
                            <?php
                            if ($var_is_closed == 0) {

                                ?>

                                <!--	<td style="text-align:center;  font-size:14px;"><input name="selector[]" id="radioBtn1" type="radio" value="<? php// echo $id;
                                ?>"></td-->
                                <td style="text-align:center;  font-size:14px;">
                                    <button name="btnEdit" value="<?php echo $id; ?>" class="btn btn-success pull-right"
                                            style="background-color:#314C95;" type="submit">
                                        Apply
                                    </button>
                                </td>
                                <?php
                            } elseif ($var_is_closed == 2) {
                                ?>

                                <td style="text-align:center;  font-size:14px;">ADVERT TO OPEN</td>

                                <?php
                            } else {
                                ?>

                                <td style="text-align:center;  font-size:14px;">ADVERT CLOSED</td>

                                <?php
                            }
                            ?>


                        </tr>

                        <?php
                    }
                }
                ?>
                </tbody>
            </table>
            <br/>

            <a href="./secA.php" role="button" class="btn btn-success pull-left" style="background-color:#314C95;"><<
                Previous</a>


            <!--<button name="btnEdit" class="btn btn-success pull-right"  style="background-color:#314C95;" type="submit">
                Apply
            </button>-->
        </form>

    </body>
    </html>
    <?php
} ?>


<?php
function verifyPeriodOkay($date, $period)
{
    // foreach ($period as $p) {
    // $p = (int)$p;
    $y = round(($period * 12 * 30.42), 0);
    $date_current_appointment = new \DateTime($date);
    $now = new \DateTime();

    if (round($date_current_appointment->diff($now)->days, 0) > $y) {
        return 0;
    } else {
        return (int)$period;
    }
    // }
}

?>
<script>
    function myFunction() {
        // Declare variables
        var input, filter, table, tr, td, i;
        input = document.getElementById("myInput");
        filter = input.value.toUpperCase();
        table = document.getElementById("example");
        tr = table.getElementsByTagName("tr");

        // Loop through all table rows, and hide those who don't match the search query
        for (i = 0; i < tr.length; i++) {
            td = tr[i].getElementsByTagName("td")[0];
            if (td) {
                if (td.innerHTML.toUpperCase().indexOf(filter) > -1) {
                    tr[i].style.display = "";
                } else {
                    tr[i].style.display = "none";
                }
            }
        }
    }


</script>
