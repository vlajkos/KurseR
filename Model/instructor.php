<?php 
class Instructor {
    private $name;
    private $surname;
    private $picture;
    private $bio;
    private $courses = [];

    public function __construct($name, $surname, $picture) {
        $this->name = $name;
        $this->surname = $surname;
        $this->picture = $picture;
    }

    public function getName() {
        return $this->name;
    }

    public function getSurname() {
        return $this->surname;
    }

    public function getBio() {
        return $this->bio;
    }

    public function getPicture() {
        return $this->picture;
    }

    public function addCourse(Course $course) {
        $this->courses[] = $course;
    }

    public function getCourses() {
        return $this->courses;
    }

    // Setters
    public function setBio($bio) {
        $this->bio = $bio;
    }

    public function setPicture($picture) {
        $this->picture = $picture;
    }

    public function setName($name) {
        $this->name = $name;
    }

    public function setSurname($surname) {
        $this->surname = $surname;
    }
}
