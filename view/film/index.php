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
        {% if session.privilege == 1 %}
        <div class="boutons">
            <a class="bouton" href="{{path}}film/create">Ajouter un film</a>
        </div>
        {% endif %}

    </main>
</body>
</html>