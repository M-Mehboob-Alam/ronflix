<?php
class Account {
    private $con;
    private $errorOfArray = array();
    public function __construct($con){
        $this->con = $con;
    }

    public function registerValidate($fn, $ln,$un, $em,$em2, $pas, $pas2){
        $this->validateFirstName($fn);
        $this->validateLastName($ln);
        $this->validateUserName($un);
        $this->validateEmail($em,$em2);
        $this->validatePassword($pas,$pas2);
        if(empty($this->errorOfArray)){
            return $this->insertUserDetails($fn, $ln,$un, $em, $pas);
        }
        return false;


    }

    public function loginUser($un, $pas){
        $pas = hash("sha512",$pas);
        $query = $this->con->prepare("SELECT * FROM users where username=:un AND password=:pa");
        $query->bindValue(':un',$un);
        $query->bindValue(':pa',$pas);
        $query->execute();
        if($query->rowCount() == 1){
            return true;
        }
        array_push($this->errorOfArray, Constant::$loginFailed);
        return false;
    }
    private function insertUserDetails($fn, $ln,$un, $em, $pas){


        $pas = hash("sha512",$pas);
        $query = $this->con->prepare("INSERT INTO users (firstName, lastName, userName,email, password) VALUES (:fn,:ln,:un,:em,:pa)");
        $query->bindValue(':fn',$fn);
        $query->bindValue(':ln',$ln);
        $query->bindValue(':un',$un);
        $query->bindValue(':em',$em);
        $query->bindValue(':pa',$pas);
        return $query->execute();
    }
    private function validateFirstName($name){
        if(strlen($name) < 2 || strlen($name) > 25){
            array_push($this->errorOfArray, Constant::$firstName);
        }
    }
    private function validateLastName($name){
        if(strlen($name) < 2 || strlen($name) > 25){
            array_push($this->errorOfArray, Constant::$lastName);
        }
    }
    private function validatePassword($password,$password2){
        if($password != $password2){
            array_push($this->errorOfArray, Constant::$passwordNotEqqual);
            return;
        }
        if(strlen($password) < 2 || strlen($password) > 25){
            array_push($this->errorOfArray, Constant::$passwordNotValid);
            return;
        }
    }
    private function validateUserName($name){
        if(strlen($name) < 2 || strlen($name) > 25){
            array_push($this->errorOfArray, Constant::$lastName);
            return;
        }

        $query = $this->con->prepare("SELECT * from users where username=:un");
        $query->bindValue(":un",$name);
        $query->execute();
        if($query->rowCount() != 0){
            array_push($this->errorOfArray, Constant::$usernameTaken);
        }
    }
    private function validateEmail($email, $email2){
        if($email != $email2){
            array_push($this->errorOfArray, Constant::$emailNotEqqual);
            return;
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            array_push($this->errorOfArray, Constant::$emailNotValid);
            return;
          } 
        $query = $this->con->prepare("SELECT * from users where email=:email");
        $query->bindValue(":email",$email);
        $query->execute();
        if($query->rowCount() != 0){
            array_push($this->errorOfArray, Constant::$emalTaken);
        }
    }

    public function getError($input){
        if(in_array( $input,$this->errorOfArray)){
            return $input;
        }
    }
}
?>