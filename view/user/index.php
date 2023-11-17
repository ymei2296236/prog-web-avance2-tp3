{{ include('header.php', {title: 'Utilisateurs (euses)'}) }}

<body>
    <main>
        <h1>Utilisateurs (euses)</h1>
        <table>
                <tr>
                    <th class="th-user">Id</th>
                    <th class="th-user">Nom</th>
                    <th class="th-user">Privilège</th>
                </tr>
                {% for user in users %}
                <tr>
                    <td>{{ user.id }}</td>
                    <td>{{ user.username }}</td>
                    <td>{{ user.privilege }}</td>
                </tr>
                {% endfor %}
            </table>
        <div class="boutons">
            <a class="bouton" href="{{path}}user/create">Ajouter</a>
        </div>
    </main>
</body>
</html>