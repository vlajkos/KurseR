<?php
$sqlCreateTable = "CREATE TABLE IF NOT EXISTS course_instructor(
    course_id INT,
    instructor_id INT,
    PRIMARY KEY (course_id, instructor_id),
    FOREIGN KEY (course_id) REFERENCES courses(id),
    FOREIGN KEY (instructor_id) REFERENCES instructors(id)
)";




if ($conn->query($sqlCreateTable) === TRUE) {
    echo "Table 'course-instructor' created successfully.\n";
} else {
    echo "Error creating table: " . $conn->error . "\n";
}



function create_course_instructor($course_id, $instructor_id)
{
    $conn = Database::connectDatabase(); // Assuming you have a method like this in your Database class

    // Prepare the SQL statement
    $sql = "INSERT INTO course_instructor (course_id, instructor_id) VALUES (?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ii", $course_id, $instructor_id);

    // Execute the statement
    if ($stmt->execute()) {
        echo "course_instructor created successfully.\n";
    } else {
        echo "Error creating course_instructor: " . $stmt->error . "\n";
    }

    $stmt->close();
}


$course_instructor = create_course_instructor(5, 5);
$course_instructor = create_course_instructor(4, 4);
$course_instructor = create_course_instructor(1, 1);
$course_instructor = create_course_instructor(1, 2);
$course_instructor = create_course_instructor(2, 3);
$course_instructor = create_course_instructor(3, 6);



?>