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
    <div class="login">
        <a href="login.php">Prijava</a>
        <a href="register.php">Registracija</a>
    </div>
</div>
