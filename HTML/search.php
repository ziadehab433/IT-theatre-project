<?php
	session_start();

	$storagePath = '../jsonFiles/Users.json';
	$storage = json_decode(file_get_contents($storagePath), true);
	$Users = $storage['Users'];
	
	$UserIndex = $_SESSION['UserId'] - 1;
	$results = array();

	if(!empty($_GET['search'])){
		$storagePath = '../jsonFiles/Users.json';
		$storage = json_decode(file_get_contents($storagePath), true);
		$plays = $storage['Plays'];

		$UserIndex = $_SESSION['UserId'] - 1;
		$results = [];
		foreach($plays as $play) {
			if(strpos($play['title'], $_GET['search']) !== false) {
				$results[] = $play;
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
	<link rel="stylesheet" href="../CSS/frame.css">
	<link rel="stylesheet" href="../CSS/search.css">
	<link rel="stylesheet" href="../CSS/homePage.css">
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Fredoka:wght@300;400;500;600&display=swap" rel="stylesheet">
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Heebo&family=Iceberg&display=swap" rel="stylesheet">
	<title>homePage</title>
    <title>Document</title>
</head>
<body>
<header>
		<div>logo + website name</div>
		<div><?php echo 'hi, ' . $Users[$UserIndex]['name']; ?></div>
</header>
<nav class="sidebar">
    <div class="half">
        <a href="homePage.php">
            <div style="padding-bottom: 2px; margin-top: 2px; position: relative;" class="half-div">
                <img src="../icons/home_FILL0_wght700_GRAD0_opsz48.png" alt="Home">
                <div class="tooltip">Home</div>
            </div>
        </a>
        <a href="search.php">
            <div class="half-div" style="position: relative">
                <img src="../icons/search_FILL0_wght400_GRAD0_opsz48.png" alt="search">
                <div class="tooltip">Search</div>
            </div>
        </a>
        <a href="<?php echo $Users[$UserIndex]['account'] == 'vendor'? 'yourShows.php': 'yourReservations.php' ?>">
            <div class="half-div" style="position: relative">
                <img src="../icons/<?php echo $Users[$UserIndex]['account'] == 'vendor'? 'storefront_FILL0_wght400_GRAD0_opsz48.png': 'menu_book_FILL0_wght400_GRAD0_opsz48.png' ?>" alt="Your Shows">
                <div class="tooltip">Yours</div>
            </div>
        </a>
    </div>
    <div class="half">
        <div>
            <img src="../icons/help_FILL0_wght400_GRAD0_opsz48.png" alt="Help">
        </div>
        <div onclick="settings()">
            <img src="../icons/settings_FILL0_wght400_GRAD0_opsz48.png" alt="Settings">
            <div class="settings" >
                <a href="logout.php">log out</a>
            </div>
        </div>
	    <script>
		    let settings = document.querySelector(".settings");
		    function settings(){
			    settings.style.opacity = 1;
		    }   
	    </script>
    </div>
</nav>

	<main>
		<div class="header">
			<form action="" method="GET">
				<input type="search" class="search" name="search" placeholder="Search">
			</form>
		</div>
		<div class="grid">
		<?php foreach($results as $play){ ?>
				<div class="play-card">
					<img src="<?php echo $play['smallPic'] ?>" alt="the lion king">
					<div class="play-card-info">
						<div>
							<div class="play-title"><?php echo $play['title'] ?></div>
							<div class="play-categories">
								<div>Comedy</div>
								<div>Kids</div>
							</div>
							<div class="play-creator">By <?php echo $play['creator'] ?></div>
						</div>
						<div>
							<div class="price"><?php echo $play['price'] ?> LE</div>
							<div class="rating">4.5 &bigstar;</div>
						</div>
					</div>
				</div>
			</form>
			<?php } ?>
		</div>
	</main>
</body>
</html>