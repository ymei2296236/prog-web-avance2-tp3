{{ include('header.php', {title: 'Acteurs et actrices'}) }}

<body>
    <main>
        <h1>Acteurs et actrices</h1>
        {% for acteur in acteurs %}
            <p>{{ acteur.prenom}} {{ acteur.nom}}</p>
        {% endfor %}
    </main>
</body>
</html>