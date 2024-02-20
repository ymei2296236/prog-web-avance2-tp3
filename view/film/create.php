{{ include('header.php', {title: 'Ajouter un film'}) }}

<body>
    <main>
        <a class="bouton bouton--tertiaire" href="{{path}}film/index">< Retourner à la liste de films</a>
        <h1 class="h1-moins-espace">Ajouter un film</h1>
        <ul class="msg-error">
        {% if errors is defined %}
            {{ errors | raw }}
        {% endif %}
        {% if msg %}
            <li>{{ msg }}</li>
        {% endif %}
        </ul>

        <form action="{{path}}film/store" method="post" enctype="multipart/form-data" novalidate>
            <label>Titre
                <textarea name="titre" cols=40 rows=2 >{{ film.titre }}</textarea>
            </label>
            <label>Année de production
                <input type="number" placeholder="YYYY" name="anneeProduction" value="{{ film.anneeProduction }}">
            </label>
            <label>Synopsis
                <textarea name="synopsis" cols=40 rows=10 >{{ film.synopsis }}</textarea>
            </label>
            <label>Duree (minutes)
                <input type="number" name="duree" value="{{ film.duree }}">
            </label>
            <label>Genre
                <select name="genre_id">
                    {% for genre in genres %}
                        <option value="{{ genre.id }}" {% if genre.id == film.genre_id %} selected {% endif %}>{{ genre.nom }}</option>     
                    {% endfor %}
                </select>
            </label>
            <label> Téléverser une image
                <input type="file" name="nomImage" value="{{ film.nomImage }}"/>
            </label>
            <div class="boutons" >
                <input class="bouton" type="submit" name="upload" value="Enregistrer">
            </div>
        </form>
    </main>
</body>
</html>