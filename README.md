# FUNCIONAMIENTO CON DOCKER

## PRECONDICIONES
- Docker instalado
- Una vez levantado el docker compose se tiene que importar docker/postgresql/manga.sql dentro del contenedor de postgresql
- En app/models/database.php las variables tienen que ser: 
    - ```$host 'postgres';```
    - ```$dbname = 'mangahouse';```
    - ```$user = 'postgresql';```
    - ```$password = 'password';```
    
## USO
### Ejecutamos ```docker compose build .``` estando en el mismo path que el docker-compose.yml
### Luego levantamos los contenedores con ```docker compose up -d```
### Para importar el archivo manga.sql tenemos que copiar el archivo con ```docker cp manga.sql ${ID_CONTENEDOR_PSQL}:.```
### Nos conectamos al contenedor con ```docker exec -it ${ID_CONTENEDOR_PSQL} bash```