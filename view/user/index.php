{{ include('header.php', {title: 'Utilisateurs (euses)'}) }}

<body>
    <main>
        <h1>Utilisateurs (euses)</h1>
        {% for user in users %}
        <p><small class="list">{{ loop.index }}</small> {{ user.privilege }} : {{ user.username }} </p>
        {% endfor %}
        <div class="boutons">
            <a class="bouton" href="{{path}}user/create">Ajouter</a>
        </div>
    </main>
</body>
</html>