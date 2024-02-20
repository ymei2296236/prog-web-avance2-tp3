<?php

class Genre extends CRUD 
{
    protected $table = 'genre';
    protected $primaryKey = 'id';
    protected $fillable = ['id', 'nom'];
}

?>