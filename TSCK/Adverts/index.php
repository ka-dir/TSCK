<?php
include('header.php');
$id_number = $_SESSION['id_number'];
?>
<head>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>


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

        function submitForm(action) {
            document.getElementById('CriteriaForm').action = action;
            document.getElementById('CriteriaForm').submit();
        }
    </script>
</head>

<body style="margin-top: -30px;">
<div class="container" style="width:auto; margin-left:-5px;">
    <h4><b>Manage Advert</b></h4>
    <?php
    //pagination
    if (isset($_GET['pageno'])) {
        $pageno = $_GET['pageno'];
    } else {
        $pageno = 1;
    }


    $no_of_records_per_page = 10;
    $offset = ($pageno - 1) * $no_of_records_per_page;

    //$result=mysqli_query($dbconnection, "SELECT COUNT(*) FROM applicant_details")or die(mysqli_error());
    $result = mysqli_query($dbconnection, "SELECT COUNT(*) FROM users") or die(mysqli_error());
    $total_rows = mysqli_fetch_array($result)[0];

    $total_pages = ceil($total_rows / $no_of_records_per_page);

    ?>
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


    <div class="navbar-default sidebar" role="navigation">
        <div class="sidebar-nav navbar-collapse">
            <ul class="nav" id="side-menu">
                <li class="sidebar-search">
                    <div class="input-group custom-search-form">
                        <form class="form-inline" method="POST" action="">
                            <div class="input-group col-md-12">
                                <input type="text" class="form-control" placeholder="Search Advert NO..." name="keyword"
                                       required="required">
                                <span class="input-group-btn">
    						<button class="btn btn-primary" name="search">
							<span class="glyphicon glyphicon-search"></span>
							</button>
    					</span>
                            </div>
                        </form>
                    </div>
                </li>
            </ul>
        </div>
    </div>

    <div class="row">

        <div class="col-md-14">
            <button class="btn btn-info btn-xs align-left" data-toggle="modal" data-target="#myModal"
                    style="margin-left: 65%">New Advert <i class="glyphicon glyphicon-plus"></i></button>
        </div>
    </div>

</div>
<div class="container" style="width:100%; margin-left:-5px;">
    <!-- START ALERTS -->
    <?php
    if (isset($_SESSION['message'])):

        ?>
        <div id="alert_message" class="<?= $_SESSION['alert']; ?>">
            <?php echo $_SESSION['message'];
            unset($_SESSION['message']); ?>
        </div>
    <?php endif; ?>
    <!-- END ALERTS -->

    <form id="CriteriaForm" name="CriteriaForm" action="" method="post">
        <table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="example">
            <thead style="background-color: #314C95;color:#FFFFFF;">
            <tr>
                <th style="text-align:center; font-size:12px;">Advert No</th>
                <th style="text-align:center; font-size:12px;">Posts</th>
                <th style="text-align:center; font-size:12px;">Closed Date</th>
                <th style="text-align:left; font-size:12px;">No of Posts</th>
                <th style="text-align:left; font-size:12px;">Category</th>
                <th style="text-align:center; font-size:12px;">Details</th>
                <th style="text-align:center; font-size:12px;width: 10%;">Action</th>
            </tr>
            </thead>
            <tbody>
            <?php

            $query = mysqli_query($dbconnection, "SELECT * FROM vacancy  ORDER BY created_at desc ") or die(mysqli_error());
            while ($row = mysqli_fetch_array($query)) {
                $advert_id = $row['vacancy_id'];
                $advert_no = $row['advert_no'];
                $encode_advertno = base64_encode(urlencode($advert_no));
                $rmre = $row['advert_no'];
                $post_vacancy = $row['post_vacancy'];
                $no_of_post = $row['no_of_post'];
                $duDate = $row['duDate'];
                $category = $row['category'];
                $pay_type = $row['pay_type'];
                $currency = $row['currency'];
                $basic_salary = $row['basic_salary'];
                $house_allowance = $row['house_allowance'];
                $commuter_allowance = $row['commuter_allowance'];
                $medical_scheme = $row['medical_scheme'];
                $status = $row['is_Closed'];

                ?>
                <tr>
                    <td style="text-align:center; font-size:12px;"><?php echo $advert_no; ?></td>
                    <?php
                    if ($duDate == '2023-02-28') {

                        ?>
                        <td style="text-align:center; font-size:12px;"><?php echo $post_vacancy; ?>
                            <button type="button" class="btn btn-primary">
                                NEW <span class="badge badge-light"></span>
                                <span class="sr-only">unread messages</span>
                            </button>
                        </td>
                        <?php
                    } else {

                        ?>

                        <td style="text-align:center; font-size:12px;"><?php echo $post_vacancy; ?>
                            <button type="button" class="btn btn-warning">
                                OLD <span class="badge badge-light"></span>
                                <span class="sr-only">unread messages</span>
                            </button>
                        </td>
                        <?php
                    }
                    ?>

                    <td style="text-align:center; font-size:12px;"><?php echo $duDate; ?></td>

                    <td style="text-align:center; font-size:12px;"><?php echo $no_of_post; ?></td>
                    <td style="text-align:center; font-size:12px;">
                        <button type="button" class="btn btn-primary">
                            <?php echo $category; ?> <span class="badge badge-light"
                                                           style="color: red"><?php if ($status == 1) {
                                    echo "Closed";
                                } else {
                                    echo "open";
                                }; ?></span>
                        </button>
                    </td>
                    <!--	<td style="text-align:center; font-size:12px;"><?php /*if($status == 1){ echo "Closed";}else{ echo "open";} ; */
                    ?></td>-->
                    <!--td style="text-align:center; font-size:12px;"><?php echo $duDate; ?></td>
				<td style="text-align:center; font-size:12px;"><?php echo $category; ?></td>
				<td style="text-align:center; font-size:12px;"><?php echo $pay_type; ?></td>
				<td style="text-align:center; font-size:12px;"><?php echo $currency; ?></td>
				<td style="text-align:center; font-size:12px;"><?php echo $basic_salary; ?></td>
				<td style="text-align:center; font-size:12px;"><?php echo $house_allowance; ?></td>-->
                    <td style="text-align:center; font-size:12px;">
                        <a href="jobdetails.php?n=<?php echo $encode_advertno; ?> ">+Read More </a>

                    </td>


                    <td style="margin: 5%">


                        <div class="btn-group">
                            <button type="button" class="btn btn-info btn-xs dropdown-toggle" data-toggle="dropdown"
                                    aria-haspopup="true" aria-expanded="false">
                                View
                                <span class="glyphicon glyphicon-film"></span>
                            </button>
                            <ul class="dropdown-menu">

                                <!--					    	<form name="bb" method="POST" action="jobdetails.php">-->
                                <!--							<input type="hidden" name="advert_no" value="-->
                                <?php //echo $advert_no;
                                ?><!--">-->
                                <!--							<input   data-id="--><?php //echo $advert_no;
                                ?><!--"  class='btn btn-info btn-xs advertinfo'   type="submit"  value="View-Advert"   style="background: none;margin: 0;padding: 0;color: #0088cc;text-decoration: none;  font-weight: 300;cursor: pointer;background: none;border: none;width:70%; text-align:center;"/>-->
                                <!--							<input  data-id="--><?php //echo $advert_no;
                                ?><!--"    style="background: none;margin: 0;padding: 0;color: #0088cc;text-decoration: none;  font-weight: 300;cursor: pointer;background: none;border: none;width:70%; text-align:center;"  type="submit"  value="Publish-Advert"/>-->
                                <!---->
                                <!--							<a href="jobdetails.php?advert_no=-->
                                <?php//// echo $encode_advertno
                                ?><!--">Details</a>-->
                                <!--                                <li>-->
                                <!--                                    <a data-toggle="modal" data-target="#myModal" href="#myModal?edit=-->
                                <?php //echo $advert_id;
                                ?><!--">Edit-Advert</a>-->
                                <!--                                </li>-->
                                <!--                                <li>-->
                                <!--                                    <a href="Adverts/delete.php?delete=-->
                                <?php //echo $advert_id;
                                ?><!--" style="color: red;" >Delete-Advert</a>-->
                                <!--                                </li> -->
                                <!---->
                                <!--                            </form>-->
                                <!--						<form name="frm_criteria" method="POST"action="adverts-criteria.php">-->
                                <!--						  <input type="hidden" name="advert_id" value="-->
                                <?php //echo $advert_id;
                                ?><!--">
						  <input style="background: none;margin: 0;padding: 0;color: #0088cc;text-decoration: none;  font-weight: 300;cursor: pointer;background: none;border: none;width:70%; text-align:center;"  type="submit"  value="Criteria"/>-->
                                <!---->
                                <!--						</form>-->


                                <li><a class="btn btn-primary active" role="button"
                                       href="adverts-criteria.php?id=<?php echo $advert_id; ?>">View-Criteria</a></li>
                                <li><a class="btn btn-success active"
                                       href="view-applicants.php?id=<?php echo $advert_id; ?>&s=xyft">View-Submitted</a>
                                </li>
                                <li><a class="btn btn-info active" style="background-color: red"
                                       href="view-applicants.php?id=<?php echo $advert_id; ?>&s=tfyx">View-Not-Submitted</a>
                                </li>
                            </ul>
                        </div>

                        <div class="btn-group">
                            <button type="button" class="btn btn-info btn-xs dropdown-toggle" data-toggle="dropdown"
                                    aria-haspopup="true" aria-expanded="false">
                                Export
                                <span class="glyphicon glyphicon-calendar"></span><span class="nav-label"></span>
                            </button>
                            <ul class="dropdown-menu">

                                <li>
                                    <form name="" method="POST" action="././Adverts/pdfexport.php">
                                        <input type="hidden" name="advert_no" value="<?php echo $advert_no; ?>"/>
                                        <input type="submit" name="pdf" value="Export pdf" class="btn btn-danger"
                                               style="height:100%; width:100%;margin: auto; background-color: red"/>
                                    </form>
                                </li>

                                <li>
                                    <form name="" method="POST" action="././Adverts/export.php">
                                        <input type="hidden" name="advert_no" value="<?php echo $advert_no; ?>"/>
                                        <input type="submit" name="export" value="Export csv" class="btn btn-success"
                                               style="height:100%; width:100%;margin: auto;"/>
                                    </form>
                                </li>


                            </ul>
                        </div>
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
</div>
<br>
<!--start edit advert modal ----------------------------------------------------------------------------------------------------------------------------------->
<?php


if (isset($_GET['edit'])) {
    $advert_id = $_GET['edit'];


    $query = ("SELECT * FROM vacancy WHERE vacancy_id='" . $advert_id . "'") or die (mysqli_error($conn));
    $result = mysqli_query($conn, $query);
    while ($row = mysqli_fetch_assoc($result)) {
        $advert_no = $row['advert_no'];
        $post_vacancy = $row['post_vacancy'];
        $no_of_post = $row['no_of_post'];
        $duDate = $row['duDate'];
        $category = $row['category'];
        $job_description = $row['job_description'];
        $duties_and_responsibilities = $row['duties_and_responsibilities'];
        $requirements = $row['requirements'];
        $pay_type = $row['pay_type'];
        $currency = $row['currency'];
        $basic_salary = $row['basic_salary'];
        $house_allowance = $row['house_allowance'];
        $commuter_allowance = $row['commuter_allowance'];
        $leave_allowance = $row['leave_allowance'];
        $medical_scheme = $row['medical_scheme'];

    }


}


?>
<!--end  edit advert modal ----------------------------------------------------------------------------------------------------------------------------------->

<!-- start model edit advert  --------------------------------------------------------------------------------------------------------------------------- -->


<!--<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
    Launch demo modal
</button>

<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title display-2" id="exampleModalLabel">Edit/Change Advert</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="post" action="Adverts/create_advert_process.php">
                    <div class="row" style="margin-left: 0%;" >
                        <div class="form-group col-md-6">
                            <label>Advert No</label>
                            <input type="text" name="advert_no" placeholder="Advert Number" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label>No of Posts</label> <br>
                            <input type="number" name="no_of_post" placeholder="No of Posts" style="width: 95%" required>
                        </div>
                    </div>
                    <hr>
                    <h4><strong>Compensation</strong></h4>
                    <hr>
                    <div class="row" style="margin-left: 0%;">
                        <div class="form-group col-md-6">
                            <label>Pay Type</label>
                            <select id = "pay_type" name="pay_type" style="width: 95%"  required>
                                <option value="" selected disabled hidden>Choose one</option>
                                <option value = "EXTERNAL">YEARLY</option>
                                <option value = "INTERNAL">MONTHLY</option>
                                <option value = "INTERNAL">WEEKLY</option>
                                <option value = "EXTERNAL">DAILY</option>
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label>Currency</label>
                            <select id = "currency" name="currency" style="width: 95%" required>
                                <option value="" selected disabled hidden>Choose one</option>
                                <option value = "EXTERNAL">KES</option>
                                <option value = "INTERNAL">TZS</option>
                                <option value = "INTERNAL">UGX</option>
                                <option value = "EXTERNAL">RWF</option>
                                <option value = "EXTERNAL">OTHER</option>
                            </select>
                        </div>
                    </div>
                    <div class="row" style="margin-left: 0%;">
                        <div class="form-group col-md-6">
                            <label>Basic Salary</label><br>
                            <input type="number" name="basic_salary" placeholder="Basic Salary" style="width: 95%" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label>House Allowance</label>
                            <input type="number" name="house_allowance" placeholder="House Allowance" style="width: 95%" required>
                        </div>

                    </div>
                    <div class="row" style="margin-left: 0%;">
                        <div class="form-group col-md-6">
                            <label>Commuter Allowance</label>
                            <input type="number" name="commuter_allowance" placeholder="Commuter Allowance" style="width: 95%" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label>Leave Allowance</label>
                            <input type="number" name="leave_allowance" placeholder="Leave Allowance" style="width: 95%" required>
                        </div>
                    </div>
                    <div class="form-group col-md-12">
                        <label>Medical Scheme</label>
                        <input type="text" name="medical_scheme" placeholder="Medical Scheme" required>
                    </div>

                    <hr>
                    <h4><strong>More Details</strong></h4>
                    <hr>
                    <div class="form-group col-md-12">
                        <label>Post Title</label>
                        <input type="text" name="post_vacancy" placeholder="Post Title" required>
                    </div>

                    <div class="row" style="margin-left: 0%;">
                        <div class="form-group col-md-6">
                            <label>Closing Date</label>
                            <input type="date" name="duDate" placeholder="Closing Date" style="width: 95%" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label>Select Category</label>
                            <select id = "category" name="category" style="width: 95%" required>
                                <option value="" selected disabled hidden>Choose one</option>
                                <option value = "INTERNAL">INTERNAL</option>
                                <option value = "EXTERNAL">EXTERNAL</option>

                            </select>
                        </div>
                    </div><br>
                    <div class="form-group col-md-12">
                        <label>Job Description</label>
                        <textarea name="job_description" required></textarea>
                        <script>
                            CKEDITOR.replace( 'job_description' );
                        </script>
                    </div>
                    <div class="form-group col-md-12">
                        <label>Duties and Responsibilities</label>
                        <textarea name="duties_and_responsibilities" required></textarea>
                        <script>
                            CKEDITOR.replace( 'duties_and_responsibilities' );
                        </script>
                    </div>
                    <div class="form-group col-md-12">
                        <label>Requirements</label>
                        <textarea name="requirements" required></textarea>
                        <script>
                            CKEDITOR.replace( 'requirements' );
                        </script>
                    </div>
                    <div class="row">
                        <button type="submit" name="btn_add_advert" class="btn btn-success my-2 " style="margin-left: 5%; width: 30%;">UPDATE ADVERT</button>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

            </div>
        </div>
    </div>
</div>
-->

<!-- end Modal edit advert ---------------------------------------------------------------------------------------------------------------------------- -->

<div id="myModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>

                <h4 class="modal-title">Create Advert </h4>

            </div>
            <div class="modal-body">
                <form method="post" action="Adverts/create_advert_process.php">
                    <div class="row" style="margin-left: 0%;">
                        <div class="form-group col-md-6">
                            <label>Advert No</label>
                            <input type="text" name="advert_no" placeholder="Advert Number" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label>No of Posts</label> <br>
                            <input type="number" name="no_of_post" placeholder="No of Posts" style="width: 95%"
                                   required>
                        </div>
                    </div>
                    <hr>
                    <h4><strong>Compensation</strong></h4>
                    <hr>
                    <div class="row" style="margin-left: 0%;">
                        <div class="form-group col-md-6">
                            <label>Pay Type</label>
                            <select id="pay_type" name="pay_type" style="width: 95%" required>
                                <option value="" selected disabled hidden>Choose one</option>
                                <option value="EXTERNAL">YEARLY</option>
                                <option value="INTERNAL">MONTHLY</option>
                                <option value="INTERNAL">WEEKLY</option>
                                <option value="EXTERNAL">DAILY</option>
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label>Currency</label>
                            <select id="currency" name="currency" style="width: 95%" required>
                                <option value="" selected disabled hidden>Choose one</option>
                                <option value="EXTERNAL">KES</option>
                                <option value="INTERNAL">TZS</option>
                                <option value="INTERNAL">UGX</option>
                                <option value="EXTERNAL">RWF</option>
                                <option value="EXTERNAL">OTHER</option>
                            </select>
                        </div>
                    </div>
                    <div class="row" style="margin-left: 0%;">
                        <div class="form-group col-md-6">
                            <label>Basic Salary</label><br>
                            <input type="text" name="basic_salary" placeholder="Basic Salary" style="width: 95%">
                        </div>
                        <div class="form-group col-md-6">
                            <label>House Allowance</label>
                            <input type="text" name="house_allowance" placeholder="House Allowance"
                                   style="width: 95%">
                        </div>

                    </div>
                    <div class="row" style="margin-left: 0%;">
                        <div class="form-group col-md-6">
                            <label>Commuter Allowance</label>
                            <input type="text" name="commuter_allowance" placeholder="Commuter Allowance"
                                   style="width: 95%">
                        </div>
                        <div class="form-group col-md-6">
                            <label>Leave Allowance</label>
                            <input type="text" name="leave_allowance" placeholder="Leave Allowance"
                                   style="width: 95%">
                        </div>
                    </div>
                    <div class="form-group col-md-12">
                        <label>Medical Scheme</label>
                        <!--<input type="text" name="medical_scheme" placeholder="Medical Scheme" required>-->
                       <!-- <select id="medical_scheme" name="medical_scheme" style="width: 95%" required>
                            <option value="" selected disabled hidden>Choose one</option>
                            <option value="Comprehensive Medical Scheme">Comprehensive Medical Scheme</option>
                            <option value="Not Applicable/Others">Not Applicable/Others</option>

                        </select>-->
                        <input type="text" name="medical_scheme" placeholder="medical scheme"
                               style="width: 95%">

                    </div>

                    <hr>
                    <h4><strong>More Details</strong></h4>
                    <hr>
                    <div class="form-group col-md-12">
                        <label>Post Title</label>
                        <input type="text" name="post_vacancy" placeholder="Post Title" required>
                    </div>

                    <div class="row" style="margin-left: 0%;">
                        <div class="form-group col-md-6">
                            <label>Closing Date</label>
                            <input type="date" name="duDate" placeholder="Closing Date" style="width: 95%" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label>Select Post Category</label>
                            <select id="category" name="category" style="width: 95%" required>
                                <option value="" selected disabled hidden>Choose one</option>
                                <option value="INTERNAL">INTERNAL</option>
                                <option value="EXTERNAL">EXTERNAL</option>

                            </select>
                        </div>
                    </div>
                    <br>
                    <div class="form-group col-md-12">
                        <label>Job Description</label>
                        <textarea name="job_description" required></textarea>
                        <script>
                            CKEDITOR.replace('job_description');
                        </script>
                    </div>
                    <div class="form-group col-md-12">
                        <label>Duties and Responsibilities</label>
                        <textarea name="duties_and_responsibilities" required></textarea>
                        <script>
                            CKEDITOR.replace('duties_and_responsibilities');
                        </script>
                    </div>
                    <div class="form-group col-md-12">
                        <label>Requirements</label>
                        <textarea name="requirements" required></textarea>
                        <script>
                            CKEDITOR.replace('requirements');
                        </script>
                    </div>
                    <div class="row">
                        <button type="submit" name="btn_add_advert" class="btn btn-success"
                                style="margin-left: 5%; width: 20%;">ADD ADVERT
                        </button>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>

        </div>

    </div>
</div>


<!--model start view-->


<div class="modal fade" id="ViewModal" role="dialog">

    <div class="modal-dialog">
        <div class="modal-content">

            <!-- Modal content-->


            <!-- Modal header-->
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Adverts</h4>
            </div>
            <!-- Modal body-->
            <div class="modal-body">


                <form method="post" id="insert_form">
                    <label>Id number</label>
                    <input type="text" name="id_no" id="id_no" class="form-control" readonly/>
                    <br/>
                    <label>Email Address</label>
                    <input type="text" name="email" id="email" class="form-control" readonly/>
                    <br/>
                    <label>Mobile Number</label>
                    <input type="text" name="mobile_no" id="mobile_no" class="form-control"/>
                    <br/>
                    <label>Role granted</label>
                    <input type="text" name="role_granted" id="role_granted" class="form-control"/>
                    <br/>
                    <label>Created at</label>
                    <input type="text" name="created_at" id="created_at" class="form-control" readonly/>
                    <br/>
                    <input type="hidden" name="id_number" id="id_number"/>
                    <input type="submit" name="insert" id="insert" value="update" class="btn btn-success"/>


                </form>


            </div>
            <span id="span1"></span>
            <!-- Modal footer-->
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>


        </div>
    </div>
</div>


</div>
</body>


<!--Jquery -->
<script type="text/javascript" src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
<!-- start alert msg disappear -->
<script src="https://services.tsc.go.ke/TSCK/users/js/sweetalert.min.js"></script>

<script type='text/javascript'>


    $(document).ready(function () {

        $(document).ready(function () {

            /* $('.advertinfo').click(function(){

                 var advertid = $(this).data('id');
                 //alert(advertid);

                 // AJAX request
                 $.ajax({
                     url: "https://services.tsc.go.ke/TSCK/Adverts/jobdetails.php",
                     type: "POST",
                     data: {advert_no:advertid},
                     dataType:"json",
                     success:function(data){
                 $('#id_no').val(data.id_number);
                  $('#email').val(data.email);
                  $('#mobile_no').val(data.phone_number);
                  $('#role_granted').val(data.is_admin);
                  $('#created_at').val(data.DateTime);
                 $('#id_number').val(data.id_number);
                 $('#empModal').val("Update");
                      // Add response in Modal body
                       //  $('.modal-body').html(response);

                         // Display Modal
                         $('#empModal').modal('show');
                         //alert(success);
                     },
                  error: function(data)
  {
          swal("Sorry!","try againtokmjlkt later","warning");
      }
                 })
                 // stop the form from submitting the normal way and refreshing the page
     event.preventDefault();
             });*/
        });

        $('#insert_form').on("submit", function (event) {
            event.preventDefault();

            $.ajax({
                url: "https://services.tsc.go.ke/TSCK/users/Edituser.php",
                method: "POST",
                data: $('#insert_form').serialize(),
                //data: {id_number:userid},

                beforeSend: function () {
                    $('#insert').val("Updating");
                },
                success: function (data) {

                    //$('#insert_form')[0].reset();
                    $('#empModal').modal('hide');
                    // $('#employee_grid').html(data);
                    swal("Good!", "succesfully updated!", "success");


                },

                error: function (data) {
                    swal("Sorry!", "try again later", "warning");

                }

            });

        });
    });

</script>


<script type="text/javascript">
    window.setTimeout(function () {
        $("#alert_message").fadeTo(500, 0).slideUp(500, function () {
            $(this).remove();
        });
    }, 3000);
</script>
<!-- end alert msg disappear -->
<script> function moreinfoModal(field) {
        console.log(field.id);
        $('.modal fade').toggleClass('open');
    }


    function closeMoreInfoModal() {
        $('.modal fade').toggleClass('open');
    }

    $(document).on('click', '.close-pill', function (e) {
        $(this).parent().remove();
        e.preventDefault();
    });
</script>
<script>
    $(document).ready(function () {
        $('#myModal').on('hidden.bs.modal', function () {
            $(this).removeData('bs.modal');
        });
    });
</script>


<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"
        integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n"
        crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
        integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo"
        crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"
        integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6"
        crossorigin="anonymous"></script>
</html>

