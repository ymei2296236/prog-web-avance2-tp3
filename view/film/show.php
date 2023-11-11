{{ include('header.php', {title: 'Détails'}) }}


<body>
    <main>
        <a class="bouton bouton--tertiaire" href="{{path}}film/index">< Retourner à la liste de films</a>
        <h1 class="h1-moins-espace">Détails</h1>
        <table>
            <tr>
                <th>Titre</th>
                <td>{{ film.titre }}</td>
            </tr>
            <tr>
                <th>Année de production</th>
                <td>{{ film.anneeProduction }}</td>
            </tr>
            <tr>
                <th>Synopsis</th>
                <td>{{ film.synopsis }}</td>
            </tr>
            <tr>
                <th>Durée</th>
                <td>{{ film.duree }}</td>
            </tr>
            <tr>
                <th>Genre</th>
                <td>{{ genre.nom }}</td>
            </tr>
        </table>
        <div class="boutons">
            <a class="bouton" href="{{path}}film/edit/{{ film.id }}">Modifier</a>
            <form action="{{path}}film/destroy" method="post">
                <input type="hidden" name="film_id" value="{{ film.id }}">
                <input class="bouton bouton--secondaire" type="submit" value="Supprimer">
            </form>
        </div>


    </main>    
</body>
</html>