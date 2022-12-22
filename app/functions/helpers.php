<?php

use app\classes\User;
use app\models\Model;

function dd($dump) {
	var_dump($dump);

	die();
}

function flash($errors, $type) {
	$flash = new app\classes\Flash;
	$flash->add($errors, $type);
}

function redirect($target) {
	return header("location:{$target}");
}

function getUser(Model $model) {
	$user = new User;
	return $user->user($model);
}