<?php 
session_start();
require_once "handler/dbBroker.php";
require_once "handler/CourseController.php";
require_once 'Model/Instructor.php';
$conn = Database::connectDatabase();
include 'common.php';




?>



<body>

<?php
    include 'header.php';
   
    $instructorModel = new InstructorModel($conn);
    $instructors = $instructorModel->getAllInstructors();
?>
<div class="content-container">
<?php
    foreach($instructors as $instructor):
    if (!$instructor) { ?>
    <h2>Trenutno nemamo instruktore! </h2>
    <?php } else { ?>
    
     <div class="content-container-div">
        <a href="<?php echo 'instructor.php?slug=' .$instructor->getSlug()  ?>" class="courses-link"></a>
        <h2><?php echo $instructor->getName() . " " . $instructor->getSurname()  ?> </h2>
        <div class="courses-content">
            <div class="courses-image-container">
                <img width=120 height=130  src="<?php echo 'Images/Profile/' . $instructor->getImage(); ?>" alt="Instructor Image">
            </div>
            <p><?php echo substr($instructor->getBiography(), 0, 255) . "..." ?> </p>
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