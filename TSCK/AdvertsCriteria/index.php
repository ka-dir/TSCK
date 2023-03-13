<?php
include(__DIR__ .'../includes/dbConfig.php');
$id_number = $_SESSION['id_number'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title></title>
    <style type="text/css"></style>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script>

        $(document).ready(function () {
            $("select").change(function () {
                var color = $(this).val();
                if (color == 1) {
                    $(".box").not(".Qualification").hide();
                    $(".Qualification").show();
                } else if (color == 2) {
                    $(".box").not(".Qualification").hide();
                    $(".Qualification").show();
                } else if (color == 3) {
                    $(".box").not(".Employment").hide();
                    $(".Employment").show();
                } else if (color == 4) {
                    $(".box").not(".Courses").hide();
                    $(".Courses").show();
                } else if (color == 5) {
                    $(".box").not(".Membership").hide();
                    $(".Membership").show();
                } else if (color == 6) {
                    $(".box").not(".Applicant").hide();
                    $(".Applicant").show();
                } else {
                    $(".box").hide();
                }
            });


        });


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


        function submitForm(action) {
            document.getElementById('CriteriaForm').action = action;
            document.getElementById('CriteriaForm').submit();
        }
    </script>
</head>
<body style="margin-top: -30px;">
<h3>Manage Adverts </h3>
<div class="row">
    <div class="col-md-4"><input type="text" id="myInput" onkeyup="myFunction()" placeholder="Search Advert...."
                                 style="width:250px;background-color:white;margin-left:10px;"></div>
    <div class="col-md-4"></div>
    <div class="col-md-4">
        <button class="btn btn-success align-left " data-toggle="modal" data-target="#myModal" style="margin-left: 74%">
            Add Criteria <i class="glyphicon glyphicon-plus"></i></button>
    </div>

</div>
<div class="container" style="width:100%; margin-left:-5px;">

    <form id="CriteriaForm" action="" method="post">
        <table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="example">
            <thead style="background-color: #314C95;color:#FFFFFF;">
            <tr>

                <th style="text-align:center; font-size:12px;">Advert No</th>
                <th style="text-align:center; font-size:12px;">Posts</th>
                <th style="text-align:center; font-size:12px;">Criteria Type</th>
                <th style="text-align:center; font-size:12px;">Award</th>
                <th style="text-align:center; font-size:12px;">Course</th>
                <th style="text-align:center; font-size:12px;">Specialization</th>
                <th style="text-align:center; font-size:12px;">KCSE Grade</th>
                <th style="text-align:center; font-size:12px;">Grade(Designation)</th>
                <th style="text-align:center; font-size:12px;">Period</th>
                <th style="text-align:center; font-size:12px;width: 10%;">Action</th>
                <!--th style="text-align:center; font-size:12px;width: 10%;">Summary</th-->
            </tr>
            </thead>
            <tbody>
            <?php
            if (isset($_POST['advert_id'])) {
                $v_id = $_POST['advert_id'];
            } else {
                $v_id = $_GET['id'];
            }

            $query = mysqli_query($dbconnection, "SELECT a.id,a.criteria_type_id,v.vacancy_id AS advert_id,
       v.advert_no,v.post_vacancy,c.criteria_type,e.grade as mean_grade,
       aw.award,cs.course_desc,s.name,s.name AS specialization,concat(d.Designame,' [',d.Desigcode,']')  as desig_name,a.period
		FROM advert_criteria a 
		LEFT OUTER JOIN vacancy v ON a.vacancy_id = v.vacancy_id 
		LEFT OUTER JOIN criteria_type c ON a.criteria_type_id = c.id
		LEFT OUTER JOIN award aw ON a.award_id = aw.id
		LEFT OUTER JOIN courses cs ON a.course_id = cs.course_id 
		LEFT OUTER JOIN specialization s ON a.specialization_id = s.id 
		LEFT OUTER JOIN designations d ON a.grade_id = d.id 
		LEFT OUTER JOIN academic_grades e ON a.mean_grade_id = e.id 
		WHERE a.vacancy_id ='" . $v_id . "' ") or die(mysqli_error());

            while ($row = mysqli_fetch_array($query)) {
                $advert_id = $row['advert_id'];
                $id = $row['id'];
                $advert_no = $row['advert_no'];
                $advert_id = $row['vacancy_id'];
                $post_vacancy = $row['post_vacancy'];
                $advert_type_id = $row['criteria_type_id'];
                $criteria_name = $row['criteria_type'];
                $criteria_type_id = $row['criteria_type_id'];
                $award = $row['award'];
                $grade = $row['desig_name'];
                $course_desc = $row['course_desc'];
                $specialization = $row['specialization'];
                $mean_grade = $row['mean_grade'];
                $period = $row['period'];
                ?>
                <tr>

                    <td style="text-align:center; font-size:12px;"><?php echo $advert_no ?></td>
                    <td style="text-align:center; font-size:12px;"><?php echo $post_vacancy ?></td>
                    <td style="text-align:center; font-size:12px;"><?php echo $criteria_name ?></td>
                    <td style="text-align:center; font-size:12px;">
                        <?php
                        if ($criteria_type_id == 1 || $criteria_type_id == 2) {
                            echo $award;
                        } else {
                            echo "-";
                        }
                        ?></td>
                    <td style="text-align:center; font-size:12px;">
                        <?php
                        if ($criteria_type_id == 1) {
                            echo $course_desc;
                        } else {
                            echo "-";
                        }
                        ?></td>
                    <td style="text-align:center; font-size:12px;">
                        <?php
                        if ($criteria_type_id == 1 || $criteria_type_id == 2) {
                            echo $specialization;
                        } else {
                            echo "-";
                        }
                        ?></td>

                    <td style="text-align:center; font-size:12px;">
                        <?php
                        if ($criteria_type_id == 8) {
                            echo $mean_grade;
                        } else {
                            echo "-";
                        }
                        ?></td>

                    <td style="text-align:center; font-size:12px;">
                        <?php
                        if ($criteria_type_id == 7) {
                            echo $grade;
                        } else {
                            echo "-";
                        }
                        ?></td>
                    <td style="text-align:center; font-size:12px;"><?php
                        if ($criteria_type_id == 7) {
                            echo $period;
                        } else {
                            echo "-";
                        }

                        ?></td>

                    <td>
                        <form action="" method="post">
                        <input type="hidden" id="criteria_to_delete_id" name="criteria_to_delete_id" value="<?php echo $id; ?>" >
                        <input type="hidden" id="advert_id" name="advert_id" value="<?php echo $v_id; ?>" >
                        <button type="submit"  name="delete_criteria"  class="fa" style="font-size:24px;text-decoration: none">&#xf1f8;</button>
                        </form>
                    </td>

                </tr>
                <?php
            }
            ?>
            </tbody>
        </table>
        <br/>

    </form>
</div>
<br>
<div id="myModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Create Criteria</h4>
            </div>
            <div class="modal-body">

                <form method="post" action="AdvertsCriteria/server.php">
                    <div class="form-group">
                        <label><?php echo $post_vacancy; ?></label>
                    </div>
                    <hr>
                    <input type="hidden" name="advert_id" value="<?php echo $v_id ?>">

                    <div class="form-group">
                        <label>Criteria Type</label>
                        <select name="criteria_type" required id="choice">
                            <option value="" selected disabled hidden>Choose one...</option>
                            <?php
                            $sql = mysqli_query($conn, "SELECT id,criteria_type FROM criteria_type where status=1 ORDER BY id ASC");
                            while ($row = $sql->fetch_assoc()) {
                                $criteria_type = $row['criteria_type'];
                                $id = $row['id'];
                                ?>
                                <option value="<?php echo $id; ?>">
                                    <?php echo $criteria_type; ?>
                                </option>
                                <?php
                            }
                            ?>
                        </select>
                    </div>

                    <div class="form-group" id="grade_div" display="none" style="display:none">
                        <label>Grade(Designation)</label>
                        <select name="grade" id="grade">
                            <option value="" selected disabled hidden>Choose grade...</option>
                            <?php
                            $sql = mysqli_query($conn, "SELECT id,concat(Designame,' [',Desigcode,']')  as desig_name FROM designations order by Designame asc");
                            while ($row = $sql->fetch_assoc()) {
                                $desig_name = $row['desig_name'];
                                $id = $row['id'];
                                ?>
                                <option value="<?php echo $id; ?>">
                                    <?php echo $desig_name; ?>
                                </option>
                                <?php
                            }
                            ?>
                        </select>
                    </div>

                    <div class="form-group" id="period_div" style="display:none">
                        <label>Period</label>
                        <select name="period" id="period">
                            <option value="" selected disabled hidden>Choose range...</option>
                            <?php
                            $ranges = range(0, 50);
                            foreach ($ranges as $range) {
                                ?>
                                <option value="<?php echo $range; ?>">
                                    <?php echo $range; ?>
                                </option>
                                <?php
                            }
                            ?>
                        </select>
                    </div>

                    <div>
                        <div class="form-group" id="award_div" style="display:none">
                            <label>Award/Certificate</label>
                            <select name="award" id="award">
                                <option value="" selected disabled hidden>Choose one</option>
                                <?php
                                $sql = mysqli_query($conn, "SELECT id,award FROM award ORDER BY award ASC");
                                while ($row = $sql->fetch_assoc()) {
                                    $award = $row['award'];
                                    $id = $row['id'];
                                    ?>
                                    <option value="<?php echo $id; ?>">
                                        <?php echo $award; ?>
                                    </option>
                                    <?php
                                }
                                ?>
                            </select>
                        </div>
                        <div class="form-group" id="award_div_p" style="display:none">
                            <label>Award/Certificate!</label>
                            <select name="award_p" id="award_p">
                                <option value="" selected disabled hidden>Choose one</option>
                                <?php
                                $sql = mysqli_query($conn, "SELECT id,award FROM award ORDER BY award ASC");
                                while ($row = $sql->fetch_assoc()) {
                                    $award = $row['award'];
                                    $id = $row['id'];
                                    ?>
                                    <option value="<?php echo $id; ?>">
                                        <?php echo $award; ?>
                                    </option>
                                    <?php
                                }
                                ?>
                            </select>
                        </div>


                        <div class="form-group" id="course_div" style="display:none">
                            <label>Course</label>
                            <select name="course" id="courses">
                                <option value="">Select Course</option>
                            </select>
<!--                            <select name="course" id="course">-->
<!--                                <option value="" selected disabled hidden>Choose one</option>-->
<!--                                --><?php
//                                $sql = mysqli_query($conn, "SELECT course_id,course_desc FROM courses ORDER BY course_desc ASC");
//                                while ($row = $sql->fetch_assoc()) {
//                                    $course_desc = $row['course_desc'];
//                                    $course_id = $row['course_id'];
//                                    ?>
<!--                                    <option value="--><?php //echo $course_id; ?><!--">-->
<!--                                        --><?php //echo $course_desc; ?>
<!--                                    </option>-->
<!--                                    --><?php
//                                }
//                                ?>
<!--                            </select>-->
                        </div>


                        <div class="form-group" id="specialization_div" style="display:none">
                            <label>Specialization</label>
                            <select name="specialization" id="specialization">

                                <option value="">
                                    Select Specialisation
                                </option>

                            </select>

<!--                            <select name="specialization" id="specialization_div">-->
<!--                                <option value="" selected disabled hidden>Choose one</option>-->
<!--                                --><?php
//                                $sql = mysqli_query($conn, "SELECT id,name FROM specialization ORDER BY name ASC");
//                                while ($row = $sql->fetch_assoc()) {
//                                    $specialization = $row['name'];
//                                    $id = $row['id'];
//                                    ?>
<!--                                    <option value="--><?php //echo $id; ?><!--">-->
<!--                                        --><?php //echo $specialization; ?>
<!--                                    </option>-->
<!--                                    --><?php
//                                }
//                                ?>
<!--                            </select>-->
                        </div>

                        <div class="form-group" id="mean_grade_div" style="display:none">
                            <label>Mean Grade</label>
                            <select name="mean_grade" id="mean_grade">
                                <option value="" selected disabled hidden>Choose one</option>
                                <?php
                                $sql = mysqli_query($conn, "SELECT id,grade FROM academic_grades where is_mean_grade=1 ORDER BY id ASC");
                                while ($row = $sql->fetch_assoc()) {
                                    $mean_grade = $row['grade'];
                                    $id = $row['id'];
                                    ?>
                                    <option value="<?php echo $id; ?>">
                                        <?php echo $mean_grade; ?>
                                    </option>
                                    <?php
                                }
                                ?>
                            </select>
                        </div>

                    </div>

                    <div>

                    </div>

                    <div>

                    </div>
                    <div>

                    </div>
                    <div>

                    </div>
                    <div class="form-group">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" name="add_criteria" class="btn btn-success pull-right"
                                style="margin-left: 2%; width: 20%;">Add Criteria
                        </button>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
            </div>
        </div>

    </div>
</div>

</body>
</html>

<?php

if (isset($_POST['delete_criteria'])) {
    $id = $_POST['criteria_to_delete_id'];
    $advert_id = $_POST['advert_id'];
    $sql = "DELETE FROM advert_criteria WHERE id='" . $id . "'";
    $result = $dbconnection->query($sql);
    if (!$result) {
        echo mysqli_error($dbconnection);
    }

    header("location: ../adverts-criteria.php?id=".$advert_id);
}


?>


<script type="application/javascript">


    $('#choice').on('change', function () {
        const val = parseInt(this.value)
        const grade_dive = document.getElementById("grade_dive");
        if (val === 1) {
            $("#award_div").css("display", "block");
            $("#award").prop('required', true);
            $("#award").attr("disabled", false);
            $("#course_div").css("display", "block");
            $("#course").prop('required', true);
            $("#course").attr("disabled", false);
            $("#specialization").attr("disabled", false);
            $("#award").attr("disabled", false);
            $("#specialization_div").css("display", "block");
            $("#specialization").prop('required', true);
            $("#grade").attr("disabled", "disabled");
            $("#grade_div").css("display", "none");
            $("#grade").val("");
            $("#grade").prop('required', false);
            $("#period").attr("disabled", "disabled");
            $("#period_div").css("display", "none");
            $("#period").val("");
            $("#period").prop('required', false);
            $("#mean_grade").attr("disabled", "disabled");
            $("#mean_grade_div").css("display", "none");
            $("#mean_grade").val("");
            $("#mean_grade").prop('required', false);
        } else if (val === 2) {
            $("#award_div").css("display", "block");
            $("#award").prop('required', true);
            $("#award").attr("disabled", false);
            $("#course_div").css("display", "none");
            $("#course").attr("disabled", false);
            $("#course").attr("disabled", "disabled");
            $("#course").val("");
            $("#specialization").attr("disabled", false);
            $("#specialization_div").css("display", "block");
            $("#specialization").prop('required', true);
            $("#grade").attr("disabled", "disabled");
            $("#grade_div").css("display", "none");
            $("#grade").val("");
            $("#grade").prop('required', false);
            $("#period").attr("disabled", "disabled");
            $("#period_div").css("display", "none");
            $("#period").val("");
            $("#period").prop('required', false);
            $("#mean_grade").attr("disabled", "disabled");
            $("#mean_grade_div").css("display", "none");
            $("#mean_grade").val("");
            $("#mean_grade").prop('required', false);
        } else if (val === 7) {
            $("#award_div").css("display", "none");
            $("#award").prop('required', false);
            $("#award").attr("disabled", "disabled");
            $("#award").val("");
            $("#course_div").css("display", "none");
            $("#course").prop('required', false);
            $("#course").attr("disabled", "disabled");
            $("#course").val("");
            $("#specialization_div").css("display", "none");
            $("#specialization").prop('required', false);
            $("#specialization").attr("disabled", "disabled");
            $("#specialization").val("");
            $("#grade_div").css("display", "block");
            $("#grade").prop('required', true);
            $("#grade").attr("disabled", false);
            $("#period_div").css("display", "block");
            $("#period").prop('required', true);
            $("#period").attr("disabled", false);
            $("#mean_grade").attr("disabled", "disabled");
            $("#mean_grade_div").css("display", "none");
            $("#mean_grade").val("");
            $("#mean_grade").prop('required', false);
        } else if (val === 8) {
            $("#award_div").css("display", "none");
            $("#award").prop('required', false);
            $("#award").attr("disabled", "disabled");
            $("#award").val("");
            $("#course_div").css("display", "none");
            $("#course").prop('required', false);
            $("#course").attr("disabled", "disabled");
            $("#course").val("");
            $("#specialization_div").css("display", "none");
            $("#specialization").prop('required', false);
            $("#specialization").attr("disabled", "disabled");
            $("#specialization").val("");
            $("#grade").attr("disabled", "disabled");
            $("#grade_div").css("display", "none");
            $("#grade").val("");
            $("#grade").prop('required', false);
            $("#period").attr("disabled", "disabled");
            $("#period_div").css("display", "none");
            $("#period").val("");
            $("#period").prop('required', false);
            $("#mean_grade_div").css("display", "block");
            $("#mean_grade").prop('required', true);
            $("#mean_grade").attr("disabled", false);
        }
    });

    $(document).ready(function() {
        $("#award").on('change', function () {
            const award_id = $(this).val();
            const filter_type = 1
            // alert(award_id)
            $.ajax({
                method: "POST",
                url: "./load_data.php",
                data: {
                    id: award_id,
                    filter_type:filter_type
                },
                datatype: "html",
                success: function (data) {
                    //  alert(data)
                    $("#courses").html(data);
                    //$("#city").html('<option value="">Select city</option');

                }
            });
        });

        $("#award").on('change', function () {
            const award_id = $(this).val();
            const filter_type = 3
            $.ajax({
                method: "POST",
                url: "./load_data.php",
                data: {
                    id: award_id,
                    filter_type:filter_type
                },
                datatype: "html",
                success: function (data) {
                    $("#specialization").html(data);
                    //$("#city").html('<option value="">Select city</option');

                }
            });
        });

        $("#courses").on('change', function () {
            const courses_id = $(this).val();
            const filter_type = 2
            // alert(award_id)
            $.ajax({
                method: "POST",
                url: "./load_data.php",
                data: {
                    id: courses_id,
                    filter_type:filter_type
                },
                datatype: "html",
                success: function (data) {
                    //  alert(data)
                    $("#specialization").html(data);
                    // $("#city").html('<option value="">Select city</option');

                }
            });
        });
    });

</script>

<script type="text/javascript">
    $("#delete_criteria").on('click', function () {
        if (confirm('Are you sure you want to delete this?')) {
            var ida = $(this).data('value');
            //window.location.reload();
            alert('dat', ida)
            $.ajax({
                method: "POST",
                url: "./delete.php",
                data: {
                    id: id
                },
                datatype: "html",
                success: function (data) {
                    alert(data)

                }
            });
        }
    });
</script>

