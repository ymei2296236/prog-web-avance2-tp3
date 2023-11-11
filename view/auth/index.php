{{ include('header.php', {title: 'Login'}) }}

<body>
    <main>
        <h1 class="h1-moins-espace">Login</h1>
        {% if errors is defined %}
        <span class="msg-error">{{ errors | raw }}</span>
        {% endif %}
        <form action="{{path}}login/auth" method="post">
            <label>Utilisateur
                <input type="text" name="username" value="{{ user.username }}"></input>
            </label>
            <label>Mot de passe
                <input type="password" name="password" ></input>
            </label>
            <div class="boutons" >
                <input class="bouton" type="submit" value="Connecter">
            </div>
        </form>
    </main>
</body>
</html>