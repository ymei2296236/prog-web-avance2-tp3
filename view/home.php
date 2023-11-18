{{ include('header.php', {title: 'Home'}) }}
    <body>
        <main class="container">
            <h1>À propos du site</h1>
            <p>Il s'agit d'un site d'archives de films, où </p>
            <p>1) les utilisateurs connectés peuvent consulter des informations sur les films, les acteurs / actrices, voir et voter pour leur personnage / rôle favori ;</p>
            <p>2) les visiteurs non connectés peuvent seulement consulter des informations sur les films, les acteurs / actrices et le dernier status de vote de personnages ;</p>
            <p>3) l'administrateur peut consulter des informations sur les films, les acteurs / actrices, le dernier status de vote. Il est aussi capable d'ajouter et supprimer des films, modifier des informations, voir le journal de bord, ajouter des usagers. Mais il ne peut pas voter.</p>
            <div class="container__img">
                <img src="{{path}}img/diagramme.png" alt="une diagramme de base de données">
            </div>
        </main>
    </body>
</html>