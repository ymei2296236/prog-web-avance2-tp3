<?php

RequirePage::model('CRUD');
RequirePage::model('Film');
RequirePage::model('Genre');
RequirePage::library('Validation');

class ControllerFilm extends controller 
{
    public function index()
    {
        $film = new Film;
        $select = $film->select();

        return Twig::render('film/index.php', ['films'=>$select, 'nbFilms' => count($select)]);
    }

    public function create()
    {
        CheckSession::sessionAuth();
        
        if($_SESSION['privilege'] != 1) 
        {
            RequirePage::url('home');
            exit();
        }
        $genre = new Genre;
        $selectGenres = $genre->select('nom');

        return Twig::render('film/create.php', ['genres'=>$selectGenres]);
    }

    public function store()
    {
        // récupère le fichier à téléverser
        if (isset($_POST['upload']))
            $_POST['nomImage'] = $_FILES["nomImage"]["name"];

        $validation = new Validation;
        extract($_POST);
 
        $validation->name('titre')->value($titre)->max(225)->min(1);
        $validation->name('Année de production')->value($anneeProduction)->required();
        $validation->name('Synopsis')->value($synopsis)->max(500)->min(25);
        $validation->name('Durée')->value($duree)->pattern('int')->required();
        $validation->name('Genre')->value($genre_id)->pattern('int')->required();
        $validation->name('Image')->value($nomImage)->required();
        $msg = '';
        
        // valide le fichier à téléverser
        if ($nomImage) 
        {
            $checkImg = getimagesize($_FILES["nomImage"]["tmp_name"]);
            $imageFileType = strtolower(pathinfo("uploads/" . basename($_POST['nomImage']), PATHINFO_EXTENSION));

            if($checkImg == false)  
                $msg = "Le fichier téléversé n'est pas une image.";

            if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") 
                $msg = "Seuls les fichiers JPG, JPEG, PNG sont autorisés.";

            if($_FILES["nomImage"]["size"]> 120000)
                $msg = "Le fichier téléversé dépasse la taille maximale de 120ko.";
        }

        if(!$validation->isSuccess() || $msg) 
        {
            $errors = $validation->displayErrors();
            $genres = new Genre; 
            $genres = $genres->select();
            return Twig::render('film/create.php', ['errors'=> $errors, 'genres'=> $genres, 'msg'=> $msg,'film'=> $_POST]);
        } 
        else
        {
            // téléverse le fichier au dossier uploads
            $tempname = $_FILES["nomImage"]["tmp_name"];
            $folder = "./uploads/" . $_POST['nomImage'];
            move_uploaded_file($tempname, $folder);
    
            // insère le film à la base de données
            $film = new Film;
            $insert = $film->insert($_POST);
            RequirePage::url('film/show/'.$insert);
        }
    }

    public function show($id)
    {
        $film = new Film;
        $selectFilm = $film->selectId($id);

        $genre= new Genre;
        $selectGenre = $genre->selectId($selectFilm['genre_id']);

        return Twig::render('film/show.php', ['film'=>$selectFilm, 'genre'=>  $selectGenre]);
    }

    public function edit($id)
    {
        CheckSession::sessionAuth();
        
        if($_SESSION['privilege'] != 1) 
        {
            RequirePage::url('home');
            exit();
        }
        $film = new Film;
        $selectFilm = $film->selectId($id);

        $genre= new Genre;
        $selectGenres = $genre->select('nom');

        return Twig::render('film/edit.php', ['film'=>$selectFilm, 'genres'=>$selectGenres]);
    }

    public function update()
    {
        CheckSession::sessionAuth();
        
        if($_SESSION['privilege'] != 1) 
        {
            RequirePage::url('home');
            exit();
        }
        $validation = new Validation;
        extract($_POST);
        $validation->name('titre')->value($titre)->max(225)->min(1);
        $validation->name('Année de production')->value($anneeProduction)->required();
        $validation->name('Synopsis')->value($synopsis)->max(500)->min(25);
        $validation->name('Durée')->value($duree)->pattern('int')->required();
        $validation->name('Genre')->value($genre_id)->pattern('int');

        if(!$validation->isSuccess()) {

            $errors = $validation->displayErrors();
            $genres = new Genre; 
            $genres = $genres->select();
            return Twig::render('film/edit.php', ['errors'=> $errors, 'genres'=> $genres, 'film'=> $_POST]);
            exit();
        } 
        $film = new Film;
        $update = $film->update($_POST);

        RequirePage::url('film/show/'.$_POST['id']);
    }

    public function destroy()
    {
        CheckSession::sessionAuth();
        
        if($_SESSION['privilege'] != 1) 
        {
            RequirePage::url('home');
            exit();
        }

        $film = new Film;
        $delete = $film->delete($_POST['film_id']);
        RequirePage::url('film/index');
    }
}

?>