<?php

namespace app\Controllers;

use app\Models\Musique;
use app\Models\Playlist;
use app\Models\Appartient;

class PlaylistController{

    public function __construct($container){
        $this->container = $container;
    }

    public function accessCreationPlaylist($request, $response){
        $musiques = Musique::select("*")->orderBy('id')->get();

        $this->container->view->render($response, 'CreerPlaylist.html.twig', ['musiques'=> $musiques]);
    }

    public function accessModificationPlaylist($request, $response,$args){
        $musiques = Musique::select("*")->orderBy('id')->get();
        // SELECT * FROM public.appartient inner join public.musique on musique.id = appartient.id_musique where id_playlist='+req.params.id+';'
        $playlist = Playlist::
        select("*")
        // select('playlist.nom','playlist.description','playlist.auteur','playlist.image_playlist','appartient.id_musique')
        
        // ->Join('appartient','playlist.id','=','appartient.id_playlist')
        ->where('playlist.id','=',$args['id'])
        ->get();
        // $musiquedeplaylist = $playlist.id_musique;
        $musiquedeplaylist = Playlist::select('appartient.id_musique')
        ->Join('appartient','playlist.id','=','appartient.id_playlist')
        ->where('playlist.id','=',$args['id'])
        ->orderBy('id_musique')
        ->get();
        $this->container->view->render($response, 'modifierPlaylist.html.twig', ['musiques'=> $musiques,"playlist"=> $playlist,"musiquedeplaylist"=> $musiquedeplaylist]);
    }

    public function creerPlaylist($request, $response){
        $playlist = new Playlist();

        $playlist->nom = $_POST["nom"];
        $playlist->description = $_POST["description"];
        $playlist->auteur = $_POST["auteur"];
        $playlist->image_playlist = $_POST["image_playlist"];

        $playlist->save();

        $array = $_POST["id_musique"];

        // var_dump($array);

        foreach($array as $value){
            $appartient = new appartient();
            $appartient->id_musique = $value;
            $appartient ->id_playlist = $playlist->id;
            $appartient->save();
        }

        // for($i = 0; $i < count($array);$i++){
        //     $appartient = new appartient();

        //     $appartient->id_musique = $array[$i];
        //     $appartient ->id_playlist = $playlist->id;
        //     $appartient->save();
        // }



        $playlists = Playlist::all();
        $this->container->view->render($response, "checkPlaylist.html.twig", ['playlist'=> $playlists]);
    }

    public function modifierPlaylist($request, $response,$args){
        $playlist = Playlist::find(intVal($args['id']));
        if($playlist->nom != $_POST["nom"]){
            $playlist->nom = $_POST["nom"];
        }
        if($playlist->description != $_POST["description"]){
            $playlist->description = $_POST["description"];
        }
        if($playlist->auteur != $_POST["auteur"]){
            $playlist->auteur = $_POST["auteur"];
        }
        if($playlist->image_playlist != $_POST["image_playlist"]){
            $playlist->image_playlist = $_POST["image_playlist"];
        }
        $playlist->save();
        
        $array = $_POST["id_musique"];

        var_dump($array);

        // foreach($array as $value){
        //     $appartient = new appartient();
        //     $appartient->id_musique = $value;
        //     $appartient ->id_playlist = $playlist->id;
        //     $appartient->save();
        // }

        $playlists = Playlist::all();
        $this->container->view->render($response, "checkPlaylist.html.twig", ['playlist'=> $playlists]);
    }

}