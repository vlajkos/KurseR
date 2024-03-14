<?php 
session_start();
include 'common.php';
require_once "handler/dbBroker.php";

require_once 'Model/Course.php';
require_once 'Handler/InstructorController.php';
require_once 'Handler/CourseController.php';
require_once 'Model/Application.php';
if(isset($_SESSION['is_admin']) && $_SESSION['is_admin'] == 1){
$conn = Database::connectDatabase();

if (isset($_POST['submit_check']))  {
    $applicationModel = new ApplicationModel($conn);
    $applicationModel->check($_POST['check']);

}
?>


<body>
<?php
    include 'header.php';
?>

    <div class="content-container">
    <table class="applications-table">
            <?php 
            $applicationModel = new ApplicationModel($conn);
            $applications = $applicationModel->getAllApplications();
            usort($applications, function ($a, $b) {
                return strtotime($b->getApplicationDate()) - strtotime($a->getApplicationDate());
            });
            
            ?>
           
            <thead>
                <tr>
                    <th><h3>Kurs</h3></th>
                    <th><h3>Ime</h3></th>
                    <th><h3>Telefon</h3></th>
                    <th><h3>Imejl</h3></th>
                    <th><h3>Datum</h3></th>
                </tr>
            </thead>
            <tbody>
            <?php 
             foreach ($applications as $application):
                $user = $application->getRelatedUser();
                $course = $application->getRelatedCourse();
                $checked = $application->getChecked();
            ?>
            
            
                 <tr <?php if (!$checked) echo "style='background-color:#FFD580'" ?>>
                
                     <td style="font-weight:700">
                        <?php echo $course->getName(); ?>
                     </td>
                     <td>
                        <?php echo $user->getName() . ' ' .  $user->getSurname(); ?>
                     </td>
                     <td>
                        <?php echo $user->getPhone(); ?>
                     </td>
                     <td>
                        <?php echo $user->getEmail(); ?>
                     </td>
                     <td><?php 
                     $date = strtotime($application->getApplicationDate());
                     $formattedDate = date('d.m.Y', $date);
                     echo $formattedDate?></td>
                     <?php if (!$checked): ?>
    <td> 
        <form method="POST">
            <input type="submit" name="submit_check" value="X" />
            <input type="hidden" name="check" value="<?php echo $application->getId(); ?>">
        </form> 
    </td>
<?php endif; ?>
                     
                 </tr>
            <?php 
            endforeach;
            ?>
            </tbody>
    


           
        </table>
    </div>


<?php
    include 'footer.php';
?>
</body>


<?php } else echo 'NEDOZVOLJEN PRISTUP' ?>



</html>