
 <?php 
 include 'Instructor.php';
 class Course {
        private $id;
        private $name;
        private $slug;
        private $date;
        private $body;
        private $views;
        private $image;
       
    
        public function __construct($id, $name, $slug, $date, $body, $image, $views) {
            $this->id = $id;
            $this->name = $name;
            $this->slug = $slug;
            $this->date = $date;
            $this->body = $body;
            $this->image = $image;
            $this->views = $views;
            
        }
    
        public function getId() {
            return $this->id;
        }
        public function getName() {
            return $this->name;
        }

        public function getSlug() {
            return $this->slug;
        }
    
        public function getDate() {
            return $this->date;
        }
    
        public function getBody() {
            return $this->body;
        }
        public function getImage() {
            return $this->image;
        }
    
        public function getViews() {
            return $this->views;
        }
    
        public function setName($name) {
            $this->name = $name;
        }
    
        public function setDate($date) {
            $this->date = $date;
        }
    
        public function setBody($body) {
            $this->body = $body;
        }
    
        public function setViews($views) {
            $this->views = $views;
        }
    
       
    
        public function getAllCourses() {
            return CourseModel::getAllCourses();
        }
        public function getInstructors() {
            return CourseModel::getInstructors($this->id);
        }
        public function addView($course) {
            return CourseModel::addView($course);
        }
    }
    
class CourseModel {
    private static $db;
    
        public function __construct($db) {
            self::$db = $db;
        }
    
        public static  function getAllCourses() {
            $sql = "SELECT * FROM courses";
            $result = self::$db->query($sql);
    
            // Check if there are results
            if ($result->num_rows > 0) {
                $courses = [];
                while ($row = $result->fetch_assoc()) {
                    $courses[] = new Course($row['id'], $row['name'], $row['slug'], $row['date'], $row['body'], $row['image'], $row['views']);
                }
                return $courses;
            } else {
                return [];
            }
        }
        public static function getInstructors($course_id) {
            // Select all instructors for the given course
            $sql = "SELECT instructors.* FROM instructors
                    INNER JOIN course_instructor ON instructors.id = course_instructor.instructor_id
                    WHERE course_instructor.course_id = ?";
            $stmt = self::$db->prepare($sql);
            $stmt->bind_param("i", $course_id);
        
            // Execute the statement
            $stmt->execute();
        
            // Get the result set from the prepared statement
            $result = $stmt->get_result();
        
            // Check if there are results
            if ($result->num_rows > 0) {
                $instructors = [];
               
                while ($row = $result->fetch_assoc()) {
                    $instructors[] = new Instructor($row['name'], $row['surname'], $row['slug'],$row['image'], $row['biography'], $row['email']);
                }
                return $instructors;
            } else {
                return [];
            }
        }

        public static function addInstructors($course_id, $slug) {
            // Assuming $conn is the database connection, and you have a table named 'instructors'
            $sql = "SELECT * FROM instructors WHERE slug = ?";
            $stmt = self::$db->prepare($sql);
            $stmt->bind_param("s", $slug);
        
            // Execute the statement
            $stmt->execute();
        
            // Get the result
            $result = $stmt->get_result();
        
            // Check if there are results
            if ($result->num_rows > 0) {
                $instructor = $result->fetch_assoc();
                
                // Insert the instructor into the course_instructor table
                $sqlInsert = "INSERT INTO course_instructor (course_id, instructor_id) VALUES (?, ?)";
                $stmtInsert = self::$db->prepare($sqlInsert);
                $stmtInsert->bind_param("ii", $course_id, $instructor['id']);
                $stmtInsert->execute();
                $stmtInsert->close();
        
                echo "Instructor added to the course successfully.\n";
            } else {
                echo "Instructor with the specified slug not found.\n";
            }
        
            $stmt->close();
        }
        public static function addView($course)
    {
        $slug = $course->getSlug();

        // Step 1: Select the course from the database
        $selectQuery = "SELECT * FROM courses WHERE slug = '$slug'";
        $selectResult = mysqli_query(self::$db, $selectQuery);

        if ($selectResult) {
            $row = mysqli_fetch_assoc($selectResult);
            

            // Step 2: Update the view count for the course
            $updateQuery = "UPDATE courses SET views = views + 1 WHERE slug = '$slug'";
            $updateResult = mysqli_query(self::$db, $updateQuery);

            if ($updateResult) {

            } else {
                return false;
            }



        } else {

            return false;
        }
    }


        
    } 
    


