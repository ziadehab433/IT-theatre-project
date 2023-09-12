<?php
	session_start();

	$storagePath = '../jsonFiles/Users.json';
	$storage = json_decode(file_get_contents($storagePath), true);
	$Users = $storage['Users'];
	$Plays = $storage['Plays'];

	$UserIndex = $_SESSION['UserId'] - 1;

	if(isset($_GET['submit'])){
        $_SESSION['playId'] = $_GET['PlayId'];
		header('location: book.php');
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="../CSS/frame.css">
	<link rel="stylesheet" href="../CSS/homePage.css">
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Fredoka:wght@300;400;500;600&display=swap" rel="stylesheet">
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Heebo&family=Iceberg&display=swap" rel="stylesheet">
	<title>homePage</title>
	<script src="../JS/script.js" defer></script>
</head>
<body>
	
	<?php include 'frame.php' ?>

	<main>
		<div class="premier">
			<img src="../pics/frozen big sc.png" alt="frozen">
			<img src="../pics/matilda s.avif" alt="lion king">
			<img src="../pics/les miserables.avif" alt="kung fu panda">
			<div class="arrows">
				<p class="slider-left"><</p>
				<p class="slider-right">></p>
			</div>
		</div>
		<div class="category">
			<span>Available Shows</span>
		</div>
		<div class="scroll-container">
			<?php foreach($Plays as $Play){ 
			?>
			<form action="<?PHP echo $_SERVER['PHP_SELF']; ?>" method="$_GET">
				<div class="play-card">
					<img src="<?php echo $Play['smallPic'] ?>" alt="the lion king">
					<div class="play-card-info">
						<div>
							<div class="play-title"><?php echo $Play['title'] ?></div>
							<div class="play-categories">
								<div>Comedy</div>
								<div>Kids</div>
							</div>
							<div class="play-creator">By <?php echo $Play['creator'] ?></div>
						</div>
						<div>
							<div class="price"><?php echo $Play['price'] ?> LE</div>
							<div class="rating">4.5 &bigstar;</div>
						</div>
					</div>
				</div>
				<input type="number" style="display: none;" value="<?php echo $Play['id']; ?>" name="PlayId">
				<button class="button" type="submit" name="submit"></button>
			</form>
			<?php } ?>
		</div>
	</main>
	<script>
		let playCard = document.querySelector(".play-card");
		let button = document.querySelector(".button");

		playCard.onclick = function(){
			button.click();
		}
	</script>
</body>
</html>