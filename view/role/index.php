{{ include('header.php', {title: 'Rôles'}) }}

<body>
    <main>
        <h1>Les meilleurs personnages du XXe siècle</h1>

        {% for vote in votes %}
            <div class="role">
                <div class="role__img">
                    <img src="{{path}}uploads/{{ vote.nomImage }}" alt="">
                </div>
                <div class="role__info">        
                    <p class="role__info">{{loop.index}}. {{vote.role_nom}}</p>
                    <p>par {{ vote.acteur_nom }}</p>
                    <p>Film <a href="{{path}}film/show/{{ vote.film_id }} "> {{ vote.titre }} </a></p>
                </div>
            </div>
        {% endfor %}

        {% if guest == true %}
        <p class="msg-login">Connectez-vous pour voter</p>
        {% elseif session.privilege != 1 %}
                {% if voteRole == 0 %}
        <form class="form-vote" action="{{path}}user/vote" method="post" >
            <label for="">Qui est votre rôle favori ?</label>
            <select name="role_id">
                <option value="">Choississez</option>
                    {% for role in roles %}
                <option value="{{ role.id }}">{{ role.prenom }} {{ role.nom }}</option>     
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