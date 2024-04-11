<?php
    session_start();
    if (!isset($_SESSION["username"])) {
    ?>
        <script type="text/javascript">
            window.location="login.php";
        </script>
    <?php
    }

    include 'inc/connection.php';
    $id = $_GET["id"];

    // Determine whether the ID corresponds to a student or a teacher
    $student_result = mysqli_query($link, "SELECT * FROM student WHERE student_number = $id");
    $teacher_result = mysqli_query($link, "SELECT * FROM teacher WHERE id_number = $id");

    if (mysqli_num_rows($student_result) > 0) {
        // If the ID corresponds to a student
        mysqli_query($link, "UPDATE student SET status='yes', verified='yes' WHERE student_number = $id");
        echo "<script>alert('Student account activated successfully!'); window.location='all-student-info.php';</script>";
    } elseif (mysqli_num_rows($teacher_result) > 0) {
        // If the ID corresponds to a teacher
        mysqli_query($link, "UPDATE teacher SET status='yes', verified='yes' WHERE id_number = $id");
        echo "<script>alert('Teacher account activated successfully!'); window.location='all-teacher-info.php';</script>";
    } else {
        // If the ID does not correspond to either a student or a teacher
        echo "<script>alert('Invalid ID.'); window.location='index.php';</script>";
    }
?>
