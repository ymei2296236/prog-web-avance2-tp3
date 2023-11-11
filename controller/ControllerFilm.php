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
        $genre = new Genre;
        $selectGenres = $genre->select('nom');

        return Twig::render('film/create.php', ['genres'=>$selectGenres]);
    }

    public function store()
    {

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
            return Twig::render('film/create.php', ['errors'=> $errors, 'genres'=> $genres, 'film'=> $_POST]);
            exit();
        } 

        $film = new Film;
        $insert = $film->insert($_POST);
        RequirePage::url('film/show/'.$insert);
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
        $film = new Film;
        $selectFilm = $film->selectId($id);

        $genre= new Genre;
        $selectGenres = $genre->select('nom');

        return Twig::render('film/edit.php', ['film'=>$selectFilm, 'genres'=>$selectGenres]);
    }

    public function update()
    {
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
        $film = new Film;
        $delete = $film->delete($_POST['film_id']);
        RequirePage::url('film/index');
    }
}

?>