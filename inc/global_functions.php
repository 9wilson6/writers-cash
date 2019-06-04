<?php 
function Register(){
global $error, $success,  $date_global;
if (isset($_POST['reg'])) {
global	$db, $error_1, $success_1;
}
if (isset($_POST['submit'])) {
require_once("../dbconfig/dbconnect.php");
/////////////////////////////////RECEIVE FORM DATA/////////////////////////////////////////
$username=$db->escape($_POST['username']);
$user_type=$db->escape($_POST['user_type']);
$email=$db->escape($_POST['email']);
$password=$db->escape($_POST['password']);
$C_password=$db->escape($_POST['C_password']);
if (isset($_POST['about_me'])) {
	$about_me=$db->escape($_POST['about_me']);
}else{
	$about_me="";
}
if (isset($_POST['reg'])) {
	$_SESSION['username']=$username;
	$_SESSION['email']=$email;
}
///////Order Variables////////////
if (isset($_POST['reg'])) {

			  $title=$db->escape($_POST['title']);
			  $_SESSION['title']=$title;
			  $subject=$db->escape($_POST['subject']);
			   $_SESSION['subject']=$subject;
			  $academic_level=$db->escape($_POST['academic_level']);
			  $_SESSION['academic_level']=$academic_level;
			  $style=$db->escape($_POST['style']);
			  $_SESSION['style']=$style;
			  $papertype=$db->escape($_POST['papertype']);
			  $_SESSION['papertype']=$papertype;
			  $datetyme= strtotime("+ {$_POST['datetyme']}");
			  $_SESSION['datetyme']=$_POST['datetyme'];
			  $pages=$db->escape($_POST['pages']);
			  $_SESSION['pages']=$pages;
			  $sources=$db->escape($_POST['sources']);
			  $_SESSION['sources']=$sources;
			  $instructions=$db->escape($_POST['instructions']);
			  $_SESSION['instructions']=str_replace("\r\n", "", $_POST['instructions']);
			  $budget=$db->escape($_POST['budget']);
			  $_SESSION['budget']=$budget;
			  $date_global=strtotime($date_global);
			  // $_SESSION['date_global']
			  // echo $datetyme;
			 
			}
////// //////////////////CHECK FOR EMPTY FIELDS///////////////////////////////////////////////
if ( !empty($username) && !empty($user_type) && !empty($email) &&  !empty($password) &&  !empty($C_password)) {
//////////////////////////CHECK EMAIL VALIDITY///////////////////////////////////////////
if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
//////////////////////////////CHECK IF PASSWORDS MATCH///////////////////////////////
if ($password===$C_password) {
///////////////CHECK PASSWORD LENGTH////////////////////////////////////////////
if (strlen($password)>5) {
	//////CHECK IF THE EMAIL ALREADY EXISTS IN THE DATABASE//////////
$query="SELECT * FROM users WHERE email='$email'";

$results=$db->get_results($query);
if($db->num_rows == 0){
	$password_=password_hash($password, PASSWORD_DEFAULT);
	$date=date("Y-m-d H:i:sa");
	$verif_key=str_shuffle(substr(password_hash($date, PASSWORD_DEFAULT), 30,90));

	$query="INSERT INTO users(username, email, password, type, created_on,verif_key, status, about_me) VALUES('$username','$email','$password_', '$user_type','$date','$verif_key', 1, '$about_me')";
	$results=$db->query($query);


	if ($results==1) {
					$query_id="SELECT user_id FROM users WHERE email='$email'";
					 $student_id=$db->get_var($query_id);
			if (isset($_POST['reg'])) {
				  $sql="INSERT INTO projects(title, subject, academic_level, style, type_of_paper, deadline, pages, sources, instructions, budget, student_id, DATE_CREATED) VALUES('$title', '$subject','$academic_level','$style','$papertype','$datetyme','$pages','$sources', '$instructions', '$budget', '$student_id', '$date_global')";
  $result=$db->query($sql);
  // $db->debug();
  // die();
  if ($result==1) {
$query="SELECT project_id FROM projects WHERE DATE_CREATED='$date_global' AND student_id='$student_id'";
    $results=$db->get_row($query);

   //,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,notification,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,
  //
  //
  //
  //,,,,,,,,,,,,,,,,,,,,,,,,,, //
  $note="Student ID: ". $student_id." posted project ID: ".$results->project_id." at ".date("Y-m-d H:i:sa",$date_global);
  $note2="You posted project ID: ".$results->project_id." at ".date("Y-m-d H:i:sa",$date_global);
  
  $user_type=1;
 $querys="INSERT INTO notifications(user_type, note) VALUES('$user_type','$note')";
  $db->query($querys);
  $querys="INSERT INTO notifications(user_type, note, user_id) VALUES(3,'$note2', '$student_id')";
  $db->query($querys);
  // ........,,,,,,,,,,,,,,,,,,,,,,,,,,notification,,,,,,,,,,,,,,,,,
  // 
  // 
  // ,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,//
    if(count($_FILES['file']['name'])==0) {
    $success_1="Homework Posted files Successfully";
}else{
 	
    myfilesUpload($student_id, $results->project_id);
      $success_1="Homework Posted Successfully";

   }
   // $success="Homework Posted Successfully";
  
  }else{
$error_1="Was not Successfully Posted try again";
  }
		$success_1= "Operation was successful ";
		session_unset();
		session_destroy();
		session_start();
	}else{$success= "Regration was successful";}



	
				// session_start();
		$_SESSION['email']=$email;
		$_SESSION['password']=$password;
		if ($user_type==1) {
			header("Refresh:0; url=login");
		}elseif ($user_type==2) {
			header("Refresh:0; url=login");
		}
////////////////////////////////
	}else{
		if (isset($_POST['reg'])) {
			$error_1= "Regration was unsuccessful";
		}else{$error= "Regration was unsuccessful";}
		
	}


}else{
		///////ALREADY REGISTERED/////////
	if (isset($_POST['reg'])) {
		$error_1="email is already in use";
	}else{$error="email is already in use";}
	
}
} else {
	///////SHORT PASSWORD/////////
if (isset($_POST['reg'])) {
$error_1="Passwords should be at least 6 characters in length";
}else{$error="Passwords should be at least 6 characters in length";}

}

} else {
////////PASSWORD MISATCH ERROR////////
	if (isset($_POST['reg'])) {
$error_1="Passwords didn't match";
}else{$error="Passwords didn't match";}

}


}else{
//////////INVALID EMAIL///////////////
	if (isset($_POST['reg'])) {
$error_1="Invalid Email Supplied...";
}else{$error="Invalid Email Supplied...";}
}
}else{
/////////////EMPTY FIELDS////////////////
	if (isset($_POST['reg'])) {
$error_="Empty Fileds Detected....";
}else{
$error="Empty Fileds Detected....";	
}

}

// die();
}
}
?>

<?php 
function Login(){

if (isset($_POST['submit'])) {
global $error;
global $db;
$email=$db->escape($_POST['email']);
$user_type=$db->escape(trim($_POST['user_type']));
$password=$db->escape($_POST['password']);
$query="SELECT * FROM users WHERE email='$email' AND type='$user_type'";
$results=$db->get_row($query);
if ($db->num_rows>0) {
if (password_verify($password, $results->password)) {
$_SESSION['username']=$results->username;
$_SESSION['user_id']=$results->user_id;
if ($user_type==1) {
if ($results->status==1) {
$_SESSION["info"]=$results;
$_SESSION['user_type']=1; ?>
<script>
	window.location.assign("createpost");
</script>

<?php }else{
$error="Sorry your account is under suspension. <br> contact admin for further details";
}

}elseif($user_type==2){
if ($results->status==1) {
if ($results->verified==1) {
	$_SESSION['user_type']=2;
	$_SESSION["info"]=$results;
	header("location:dashboard");
}else{
	header("location:not_active");
}
}else{
$error="Sorry your account is under suspension. <br> contact admin for further details";
}
}elseif ($user_type==3) {
$_SESSION['user_type']=3;
$_SESSION["info"]=$results;
header("location:./index");
}
}else{
$error="Invalid credentials";
}
}else{
$error="Invalid credentials";

}

}

}

function reset_pass(){
require_once("../dbconfig/dbconnect.php");
global $error, $success;
if (isset($_POST['reset'])) {
$email=$_POST['email'];
if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
$user_type=$_POST['user_type'];
$query="SELECT *  FROM users WHERE type='$user_type' AND email='$email'";
$results=$db->get_row($query);
if ($db->num_rows>0) {
$date=date("Y-m-d H:i:sa");
$verif_key=str_shuffle(substr(password_hash($date, PASSWORD_DEFAULT), 30,10));
$password=password_hash($verif_key, PASSWORD_DEFAULT);
$query="UPDATE users set password='$password' WHERE email='$email' AND type='$user_type'";
if ($db->query($query)) {
$success="Password sent to your email";
$subject="Password reset successful";
$details="Hello ". $results->username ." your password was successfully reset. <br> New password: ".$verif_key. "<br> You can always adjust this password after you log in to you user account.";
sendMail($details,$email, $subject, 1);
}


}else{
$error=$email ." is not registered with us";
}

// sendMail("hello wilson your new password is here ",$email, "email reset", 1);
}else{
$error="The email you entered is invalid";	
}

}
}

  function myfilesUpload($student_id, $project_id){

  if (!file_exists('./FILES/'.$student_id.'/'.$project_id.'/')) {
       mkdir('./FILES/'.$student_id.'/'.$project_id.'/', 0777, true);
       $dir="./FILES/{$student_id}/{$project_id}/";
       }else{
          $dir="./FILES/{$student_id}/{$project_id}/";
       }

        $zipname =$dir."Order_". $project_id."_.zip";
if (file_exists($zipname)) {
    unlink($zipname);

}
   for ($i=0; $i < count($_FILES['file']['name']); $i++) { 
    $name= $_FILES['file']['name'][$i];
    $size=$_FILES['file']['size'][$i];
    $type=$_FILES['file']['type'][$i];
    $tmp_name=$_FILES['file']['tmp_name'][$i];
   move_uploaded_file($tmp_name, $dir."".$name);
}

}
?>

<?php function getDateTimeDiff($current_date, $other_date){
$now_timeStamp=strtotime($current_date);

if ($now_timeStamp<$other_date) {
$diff_timestmp=$other_date- $now_timeStamp;
/////////////////////////////////seconds/////////////////////////////////////////////////////
if ($diff_timestmp<60) {
if ($diff_timestmp==1) {
return $diff_timestmp . ' sec';
}else{
return $diff_timestmp . ' secs';
}

//////////////////////////////////////minutes/////////////////////////////////////////////////////////
} elseif($diff_timestmp>=60 && $diff_timestmp<3600) {
if (round(($diff_timestmp/60))==1) {
return round(($diff_timestmp/60)). ' min ';
}else{
return round(($diff_timestmp/60)). ' mins ';
}
//////////////////////////////////////hours/////////////////////////////////////////////////////////	
}elseif($diff_timestmp>=3600 && $diff_timestmp<86400) {

if (floor(($diff_timestmp/3600))==1) {

$time_remaining=floor(($diff_timestmp/3600)). ' hour';

if (floor((($diff_timestmp/3600)-floor($diff_timestmp/3600))*60 )==1) {

$time_remaining.=floor((($diff_timestmp/3600)-floor($diff_timestmp/3600))*60 ). ' min';

}elseif(floor((($diff_timestmp/3600)-floor($diff_timestmp/3600))*60 )>1){
$time_remaining.=floor((($diff_timestmp/3600)-floor($diff_timestmp/3600))*60 ). ' mins';

}
return $time_remaining;
}else{
$time_remaining = floor(($diff_timestmp/3600)). ' hours ';
if (floor((($diff_timestmp/3600)-floor($diff_timestmp/3600))*60 )==1) {

$time_remaining.=floor((($diff_timestmp/3600)-floor($diff_timestmp/3600))*60 ). ' min';

}elseif(floor((($diff_timestmp/3600)-floor($diff_timestmp/3600))*60 )>1){
$time_remaining.=floor((($diff_timestmp/3600)-floor($diff_timestmp/3600))*60 ). ' mins';

}
return $time_remaining;

}
//////////////////////////////////////days/////////////////////////////////////////////////////////
}elseif($diff_timestmp>=86400 && $diff_timestmp<86400 * 30) {

if (floor(($diff_timestmp/86400))==1) {

$time_remaining=floor(($diff_timestmp/86400)). ' day ';

if (floor((($diff_timestmp/86400)-floor($diff_timestmp/86400))*24)==1) {

$time_remaining.=floor((($diff_timestmp/86400)-floor($diff_timestmp/86400))*24 ). ' hour';

} elseif(floor((($diff_timestmp/86400)-floor($diff_timestmp/86400))*60 )>1) {

$time_remaining.=floor((($diff_timestmp/86400)-floor($diff_timestmp/86400))*24 ). ' hours';

}

return $time_remaining;
}else{
$time_remaining=floor(($diff_timestmp/86400)). ' days ';

if (floor((($diff_timestmp/86400)-floor($diff_timestmp/86400))*24 )==1) {

$time_remaining.=floor((($diff_timestmp/86400)-floor($diff_timestmp/86400))*24 ). ' hour';

} elseif(floor((($diff_timestmp/86400)-floor($diff_timestmp/86400))*60 )>1) {

$time_remaining.=floor((($diff_timestmp/86400)-floor($diff_timestmp/86400))*24 ). ' hours';

}

return $time_remaining;
}

// if need be////////////////////////////////////////////////////////////////////////////////////////////
}elseif($diff_timestmp>=86400 * 30 && $diff_timestmp<86400 * 365) {
if (round(($diff_timestmp/(86400 * 30)))==1) {
return round(($diff_timestmp/(86400 * 30))). ' month';
}else{
return round(($diff_timestmp/(86400 * 30))). ' months';
}

}else{
if (round(($diff_timestmp/(86400 * 365)))==1) {
return round(($diff_timestmp/(86400 * 365))). ' year';
}
return round(($diff_timestmp/(86400 * 365))). ' years';
}

}else{
$diff_timestmp=$now_timeStamp - $other_date;
if ($diff_timestmp<60) {
return $diff_timestmp . ' sec ago';
} elseif($diff_timestmp>=60 && $diff_timestmp<3600) {
return round(($diff_timestmp/60)). ' mins ago';
}elseif($diff_timestmp>=3600 && $diff_timestmp<86400) {
return round(($diff_timestmp/3600)). ' hours ago';
}elseif($diff_timestmp>=86400 && $diff_timestmp<86400 * 30) {
return round(($diff_timestmp/86400)). ' days ago';
}elseif($diff_timestmp>=86400 * 30 && $diff_timestmp<86400 * 365) {
return round(($diff_timestmp/(86400 * 30))). ' months ago';
}else{
return round(($diff_timestmp/(86400 * 365))). ' years ago';
}
}



} ?>

<?php  
# ////////////////////////////FILES////////////////////////////////////////// -->
function filesDownload($student_id, $project_id){
$dir="../FILES/{$student_id}/{$project_id}/";
$dir_="FILES/{$student_id}/{$project_id}/";
if (!file_exists($dir)) {
echo "No Files Attached"; 
}else{

$allFiles=scandir($dir);
$files=array_diff($allFiles, array('.', '..'));

if(empty($files)) {
echo "No Files Attached";
}else{
// $files = array('readme.txt', 'test.html', 'image.gif');\
$zipname =$dir."Order_". $project_id."_.zip";
$zip = new ZipArchive;
$zip->open($zipname, ZipArchive::CREATE);
echo '<ul class="list-group">';
foreach ($files as  $file) {
if (!file_exists($zipname)) {
$zip->addFile($dir."/".$file, $file);
} 
} ?>
<li class="list-group-item text-center "><a href="<?php echo $zipname ?>" class="text-success">Download as a zip</a><i
class="far fa-file-archive icon-r ml-3"></i></li>
<?php $zip->close();
$files=array_diff($allFiles, array('.', '..', "Order_". $project_id."_.zip"));
foreach ($files as  $file) {
?>
<li class="list-group-item">
<?php echo "<a href='../download?file=".urlencode($file)."&dir=".$dir_."'>".$file."</a><i class='fa fa-download ml-3 icon-r'></i><br/>";	 ?>
</li>


<?php }

}

?>

</ul>
<?php
}

}

/////////////////////SHOW RESULTS///////////////////////////
function resultsDownload($student_id, $project_id){

$dir="../RESULTS/{$student_id}/{$project_id}/DRAFT";
$dir_="RESULTS/{$student_id}/{$project_id}/DRAFT";
if (!file_exists($dir)) {
echo "No Files Attached"; 
}else{

$allFiles=scandir($dir);
$files=array_diff($allFiles, array('.', '..'));

if(empty($files)) {
// echo "No Files Attached";
}else{
// $files = array('readme.txt', 'test.html', 'image.gif');\
$zipname =$dir."Order_". $project_id."_.zip";
$zip = new ZipArchive;
$zip->open($zipname, ZipArchive::CREATE);
echo '<ul class="list-group">';
echo "<h2 class='text-center'>drafts</h2>";
foreach ($files as  $file) {
if (!file_exists($zipname)) {
$zip->addFile($dir."/".$file, $file);
} 
} ?>
<li class="list-group-item text-center "><a href="<?php echo $zipname ?>" class="text-success">Download as a zip</a><i
class="far fa-file-archive icon-r ml-3"></i></li>
<?php $zip->close();
$files=array_diff($allFiles, array('.', '..', "Order_". $project_id."_.zip"));
foreach ($files as  $file) {
?>
<!-- <h1>drafts</h1> -->
<li class="list-group-item">
<?php echo "<a href='../download?file=".urlencode($file)."&dir=".$dir_."'>".$file."</a><i class='fa fa-download ml-3 icon-r'></i><br/>";	 ?>
</li>


<?php }

}

?>

</ul>
<?php
}
/////////////////////////Final////////////////////////
$dir="../RESULTS/{$student_id}/{$project_id}/FINAL";
$dir_="RESULTS/{$student_id}/{$project_id}/FINAL";
if (!file_exists($dir)) {
// echo "No Files Attached"; 
}else{

$allFiles=scandir($dir);
$files=array_diff($allFiles, array('.', '..'));

if(empty($files)) {
// echo "No Files Attached";
}else{
// $files = array('readme.txt', 'test.html', 'image.gif');\
$zipname =$dir."Order_". $project_id."_.zip";
$zip = new ZipArchive;
$zip->open($zipname, ZipArchive::CREATE);
echo '<ul class="list-group">';
echo "<h2 class='text-center'>final</h2>";
foreach ($files as  $file) {
if (!file_exists($zipname)) {
$zip->addFile($dir."/".$file, $file);
} 
} ?>
<li class="list-group-item text-center "><a href="<?php echo $zipname ?>" class="text-success">Download as a zip</a><i
class="far fa-file-archive icon-r ml-3"></i></li>
<?php $zip->close();
$files=array_diff($allFiles, array('.', '..', "Order_". $project_id."_.zip"));
foreach ($files as  $file) {
?>
<!-- <h1>drafts</h1> -->
<li class="list-group-item">
<?php echo "<a href='../download?file=".urlencode($file)."&dir=".$dir_."'>".$file."</a><i class='fa fa-download ml-3 icon-r'></i><br/>";	 ?>
</li>


<?php }

}

?>

</ul>
<?php
}
/////////////////////////FINAL///////////////////////
}

/////////////////////SHOW RESULTS///////////////////////////



function manageFiles($student_id, $project_id){
$dir="../FILES/{$student_id}/{$project_id}/";
$dir_="FILES/{$student_id}/{$project_id}/";
if (!file_exists($dir)) {
echo "No Files Attached"; 
}else{

$allFiles=scandir($dir);
$files=array_diff($allFiles, array('.', '..'));

if(empty($files)) {
echo "No Files Attached";
}else{
// $files = array('readme.txt', 'test.html', 'image.gif');\
$zipname =$dir."Order_". $project_id."_.zip";
echo '<ul class="list-group">';
?>

<?php
$files=array_diff($allFiles, array('.', '..', "Order_". $project_id."_.zip"));
foreach ($files as  $file) {
?>
<li class="list-group-item">
<?php echo $file. "<a href='../delete_file?id={$project_id}&&file=".urlencode($file)."&dir=".$dir_."'> <span class='text-danger'> &nbsp; delete file.</span>  </a><br/>";	 ?>
</li>

<?php
}
}
}
}
////////////////////Show Files Without download////////


////////////////////Show Files Without download////////
function deleteFiles($student_id, $project_id){

$dir="../FILES/{$student_id}/{$project_id}/";
$dir_="FILES/{$student_id}/{$project_id}/";

if (!file_exists($dir)) {
// rmdir("../FILES/{$student_id}/{$project_id}");
}else{

$allFiles=scandir($dir);
$files=array_diff($allFiles, array('.', '..'));

if(empty($files)) {
rmdir("../FILES/{$student_id}/{$project_id}");
}else{
// $files = array('readme.txt', 'test.html', 'image.gif');\
$zipname =$dir."Order_". $project_id."_.zip";
foreach ($files as  $file) {
unlink("../FILES/{$student_id}/{$project_id}/".$file);
}
if (file_exists($zipname)) {
unlink($zipname);

}
rmdir("../FILES/{$student_id}/{$project_id}");

}

}
$directory = "../FILES/{$student_id}/";
if(file_exists($directory)){
// Directory


// Returns array of files
$files = scandir($directory);

// Count number of files and store them to variable..
$num_files = count($files)-2;
if ($num_files==0) {
rmdir("../FILES/{$student_id}");
}
}

}

?>
<?php 
function sendMail($details,$to, $subject, $reset=0){

if ($reset==1) {
require_once("./phpmailer/PHPMailerAutoload.php");
// $mail->isSMTP();
}else{
require_once("../phpmailer/PHPMailerAutoload.php");
}

$mail= new PHPMailer;
$mail->Host="smtp.gmail.com";
$mail->Port=587;
$mail->SMTPAuth=true;
$mail->SMTPSecure="TLS";// or ssl

$mail->SMTPdebug=2;
$mail->isHTML(true);
$mail->Username="admin@perfectgrader.com";
$mail->Password="perfectgrader.com";
$mail->setFrom("admin@perfectgrader.com", "PerfectGrader");
$mail->addAddress($to);
//or 465 if ssl
$mail->Subject=$subject;
$message = '<html lang="en">
<head>
<meta charset="UTF-8">
<title>PerferctGrader</title>
</head>
<body style="background-color: #fff;

min-height: 50vh;">
<div style="
width: 90%;
margin: 20px auto;
padding: 20px;
border-radius: 13px;
min-height: 20vh;
color: #000;
background-color: #ecf0f1;">
<div style="min-height: 50px; background: #27ae60; border-radius: 10px; margin-top: 10px; margin-left: 20px; text-align: left; padding-left: 30px; padding-top: 5px;">
<img style="height: 30px; width:30px; position: relative; bottom: -10px; right: -3px;" src="https://www.perfectgrader.com/assets/pen.png">
<span style="color: #f1c40f;">PerfectGrders</span></div>
<div style="font-size: 16px; line-height: 25px; color:#000;"> <br>'. $details .'<br>
<small style="font-size:13px;"><a href="https://www.perfectgrader.com" target="blank">For more details follow this link....</a></small>
<br>
<small>Date: '.date("Y-m-d H:i:s").'</small>
</div>
<div style="background: #27ae60; margin: 15px auto; color: #f1c40f; font-size: 14px; padding-top: 20px; border-radius: 10px; text-align: center; min-height: 40px;">Copyright © '.date("Y").' <a style="text-decoration:none; color: #f1c40f;" href="https://www.perfectgrader.com"> PerfectGrader.com </a>,All rights reserved.</div>
</div>

</body>
</html>';
$mail->Body=$message;

if ($mail->send()) {
// echo "Mail sent";
}else{
echo $mail->ErrorInfo;
}
}
/* 
* php delete function that deals with directories recursively
*/
function delete_files($target) {
if(is_dir($target)){
$files = glob( $target . '*', GLOB_MARK ); //GLOB_MARK adds a slash to directories returned

foreach( $files as $file ){
delete_files( $file );      
}

rmdir( $target );
} elseif(is_file($target)) {
unlink( $target );  
}
}
?>
<?php
//////////////////////Admin docs download//////////////////////////////

function docs_download($tutor_id){
$dir="../DOCS/{$tutor_id}/";
$dir_="DOCS/{$tutor_id}/";
if (!file_exists($dir)) {
echo "No Files Attached"; 
}else{

$allFiles=scandir($dir);
$files=array_diff($allFiles, array('.', '..'));

if(empty($files)) {
echo "No Files Attached";
}else{
echo '<ul class="list-group">';
 ?>
<?php
// $files=array_diff($allFiles, array('.', '..', "Order_". $project_id."_.zip"));
foreach ($files as  $file) {
?>
<li class="list-group-item">
<?php echo "<a href='../download?file=".urlencode($file)."&dir=".$dir_."'>".$file."</a><i class='fa fa-download ml-3 icon-r'></i><br/>";	 ?>
</li>


<?php }

}

?>

</ul>
<?php
}

}
?>
