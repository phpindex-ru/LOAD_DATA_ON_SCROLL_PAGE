<?php
if(isset($_POST["id"]) && !empty($_POST["id"])){

//Include DB configuration file
include('dbConfig.php');

//Get last ID
$lastID = $_POST['id'];

//Limit on data display
$showLimit = 2;

//Get all rows except already displayed
$queryAll = $db->query("SELECT COUNT(*) as num_rows FROM posts WHERE id < ".$lastID." ORDER BY id DESC");
$rowAll = $queryAll->fetch_assoc();
$allNumRows = $rowAll['num_rows'];

//Get rows by limit except already displayed
$query = $db->query("SELECT * FROM posts WHERE id < ".$lastID." ORDER BY id DESC LIMIT ".$showLimit);

if($query->num_rows > 0){
    while($row = $query->fetch_assoc()){ 
        $postID = $row["id"]; ?>
        <div class="list-item"><a href="javascript:void(0);"><h2><?php echo $row["title"]; ?></h2></a></div>
<?php } ?>
<?php if($allNumRows > $showLimit){ ?>
    <div class="load-more" lastID="<?php echo $postID; ?>" style="display: none;">
        <img src="loading.gif"/>
    </div>
<?php }else{ ?>
    <div class="load-more" lastID="0">
        That's All!
    </div>
<?php }
    }else{ ?>
    <div class="load-more" lastID="0">
        That's All!
    </div>
<?php
    }
}
?>