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
    $courseController = new CourseController($courseModel);
    $courseFound = 0;
?>
<div class="main-content">
  <?php
    $currentCourse;
    foreach($courses as $course):
    if ($course->getSlug() == $_GET['slug']) { 
        $courseFound = 1;
        $currentCourse = $course;

    if (isset($_POST['addInstructorToCourse']))  {
  
          $courseModel->addInstructors($course->getId(), $_POST['instructor']);
        }
   ?>

    
    <div class="course-container">
            <h2><?php echo $course->getName() ?></h2>

             <p><?php echo $course->getBody() ?></p>

             <div class="course-instructors-container">
                <h2>Instruktori:</h2>
                <div class="course-instructors-main">
                  <?php 
                  $currentCourse->addView($currentCourse);
                  $instructors = $course->getInstructors();
                  foreach($instructors as $instructor):
                    
                   
                  ?>
                  
                    <div class="course-instructors-sub">
                    <a href="<?php echo 'instructor.php?slug=' . $instructor->getSlug(); ?>"> <?php echo $instructor->getName() . ' ' . $instructor->getSurname() ?></a>
                    <img width= 160 height= 160 src="<?php echo 'Images/Profile/' .$instructor->getImage() ?>" alt="">
                    </div>
                  <?php
                   endforeach;
                   ?>
                 
                  
                  
                 
  


                 
                
                </div>
                
                 <?php
                  // SAMO AKO JE USER ADMIN 
                  //Proveravamo koji instruktori već predaju na ovom kursu kako en bismo mogli ponovo da ih dodamo
                  $instructorModel = new InstructorModel($conn);
                  $allInstructors  = $instructorModel->getAllInstructors();
                   if (isset($_SESSION['is_admin']) && $_SESSION['is_admin']):
                    
                  
                  ?>
                <form action="" method="POST">
                 <h3>Dodaj Instruktora</h3>
                    <select name="instructor" id="">
                    <?php foreach($allInstructors as $instructor):
                    // Instruktor je prikazan samo ako već nije predavač na kursu 
                      if(!in_array( $instructor, $instructors)):
                      ?>
                      
                      
                      <option  value="<?php echo $instructor->getSlug() ?>"> <?php echo $instructor->getName()?></option>
                    <?php  endif; endforeach; ?>
                    </select>
                     <input type="submit" name="addInstructorToCourse" value="Dodaj">
                  </form>
                  <?php 
                 
                endif;
               ?>
             </div>  
             <div class="course-date">
                <p>Početak Kursa:</p>
                <date> <?php 
                $date =$course->getDate();
                $dateTime = new DateTime($date);
                echo $dateTime->format("d.m.Y.") ?> </date>
             </div>
            
    </div>
    
    <?php break;  }
     endforeach;
     if ($courseFound == 0):
     ?>
     <div class="course-container">
        <h2>Nepostojeći kurs!</h2>
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