{{ include('header.php', {title: 'Journal de bord'}) }}

<body>
    <main>
        <h1>Journal de bord</h1>
            {% if nbLogs >= 1 %}
            <table>
                <tr>
                    <th class="th-log">Id</th>
                    <th class="th-log">Nom</th>
                    <th class="th-log">Adresse ip</th>
                    <th class="th-log">Date</th>
                    <th class="th-log">Page visitée</th>
                </tr>
                {% for log in logs %}
                <tr>
                    <td>{{ log.id }}</td>
                    <td>{{ log.nom }}</td>
                    <td>{{ log.ip }}</td>
                    <td>{{ log.date }}</td>
                    <td>{{ log.url }}</td>
                </tr>
                {% endfor %}
            </table>
            {% else %}
                <p>Il n'y a pas d'enregistrement.</p>
            {% endif %}
        <div class="boutons">
        </div>
    </main>
</body>
</html>