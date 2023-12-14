<?php

    class Image{

        public static function uploadImage($fileName, $folder){
                           
            $target_dir = $folder;
            $name = $_FILES[$fileName]['name'];
            $target_file = $target_dir . basename($name);
            $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

            if(!self::checkImage($fileName, $target_file)) return false;

            if(move_uploaded_file($_FILES[$fileName]["tmp_name"], $target_file)) {
                rename($folder.$name, $folder."$fileName");
                return true;
            } else {
                $_SESSION['image_error'] = 'O servidor teve um problema ao salvar essa imagem! Tente novamente!';
                return false;
            }
        }

        public static function checkImage($fileName, $target_file){
                        
            $check = getimagesize($_FILES[$fileName]["tmp_name"]);
            $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

            if($check == false) {
                $_SESSION['image_error'] = "O arquivo não é uma imagem!";
                return false;
            }
            

            // Check if file already exists
            if (file_exists($target_file)) {
                $_SESSION['image_error'] = "A imagem já existe! Altere o seu nome!";
                return false;
            }

            // Check file size
            if ($_FILES[$fileName]["size"] > 1000000) {
                $_SESSION['image_error'] = "Arquivo muito grande!";
                return false;
            }

            // Allow certain file formats
            if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
            && $imageFileType != "gif" ) {
                $_SESSION['image_error'] = "Apenas os formatos JPG, JPEG, PNG e GIF são permitidos!";
                return false;
            }

            return true;
        }

        public static function deleteDirectory($dir) {
            if (!file_exists($dir)) {
                return true;
            }
        
            if (!is_dir($dir)) {
                return unlink($dir);
            }
        
            foreach (scandir($dir) as $item) {
                if ($item == '.' || $item == '..') {
                    continue;
                }
        
                if (self::deleteDirectory($dir . DIRECTORY_SEPARATOR . $item)) {
                    return false;
                }
        
            }
        
            return rmdir($dir);
        }
    }
?>