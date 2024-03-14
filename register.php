<?php
session_start();
require "handler/dbBroker.php";
require "model/user.php";
$conn = Database::connectDatabase();


if (isset($_SESSION['id'])) {
    header("Location: index.php");
}

if (isset($_POST["name"]) && isset($_POST["username"]) && isset($_POST["password"]) && isset($_POST["surname"]) && isset($_POST["birthday"]) && isset($_POST["email"]) && isset($_POST["phone"])) {

    $name = $_POST["name"];
    $username = $_POST["username"];
    $password = $_POST["password"];
    $surname = $_POST["surname"];

    $email = $_POST["email"];
    $birthday = $_POST["birthday"];
    $phone = $_POST["phone"];
    $user = new User(1, $name, $surname, $username, $password,  $email, $birthday, $phone);

    if ($user->checkRegistration($name, $surname, $username, $email, $phone, $password) && $user->checkUsername($conn)) {
        $user->registerUser($conn);
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
        }
    } else {}
       






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
<div class="register-container">
    <form action="#" class="register-form" method="POST">
        <h2>Registruj se i postani član KurseR porodice!</h2>

        <div id="name_error"></div>
        <div class="register-input-container">        
            <input class="register-input-field" type="text" placeholder="Vaše ime" name="name" id="name" value="<?php echo isset($_POST['name']) ? htmlspecialchars($_POST['name']) : ''; ?>">
        </div>

        <div id="surname_error"></div>
        <div class="register-input-container"> 
            <input class="register-input-field" type="text" placeholder="Vaše prezime" name="surname" id="surname" value="<?php echo isset($_POST['surname']) ? htmlspecialchars($_POST['surname']) : ''; ?>">
        </div>

        <div id="username_error"></div>
        <div class="register-input-container">
            <input class="register-input-field" type="text" placeholder="Vaše Korisničko Ime" name="username" id="username" value="<?php echo isset($_POST['username']) ? htmlspecialchars($_POST['username']) : ''; ?>">
        </div>

        <div id="password_error"></div>
        <div class="register-input-container">
            <input class="register-input-field" type="password" placeholder="Vaša Lozinka" name="password" id="password">
        </div>
        <div id="email_error"></div>
        <div class="register-input-container"> 
            <input class="register-input-field" type="email" placeholder="Vaš Imejl" name="email" id="email" value="<?php echo isset($_POST['email']) ? htmlspecialchars($_POST['email']) : ''; ?>">
        </div>

        <div id="birthday_error"></div>
        <div class="register-input-container" id="register-input-container-birthday">
            <p>Vaš Datum Rođenja</p>
            <input class="register-input-field" type="date" name="birthday" id="birthday" value="<?php echo isset($_POST['birthday']) ? htmlspecialchars($_POST['birthday']) : ''; ?>">
        </div>

        <div id="phone_error"></div>
        <div class="register-input-container">
            <input class="register-input-field" type="text" placeholder="Vaš Broj Telefona" name="phone" id="phone" value="<?php echo isset($_POST['phone']) ? htmlspecialchars($_POST['phone']) : ''; ?>">
        </div>
        
        <?php 
        if (isset($_SESSION['registration-error'])):
        ?>
        <div id="error">
            <?php
            echo $_SESSION['registration-error'];
            ?>
        </div>
        <?php 
        unset($_SESSION['registration-error']);
        endif;
        ?>
        
        <button type="submit" class="register-btn">Register</button>
    </form>
</div>

<?php
include 'footer.php'
    ?>
</div>

<script>
    let register_form = document.querySelector('.register-form');
    register_form.addEventListener("submit", (event) => {
        event.preventDefault();
        if (validation()) {
            register_form.submit();
        }
    });
    function validation() {
       let name = document.getElementById('name').value;
       let surname = document.getElementById("surname").value;
       let username = document.getElementById("username").value;
       let password = document.getElementById("password").value;
       let phone = document.getElementById("phone").value;
        // if (name == '' || surname == '' || username == '' || password == '') {
        //     document.getElementById("endresult").innerHTML = "Something is missing, enter all of informations";
        //     return false;
        // }

        let truth = true;
        if (name.length < 2 || name.lengh > 24) {
            document.getElementById("name_error").innerHTML = "Ime mora imati između 2 i 24 karaktera";
            truth = false;

        }
        else document.getElementById("name_error").innerHTML = '';

        if (surname.length < 2 || surname.lengh > 24) {
            document.getElementById("surname_error").innerHTML = "Prezime mora imati između 2 i 24 karaktera";
            truth = false;
        }
        else document.getElementById("surname_error").innerHTML = '';

        if (username.length < 4 ||  username.length > 24) {
            document.getElementById("username_error").innerHTML = "Korisničko ime mora imati između 4 i 24 karaktera";
            truth = false;
        }
        else document.getElementById("username_error").innerHTML = '';

        if (password.length < 8) {
            document.getElementById("password_error").innerHTML = "Šifra mora imati bar 8 karaktera";
            truth = false;
        }

        if (phone.length < 6 || phone.length > 24) {
            document.getElementById("phone_error").innerHTML = "Neispravan broj telefona";
            truth = false;
        }
        else document.getElementById("phone_error").innerHTML = '';


        return truth;


    }
</script>

</body>

</html>