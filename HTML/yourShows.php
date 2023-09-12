<?php
    session_start();

	$storagePath = '../jsonFiles/Users.json';
	$storage = json_decode(file_get_contents($storagePath), true);
	$Users = $storage['Users'];
    $Plays = $storage['Plays'];

	$UserIndex = $_SESSION['UserId'] - 1;

    $PlayIdGET = 3;
    $error = '';

    if(isset($_GET['submit'])){
        $PlayIdGET = $_GET['PlayId'];
    }

    if(isset($_POST['remove'])){
        foreach($Plays as $Key => $play){
            if($Play['id'] == $PlalyIdGET){
                unset($Plays[$Key]);
            }
        }
        // unset($Plays[$PlayIdGET - 1]);
        $storage['Plays'] = $Plays;
        $error = $storage['plays'];
        file_put_contents($storagePath, json_encode($storage, JSON_PRETTY_PRINT));
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../CSS/yourShows.css">
    <link rel="stylesheet" href="../css/frame.css"
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Fredoka:wght@300;400;500;600&display=swap" rel="stylesheet">
    <title>frame</title>
</head>

<body>
    
    <?php include 'frame.php' ?>

    <main>
        <h1>Your Shows</h1>
        <div class="flex-container">
            <div class="table-container">
                <table>
                    <thead>
                        <tr>
                            <th scope="col">Id</th>
                            <th scope="col">Title</th>
                            <th scope="col">Price</th>
                            <th scope="col">Reservations</th>
                            <th scope="col">Available Seats</th>
                            <th scope="col"></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($Users[$UserIndex]['PlaysAddedId'] as $Play){ 
                            $Plays = $storage['Plays'];
                            $PlayIndex = $Play - 1;
                        ?>
                        <tr>
                            <td><?php echo $Plays[$PlayIndex]['id'] ?></td>
                            <td><?php echo $Plays[$PlayIndex]['title'] ?></td>
                            <td><?php echo $Plays[$PlayIndex]['price'] ?></td>
                            <td><?php echo 'empty' ?></td>
                            <td><?php echo 'empty' ?></td>
                            <td><form action="<?PHP echo $_SERVER['PHP_SELF']; ?>" method="$_GET"><input type="number" style="display: none;" value="<?php echo $Plays[$PlayIndex]['id']; ?>" name="PlayId"><button class="view" type="submit" name="submit">view</button></form></td>
                        </tr>
                        <?php } ?>
        
                    </tbody>
                </table>
            </div>
            <div class="border-container">
                <div class="border">
                    <img src="<?php echo $Plays[$PlayIdGET - 1]['smallPic'] ?>" alt="the lion king" class="card-img">
                    <div class="card-info">
                        <div>
                            <div class="title">
                                <?php echo $Plays[$PlayIdGET - 1]['title'] ?>
                            </div>
                            <div class="discreption">
                                <?php echo $Plays[$PlayIdGET - 1]['description'] ?>
                            </div>
                            <div class="duration"><img src="../icons/timer_FILL0_wght400_GRAD0_opsz48.png" alt="duration" height="17px"> <span><?php echo $Plays[$PlayIdGET - 1]['duration'] ?></span></div>
                        </div>
                        <div class="buttons-container">
                            <button class="option">
                                view list of customers
                            </button>
                            <form action="<?PHP echo $_SERVER['PHP_SELF']; ?>" method="$_POST">
                                <button class="option" name="remove" type="submit">
                                    remove play
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
                <a href="Addv2.php"><button type="button" class="add">Add a Play</button></a><?php echo $error; ?>
            </div>
    
        </div>
    </main>
    <script>
        function getId(PlayId){
            console.log(PlayId);
        }
    </script>
</body>

</html>