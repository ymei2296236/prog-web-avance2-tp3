{{ include('header.php', {title: 'Rôles classiques'}) }}

<body>
    <main>
        <h1>Les meilleurs personnages du XXe siècle</h1>
        {% for role in roles %}
        <p> {{role.role_nom}} par {{ role.acteur_nom }} dans le film <a href="{{path}}film/show/{{ role.film_id }} "> {{ role.titre }} </a></p>
        {% endfor %}

        <form action="{{path}}role/vote" method="post" >
            <label for="">Qui est votre rôle favori ?</label>
            <select name="role_id">
                <option value="">Choississez</option>
                {% for role in roles %}
                <option value="{{ role.film_id}}#{{ role.acteur_id }}">{{ role.role_nom }}</option>     
                {% endfor %}
            </select>
            <div class="boutons">
                <input class="bouton" type="submit" value="Confirmer">
            </div>
        </form>
    </main>
</body>
</html>