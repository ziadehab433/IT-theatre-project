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