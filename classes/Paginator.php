<?php 


    class Paginator{

        public static function calcNumOfPages($numOfProducts, $productsPerPage){

			$totalPages = $numOfProducts / $productsPerPage;

			if($totalPages >= 1){
				if(is_float($totalPages)){
					$difference =  intval($totalPages);
					$totalPages += ($difference + 1) - $totalPages;
				}
				
				$totalPages = $totalPages < 1 ? 1 : $totalPages;
			}

			return $totalPages;

		}

		public static function calcLimit($productsPerPage, $numOfProducts){
		
			$currentPage = isset($_GET['page']) ? $_GET['page'] : 1;

			if($currentPage * $productsPerPage > $numOfProducts + $productsPerPage)
				Login::redirect(FULL_PATH_CATALOGO);

			$beginLimit = ($currentPage - 1) * $productsPerPage;

			return " LIMIT $beginLimit, $productsPerPage";
		}

    }


?>