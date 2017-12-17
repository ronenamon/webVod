<?php
/**
 * Created by PhpStorm.
 * User: ronen amon
 *
 * Developer: Ronen Amon At Apache With Mamp
 * This File Have: The functions such as connecting with MySQL database and execution of queries are defined in this file.
 *
 */

class DBconfig{

    private $host = 'localhost';
    private $user = 'root';
    private $pass = 'root';
    private $db = 'newmovies';
    private $conn;

    public function __construct() {

        //PDO Connections => $dbh = new PDO('mysql:host=localhost;dbname=test', $user, $pass);

        try{

            $this -> conn = new PDO("mysql:host=".$this -> host.";dbname=".$this -> db, $this -> user, $this -> pass);

        }catch (PDOException $e) {

            print "Error!: " . $e->getMessage() . "<br/>";
            die();
        }

    }




// New User for registration which accepts name, email and password
    public function insertData($name,$email,$password){

        $unique_id = uniqid('', true);

        $sql = 'INSERT INTO users SET unique_id =:unique_id,
                                      name =:name,
                                      email =:email,
                                      pass =:password,
                                      created_at = NOW(),
                                      admin = 1';


        $query = $this ->conn->prepare($sql);
        $query->execute(array('unique_id' => $unique_id, ':name' => $name, ':email' => $email,
            ':password' => $password));

        if ($query) {

            return true;

        } else {

            return false;

        }
    }



    public function insertNewMovie(){
        $sql = '';

    }

    public function checkLogin($email, $password) {

        $sql = 'SELECT * FROM users WHERE email = :email';
        $query = $this -> conn -> prepare($sql);
        $query -> execute(array(':email' => $email));
        $data = $query -> fetchObject();


        $user["username"] = $data -> username;
        $user["email"] = $data -> email;
        $user["unique_id"] = $data -> unique_id;
        return $user;

//    } else {
//
//        return false;
//    }
    }

    public function changePassword($email, $password){

        $hash = $this -> getHash($password);
        $encrypted_password = $hash["encrypted"];
        $salt = $hash["salt"];

        $sql = 'UPDATE users SET encrypted_password = :encrypted_password, salt = :salt WHERE email = :email';
        $query = $this -> conn -> prepare($sql);
        $query -> execute(array(':email' => $email, ':encrypted_password' => $encrypted_password, ':salt' => $salt));

        if ($query) {

            return true;

        } else {

            return false;

        }
    }


    // if user with same email exist!
    public function checkUserExist($email){

        $sql = 'SELECT COUNT(*) from users WHERE email =:email';
        $query = $this -> conn -> prepare($sql);
        $query -> execute(array('email' => $email));
        if($query){

            $row_count = $query -> fetchColumn();

            if ($row_count == 0){

                return false;

            } else {

                return true;

            }
        } else {

            return false;
        }
    }
}

?>

