<?php

	class ImageController{

		function delete(){

			if(isset($_GET['imgId'])){

				$productId = $_GET['productId'];

				if($this->deleteImage($productId) == true){
					$_SESSION['image_success'] = 'Imagem Apagada!';
					Login::redirect(FULL_PATH_PANEL."product?id=$productId");
				}else{
					$_SESSION['image_error'] = 'Não foi possível deletar a imagem!';
					Login::redirect(FULL_PATH_PANEL."product?id=$productId");
				}
			}else{
				Login::redirect(FULL_PATH_PANEL);
			}
		}


		/* functions */

		private function deleteImage($productId){

			try{
				$imgName = $_GET['imgName'];
				$order = $_GET['imgOrder'];

				$path = PATH_UPLOAD."products/$productId";
				$image = '';

				foreach(scandir($path) as $item){
					if(preg_match("/image$order/", $item))
						$image = $item;
				}

				unlink("$path/$image");

				if(count(scandir($path)) == 2)
					ProductModel::disable($productId);

			}catch(Throwable $error){
				return false;
			}

			return ImageModel::deleteImage($productId, $order);
		}
	}
?>