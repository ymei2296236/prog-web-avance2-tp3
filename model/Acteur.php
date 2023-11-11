<?php

class Acteur extends CRUD 
{
    protected $table = 'acteur';
    protected $primaryKey = 'id';
    protected $fillable = ['id', 'nom', 'prenom'];
}

?>