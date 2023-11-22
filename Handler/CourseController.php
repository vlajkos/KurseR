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
}