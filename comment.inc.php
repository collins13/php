<!DOCTYPE html>
<!DOCTYPE html>
<html>
<head>
<style type="text/css">
	#comment-box{
		width: 845px;
		padding: 20px;
		margin-bottom: 4px;
		border-radius: 4px;
		background-color: #fff; 
		position: relative;
	}
	.edit-form{
		position: absolute;
		bottom: 0px;
		right: 0px;
	}
		.edit-form button{
			height: 30px;
			width: 100px;
			color: #222;
			background-color: #fff;
			opacity: 0.7;
	}
	.edit-form button:hover{
		opacity: 1;

	}
	.delete-form{
		position: absolute;
		bottom: 0px;
		right: 110px;
	}
		.delete-form button{
			height: 30px;
			width: 100px;
			color: #222;
			background-color: #fff;
			opacity: 0.7;
	}
	.delete-form button:hover{
		opacity: 1;

	}
	
	
</style>
	<title>php section</title>
</head>
<body>

</body>
</html>

<?php

function setcomments($conn){
	if(isset($_POST['commentSubmit'])){
		$uid = $_POST['uid'];
	    $date= $_POST['date'];
	    $message =$_POST['message'];

	 $sql ="INSERT INTO comments(uid, date, message)  VALUES('$uid', '$date', '$message')";
	     $result = $conn->query( $sql);
	 }
	
}
function getcommnts($conn){
	$sql = "SELECT * FROM comments";
	 $result = $conn->query( $sql);
	 while ( $row =$result->fetch_assoc()) {
             echo "<div id='comment-box'><p>";
	         echo $row['uid']."<br>";
	         echo $row['date']."<br>";
	         echo nl2br($row['message']);
	 echo "</p>
	            <form class='delete-form' method='POST' action='".deletecomments($conn)."'>

         <input type='hidden' name='id' value='".$row['id']."'>
         <button type='submit' name='deletecomments'>delete</button>

    </form>
             <form class='edit-form' method='POST' action='editcomments.php'>
         <input type='hidden' name='id' value='".$row['id']."'>
         <input type='hidden' name='uid' value='".$row['uid']."'><br>
         <input type ='hidden' name='date' value='".$row['date']."'><br>
         <input type ='hidden' name='message' value='".$row['message']."'><br>
         <button>edit</button>

    </form>
	 </div>";
	 }
	

}

function editcomments($conn){
	if(isset($_POST['commentSubmit'])){
		$id = $_POST['id'];
		$uid = $_POST['uid'];
	    $date= $_POST['date'];
	    $message =$_POST['message'];

	 $sql ="UPDATE comments SET message='$message' WHERE id='$id'";
	     $result = $conn->query( $sql);
	     header("location: comments.php");
	 } 
}
function deletecomments($conn){
	if(isset($_POST['deletecomments'])){
		$id = $_POST['id'];

	 $sql ="DELETE FROM comments WHERE id='$id'";
	     $result = $conn->query( $sql);
	     header("location: comments.php");
	 } 




}