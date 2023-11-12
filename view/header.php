<!DOCTYPE html>
            <html lang="en">
            <head>
                <meta charset="UTF-8">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <title>{{ title }}</title>
                <link rel="stylesheet" href="{{path}}css/style.css">
            </head>
            <nav>
            <ul class="navigation">
                <div class="navigation__guest">
                    <li><a href="{{path}}role">Rôles classiques</a></li>
                    <li><a href="{{path}}">À propos</a></li>
                </div>
                {% if session.privilege == 1 %}
                <div class="navigation__admin">
                    <li><a href="{{path}}film">Films</a></li>
                    <li><a href="{{path}}acteur">Acteurs et actrices</a></li>
                    <li><a href="{{path}}user">Utilisateurs</a></li>
                </div>
                {% endif %}
                <div class="navigation__account">
                    {% if guest %}
                    <li><a href="{{path}}login">Login</a></li>
                    {% else %}
                    <li class="menu-username"> {{ session.username }}</li>
                    <li><a href="{{path}}login/logout">Logout</a></li>
                    {% endif %}
                </div>
            </ul>
        </nav>