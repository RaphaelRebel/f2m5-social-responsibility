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


