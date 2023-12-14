<?php


    class CategoryModel{

        private static $categoryTable = "categories";
        private static $categoryFields = "name, description";

        public static function createCategory($name, $description){
            $values = "'$name', '$description'";

            return MySQL::insert(self::$categoryTable, self::$categoryFields, $values);
        }

        public static function selectCategory($columns, $where){
            return MySQL::select($columns, self::$categoryTable, $where);
        }

        public static function updateCategory($name, $description, $where){
            $timestamp = date('Y-m-d H:i:s');
            $columns = "set name = '$name', description = '$description', modified_at = '$timestamp'";

            return MySQL::update(self::$categoryTable, $columns, $where);
        }

        public static function enable($id){
			$columns = "SET is_active = 1";

			return MySQL::update(self::$categoryTable, $columns, "WHERE id = $id");
		}

		public static function disable($id){
			$columns = "SET is_active = 0";

			return MySQL::update(self::$categoryTable, $columns, "WHERE id = $id");
		}

        public static function deleteCategory($where){
            return MySQL::delete(self::$categoryTable, $where);
        }

    }

?>