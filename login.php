<?php
require "handler/dbBroker.php";
require "model/user.php";
$conn = Database::connectDatabase();
session_start();


if (isset($_SESSION['id'])) {
    header("Location: index.php");
}


if (isset($_POST["username"]) && isset($_POST["password"]) && $_POST["username"] != "" && $_POST["password"] != "") {
    $username = $_POST["username"];
    $password = $_POST["password"];
    $user = new User(1, $name, $surname, $username, $password,  $email, $birthday, $phone);
    $result = $user->logIn($conn);
    $data = $result->fetch_array();

    if ($result->num_rows === 1) {
        $_SESSION["username"] = $username;
        $id = $data["id"];
        $_SESSION["id"] = $id;
        $_SESSION["name"] = $data["name"];
        $_SESSION["surname"] = $data["surname"];
        $_SESSION["is_admin"] = $data["is_admin"];
        header("Location: index.php");


    } else
        header("Location: login.php");
}

?>







<?php
 include 'common.php';
?>

<body>
    <!-- div za ceo sajt-->
    <div id="sajt">
        <!-- navigacioni bar-->
        <?php
         include 'header.php';
        ?>
        <!-- izmedju nav bara i footera -->
        <div id="mid">
        </div>
    </div>
</body>
<div class="login-container">
    <form action="#" class="login-form" method="POST">
        <h2>Logujte se pomoću korisničkog imena i lozinke</h2>

        <div class="login-input-container">
            <input class="login-input-field" type="text" placeholder="Unesite vaše korisničko ime" name="username" id="username">
        </div>


        <div class="login-input-container">
            <input class="login-input-field" type="password" placeholder="Unesite vašu lozinku" name="password" id="password">
        </div>
        <button type="submit" class="btn">Login</button>
</div>
<?php
include 'footer.php'
    ?>
</div>