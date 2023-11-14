<?php

class Log extends CRUD {

    protected $table = 'log';
    protected $primaryKey = 'id';
    protected $fillable = ['id', 'nom', 'ip', 'date', 'url'];

}


?>