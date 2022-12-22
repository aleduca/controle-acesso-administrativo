<?php

namespace app\models\querybuilder;

class Update {

	private $where;

	public function where($where) {
		$this->where = $where;

		return $this;
	}

	public function sql($table, $attributes) {

		$sql = "update {$table} set ";

		unset($attributes[array_keys($this->where)[0]]);

		foreach ($attributes as $key => $value) {
			$sql .= "{$key} = :{$key}, ";
		}

		$sql = rtrim($sql, ', ');

		$where = array_keys($this->where);

		$sql .= " where {$where[0]} = :{$where[0]}";

		return $sql;

	}

}