<?php

namespace app\classes;

class Bind {

	private static $bind = [];

	public static function bind($key, $value) {
		static::$bind[$key] = $value;
	}

	public static function get($key) {
		return static::$bind[$key];
	}

}