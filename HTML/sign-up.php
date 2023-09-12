<?php
    session_start();

    $name = $email = $password = $passwordEncrypted = $account = "";
    $error = "";

    if(isset($_POST['submit']))
    {
        $UserId = 1;
        $storagePath = '../jsonFiles/Users.json';

        // get to the Users.json
        $storage = json_decode(file_get_contents($storagePath), true);
        $Users = $storage['Users'];

        function getInput(){
            if(empty($_POST['name']) || empty($_POST['email']) || empty($_POST['password']) || empty($_POST['account'])){
                $GLOBALS['error'] = 'all feilds are required';
                return false;
            }
            $GLOBALS['name'] = filter_var(trim($_POST['name']), FILTER_SANITIZE_STRING);

            $GLOBALS['email'] = filter_var(trim($_POST['email']), FILTER_SANITIZE_EMAIL);

            $GLOBALS['password'] = filter_var(trim($_POST['password']), FILTER_SANITIZE_STRING);

            $GLOBALS['account'] = $_POST['account'];

            return true;
        }

        function checkIfUserExists(){
            global $Users, $UserId;
            foreach($Users as $User){
                $UserId += 1;
                if($User['email'] == $GLOBALS['email'])
                {
                    $GLOBALS['error'] = 'this account already exists';
                    return true;
                }
            }
            return false;
        }

        function insertNewUser(){
            global $passwordEncrypted, $name, $account, $email, $Users, $newUser, $storage, $storagePath, $UserId, $error;

            $newUser = [
                "id" => $UserId,
                "name" => $name,
                "passwordEncrypted" => $passwordEncrypted,
                "email" => $email,
                "account" => $account,
                "PlaysAddedId" => []
            ];
            
            array_push($Users,$newUser);
            $storage['Users'] = $Users;
    
            if(!file_put_contents($storagePath, json_encode($storage, JSON_PRETTY_PRINT))){
                $error = "Could'nt save the data";
                return false;
            }
            return true;
        }

        if(getInput()){  // figure out why password encryption is not working inside the getInput() function
            $passwordEncrypted = password_hash($password, PASSWORD_DEFAULT);
            if(!checkIfUserExists()){
                if(insertNewUser()){
                    $_SESSION['UserId'] = $UserId;
                    header('location: homePage.php');
            }
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
    <link rel="stylesheet" href="../CSS/sign-up.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Fredoka:wght@300;400;500;600&display=swap" rel="stylesheet">
</head>
<body>
    <span class="siteName">Ticketsnerd</span>
    <div>
        <form class="container" method="POST" action="<?PHP echo $_SERVER['PHP_SELF']; ?>">
            <div class="upper-half">
                <div class="logo">
                    <img src="../icons/theater_comedy_FILL0_wght400_GRAD0_opsz48.png" alt="" class="icon">
                </div>
                <div class="first-row-container">
                    <div>
                        <label>Name</label><br>
                        <input type="text" class="input" style="width: 125px;" name="name">
                    </div>
                    <div>
                        <label>Account</label><br>
                        <select class="input" style="width: 125px;" name="account"> <!-- hopefully replace it with a drop down menu (javascript)-->
                            <option selected disabled>Select</option>
                            <option value="vendor">Vendor</option>
                            <option value="customer">Customer</option>
                        </select>
                    </div>
                </div>
                <div>
                    <label>Email</label><br>
                    <input type="email" class="input" name="email">
                </div>
                <div>
                    <label>Password</label><br>
                    <input type="password" class="input" name="password" minlength="8"><br> <!-- !!!!!!!!  password validation  !!!!!!! -->
                </div>
            </div>
            <p class="error"><?php echo $error; ?></p>
            <button type="submit" name="submit">Sign up</button>
            <p class="paragraph">already have an account? <a href="sign-inv2.php">Sign in</a></p>
        </form>
    </div>
    <div>
        <img src="../pics/circle-highres.png" alt="doodle" class="bigIMG">
    </div>
</body>
</html>