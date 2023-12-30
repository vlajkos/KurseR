<?php

include_once __DIR__ . '/../Model/Instructor.php';



class InstructorController
{
    private $model;

    public function __construct($model)
    {
        $this->model = $model;
    }

    public function createInstructor($name, $surname, $slug, $image, $biography, $email)
    {
      
        // File upload handling
        $uploadDir = 'Images/Profile/';
        $tempFilePath = $_FILES['image']['tmp_name'];
        $newFileName = uniqid() . '_' . $image;
        $targetFilePath = $uploadDir . $newFileName;
        if (move_uploaded_file($tempFilePath, $targetFilePath)) {
            // Insert instructor data into the database using the model
            $result = $this->model->createInstructor($name, $surname, $slug, $newFileName, $biography, $email);

            header("Location: http://localhost/kurser/instructors.php");
            exit(); // Make sure to exit after the header to prevent further execution
         
        }

    
    }
}

?>
