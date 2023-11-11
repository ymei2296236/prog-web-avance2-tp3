<?php

class Film extends CRUD 
{
    protected $table = 'film';
    protected $primaryKey = 'id';
    protected $fillable = ['id', 'titre', 'anneeProduction', 'synopsis', 'duree', 'genre_id'];
}

?>