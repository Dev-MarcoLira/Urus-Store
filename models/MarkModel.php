<?php
	
	class MarkModel
	{
		
		private static $markTable = "marks";
		private static $markFields = "name";
			
		public static function createMark($name){

			$values = "'$name'";

			return MySQL::insert(self::$markTable, self::$markFields, $values);

		}

		public static function selectMark($columns, $where){

			return MySQL::select($columns, self::$markTable, $where);

		}

		public static function updateMark($name, $where){
			$timestamp = date('Y-m-d H:i:s');
			$columns = "set name = '$name', modified_at = '$timestamp'";

			return MySQL::update(self::$markTable, $columns, $where);
		}

		public static function enable($id){
			$columns = "SET is_active = 1";

			return MySQL::update(self::$markTable, $columns, "WHERE id = $id");
		}

		public static function disable($id){
			$columns = "SET is_active = 0";

			return MySQL::update(self::$markTable, $columns, "WHERE id = $id");
		}

		public static function deleteMark($where){
			return MySQL::delete(self::$markTable, $where);
		}

	}

?>