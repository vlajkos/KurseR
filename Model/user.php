<?php
class User
{
    private $id;
    private $username;
    private $password;
    private $name;
    private $surname;
    private $is_admin;
    private $email;
    private $birthday;
    private $phone;
    public function __construct($id, $name, $surname, $username, $password, $email, $birthday, $phone, $is_admin = false)
    {
        $this->id = $id;
        $this->username = $username;
        $this->password = $password;
        $this->surname = $surname;
        $this->name = $name;
        $this->email = $email;
        $this->phone = $phone;
        $this->birthday = $birthday;
        $this->is_admin = $is_admin;

    }

    public function getId()
    {
        return $this->id;
    }
    public function setId($id)
    {
        $this->id = $id;
    }

    public function getName()
    {
        return $this->name;
    }
    public function setName($name)
    {
        $this->name = $name;
    }

    public function getSurname()
    {
        return $this->surname;
    }
    public function setSurname($surname)
    {
        $this->surname = $surname;
    }

    public function getUsername()
    {
        return $this->username;
    }
    public function setUsername($username)
    {
        $this->username = $username;
    }

    public function getEmail() {
        return $this->email;
    }

    public function setEmail($email) {
        $this->email = $email;
    }

    public function getBirthday() {
        return $this->birthday;
    }

    public function setBirthday($birthday) {
        $this->birthday = $birthday;
    }

    public function getPhone() {
        return $this->phone;
    }

    public function setPhone($phone) {
        $this->phone = $phone;
    }



    public function registerUser($conn)
    {
       
        $query = "INSERT INTO users (name, surname, username, password, email, birthday, phone)
        VALUES ('{$this->name}', '{$this->surname}', '{$this->username}', '{$this->password}','{$this->email}', '{$this->birthday}', '{$this->phone}')";
        return $conn->query($query);
    }

    public function checkUsername($conn)
    {
        $query = "SELECT * FROM users
                  WHERE username= '{$this->username}'";
        $result = $conn->query($query);

        if ($result->num_rows === 0) {
            
            return true;
        }
        else { 
            $_SESSION["registration-error"] = 'Korisničko ime je zauzeto!';
            return false;
        }
    }
    public function checkRegistration($name, $surname, $username, $email, $phone, $password)
    {
        
        if (
            (strlen($name) >= 2 && strlen($name) <= 24) && (strlen($surname) >= 2 && strlen($surname) <= 24) && (strlen($email) > 4 && strlen($email) <= 128)
            && (strlen($username) >= 4 && strlen($username) <= 24) && (strlen($password) >= 8 && strlen($password) <= 128) &&
            (strlen($phone) >= 6 && strlen($phone) <= 24)
            )
        {
            return true;  
        } else {
        $_SESSION["registration-error"] = 'Greška prilikom registracije!';
            return false;
        }

    }

    public function logIn($conn)
    {
        $username = $this->username;
        $query = "SELECT * FROM users
            WHERE username = '$username' AND password = '{$this->password}'";
        $result = $conn->query($query);
        return $result;


    }




}