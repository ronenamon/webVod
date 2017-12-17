<?php
/**
 * Created by PhpStorm.
 * User: ronen
 * Date: 09/12/2017
 * Time: 21:28
 */


require_once "DBconfig.php";



class Functions{

    private $db;

    public function __construct() {
        //instance of DB
        $this -> db = new DBconfig();

    }

    /*
    //json object
    {
       "operation":"register",
       "user":{
            "name":"Ronen Amon",
            "email":"ronenamon@hotmail.com",
            "password":"123123"
       }
    }
    */

    public function addNewMovie($movieName , $movieYear , $movieAddBy , $movieDescription){

        $db = $this->db;

        //if all params isset then add new movie

    }
    public function registerUser($name, $email, $password) {

        $db = $this -> db;

        if (!empty($name) && !empty($email) && !empty($password)) {

            if ($db-> checkUserExist($email)) {

                $response["result"] = "failure";
                $response["message"] = "User Already Registered !";
                return json_encode($response);

            } else {

                $result = $db -> insertData($name, $email, $password);

                if ($result) {

                    $response["result"] = "success";
                    $response["message"] = "User Registered Successfully !";
                    return json_encode($response);

                } else {

                    $response["result"] = "failure";
                    $response["message"] = "Registration Failure";
                    return json_encode($response);

                }
            }
        } else {

            return $this -> getMsgParamNotEmpty();

        }
    }
    /*
     //json object
     {
       "operation":"login",
       "user":{
           "email":"ronenamon@hotmail.com",
           "password":"123123"
       }
    }
     */
    public function loginUser($email, $password) {

        $db = $this -> db;

        if (!empty($email) && !empty($password)) {

            if ($db -> checkUserExist($email)) {
                $result =  $db -> checkLogin($email, $password);
                //echo $result;
                if(!$result) {

                    $response["result"] = "failure";
                    $response["message"] = "Invaild Login Credentials";
                    return json_encode($response);

                } else {
                    
                    $response["result"] = "success";
                    $response["message"] = "Login Sucessful";
                    $_SESSION['login_user'] = $email;
                    return json_encode($response);

                }
            } else {

                $response["result"] = "failure";
                $response["message"] = "Invaild Login Credentials";
                return json_encode($response);

            }
        } else {

            return $this -> getMsgParamNotEmpty();
        }
    }
    /*
    {
       "operation":"chgPass",
       "user":{
           "email":"raj.amalw@learn2crack.com",
           "old_password":"rajamal",
           "new_password":"rajamalw"
       }
    }
     *  */
    public function changePassword($email, $old_password, $new_password) {

        $db = $this -> db;

        if (!empty($email) && !empty($old_password) && !empty($new_password)) {

            if(!$db -> checkLogin($email, $old_password)){

                $response["result"] = "failure";
                $response["message"] = 'Invalid Old Password';
                return json_encode($response);

            } else {

                $result = $db -> changePassword($email, $new_password);

                if($result) {

                    $response["result"] = "success";
                    $response["message"] = "Password Changed Successfully";
                    return json_encode($response);

                } else {

                    $response["result"] = "failure";
                    $response["message"] = 'Error Updating Password';
                    return json_encode($response);

                }
            }
        } else {

            return $this -> getMsgParamNotEmpty();
        }
    }

    public function isEmailValid($email){

        return filter_var($email, FILTER_VALIDATE_EMAIL);
    }

    public function getMsgParamNotEmpty(){

        $response["result"] = "failure";
        $response["message"] = "Parameters should not be empty !";
        return json_encode($response);

    }

    public function getMsgInvalidParam(){

        $response["result"] = "failure";
        $response["message"] = "Invalid Parameters";
        return json_encode($response);

    }

    public function getMsgInvalidEmail(){

        $response["result"] = "failure";
        $response["message"] = "Invalid Email";
        return json_encode($response);

    }
}





?>