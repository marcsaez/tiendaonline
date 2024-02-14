# FUNCIONAMIENTO CON DOCKER

## PRECONDICIONES
- Docker instalado
- Una vez levantado el docker compose se tiene que importar docker/postgresql/manga.sql
- En app/models/database.php las variables tienen que ser: 
    - ```$host 'postgres';```
    - ```$dbname = 'mangahouse';```
    - ```$user = 'postgresql';```
    - ```$password = 'password';```
    