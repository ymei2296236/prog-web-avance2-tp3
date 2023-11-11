{{ include('header.php', {title: 'Films'}) }}

<body>
    <main>
        <h1>Films</h1>
            {% if nbFilms >= 1 %}
                {% for film in films %}
                <p><a href="{{path}}film/show/{{ film.id }}"> {{ film.titre}}</a> </p>
                {% endfor %}
            {% else %}
                <p>Il n'y a pas de film.</p>
            {% endif %}
        <div class="boutons">
            <a class="bouton" href="{{path}}film/create">Ajouter un film</a>
        </div>
    </main>
</body>
</html>