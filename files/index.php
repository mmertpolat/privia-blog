<?php
include("config.php");
?>
<!DOCTYPE html>
<html>
<head>
	<title>Privia Blog</title>
	<link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet">
	<link rel="stylesheet" href="style.css">
</head>
<body>

<link href="https://fonts.googleapis.com/css?family=Montserrat:400,700|Open+Sans+Condensed:300" rel="stylesheet">

<center><h3>Privia Blog</h3></center>
<div class="post">

<?php 
$query = $db->query("SELECT * FROM yazilar ORDER BY tarih DESC", PDO::FETCH_ASSOC);
if ( $query->rowCount() ){
     foreach( $query as $row ){ 
     	$postid = $row['id'];
     	?>
     	<h2><?php print $row['baslik']; ?></h2>
<div class="date"><?php print $row['tarih']; ?></div>
<p><?php print $row['icerik']; ?></p>

	<?php
	$query2 = $db->query("SELECT * FROM yorumlar WHERE hangiposta = '$postid'", PDO::FETCH_ASSOC);
if ( $query2->rowCount() ){
     foreach( $query2 as $row2 ){ ?>
          <div class="dialogbox">
    <div class="body">
      <span class="tip tip-left"></span>
      <div class="message">
      	<a style="color:black;font-weight: bold"><?php print $row2['email']; ?></a><br>
        <span><?php print $row2['yorum']; ?></span>
      </div>
    </div>
  </div>
     <?php } } ?>

  <hr>
</div>
<?php } } ?>

</body>
</html>