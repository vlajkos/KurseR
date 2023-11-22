<div class="nav">
   <div class="menu">
       <!-- logo sa klikom na povratak na pocetnu stranicu -->
        <div class="logo">
        <a href="index.php"><img src="Images/logo.png" width="90px" height="90px"></a>
        </div>
        <!-- meni -->
        <div >
            <nav>
                <ul>
                    <li><a href="index.php">Kursevi</a></li>
                    <li><a href="lyrics.php">Predavači</a></li>
                    <li><a href="lyrics.php">Akcije</a></li>
                    <li><a href="about.php">O nama</a></li>
                    <?php
                    if (isset($_SESSION["is_admin"]) && $_SESSION["is_admin"] == 1):
                        ?>
                        <li><a href="admin.php">Admin panel</a></li>
                        <?php
                    endif
                    ?>
                </ul>
            </nav>
        </div>
        
    </div>
    <div class="login-links-container">
        <?php
        if (!in_array(basename($_SERVER['PHP_SELF']), ['login.php', 'register.php']) && !isset($_SESSION['id'])) {
            // Condition 1: Not on login.php or register.php and not logged in
            echo '<div class="login">
            <a href="login.php">Login</a>';
            echo '<div></div>';
            echo '<a href="register.php">Register</a> </div>';
        } elseif (isset($_SESSION['id'])) {
            // Condition (not on login.php or register.php)
            echo "<p>" . ucfirst($_SESSION['name']) . ' ' .
                ucfirst($_SESSION['surname']) . "</p>";
            ?>
            <form action="handler/logout.php" method="POST"> <input type="submit" name="logout" value="Logout"></form>
            <?php
        } else {
           
        }
        ?>

    </div>
    
</div>
