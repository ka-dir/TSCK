 <?php
session_start();
//include('header.php');
include('../includes/dbConfig.php');
include('fpdf/fpdf.php');
 if(isset($_POST['pdf']))
{
	if(isset($_POST['advert_no']))
	{
$advert_no=$_POST['advert_no'];
$result=mysqli_query($dbconnection,"SELECT `advert_no`,`post_vacancy` FROM `vacancy` WHERE `advert_no`='".$advert_no."'")or die(mysqli_error());		
$rows=mysqli_fetch_array($result);	
//echo $rows['advert_no'].' - '.$rows['post_vacancy'];	









		

$pdf=new FPDF();
$pdf->SetTitle($rows['post_vacancy'].' - '.$rows['advert_no']);
$pdf->AliasNbPages();
$pdf->AddPage();

$pdf->SetFont('Arial','B',10);
$pdf->Ln();
$pdf->Ln();
$pdf->SetFont('times','B',10);
$pdf->Cell(10,7,"#");
$pdf->Cell(20,7,"ID");
$pdf->Cell(20,7,"TSCNO");
$pdf->Cell(70,7,"Names");
$pdf->Cell(20,7,"Gender");
//$pdf->Cell(30,7,"VACANCYNAME");
$pdf->Cell(20,7,"Flag(1/0)");
$pdf->Cell(20,7,"Status");

$pdf->Ln();
$pdf->Cell(450,7,"----------------------------------------------------------------------------------------------------------------------------------------------------------------------");
$pdf->Ln();
$advert_no=$_POST['advert_no'];


        
		 $result=mysqli_query($dbconnection,"
		 SELECT 
		 tbl.id_number,tbl.tscNo,tbl.advert_no,tbl.post_vacancy,tbl.status,tbl.is_submitted,
		 CONCAT(a.title,' ',a.F_name,' ',a.S_name,' ',a.O_name) AS Name,a.gender
		 FROM tblappliedjobs as tbl
		 left join applicant_details as a on tbl.id_number=a.id_no
		 WHERE advert_no='".$advert_no."'")
		 or die(mysqli_error($dbconnection));
     
		
		$no=0;
        while($rows=mysqli_fetch_array($result))
        {

            $no++;	
			$ID = $rows['id_number'];
			$TSCNO = $rows['tscNo'];
            $NAME = $rows['Name'];
            $GENDER = $rows['gender'];			
           //$VACANCY = $rows['post_vacancy'];
            $ISSUBMITTED = $rows['is_submitted'];			
            $STATUS = $rows['status'];
			
            $pdf->Cell(10,7,$no);          
            $pdf->Cell(20,7,$ID);
            $pdf->Cell(20,7,$TSCNO);
            $pdf->Cell(70,7,$NAME);
            $pdf->Cell(10,7,$GENDER);			
           // $pdf->Cell(30,7,$VACANCY);
		    $pdf->Cell(30,7,$ISSUBMITTED);
            $pdf->Cell(50,7,$STATUS);
            $pdf->Ln(); 
        }

        
$pdf->Output();

}}
?>


