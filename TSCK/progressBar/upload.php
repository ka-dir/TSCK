<?php 
if(isset($_POST['title']))
{
	$title=$_POST['title'];
	$desc=$_POST['desc'];
	
	$filename=uniqid("file_attach_").$_FILES['file_upload']['name'];
	
	move_uploaded_file($_FILES['file_upload']['tmp_name'],"./uploads/".$filename);
	
	$flag=file_exists("./uploads/".$filename);
	
	/* check if file uploaded successfully */
	if($flag){
		/* make your db connection or use existing connected db */
		$con=mysql_connect("localhost","root","");
		mysql_select_db("progress_db");
		/*now insert the details in table */
		$insert_statement="insert into upload_table set `title`='".$title."',`description`='".$desc."',`file_name`='".$filename."' ";
		
		mysql_query($insert_statement);
		
		echo "Form processed Completely";
	}
	else
	{
		echo "Some Error occured";
	}
	
	 
	
	
}
?>