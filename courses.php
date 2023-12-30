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
   ?>
   <div class="content-container">
   <?php 
    $courseModel = new CourseModel($conn);
    $courses = $courseModel->getAllCourses();
    foreach($courses as $course):
    if (!$course) { ?>
 
    <h2>Trenutno nemamo raspoložive kurseve. Posetite nas ponovo! </h2>
    <?php } else { ?>
  <div class="content-container-div">
        <a href="<?php echo 'course.php?slug=' .$course->getSlug()  ?>" class="courses-link"></a>
        <h2><?php echo $course->getName() ?> </h2>
        <div class="courses-content">
            <div class="courses-image-container">
                <img width=120 height=130  src="<?php echo 'Images/Courses/' . $course->getImage(); ?>" alt="Course  Image">
            </div>
            <p><?php echo substr($course->getBody(), 0, 255) . "..." ?> </p>
        </div>
        

           
    

 </div>   
<?php
}
 endforeach   
?>
</div>
<footer>
<?php
    include 'footer.php';
 ?>
</footer>
</body>


</html>