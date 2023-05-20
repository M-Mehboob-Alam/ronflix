<?php
    require_once('includes/config.php');
    require_once('includes/classes/FormSanitizer.php');
    require_once('includes/classes/Constant.php');
    require_once("includes/classes/Account.php");
    $account = new Account($con);
    if(isset($_POST["submitButton"])) {
         $firstName = FromSanitizer::sanitizeFormName($_POST['firstName']);
         $lastName = FromSanitizer::sanitizeFormName($_POST['lastName']);
         $userName = FromSanitizer::sanitizeFormUsername($_POST['username']);
         $email = FromSanitizer::sanitizeFormEmail($_POST['email']);
         $email2 = FromSanitizer::sanitizeFormEmail($_POST['email2']);
         $password = FromSanitizer::sanitizeFormPassword($_POST['password']);
         $password2 = FromSanitizer::sanitizeFormPassword($_POST['password2']);

        $success =  $account->registerValidate($firstName, $lastName,$userName,$email,$email2, $password,$password2);
        if($success){
            // store sesssion 
            $_SESSION['loggedInUser'] = $userName;
            header('Location: index.php');
        }
    }
    
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Welcome to Reeceflix</title>
        <link rel="stylesheet" type="text/css" href="assets/style/style.css" />
    </head>
    <body>
        
        <div class="signInContainer">

            <div class="column">

                <div class="header">
                    <img src="assets/images/logo.png" title="Logo" alt="Site logo" />
                    <h3>Sign Up</h3>
                    <span>to continue to Reeceflix</span>
                </div>

                <form method="POST">
                    <span style="color:red">
                    <?php echo $account->getError(Constant::$firstName); ?>
                    </span>
                    
                    <input type="text" name="firstName" placeholder="First name" required>
                    <span style="color:red">
                    <?php echo $account->getError(Constant::$lastName); ?>
                    </span>
                    <input type="text" name="lastName" placeholder="Last name" required>
                    <span style="color:red">
                    <?php echo $account->getError(Constant::$username); ?>
                    </span>
                    <span style="color:red">
                    <?php echo $account->getError(Constant::$usernameTaken); ?>
                    </span>
                    <input type="text" name="username" placeholder="Username" required>
                    <span style="color:red">
                    <?php echo $account->getError(Constant::$emailNotEqqual); ?>
                    </span>
                    <span style="color:red">
                    <?php echo $account->getError(Constant::$emalTaken); ?>
                    </span>
                    <span style="color:red">
                    <?php echo $account->getError(Constant::$emailNotValid); ?>
                    </span>
                    <input type="email" name="email" placeholder="Email" required>

                    <input type="email" name="email2" placeholder="Confirm email" required>
                    <span style="color:red">
                    <?php echo $account->getError(Constant::$passwordNotEqqual); ?>
                    </span>
                   
                    <span style="color:red">
                    <?php echo $account->getError(Constant::$passwordNotValid); ?>
                    </span>
                    <input type="password" name="password" placeholder="Password" required>

                    <input type="password" name="password2" placeholder="Confirm password" required>

                    <input type="submit" name="submitButton" value="SUBMIT">

                </form>

                <a href="login.php" class="signInMessage">Already have an account? Sign in here!</a>

            </div>

        </div>

    </body>
</html>