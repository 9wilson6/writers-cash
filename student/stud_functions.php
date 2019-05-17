<?php 
function create_post(){
  if (isset($_POST['submit'])) {

global $success, $error, $date_global, $db;
// echo date("Y-m-d H:i:sa", strtotime($date_global));
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
        $student_id=$_SESSION['user_id'];
  $sql="INSERT INTO projects(title, subject, academic_level, style, type_of_paper, deadline, pages, sources, instructions, budget, student_id, DATE_CREATED) VALUES('$title', '$subject','$academic_level','$style','$papertype','$datetyme','$pages','$sources', '$instructions', '$budget', '$student_id', '$date_global')";
  $result=$db->query($sql);
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
  
  $user_type=$_SESSION['user_type'];
 $querys="INSERT INTO notifications(user_type, note) VALUES('$user_type','$note')";
  $db->query($querys);
  $querys="INSERT INTO notifications(user_type, note, user_id) VALUES(3,'$note2', '$student_id')";
  $db->query($querys);
  // ........,,,,,,,,,,,,,,,,,,,,,,,,,,notification,,,,,,,,,,,,,,,,,
  // 
  // 
  // ,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,//
    if(count($_FILES['file']['name'])==0) {
    $success="Homework Posted files Successfully";
}else{
 
    filesUpload($student_id, $results->project_id);
      $success="Homework Posted Successfully";

   }
   // $success="Homework Posted Successfully";
  
  }else{
$error="Was not Successfully Posted try again";
  }
}
}
 function create_class(){

  if (isset($_POST['submit_class'])) {
    global $success, $error, $date_global, $db;
    $subject=$db->escape($_POST['subject']);
    $budget=$db->escape($_POST['budget']);
    $instructions=$db->escape($_POST['instructions']);
    $student_id=$_SESSION['user_id'];
    $class_query="INSERT into classes(student_id, budget, instructions, subject, date_created)VALUES('$student_id','$budget','$instructions','$subject', '$date_global') ";
    if ($db->query($class_query)) {
   $success="Class created successfully";  
    //,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,notification,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,
  //
  //
  //
  //,,,,,,,,,,,,,,,,,,,,,,,,,, //
  $date_global=strtotime($date_global);
  $note="Student ID: ". $student_id." posted a new class at ".date("Y-m-d H:i:sa",$date_global);
  $note2="You posted a new class at ".date("Y-m-d H:i:sa",$date_global);
  
  $user_type=$_SESSION['user_type'];
 $querys="INSERT INTO notifications(user_type, note) VALUES('$user_type','$note')";
  $db->query($querys);
  $querys="INSERT INTO notifications(user_type, note, user_id) VALUES(3,'$note2', '$student_id')";
  $db->query($querys);
  // ........,,,,,,,,,,,,,,,,,,,,,,,,,,notification,,,,,,,,,,,,,,,,,
  // 
  // 
  // ,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,//
    }else{

$error="Class not created";
    }

  }
 }
function edit_post(){
if (isset($_POST['edit'])) {
require_once("../dbconfig/dbconnect.php");
global $success, $error, $date_global;
// echo date("Y-m-d H:i:sa", strtotime($date_global));
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
        $student_id=$_SESSION['user_id'];
        $project_id=$_POST['project_id'];
// die("we done here");

  $query="UPDATE projects SET title='$title',subject='$subject',academic_level='$academic_level',style='$style', type_of_paper='$papertype', deadline='$datetyme',pages='$pages',sources='$sources',instructions='$instructions',budget='$budget',student_id='$student_id' WHERE project_id='$project_id'";


  if ($db->query($query)) {
   
    /////////////////////////////////notification/////////////////////////////////////////////
    $note="Student Id: ".  $student_id." edited project id: ".$project_id." at ".date("Y-m-d H:i:sa",$date_global);
    $note2="You Edited project id: ".$project_id." at ".date("Y-m-d H:i:sa",$date_global);
    $user_type=$_SESSION['user_type'];
    $querys="INSERT INTO notifications(user_type, note) VALUES('$user_type','$note')";
    $db->query($querys);
    $querys="INSERT INTO notifications(user_type, note, user_id) VALUES(3,'$note2', '$student_id')";
    $db->query($querys);
      /////////////////////////////////notification/////////////////////////////////////////////
      $success="Homework Updated Successfully";
       header("location:my-homework-details?id=".urlencode(convert_uuencode($project_id)));
  }else{
$error="Was not Successfully Posted try again";
header("location:homework_edit?id=".urlencode(convert_uuencode($project_id))."&error=".$error);
  }
}
}

function class_edit(){

global $success, $error, $date_global, $db;
if (isset($_POST['edit_class'])) {
  $homework_id=$_POST['project_id'];
  $subject=$db->escape($_POST['subject']);
  $budget=$db->escape($_POST['budget']);
  $instructions=$db->escape($_POST['instructions']);
  $class_edit_query="UPDATE classes SET subject='$subject', budget='$budget', instructions='$instructions' WHERE project_id='$homework_id' ";
if ($db->query($class_edit_query)) {
   $student_id=$_SESSION['user_id'];
    /////////////////////////////////notification/////////////////////////////////////////////
    $note="Student Id: ".  $student_id." edited class id: ".$project_id." at ".date("Y-m-d H:i:sa",$date_global);
    $note2="You Edited class id: ".$project_id." at ".date("Y-m-d H:i:sa",$date_global);
    $user_type=$_SESSION['user_type'];
    $querys="INSERT INTO notifications(user_type, note) VALUES('$user_type','$note')";
    $db->query($querys);
    $querys="INSERT INTO notifications(user_type, note, user_id) VALUES(3,'$note2', '$student_id')";
    $db->query($querys);
  $success="Class updated successfully";
 header("location:my-class-details?id=".urlencode(convert_uuencode($homework_id)));
  }else{
$error="Was not Successfully Posted try again";
header("location:class_edit?id=".urlencode(convert_uuencode($homework_id))."&error=".$error);
  }

}
}

  function filesUpload($student_id, $project_id){

  if (!file_exists('../FILES/'.$student_id.'/'.$project_id.'/')) {
       mkdir('../FILES/'.$student_id.'/'.$project_id.'/', 0777, true);
       $dir="../FILES/{$student_id}/{$project_id}/";
       }else{
          $dir="../FILES/{$student_id}/{$project_id}/";
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
// function bids($order_id){
//   $query="SELECT COUNT(bid)"
// }
 ?>
