<?php
class CourseController {
    private $courseModel;

    public function __construct($courseModel) {
        $this->courseModel = $courseModel;
    }

    public function getAllCourses() {
        $courses = $this->courseModel->getAllCourses();
        return $courses;
    }
    public function getInstructors() {
        $instructors = $this->courseModel->getInstructors();
        return $instructors;
    }

    public static function totalViews($conn)
    {
        $courses = $conn->query("SELECT * FROM courses");
        $totalViews = 0;
        foreach ($courses as $course) {
            $totalViews += $course['views'];
        }
        return $totalViews;

    }

    public static function getPercentage($conn, $course)
    {
        $totalViews = self::totalViews($conn);
        $percentage = ($course->getViews() * 100) / $totalViews;
        $percentage = number_format($percentage, 2);
        return $percentage;
    }
}