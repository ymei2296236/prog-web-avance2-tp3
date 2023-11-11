{{ include('header.php', {title: 'Ajouter un utilisateur'}) }}

<body>
    <main>
        <h1 class="h1-moins-espace">Ajouter un utilisateur</h1>
        {% if errors is defined %}
        <span class="msg-error">{{ errors | raw }}</span>
        {% endif %}
        <form action="{{path}}user/store" method="post" novalidate>
            <label>Utilisateur
                <input type="text" name="username" value="{{ user.username }}"></input>
            </label>
            <label>Mot de passe
                <input type="password" name="password" ></input>
            </label>
            <label>Privilège
                <select name="privilege_id">
                    <option value="">Choississez un privilège</option>
                    {% for privilege in privileges %}
                    <option value="{{ privilege.id }}" {% if privilege.id == user.privilege_id %} selected {% endif %}>{{ privilege.privilege }}</option>     
                    {% endfor %}
                </select>
            </label>
            <div class="boutons" >
                <input class="bouton" type="submit" value="Enregistrer">
            </div>
        </form>
    </main>
</body>
</html>