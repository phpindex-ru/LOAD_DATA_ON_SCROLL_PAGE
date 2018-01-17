<!DOCTYPE html>
<html lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta charset="utf-8">
<title></title>
<style type="text/css">
body {
font: normal 15px arial,sans-serif;
}
.post-list{ 
margin-bottom:20px;
}
div.list-item {
border-left: 4px solid #7ad03a;
margin: 5px 15px 2px;
padding: 1px 12px;
background-color:#F1F1F1;
-webkit-box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
height: 80px;
}
div.list-item p {
margin: .5em 0;
padding: 2px;
font-size: 13px;
line-height: 1.5;
}
.list-item a {
text-decoration: none;
padding-bottom: 2px;
color: #0074a2;
-webkit-transition-property: border,background,color;
transition-property: border,background,color;-webkit-transition-duration: .05s;
transition-duration: .05s;
-webkit-transition-timing-function: ease-in-out;
transition-timing-function: ease-in-out;
}
.list-item a:hover{ 
text-decoration:underline;
}
.load-more {
margin: 15px 25px;
cursor: pointer;
padding: 10px 0;
text-align: center;
font-weight:bold;
}

</style>
<script src="jquery.min.js"></script>
<script type="text/javascript">
$(document).ready(function(){
	$(window).scroll(function(){
		var lastID = $('.load-more').attr('lastID');
		if ($(window).scrollTop() == $(document).height() - $(window).height() && lastID != 0){
			$.ajax({
				type:'POST',
				url:'getData.php',
				data:'id='+lastID,
				beforeSend:function(html){
					$('.load-more').show();
				},
				success:function(html){
					$('.load-more').remove();
					$('#postList').append(html);
				}
			});
		}
	});
});
</script>
</head>

<body>

<?php
//Include DB configuration file
include('dbConfig.php');
?>
<div class="container">
    <div class="row">
        <div class="col-lg-12">
        	<h1></h1>
            <div class="post-list" id="postList">
			<?php
			//get rows query
			$query = $db->query("SELECT * FROM posts ORDER BY id DESC LIMIT 10");
			
			if($query->num_rows > 0){ 
				while($row = $query->fetch_assoc()){ 
                    $postID = $row["id"];
            ?>
           	 	<div class="list-item"><a href="javascript:void(0);"><h2><?php echo $row['title']; ?></h2></a></div>
            <?php } ?>
            <div class="load-more" lastID="<?php echo $postID; ?>" style="display: none;">
                <img src="loading.gif"/>
            </div>
            <?php } ?>
            </div>
        </div>
    </div>
</div>

</body>
</html>

