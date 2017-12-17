<?php

session_start();

require_once 'Functions.php';

//instance of Functions
$fun = new Functions();

if ($_SERVER['REQUEST_METHOD'] == 'POST')
{

    //var_dump($_POST);
    $data = $_POST;
    //$data = json_decode(file_get_contents("php://input"));
    //var_dump($data);

    if(isset($data['operation'])) {

        $operation = $data['operation'];

        if(!empty($operation)){

            if($operation == 'register'){

                if( isset($data['user']) && !empty($data['user']) && isset($data['email'])
                    && isset($data['password']) ) {

                    $name = $data['user'];
                    $email = $data['email'];
                    $password = $data['password'];

                    if ($fun -> isEmailValid($email)) {

                        echo $fun -> registerUser($name, $email, $password);

                    } else {

                        echo $fun -> getMsgInvalidEmail();
                    }

                } else {

                    echo $fun -> getMsgInvalidParam();

                }

            }else if($operation == 'addNewMovie'){
                
                if(isset($data['movieName']) && isset($data['movieYear']) ){





                }else{

                }
                /*
                 *  // user : $("#username").val(),
                    movieName        : $("#movie_name").val(),
                    movieYear        : $("#movie_year").val(),
                    movieAddBy       : "ronenAdd",
                    movieDescription : $("#movie_description").val() ,
                    moviePublish     : $("#movie_publish").val(),
                    operation        : "addNewMovie" */





            }else if ($operation == 'login') {

                if(isset($data['email']) && isset($data['password'])){

                    //$user = $data -> user;
                    $email = $data['email'];
                    $password = $data['password'];

                    echo $fun -> loginUser($email, $password);


                } else {

                    echo $fun -> getMsgInvalidParam();

                }
            } else if ($operation == 'chgPass') {

                if(isset($data -> user ) && !empty($data -> user) && isset($data -> user -> email) && isset($data -> user -> old_password)
                    && isset($data -> user -> new_password)){

                    $user = $data -> user;
                    $email = $user -> email;
                    $old_password = $user -> old_password;
                    $new_password = $user -> new_password;

                    echo $fun -> changePassword($email, $old_password, $new_password);

                } else {

                    echo $fun -> getMsgInvalidParam();

                }
            }else if ($operation == 'test') {
                $response["result"] = "success";
                $response["message"] = "API Work with POST";
                echo json_encode($response);
            }
        }else{

            echo $fun -> getMsgParamNotEmpty();

        }
    } else {

        echo $fun -> getMsgInvalidParam();

    }
} else if ($_SERVER['REQUEST_METHOD'] == 'GET'){

    $response["result"] = "success";
    $response["message"] = "API Work";
    echo json_encode($response);

}
?>
