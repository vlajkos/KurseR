<?php
include 'User.php';
class Application {
    private $id;
    private $courseId;
    private $userId;
    private $checked;
    private $applicationDate;

    public function __construct($id, $courseId, $userId, $applicationDate, $checked) {
        $this->id = $id;
        $this->courseId = $courseId;
        $this->userId = $userId;
        $this->applicationDate = $applicationDate;
        $this->checked = $checked;
    }

    public function getId() {
        return $this->id;
    }
    public function getChecked() {
        return $this->checked;
    }

    public function getCourseId() {
        return $this->courseId;
    }

    public function getUserId() {
        return $this->userId;
    }

    public function getApplicationDate() {
        return $this->applicationDate;
    }
    public function getRelatedUser() {
        return ApplicationModel::getRelatedUser($this->id);
    }
    public function getRelatedCourse() {
        return ApplicationModel::getRelatedCourse($this->id);
    }
}



class ApplicationModel {
    private static $db;

    public function __construct($db) {
        self::$db = $db;
    }

    public static function getAllApplications() {
        $sql = "SELECT * FROM applications";
        $result = self::$db->query($sql);

        // Check if there are results
        if ($result->num_rows > 0) {
            $applications = [];
            while ($row = $result->fetch_assoc()) {
                $applications[] = new Application(
                    $row['id'],
                    $row['course_id'],
                    $row['user_id'],
                    $row['application_date'],
                    $row['checked']
                );
            }
            return $applications;
        } else {
            return [];
        }
    }

    public static function getRelatedCourse($application_id) {
        $sql = "SELECT courses.* FROM courses
                INNER JOIN applications ON applications.course_id = courses.id
                WHERE applications.id = ?";
        $stmt = self::$db->prepare($sql);
        $stmt->bind_param("i", $application_id);
    
        // Execute the statement
        $stmt->execute();
    
        // Get the result set from the prepared statement
        $result = $stmt->get_result();
    
        // Check if there are results
        if ($result->num_rows > 0) {
            $courseData = $result->fetch_assoc();
            return new Course($courseData['id'], $courseData['name'], $courseData['slug'], $courseData['date'], $courseData['body'], $courseData['image'], $courseData['views']);
        } else {
            return null;
        }
    }

    public static function getRelatedUser($application_id) {
        $sql = "SELECT users.* FROM users
                INNER JOIN applications ON applications.user_id = users.id
                WHERE applications.id = ?";
        $stmt = self::$db->prepare($sql);
        $stmt->bind_param("i", $application_id);
    
        // Execute the statement
        $stmt->execute();
    
        // Get the result set from the prepared statement
        $result = $stmt->get_result();
    
        // Check if there are results
        if ($result->num_rows > 0) {
            $userData = $result->fetch_assoc();
            return new User($userData['id'], $userData['name'], $userData['surname'], ['username'], ['password'], $userData['email'], $userData['birthday'], $userData['phone']); // Add other user properties as needed
        } else {
            return null;
        }
    }
    public static function createApplication($course_id, $user_id) {
        $conn = Database::connectDatabase();
    
        // Use the current date as the application date
        $currentDate = date('Y-m-d');
    
        // Set the "checked" field to 0 for all applications
        $checked = 0;
    
        // Prepare the SQL statement
        $sql = "INSERT INTO applications (course_id, user_id, application_date, checked) VALUES (?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("iisi", $course_id, $user_id, $currentDate, $checked);
    
        // Execute the statement
        if ($stmt->execute()) {
           
        } else {
            echo "Error creating application: " . $stmt->error . "\n";
        }
    
        $stmt->close();
    }
    
    public function check($id) {
        $sql = "UPDATE applications SET checked = 1 WHERE id = ?";
        $stmt = self::$db->prepare($sql);
        $stmt->bind_param("i", $id);

        if ($stmt->execute()) {
        } else {
        echo "Error checking application: " . $stmt->error . "\n";
        }

    $stmt->close();

    }
    
}

?>


