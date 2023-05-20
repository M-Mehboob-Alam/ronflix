<?php
   require_once('includes/config.php');
   require_once('includes/classes/FormSanitizer.php');
   require_once('includes/classes/Constant.php');
   require_once("includes/classes/Account.php");
   $account = new Account($con);
    if(isset($_POST["submitButton"])) {
      
        $userName = FromSanitizer::sanitizeFormUsername($_POST['username']);
        $password = FromSanitizer::sanitizeFormPassword($_POST['password']);
      

       $success =  $account->loginUser($userName, $password);
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
                    <h3>Sign In</h3>
                    <span>to continue to Reeceflix</span>
                </div>

                <form method="POST">

                   <span style="color:red">
                     <?php echo $account->getError(Constant::$loginFailed); ?>
                    </span>
                    <input type="text" name="username" placeholder="Username" required>

                    <input type="password" name="password" placeholder="Password" required>

                    <input type="submit" name="submitButton" value="SUBMIT">

                </form>

                <a href="register.php" class="signInMessage">Need an account? Sign up here!</a>

            </div>

        </div>

    </body>
</html>