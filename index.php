<?php 
session_start();
require_once "handler/dbBroker.php";
require_once "handler/CourseController.php";
require_once 'Model/Course.php';
$conn = Database::connectDatabase();
include 'common.php';




?>



<body>
<?php
    include 'header.php';
   
    $courseModel = new CourseModel($conn);
    $courses = $courseModel->getAllCourses();
    foreach($courses as $course):
    if (!$course) { ?>
    <h2>Trenutno nemamo raspoložive kurseve. Posetite nas ponovo! </h2>
    <?php } else { ?>
    

<h2><?php echo $course->getName() ?></h2>
<p><?php echo $course->getBody() ?></p>
<date> <?php echo $course->getDate() ?> </date>
        
<?php
}
 endforeach   
?>

</body>

<footer>
<?php
    include 'footer.php';
 ?>
</footer>
</html>