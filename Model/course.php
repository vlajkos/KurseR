
 <?php 
 class Course {
        private $name;
        private $date;
        private $body;
        private $views;
        private $instructors = [];
    
        public function __construct($name, $date, $body, $views) {
            $this->name = $name;
            $this->date = $date;
            $this->body = $body;
            $this->views = $views;
            
        }
    
        public function getName() {
            return $this->name;
        }
    
        public function getDate() {
            return $this->date;
        }
    
        public function getBody() {
            return $this->body;
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
    
        public function addInstructor(Instructor $instructor) {
            $this->instructors[] = $instructor;
        }
    
        public function getInstructors() {
            return $this->instructors;
        }
    
        public function getAllCourses() {
            return CourseModel::getAllCourses();
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
                    $courses[] = new Course($row['name'], $row['date'], $row['body'], $row['views']);
                }
                return $courses;
            } else {
                return [];
            }
        }
    } 
    
    


