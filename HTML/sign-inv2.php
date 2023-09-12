<?php
    session_start();

    $email = $password = "";
    $error = "";
    $UserId = 1;

    if(isset($_POST['submit'])){
        
        $storagePath = '../jsonFiles/Users.json';

        // get to the Users.json
        $storage = json_decode(file_get_contents($storagePath), true);
        $Users = $storage['Users'];

        function getInput(){
            if(empty($_POST['email']) || empty($_POST['password'])){
                $GLOBALS['error'] = 'all feilds are required';
                return false;
            }

            $GLOBALS['email'] = filter_var(trim($_POST['email']), FILTER_SANITIZE_EMAIL);

            $GLOBALS['password'] = filter_var(trim($_POST['password']), FILTER_SANITIZE_STRING);

            return true;
        }

        function checkUserInfo(){
            global $Users, $UserId;
            foreach($Users as $User){
                if($User['email'] == $GLOBALS['email'] && password_verify($GLOBALS['password'], $User['passwordEncrypted']))
                {
                    $UserId = $User['id'];
                    return true;
                }
            }
            $GLOBALS['error'] = 'User not found';
            return false;
        }

        if(getInput()){
            if(checkUserInfo()){
                $_SESSION['UserId'] = $UserId;
                header('location: homePage.php');
            }
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>sign in</title>
    <link rel="stylesheet" href="../CSS/sign-inv2.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Fredoka:wght@300;400;500;600&display=swap" rel="stylesheet">
</head>
<body>
    <span class="siteName">Ticketnerd</span>
    <div>
        <form class="container" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
            <div class="logo">
                <img src="../icons/theater_comedy_FILL0_wght400_GRAD0_opsz48.png" alt="" class="icon">
            </div>
            <div>
                <label>Email</label><br>
                <input type="email" class="input" name="email">
            </div>
            <div>
                <label>Password</label><br>
                <input type="password" class="input" name="password">
            </div>
            <div class="checkbox-container">
                <input id="checkbox" type="checkbox" class="checkbox">
                <label for="checkbox">Remember me</label>
                <p class="error"><?php echo $error; ?></p>
            </div>
            <button type="submit" name="submit">Sign in</button>
            <p>Don't have an account? <a href="sign-up.php">Sign up</a></p>
        </form>
    </div>
    <div>
        <img src="../pics/circle-highres.png" alt="doodle" class="bigIMG">
    </div>
</body>
</html>