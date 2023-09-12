<?PHP
    session_start();

    $UserIndex = $_SESSION['UserId'] - 1;
    
    $title = $duration = $price = $imgx5 = $imgx10 = $description = $target_dir1 = $target_dir2 = '';
    $error = '';

    $PlayId = 1;

    $storagePath = '../jsonFiles/Users.json';

    // get to the Users.json
    $storage = json_decode(file_get_contents($storagePath), true);
    $Plays = $storage['Plays'];
    $Users = $storage['Users'];

    if(isset($_POST['submit']))
    {

        function getInput(){
            global $target_dir1, $target_dir2;

            if(empty($_POST['title']) || empty($_POST['duration']) || empty($_POST['price']) || empty($_POST['description']) || empty($_FILES['imgx5']) || empty($_FILES['imgx10'])){
                $GLOBALS['error'] = 'all feilds are required';
                return false;
            }
            $GLOBALS['title'] = filter_var(trim($_POST['title']), FILTER_SANITIZE_STRING);

            $GLOBALS['description'] = filter_var(trim($_POST['description']), FILTER_SANITIZE_STRING);

            $GLOBALS['duration'] = $_POST['duration'];

            $GLOBALS['price'] = $_POST['price'];

            $file_name1 = $_FILES['imgx5']['name'];
            $file_tmp1 = $_FILES['imgx5']['tmp_name'];
            $target_dir1 = '../uploaded/' . $file_name1;
            $file_ext1 = explode('.', $file_name1);

            $file_name2 = $_FILES['imgx10']['name'];
            $file_tmp2 = $_FILES['imgx10']['tmp_name'];
            $target_dir2 = '../uploaded/' . $file_name2;
            $file_ext2 = explode('.', $file_name2);

            move_uploaded_file($file_tmp1, $target_dir1);
            move_uploaded_file($file_tmp2, $target_dir2);

            return true;
        }

        function insertNewPlay(){
            global $title, $description, $duration, $price, $Plays, $storage, $storagePath, $PlayId, $error, $target_dir1, $target_dir2, $Users, $UserIndex;

            foreach($Plays as $Play){
                $PlayId += 1;
            }



            $smallPic = $target_dir1;
            $bigPic = $target_dir2;

            $newPlay = [
                "id" => $PlayId,
                "title" => $title,
                "description" => $description,
                "duration" => $duration,
                "price" => $price,
                "bigPic" => $bigPic,
                "smallPic" => $smallPic,
                "creator" => $Users[$UserIndex]['name']
            ];
            
            array_push($Plays,$newPlay);
            $storage['Plays'] = $Plays;

            array_push($Users[$UserIndex]['PlaysAddedId'], $PlayId);
            $storage['Users'] = $Users;
    
            if(!file_put_contents($storagePath, json_encode($storage, JSON_PRETTY_PRINT))){
                $error = "Could'nt save the data";
                return false;
            }
            return true;
        }

        if(getInput()){
            if(insertNewPlay()){
                header('location: yourShows.php');
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
    <link rel="stylesheet" href="../CSS/Addv2.css">
    <link rel="stylesheet" href="../CSS/frame.css">
    <link rel="stylesheet" href="../CSS/homePage.css">
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Fredoka:wght@300;400;500;600&display=swap" rel="stylesheet">
    <title>website name</title>
    <script src="../JS/addv2.js" defer></script>
</head>
<body>
    
    <?php include 'frame.php' ?>

    <main>
    <h1>Add a play</h1> <br> 
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" enctype="multipart/form-data"> 
        <div class="left">
            <label>Title</label><br> <input type="text" class="multiple input" name="title">
            <br>

            <div class="price-duration-container">
                <div>
                    <label>Duration(min)</label><br> <input type="number" class="multiple input" max="240" min="30" name="duration">
                </div>
                <div>
                    <label>Price</label><br>  <input type="number" class="multiple input" min="50" max="500" name="price">
                </div>
            </div>
            <br>
            <label>Image (5x3)</label><br>
            <div class="imgx5 multiple input">
                <img src="">
            </div>
            <input type="file" class="file5 file" name="imgx5">
            <input type="file" class="file10 file" name="imgx10">
            <label>Categories</label>
            <div class="categories-container">
                <div>
                    <input type="checkbox" id="Kids">
                    <label for="Kids">Kids</label><br>
                    <input type="checkbox" id="Action">
                    <label for="Action">Action</label><br>
                    <input type="checkbox" id="Drama">
                    <label for="Drama">Drama</label><br>
                    <input type="checkbox" id="Comedy">
                    <label for="Comedy">Comedy</label><br>
                </div>
                <div>
                    <input type="checkbox" id="Tragedy">
                    <label for="Tragedy">Tragedy</label><br>
                    <input type="checkbox" id="Musical">
                    <label for="Musical">Musical</label><br>
                    <input type="checkbox" id="Heroic Drama">
                    <label for="Heroic Drama">Heroic Drama</label><br>
                    <input type="checkbox" id="Melodrama">
                    <label for="Melodrama">Melodrama</label><br>
                </div>
            </div>
        </div>
        <div class="right">
            <div>
                <label>Image (10x3)</label>
                <div class="imgx10 multiple">
                    <img src="">
                </div>
                <label>play description</label><br> 
                <textarea class="description multiple" name="description"></textarea>
            </div>
            <div class="buttons-container">
                <div>
                    <p class="error"><?php echo $error; ?></p>
                </div>
                <div>
                    <button>Back</button>
                    <button type="submit" name="submit">Add</button>
                </div>
            </div>
        </div>
    </form>
    </main>
</body>
</html>