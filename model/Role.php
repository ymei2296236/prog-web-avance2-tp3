<?php

class Role extends CRUD 
{
    protected $table = 'role';
    protected $primaryKey = 'id';
    protected $fillable = ['id', 'nom', 'prenom','film_id', 'acteur_id'];

    public function roleActeurFilm()
    {
        $sql = 
        "SELECT role.id, film_id, 
        CONCAT(acteur.prenom, ' ', acteur.nom) AS acteur_nom, 
        CONCAT(role.prenom, ' ', role.nom) AS role_nom, 
        titre FROM $this->table 
        INNER JOIN acteur 
        INNER JOIN film 
        ON acteur_id = acteur.id and film_id = film.id";
        
        $stmt = $this->query($sql);
        $roleActeurFilm = $stmt->fetchAll();
        return $roleActeurFilm;
        
    }

    public function countVote()
    {

        $sql = 
        "SELECT role.id, film_id, titre, nomImage,
        CONCAT(acteur.prenom, ' ', acteur.nom) AS acteur_nom, 
        CONCAT(role.prenom, ' ', role.nom) AS role_nom, 
        COUNT(*) AS nombreVote 
        FROM $this->table 
        INNER JOIN acteur 
        INNER JOIN film 
        INNER JOIN user 
        ON acteur_id = acteur.id and film_id = film.id and role.id = role_id 
        GROUP BY role_id 
        ORDER BY nombreVote DESC";

        $stmt = $this->query($sql);
        $countVote = $stmt->fetchAll();
        return $countVote;
    }


}

?>