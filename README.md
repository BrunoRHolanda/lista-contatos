 # Passos para se executar os arquivos da aplicação
 
 ## 1. Inicialização
 
 Necessário ter instalado o vagrant e o virtual box
 
 1. vagrant up (inicializa a máquina virtual)
 1. npm install (instale as dependências do node com um npm externo)
 3. vagrant ssh
 
 ## 2. Configuração do mysql
 
 1. mysql -u root -p
 2. senha: root
 3. GRANT ALL PRIVILEGES ON *.* TO 'contatos_user'@'%' IDENTIFIED BY '123456';
 4. \q
 5. mysql -u contatos_user -p
 6. CREATE DATABASE contatos_db;
 7. \q
    
 ## 3. Configuração do laravel
 
 1. cd /vagrant
 2. php artisan migrate
 3. php artisan db:seed
 4. ./vendor/bin/phpunit (testes)
 5. exit
 
 ## 4. Iniciando o vue com npm
 
 13. npm run watch

 ## 5. Considerações finais

A aplicação estará disponível em: http://localhost:8080

Main informações sobre a operação da máquina virtual consulte
o Vagrantfile

o diretório com o app vue está em resource/assets
