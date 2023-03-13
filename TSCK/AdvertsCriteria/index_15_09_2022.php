<?php
include('../includes/dbConfig.php');


$id_number = $_SESSION['id_number'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title></title>
    <style type="text/css"></style>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
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
                <th style="text-align:center; font-size:12px;">Criteria</th>
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
       v.advert_no,v.post_vacancy,c.criteria_type,
       aw.award,cs.course_desc,s.name,s.name AS specialization,concat(d.Designame,' [',d.Desigcode,']')  as desig_name,a.period
		FROM advert_criteria a 
		LEFT OUTER JOIN vacancy v ON a.vacancy_id = v.vacancy_id 
		LEFT OUTER JOIN criteria_type c ON a.criteria_type_id = c.id
		LEFT OUTER JOIN award aw ON a.award_id = aw.id
		LEFT OUTER JOIN courses cs ON a.course_id = cs.course_id 
		LEFT OUTER JOIN specialization s ON a.specialization_id = s.id 
		LEFT OUTER JOIN designations d ON a.grade_id = d.id 
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
                $period = $row['period'];
                ?>
                <tr>

                    <td style="text-align:center; font-size:12px;"><?php echo $advert_no ?></td>
                    <td style="text-align:center; font-size:12px;"><?php echo $post_vacancy ?></td>
                    <td style="text-align:center; font-size:12px;"><?php echo $criteria_name ?></td>
                    <td style="text-align:center; font-size:12px;">
                        <?php
                        if($criteria_type_id == 7)
                        {
                            echo $grade;
                        }
                        ?></td>
                    <td style="text-align:center; font-size:12px;"><?php echo $period ?></td>

                    <td>
                        <div class="btn-group" role="group">
                            <button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown"
                                    aria-haspopup="true" aria-expanded="false">
                                Action
                                <span class="caret"></span>
                            </button>
                            <ul class="dropdown-menu">
                                <!--li><a href="Adverts/criteria.php?id=<?php //echo $id;
                                ?>">Delete</a></li-->

                                <input type="hidden" name="a_id" value="<?php echo $row['id'] ?>">
                                <input type="submit" name="delete_submit" value="Delete"
                                       style="background: none;margin: 0;padding: 0;color: #0088cc;text-decoration: none;  font-weight: 300;cursor: pointer;background: none;border: none;width:70%; text-align:center;"/>

                            </ul>
                        </div>


                    </td>

                    <!--<td>
				<div class="btn-group" role="group">
				<button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
					     Summary
					      <span class="caret"></span>
				</button>
				<ul class="dropdown-menu">
				<li>
					<input type="hidden" name="advert_no" onclick="submitForm('../TSCKTEST/AdvertsCriteria/export.php')" value="<?php /*echo $advert_no;*/
                    ?>"/>
				<input type="submit" name="export" onclick="submitForm('../TSCKTEST/AdvertsCriteria/export.php')" value="Shortlist" class="btn btn-success"  style="height:100%; width:100%;margin: auto;"  />
				</li>
				
				<li>
				<input type="hidden" name="advert_no" onclick="submitForm('../TSCKTEST/AdvertsCriteria/dashboard.php')" value="<?php /*echo $advert_no;*/
                    ?>"/>
				<input type="submit" name="dashboard" onclick="submitForm('../TSCKTEST/AdvertsCriteria/dashboard.php')" value="dashboard" class="btn btn-success"  style="height:100%; width:100%;margin: auto;"  />
				</li>
				
				</ul>
			</div>
				</td>-->


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
                        <select name="criteria_type" required>
                            <option value="" selected disabled hidden>Choose one...</option>
                            <?php
                            $sql = mysqli_query($conn, "SELECT id,criteria_type FROM criteria_type WHERE criteria_type like '%grade%'  ORDER BY criteria_type ASC");
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

                    <div class="form-group">
                        <label>Grade</label>
                        <select name="grade" required>
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

                    <div class="form-group">
                        <label>Period</label>
                        <select name="period" required>
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
                        <!--			<div class="form-group">-->
                        <!--        			<label>Award/Certificate</label>-->
                        <!--        		<select name="award">-->
                        <!--				<option value="" selected disabled hidden>Choose one</option>-->
                        <!--				--><?php //
                        //				$sql = mysqli_query($conn, "SELECT id,award FROM award ORDER BY award ASC");
                        //				while ($row = $sql->fetch_assoc())
                        //				{
                        //				$award=$row['award'];
                        //				$id=$row['id'];
                        //				?>
                        <!--				<option value="--><?php //echo $id  ;?><!--" >-->
                        <!--				--><?php //echo $award ;?>
                        <!--				</option>-->
                        <!--				--><?php
                        //				}
                        //				?>
                        <!--			</select>-->
                        <!--        	</div>-->
                        <!--			-->
                        <!--			-->
                        <!--			<div class="form-group">-->
                        <!--        			<label>Course</label>-->
                        <!--        		<select name="course">-->
                        <!--				<option value="" selected disabled hidden>Choose one</option>-->
                        <!--				--><?php //
                        //				$sql = mysqli_query($conn, "SELECT course_id,course_desc FROM courses ORDER BY course_desc ASC");
                        //				while ($row = $sql->fetch_assoc())
                        //				{
                        //				$course_desc=$row['course_desc'];
                        //				$course_id=$row['course_id'];
                        //				?>
                        <!--				<option value="--><?php //echo $course_id;?><!--" >-->
                        <!--				--><?php //echo $course_desc ;?>
                        <!--				</option>-->
                        <!--				--><?php
                        //				}
                        //				?>
                        <!--			</select>-->
                        <!--        	</div>-->
                        <!--			-->
                        <!---->
                        <!--			-->
                        <!--			<div class="form-group">-->
                        <!--        		<label>Specialization</label>-->
                        <!--        		<select name="specialization">-->
                        <!--				<option value="" selected disabled hidden>Choose one</option>-->
                        <!--				--><?php //
                        //				$sql = mysqli_query($conn, "SELECT id,name FROM specialization ORDER BY name ASC");
                        //				while ($row = $sql->fetch_assoc())
                        //				{
                        //				$specialization=$row['name'];
                        //				$id=$row['id'];
                        //				?>
                        <!--				<option value="--><?php //echo $id  ;?><!--" >-->
                        <!--				--><?php //echo $specialization; ?>
                        <!--				</option>-->
                        <!--				--><?php
                        //				}
                        //				?>
                        <!--				</select>-->
                        <!--        	</div>-->

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

if (isset($_POST['delete_submit'])) {
    $id = $_POST['a_id'];
    $sql = "DELETE FROM advert_criteria WHERE id='" . $id . "'";
    $result = $dbconnection->query($sql);
    if (!$result) {
        echo mysqli_error($dbconnection);
    }

    ?>
    <script>
        //window.alert("Deleted successfully.");
        window.location.href = 'adverts.php';

    </script>
    <?php

}


?>
					 


