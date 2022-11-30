<?php

define('ROOT', __DIR__);
//require_once(ROOT . '/utils/NewsManager.php');
//require_once(ROOT . '/utils/CommentManager.php');

require_once(ROOT . '/utils/NewsController.php');
require_once(ROOT . '/utils/CommentController.php');


  //$newsss =  new NewsManager();
  
  
 $newss=   new NewsController();
 $comments=   new CommentController();
 
      $listNews =  $newss->listNews();
     
	 $listcomments =  $comments->listComments();
  
 
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Bootstrap Example</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>
<body>

<div class="container">
 <h2> <center>News</center> </h2> 
             
  <table class="table">
    <thead>
      <tr>
        <th>News ID</th>
        <th>Title</th>
        <th>News Description</th>
        <th>News Comment</th>
       
      </tr>
    </thead>
    <tbody>
	<?php 
	
	foreach ($listNews as $news) {
	
	?>
      <tr>
        <td><?php echo $news['setId']; ?></td>
        <td><?php echo $news['setTitle']; ?></td>
        <td><?php echo $news['setBody']; ?></td>
		<td><?php foreach ($listcomments as $comment) {
		if ($comment['newsid'] == $news['setId']) {
			echo("Comment " . $comment['Id'] . " : " . $comment['Body'] . "\n <br>");
		}
	} ?></td>
      </tr>
    <?php } ?>
    </tbody>
  </table>
</div>

</body>
</html>

