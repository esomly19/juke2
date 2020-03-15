<?php
namespace app\Controllers;


use app\Models\Search as deez;





class musicController{

    public function getDeezer(){

        $mus=$this->getMusic();
        $search = new deez($mus);
        $data = $search->search();
        $a = array(
            "Titre" => $data[0]->title,
            "Duree" => $data[0]->duration,
            "Auteur" => $data[0]->artist->name,
            "Photos_auteur" => $data[0]->artist->picture,
            "Photos_auteur_small" => $data[0]->artist->picture_small,
            "Photos_auteur_medium" => $data[0]->artist->picture_medium,
            "Photos_auteur_big" => $data[0]->artist->picture_big,
            "Photos_auteur_xl" => $data[0]->artist->picture_xl,
            "Titre_album" => $data[0]->album->title,
            "Cover_album" => $data[0]->album->cover,
            "Cover_album_small" => $data[0]->album->cover_small,
            "Cover_album_medium" => $data[0]->album->cover_medium,
            "Cover_album_big" => $data[0]->album->cover_big,
            "Cover_album_xl" => $data[0]->album->cover_xl,
        );
        echo json_encode($a);


    }

    public function getMusic(){
        $tab = getallheaders();
        return $tab["Musicname"];

    }

    public function testFile(){

        $file = "musiques/".file_get_contents('php://input');
        if (file_exists($file)) {
            header('Content-Description: File Transfer');
            header('Content-Type: application/octet-stream');
            header('Content-Length: ' . filesize($file));
            readfile($file);
            exit;
        }
        var_dump($file);


        /**
        $tab = scandir("musiques");
        //On vire les éléments parasites et le .txt pour ne garder que les musiques
        unset($tab[0]);
        unset($tab[1]);
        unset($tab[2]);
        var_dump($tab);
         */

    }


}
