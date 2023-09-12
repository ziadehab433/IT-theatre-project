<?php
    session_start();

	$storagePath = '../jsonFiles/Users.json';
	$storage = json_decode(file_get_contents($storagePath), true);
	$Users = $storage['Users'];
    $Plays = $storage['Plays'];

	$UserIndex = $_SESSION['UserId'] - 1;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../CSS/book.css">
    <link rel="stylesheet" href="../CSS/frame.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Fredoka:wght@300;400;500;600&display=swap" rel="stylesheet">
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Heebo&family=Iceberg&display=swap" rel="stylesheet">
</head>
<body>
        
        <?php include 'frame.php' ?>

        <main>
            <img src="" alt="frozen">
            <div class="staff">
                <div class="first">
                    <p class="title"><?php echo  $_SESSION['playId']['title'] ?><span>By <?php echo  $_SESSION['playId']['creator'] ?></span></p>
                    <div class="right">
                        <p class="two"><?php echo  $_SESSION['playId']['price'] ?> LE</p>
                        <button>Book</button>
                    </div>
                </div>
                <div class="st">
                    <div class="in">Kids</div>
                    <div class="in">Comedy</div>
                </div>
                <div class="st2">
                    <div class="div1">
                        <img src="../icons/location_on_FILL0_wght400_GRAD0_opsz48.png" class="icon">
                        <p>Cairo Theatre</p>
                    </div>
                    <div class="div2">
                        &bigstar; 4.2
                    </div>
                </div>
                <div class="st3">
                    <div class="div1">
                        <img src="../icons/calendar_month_FILL0_wght400_GRAD0_opsz48.png" class="icon">
                        <p>08 Aug 2023</p>
                    </div>
                    <div class="div2">
                        <img src="../icons/timer_FILL0_wght400_GRAD0_opsz48.png" class="icon">
                        <p>2h 34m</p>
                    </div>
                </div>
                <div class="desc">
                    <p>Description:</p>
                    <p>
                        Lion King: The Musical is based on a hit film of the same name by Walt Disney in 1994. Set in the Pridelands of Africa comes the inspiring story of a young cub Simba and his journey through life.<br>
Simba learns all about Pride Rock and the kingdom from his father Mufasa. His Uncle Scar is rather unhappy about Simba’s birth, which ruins his chances of succession. Scar, along with his hyenas, plots to kill Simba and Mufasa and take over the Pridelands with a terribly vengeful plan.
A series of unfortunate events lead to Scar tricking Simba into running away from his home and never coming back. Scar takes over as King, while Simba is on his own journey far away. As Simba grows into a young lion, his past catches up to him and he must return to Pride Rock and fulfil his destiny.
                    </p>
                </div>
            </div>
        </main>
</body>
</html>