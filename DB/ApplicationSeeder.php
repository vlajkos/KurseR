<?php
$sqlCreateApplicationsTable = "CREATE TABLE IF NOT EXISTS applications(
    id INT AUTO_INCREMENT PRIMARY KEY,
    course_id INT,
    user_id INT,
    checked TINYINT(1) DEFAULT 0,
    application_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (course_id) REFERENCES courses(id),
    FOREIGN KEY (user_id) REFERENCES users(id)
)";

if ($conn->query($sqlCreateApplicationsTable) === TRUE) {
    echo "Table 'applications' created successfully.\n";
} else {
    echo "Error creating table: " . $conn->error . "\n";
}


function create_application($course_id, $user_id, $randomDate, $checked)
{
    $conn = Database::connectDatabase(); 

    // Prepare the SQL statement
    $sql = "INSERT INTO applications (course_id, user_id, application_date, checked) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("isss", $course_id, $user_id, $randomDate, $checked);

    // Execute the statement
    if ($stmt->execute()) {
        echo "Application created successfully for Course ID: $course_id, User ID: $user_id, Date: $randomDate, Checked: $checked\n";
    } else {
        echo "Error creating application: " . $stmt->error . "\n";
    }

    $stmt->close();
}

create_application(1, 3, '2023-12-23', 1);
create_application(2, 4, '2023-12-23', 1);
create_application(3, 5, '2023-12-23', 1);
create_application(4, 6, '2024-01-02', 0);
create_application(5, 7, '2024-01-03', 0);
create_application(1, 8, '2023-12-23', 1);
create_application(2, 9, '2024-01-03', 0);
create_application(3, 10, '2024-01-03', 0);
create_application(4, 11, '2023-12-21', 1);
create_application(5, 12, '2024-01-03', 0);
create_application(1, 13, '2024-01-04', 0);
create_application(2, 14, '2024-01-05', 0);
create_application(3, 15, '2024-01-06', 0);
create_application(4, 16, '2023-12-14', 1);
create_application(5, 17, '2024-01-06', 0);
create_application(1, 18, '2023-12-30', 1);
create_application(2, 19, '2023-12-24', 1);
create_application(3, 20, '2023-12-29', 1);
create_application(4, 21, '2023-12-31', 1);
create_application(5, 22, '2023-12-26', 1);
create_application(1, 23, '2023-12-22', 1);
create_application(2, 24, '2023-12-28', 1);
create_application(3, 25, '2023-12-23', 1);
create_application(4, 26, '2023-12-25', 1);
create_application(5, 27, '2023-12-27', 1);
create_application(1, 28, '2024-01-01', 1);
create_application(2, 29, '2024-01-01', 1);
create_application(3, 30, '2024-01-01', 1);
create_application(4, 31, '2024-01-02', 1);
create_application(5, 32, '2024-01-02', 1);
create_application(1, 33, '2024-01-01', 1);
create_application(2, 34, '2024-01-06', 0);
create_application(3, 35, '2024-01-01', 1);
create_application(4, 36, '2024-01-01', 1);
create_application(5, 37, '2024-01-02', 1);
create_application(1, 38, '2023-12-21', 1);
create_application(2, 39, '2023-12-27', 1);
create_application(3, 40, '2024-01-09', 0);
















?>