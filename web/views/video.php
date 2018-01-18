<?php
  session_start();
  include "../../src/query.php";
  $sentFrom = "'".$_SESSION['id']."'";
  $query = new GetData($sentFrom);
  $type = "video";

  $role = "'".$_SESSION['role']."'";
  $teacher = "te";
  $student = "st";
  if($role=="'".$student."'")
  {
    $batch =  "'".$_SESSION['batch']."'";
    $year =  "'".$_SESSION['year']."'";
    $result = $query->getStudyMaterialForStudent($batch,$year,"'".$type."'");
  }
  else if($role=="'".$teacher."'")
  {
    $result = $query->getStudyMaterialMadeByMeById("'".$type."'");
  }

?>


<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="../css/bootstrap-4.0.0-alpha.6-dist/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="../css/bootstrap-4.0.0-alpha.6-dist/css/bootstrap.css">
    <title></title>
  </head>
  <body>
    <div style="text-align:center;" class="header" id="myHeader">
        <h1>Videos</h1>
    </div>

    <div class="row">
    <div class="col-md-1">

    </div>
    <div class="col-md-10" style="text-align:center;">
        <div class="row">
          <?php
            if($result)
            {
                foreach ($result as $row) {
                $fileName = basename($row['content'],".");
                $fileName = preg_replace("/\.[^.]+$/", "", $fileName);

                $path = "../../src/uploads/".$row['send_from']."/".$row['type']."/".$row['content']."";
                echo "
                <span style='margin:auto;'>
                  <video width='320' height='240' controls>
                    <source src='".$path."' type='video/mp4'>
                  Your browser does not support the video tag.
                  </video>
                  <p>$fileName</p>
                </span>";
              }
            }
            else{
              echo "no data available";
            }
           ?>
        </div>
   </div>
   <div class="col-md-1">

   </div>
 </div>
  </body>
</html>
