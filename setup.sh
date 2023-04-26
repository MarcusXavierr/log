echo "Subindo repositório e fazendo build das imagens"
docker-compose up -d --build

echo "Instalando dependencias do frontend"
docker exec -it -u root test-logcomex-node npm install

echo "Buildando o frontend"
docker exec -it -u root test-logcomex-node npm run build

echo "Instalando dependencias do backend"
docker exec -it -u root test-logcomex-php composer install

echo "criando o .env do frontend"
cp packages/frontend/.env.example packages/frontend/.env

echo "criando o .env do backend"
cp packages/backend/.env.example packages/backend/.env

echo "criando a application key do laravel"
docker exec -it -u root test-logcomex-php php artisan key:generate

echo "esperando alguns segundos e rodando a migration do banco de dados e as seeders"
sleep 10; docker exec -it -u root test-logcomex-php php artisan migrate --seed
