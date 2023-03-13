<?php
include(__DIR__ . '../includes/dbConfig.php');
$id_number = $_SESSION['id_number'];
$advert_id = $_GET['id'];
$s = $_GET['s'];
$status = "";

if ($s == 'xyft') {
    $status = 1;
} elseif ($s == 'tfyx') {
    $status = 0;
} else {
    $status = "";
}


$sql = "
select a.id_number,a.tscNo,b.F_name as first_name,b.O_name as middle_name,b.S_name as surname,a.advert_no,a.post_vacancy,
if(a.is_submitted = 0,'not-submitted','submitted') as status,a.DateTime as status_date
 from tblappliedjobs a
join applicant_details b on a.id_number = b.id_no
where a.vacancy_id='$advert_id' and a.is_submitted = '$status'";
$result = $conn->query($sql);
$arr_applicants = [];
if ($result->num_rows > 0) {
    $arr_applicants = $result->fetch_all(MYSQLI_ASSOC);
}
?>

<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.11.5/datatables.min.css"/>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.1/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.3.2/css/buttons.dataTables.min.css">

<table id="tblUser" class="display nowrap" style="width:100%">
    <thead>
    <th>#</th>
    <th>Id Number</th>
    <th>Tsc No</th>
    <th>First Name</th>
    <th>Last Name</th>
    <th>Surname</th>
    <th>Advert No</th>
    <th>Advert Name</th>
    <th>Status</th>
    <th>Status Date</th>
    <th>Action</th>
    </thead>
    <tbody>
    <?php if (!empty($arr_applicants)) {
        $count = 1;
        ?>
        <?php foreach ($arr_applicants as $applican) {
            ?>
            <tr>
                <td><?php echo $count; $count++; ?></td>
                <td><?php echo $applican['id_number']; ?></td>
                <td><?php  echo $applican['tscNo'] > 0 ? $applican['tscNo'] : '-'; ?></td>
                <td><?php echo $applican['first_name']; ?></td>
                <td><?php echo $applican['middle_name']; ?></td>
                <td><?php echo $applican['surname']; ?></td>
                <td><?php echo $applican['advert_no']; ?></td>
                <td><?php echo $applican['post_vacancy']; ?></td>
                <td><?php echo $applican['status']; ?></td>
                <td><?php echo $applican['status_date']; ?></td>
                <td>
                    <a target="_blank" href="secSeventeen.php?id_number=<?php echo base64_encode(urlencode($applican['id_number']));?> & advert_no=<?php echo base64_encode(urlencode($applican['advert_no']));?>" class="fa"
                       style="font-size:20px;text-decoration: none" target="_blank">&#xf06e; </a>
                    <a target="_blank" href="secSeventeen_uploads.php?id_number=<?php echo base64_encode(urlencode($applican['id_number']));?> & advert_no=<?php echo base64_encode(urlencode($applican['advert_no']));?>" class="fa fa-file"
                       style="font-size:20px;text-decoration: none" target="_blank"> </a>
                </td>

            </tr>
        <?php

        }

    } ?>
    </tbody>
</table>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.11.5/datatables.min.js"></script>
<script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/2.3.2/js/dataTables.buttons.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/2.3.2/js/buttons.html5.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/2.3.2/js/buttons.print.min.js"></script>








<script>
    jQuery(document).ready(function ($) {
        $('#tblUser').DataTable(
            {
            dom: 'Bfrtip',
            buttons: [
                'copy', 'csv', 'excel', 'pdf', 'print'
            ]
        }
        );

    });


</script>