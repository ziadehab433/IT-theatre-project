<?php
    session_start();

	$storagePath = '../jsonFiles/Users.json';
	$storage = json_decode(file_get_contents($storagePath), true);
	$Users = $storage['Users'];
    $Plays = $storage['Plays'];

	$UserIndex = $_SESSION['UserId'] - 1;

    $showsIds = array('');
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
        <h1>Your Reservations</h1>
        <div class="flex-container">
            <div class="table-container">
                <table>
                    <thead>
                        <tr>
                            <th scope="col">Id</th>
                            <th scope="col">Title</th>
                            <th scope="col">Price</th>
                            <th scope="col">Seat no.</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>123</td>
                            <td>frozen</td>
                            <td>230</td>
                            <td>43</td>
                        </tr>
        
                    </tbody>
                </table>
            </div>
            <div class="border-container">
                <div class="border">
                    <img src="../pics/lion king s.avif" alt="the lion king" class="card-img">
                    <div style="padding: 10px;">
                        <div class="title">
                            The Lion King
                        </div>
                        <div class="discreption"> Disney's The Lion King is about a young lion named simba, who is the crown
                            prince of an african
                            savanna. When his father dies in an accident staged by his uncle, Simba is made to feel responsible
                            for
                            his father's death and must overcome his fear of taking responsibility as the rightful heir to the
                            throne.</div>
                        <div class="duration"><img src="../icons/timer_FILL0_wght400_GRAD0_opsz48.png" alt="duration" height="17px"> <span>2h</span></div>
                        <div class="buttons-container">
                            <button class="option">
                                Cancel Reservation
                            </button>
                        </div>
                    </div>
                </div>
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