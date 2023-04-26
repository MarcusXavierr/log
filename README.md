## Mini BI de vendas


https://user-images.githubusercontent.com/59923581/234614710-8f9816a5-ff1b-4eb6-bf54-a1eca1c33f3c.mp4



https://user-images.githubusercontent.com/59923581/234616556-8a0549bf-ac71-4b55-af82-aa021cb4a477.mp4



A ideia desse projeto é ser um mini BI de vendas, onde são mostrados gráficos, e caso o usuário clique no gráfico, é redirecionado para uma tela de detalhamento

**Só é preciso ficar atento a uma coisa**, caso você não esteja usando um computador com processador `ARM`, não é necessário deixar o parâmetro `platform: linux/amd64` no arquivo docker-compose.yml, nesse trecho da configuração do mysql
```docker
...
  mysql:
    build: ./.docker/mysql
    command: --innodb-use-native-aio=0 --default-authentication-plugin=mysql_native_password
    container_name: "test-logcomex-mysql"
    platform: linux/amd64 # Pode apagar se não usar processador ARM
    ...
```

## Como rodar o projeto
O setup desse projeto pode ser feito usando o docker. Na raiz do projeto eu deixei um arquivo `setup.sh` contendo os comandos necessário para subir o projeto. Colocarei o conteúdo dele aqui e explicarei quando for necessário fazer mais alguma coisa

Caso você queira rodar outro banco de dados e não o do docker, copie o script abaixo deixando de copiar somente os dois ultimos comandos. Após rodar ele, atualize o .env com o seu banco de dados e rode o último comando

```sh
# Esse comando irá subir os containers e buildar o que for necessário
docker-compose up -d --build

# Depois que os containers tiverem rodando, é necessário rodar esse comando para instalar dependencias do front
docker exec -it -u root test-logcomex-node npm install

# Rodando esse comando para fazer o build
docker exec -it -u root test-logcomex-node npm run build-only

# Instalando dependencias do backend
docker exec -it -u root test-logcomex-php composer install

# criando o .env do frontend
cp packages/frontend/.env.example packages/frontend/.env

# criando o .env do backend
cp packages/backend/.env.example packages/backend/.env

# criando a application key do laravel
docker exec -it -u root test-logcomex-php php artisan key:generate

# esperando alguns segundos e rodando a migration do banco de dados e as seeders
# Caso você queira usar outro banco de dados e não o do docker, atualize o arquivo .env em packages/backend antes de rodar esse comando
sleep 10; docker exec -it -u root test-logcomex-php php artisan migrate --seed
```


