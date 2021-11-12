<?php
// Model functions
// In dit bestand zet je ALLE functions die iets met data of de database doen

function getUsers() {
	$connection = dbConnect();
	$sql        = "SELECT * FROM `user`";
	$statement  = $connection->query( $sql );

	return $statement->fetchAll();
}

function getUserByEmail($email){
	$connection = dbConnect();
	$sql        = "SELECT * FROM `user` WHERE `email` = :email";
	$statement  = $connection->prepare( $sql );
	$statement->execute(['email' => $email]);

	if($statement->rowCount() === 1){
		return $statement->fetch();

	}

	return false;
}

function getUserById($id){
	$connection = dbConnect();
	$sql        = "SELECT * FROM `user` WHERE `id` = :id";
	$statement  = $connection->prepare( $sql );
	$statement->execute(['id' => $id]);

	if($statement->rowCount() === 1){
		return $statement->fetch();

	}

	return false;
}

function getUserByCode($code){
	$connection = dbConnect();
	$sql        = "SELECT * FROM `user` WHERE `code` = :code";
	$statement  = $connection->prepare( $sql );
	$statement->execute(['code' => $code]);

	if($statement->rowCount() === 1){
		return $statement->fetch();

	}

	return false;
}



function getAllTopics(){
	$connection = dbConnect();
	$sql = "SELECT `topics`.*, `images`.`filename`
			 FROM `topics` 
			 LEFT JOIN `images` 
			 ON  `images`.`id` = `topics`.`image_id`
			 ORDER BY `topics`.`id` ASC";

	
	$statement = $connection->query($sql);

	return $statement->fetchAll();
}

function getUserTopicsByUserId(){
	// $user = $_SESSION['user_id'];
	$connection = dbConnect();
	$sql = "SELECT `topics`.*
			 FROM `topics` 
			 LEFT JOIN `user` 
			 ON  `user`.`id` = `topics`.`user_id`
			 ORDER BY `topics`.`id` ASC ";

	
	$statement = $connection->query($sql);

	return $statement->fetchAll();
}

function getBlogById($id){
	$connection = dbConnect();
	$sql        = "SELECT * FROM `topics` WHERE `id` = :id";
	$statement  = $connection->prepare( $sql );
	$statement->execute(['id' => $id]);

	if($statement->rowCount() === 1){
		return $statement->fetch();

	}

	return false;
}

function getUserByResetCode($reset_code){
	$connection = dbConnect();
	$sql        = "SELECT * FROM `user` WHERE `password_reset` = :code";
	$statement  = $connection->prepare( $sql );
	$statement->execute(['code' => $reset_code]);

	if($statement->rowCount() === 1){
		return $statement->fetch();

	}

	return false;
}

function updatePassword($user_id, $new_password){
	$safe_new_password = password_hash($new_password, PASSWORD_DEFAULT);
	$sql = "UPDATE `user` SET `password` = :password, `password_reset` = NULL WHERE id = :id";
	$connection = dbConnect();
	$statement = $connection->prepare($sql);
	$params = [
		'password' => $safe_new_password,
		'id' => $user_id
	];

	return $statement->execute($params);
}

function createTopic($title, $description, $image_id){
	$user = $_SESSION['user_id'];
	$sql = "INSERT INTO `topics` (`title`, `description`, `image_id`, `user_id`) VALUES (:title, :description, :image_id, :user_id)";
	$connection = dbConnect();
	$statement = $connection->prepare($sql);
	$params = [
		'title' => $title,
		'description' => $description,
		'image_id' => $image_id,
		'user_id' => $user
	];

	$statement->execute($params);
}

function createImage($newFilename, $origFilename){
	$connection = dbConnect();
	$sql = "INSERT INTO `images` (`filename`, `original_filename`) VALUES (:filename, :orig_filename)";
	$statement = $connection->prepare($sql);
	$params = [
		'filename' => $newFilename,
		'orig_filename' => $origFilename
	];
	$statement->execute($params);
	return $connection->lastInsertId();
}

function getImage($filename){
	$connection = dbConnect();
	$sql        = "SELECT * FROM `images` WHERE `filename` = :filename";
	$statement  = $connection->prepare( $sql );
	$statement->execute(['filename' => $filename]);

	if($statement->rowCount() === 1){
		return $statement->fetch();

	}

	return false;
}


