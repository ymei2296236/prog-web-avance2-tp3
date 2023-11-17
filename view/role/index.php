{{ include('header.php', {title: 'Rôles classiques'}) }}

<body>
    <main>
        <h1>Les meilleurs personnages du XXe siècle</h1>

        {% for role in roles %}
        <p> {{role.role_nom}} par {{ role.acteur_nom }} dans le film <a href="{{path}}film/show/{{ role.film_id }} "> {{ role.titre }} </a></p>
        {% endfor %}

        {% if guest == true %}
        <p class="msg-login">Connectez-vous pour voter</p>
        {% elseif session.privilege != 1 %}
                {% if vote == 0 %}
        <form class="form-vote" action="{{path}}user/vote" method="post" >
            <label for="">Qui est votre rôle favori ?</label>
            <select name="role_id">
                <option value="">Choississez</option>
                    {% for role in roles %}
                <option value="{{ role.id }}">{{ role.role_nom }}</option>     
                    {% endfor %}
            </select>
            <div class="boutons">
                <input class="bouton" type="submit" value="Confirmer">
            </div>
        </form>
                
                {% else %}
        <p class="msg-login">Vous avez déjà voté.</p>
                {% endif %}
        {% endif %}
         
    </main>
</body>
</html>