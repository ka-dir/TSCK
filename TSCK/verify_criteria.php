<?php
include('./includes/dbConfig.php');
//$id_number = $_SESSION['id_number'];

$id_no = mysqli_real_escape_string($conn, $_POST['id_no']);
$stage = mysqli_real_escape_string($conn, $_POST['stage']);
$advert = mysqli_real_escape_string($conn, $_POST['advert']);
$resposible_function = "";
$result = 0;

if ($advert == null) {
    echo $result; // no advert
}

if ($stage == 4) {
    $resposible_function = verifyAcademic($id_no, $advert);
}elseif ($stage == 5) {
    $resposible_function = verifyProfessional($id_no, $advert);
}

echo $resposible_function;


function verifyProfessional($id_no, $advert)
{
    /**
     * responses and meanings
     *
     * 0 - no advert
     * 1 - no criteria for this section
     * 2 - no uploads made
     * 3 - no required award
     * 4 - no required specialization
     * 5 - meets criteria
     * 6 - no uploads and no criteria
     *
     */
    global $conn;
    $query_criteria = "select * from advert_criteria where vacancy_id = '$advert' and criteria_type_id=2";
    $result_criteria = $conn->query($query_criteria);
    $required_awards = array();
    $required_course = array();
    $required_specialization = array();
    $count = mysqli_num_rows($result_criteria);

    if ($count > 0) {
        while ($row_criteria = mysqli_fetch_array($result_criteria)) {
            $award = $row_criteria['award_id'];
            $specialization = $row_criteria['specialization_id'];


            array_push($required_awards, $award);
            array_push($required_specialization, $specialization);


        }

        // get uploaded documents
        $required_awards_uploads = array();
        $required_specialization_uploads = array();
        $query_uploads = "select * from professional_qualification where id_number = '$id_no'";
        $result_uploads = $conn->query($query_uploads);
        $count_uploads = mysqli_num_rows($result_uploads);
        if ($count_uploads > 0) {
            while ($row_uploads = mysqli_fetch_array($result_uploads)) {
                $award_uploads = $row_uploads['award_id'];
                $specialization_uploads = $row_uploads['specialization_id'];

                array_push($required_awards_uploads, $award_uploads);
                array_push($required_specialization_uploads, $specialization_uploads);

            }
        } else {
            return 2; // no uploads
        }

//        $check_if_qualify_award = array_diff($required_awards, $required_awards_uploads);
//        if (count($check_if_qualify_award) > 0) {
//            return 3; // no award
//        }

        $check_if_qualify_specialization = array_intersect($required_specialization, $required_specialization_uploads);
        if (count($check_if_qualify_specialization) == 0) {
            return 4; // no specialization
        }

        return 5; // meets requirement

    } else {
        $query_uploads = "select * from academic_qualification where id_number = '$id_no'";
        $result_uploads = $conn->query($query_uploads);
        $count_uploads = mysqli_num_rows($result_uploads);
        if ($count_uploads <= 0) {
            return 6;
        }
        return 1; //no criteria for this section
    }
}

function verifyAcademic($id_no, $advert)
{
    /**
     * responses and meanings
     *
     * 0 - no advert
     * 1 - no criteria for this section
     * 2 - no uploads made
     * 3 - no required award
     * 4 - no required course
     * 5 - no required specialization
     * 6 - meets criteria
     * 7 - no uploads and no criteria
     *
     */
    global $conn;
    $query_criteria = "select * from advert_criteria where vacancy_id = '$advert' and criteria_type_id=1";
    $result_criteria = $conn->query($query_criteria);
    $required_awards = array();
    $required_course = array();
    $required_specialization = array();
    $count = mysqli_num_rows($result_criteria);

    if ($count > 0) {
        while ($row_criteria = mysqli_fetch_array($result_criteria)) {
            $award = $row_criteria['award_id'];
            $course = $row_criteria['course_id'];
            $specialization = $row_criteria['specialization_id'];


            array_push($required_awards, $award);
            array_push($required_course, $course);
            array_push($required_specialization, $specialization);


        }

        // get uploaded documents
        $required_awards_uploads = array();
        $required_course_uploads = array();
        $required_specialization_uploads = array();
        $query_uploads = "select * from academic_qualification where id_number = '$id_no'";
        $result_uploads = $conn->query($query_uploads);
        $count_uploads = mysqli_num_rows($result_uploads);
        if ($count_uploads > 0) {
            while ($row_uploads = mysqli_fetch_array($result_uploads)) {
                $award_uploads = $row_uploads['award_id'];
                $course_uploads = $row_uploads['course_id'];
                $specialization_uploads = $row_uploads['specialization_id'];

                array_push($required_awards_uploads, $award_uploads);
                array_push($required_course_uploads, $course_uploads);
                array_push($required_specialization_uploads, $specialization_uploads);

            }
        } else {
            return 2; // no uploads
        }

        $check_if_qualify_award = array_diff($required_awards, $required_awards_uploads);
        if (count($check_if_qualify_award) > 0) {
            return 3; // no award
        }

        $check_if_qualify_course = array_diff($required_course, $required_course_uploads);

        if (count($check_if_qualify_course) > 0) {
            return 4; // no course
        }

        $check_if_qualify_specialization = array_diff($required_specialization, $required_specialization_uploads);

        if (count($check_if_qualify_specialization) > 0) {
            return 5; // no specialization
        }

        return 6; // meets requirement

    } else {
        $query_uploads = "select * from academic_qualification where id_number = '$id_no'";
        $result_uploads = $conn->query($query_uploads);
        $count_uploads = mysqli_num_rows($result_uploads);
        if ($count_uploads <= 0) {
            return 7;
        }
        return 1; //no criteria for this section
    }
}

?>