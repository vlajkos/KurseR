<?php 
class Instructor {
    private $name;
    private $surname;
    private $slug;
    private $image;
    private $biography;
    private $email;
  

    public function __construct($name, $surname, $slug, $image, $biography, $email ) {
        $this->name = $name;
        $this->surname = $surname;
        $this->slug = $slug;
        $this->image = $image;
        $this->biography = $biography;
        $this->email = $email;
       

    }

    public function getName() {
        return $this->name;
    }

    public function getSurname() {
        return $this->surname;
    }

    public function getBiography() {
        return $this->biography;
    }

    public function getImage() {
        return $this->image;
    }

    public function getEmail() {
        return $this->email;
    }
    public function getSlug() {
        return $this->slug;
    }


    // Setters
    public function setBiography($biography){
          $this->biography = $biography;
        }

    public function setImage($image) {
        $this->image = $image;
    }

    public function setName($name) {
        $this->name = $name;
    }

    public function setSurname($surname) {
        $this->surname = $surname;
    }

    
}

class InstructorModel {
    private static $conn;
    
        public function __construct($conn) {
            self::$conn = $conn;
        }
    
        public static  function getAllInstructors() {
            $sql = "SELECT * FROM instructors";
            $result = self::$conn->query($sql);
    
            // Check if there are results
            if ($result->num_rows > 0) {
                $instructors = [];
                while ($row = $result->fetch_assoc()) {
                    $instructors[] = new Instructor($row['name'], $row['surname'], $row['slug'], $row['image'], $row['biography'], $row['email']);
                }
                return $instructors;
            } else {
                return [];
            }
        }

        public function createInstructor($name, $surname, $slug, $image, $biography, $email)
        {
            
        
            $sql = "INSERT INTO instructors (name, surname, slug, image, biography, email) 
                    VALUES ('$name', '$surname', '$slug', '$image', '$biography', '$email')";
        
            return self::$conn->query($sql);
        }
        
    } 
