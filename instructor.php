<?php 
session_start();
require_once "handler/dbBroker.php";
require_once 'Model/Instructor.php';
$conn = Database::connectDatabase();
include 'common.php';




?>



<body>
<?php
    include 'header.php';
   
    $instructorModel = new InstructorModel($conn);
    $instructors = $instructorModel->getAllInstructors();
    $instructorFound = 0;
?>
<div class="main-content">
  <?php
    foreach($instructors as $instructor):
    if ($instructor->getSlug() == $_GET['slug']) { 
        $instructorFound = 1;
   ?>

    
    <div class="course-container instructor-container">
    
        <div class = "instructor-header">
            <h2><?php echo $instructor->getName() . " " . $instructor->getSurname() ?></h2>
            <div class="courses-image-container">
                <img width=120  src="<?php echo 'Images/Profile/' . $instructor->getImage(); ?>" alt="Instructor Image">
            </div>
        </div>
            

        <p><?php echo $instructor->getBiography() ?></p>

           
            
    </div>
    
    <?php break;  }
     endforeach;
     if ($instructorFound == 0):
     ?>
     <div class="course-container">
        <h2>Nepostojeći predavač!</h2>
     </div>
    <?php endif;
    ?>
</div>
<footer>
<?php
    include 'footer.php';
 ?>
</footer>
</body>


</html>