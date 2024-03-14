<?php 
session_start();
include 'common.php';
require_once "handler/dbBroker.php";

require_once 'Model/Course.php';
require_once 'Handler/InstructorController.php';
require_once 'Handler/CourseController.php';

if(isset($_SESSION['is_admin']) && $_SESSION['is_admin'] == 1){
$conn = Database::connectDatabase();

?>
<?php

if (isset($_POST['name']) && isset($_POST['surname']) && isset($_POST['slug']) && isset($_POST['biography']) && isset($_POST['email'])) {
   
    $uploadDir = 'Images/Profile/'; // Directory where uploaded images will be stored
    
    $model = new InstructorModel($conn); 
    
    $instructor_controller = new InstructorController($model);
    $result = $instructor_controller->createInstructor(
        $_POST['name'],
        $_POST['surname'],
        $_POST['slug'],
        $_FILES['image']['name'],
        $_POST['biography'],
        $_POST['email']
    );
    
}


?>


<body>
<?php
    include 'header.php';
?>

<div class="admin-application-container">
    <a href="applications.php"><h2>Prijave za kurseve</h2></a>
</div>
 
<div class="admin-add-instructor-container">

<h2>Dodaj Instruktora</h2>
<form class="admin-add-instructor" action="" method=POST enctype="multipart/form-data">
    <input type="text" name="name" id="" placeholder="Ime" >
    <input type="text" name="surname" id="" placeholder="Prezime">
    <input type="text" name="slug" id="" placeholder="Slug">
    <input type="email" name="email" id="" placeholder="Email">
    <textarea name="biography" id="" cols="30" rows="10" placeholder="Biografija"></textarea>
    <label for="fileInput">
    Izaberi Sliku:
    <input type="file" id="img" name="image" accept="image/*">
  </label>
  
  <img class="default-profile-photo" id="image-preview-default" src="https://cdn-icons-png.flaticon.com/512/21/21104.png" alt="">
  <div class="image-preview-container">
            <div id="image-preview" class="hidden height=120 width=120">
            </div>
  </div>
 
    <button type="submit" name="submit">Submit</button>
</form>


</div>

<div class="graph-container-main">
    <h2>Statistika najpregledanijih Kurseva</h2>
<div class="graph-container">
  
               <div class="graph-course-names">
                    <?php
                     $courseModel = new CourseModel($conn);
                     $courses = $courseModel->getAllCourses();
                    for ($i = 0; $i < count($courses); $i++):
                        $course = $courses[$i];
                        ?>
                        <p>Kurs
                            <?php echo ($i + 1) . " = " .
                                $course->getName() . " ( " . $course->getViews() . ' pregleda' . " )" ?>
                        </p>

                        <?php
                    endfor
                    ?>
                </div>
<div class="graph">
                    <p class="graph-percentage">25%-</p>
                    <p class="graph-percentage">50%-</p>
                    <p class="graph-percentage">75%-</p>
                    <p class="graph-percentage">100%-</p>
                    <?php
                   
                
                    for ($i = 0; $i < count($courses); $i++):
                        $course = $courses[$i];
                        $percentage = CourseController::getPercentage($conn, $course);
                        ?>
                        <div class="graph-item" style="height:<?php echo $percentage . '%' ?>">
                            <p>Kurs
                                <?php echo ($i + 1) ?>
                            </p>

                        </div>
                        <?php
                    endfor
                    ?>


                </div>
</div>
</div>
<script>
    // Function to handle file input change event
    function previewImage(input) {

        const preview = document.getElementById('image-preview');
        const default_preview = document.getElementById('image-preview-default');
        
        if (input.files && input.files[0]) {
            const reader = new FileReader();

            reader.onload = function(e) {
                preview.style.backgroundImage = `url('${e.target.result}')`;
                preview.classList.remove('hidden');
                default_preview.classList.add('hidden');

            };

            reader.readAsDataURL(input.files[0]);
        } else {
            preview.src = '';
            preview.classList.add('hidden');
        }
    }

    // Attach an event listener to the file input
    const fileInput = document.getElementById('img');
    fileInput.addEventListener('change', function() {
        previewImage(this);
    });
</script>








 
<?php
    include 'footer.php';
 ?>

</body>
<?php } else echo 'NEDOZVOLJEN PRISTUP' 
 ?>





</html>