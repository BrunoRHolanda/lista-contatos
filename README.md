# Prova de Avaliação Técnica

Esta Prova consiste em desenvolver uma aplicação WEB feita na linguagem PHP para fim de avaliação Técnica no processo seletivo da Before.

# Aplicação

A aplicação que será desenvolvida é uma agenda de contatos, aonde o usuário poderá adicionar contatos, que consiste em: nome, telefone, e-mail.

A agenda deve conter pelo menos um filtro, ou seja por busca textual ou por inicial do nome do contato.

# Método de Avaliação

A prova possui um critério mínimo de requisitos que devem ser entregue, que são:

 - Capacidade de adicionar Contatos
 - Buscar Contatos

A partir do momento que foi atigindo o critério mínimo o candidato tem direito de submeter a prova, porém caso o candidato queira adicionar funcionalidades, modificações em questões de layout, arquitetura da aplicação etc, isso será avaliado também.

# Itens Técnicos Obrigatórios

O canditado deverá utilizar o Framework PHP Laravel (https://laravel.com/).

# Itens Adicionais

Caso o candidato utilize algum dos itens a seguir conseguirá pontos adicionais na prova:

 - Utilização de Framework Javascript Vuejs
 - Utilização de Padrões de Projetos
 - Utilização de Testes Automatizados


# Duração da Prova

A prova terá duração determinada pelo período em que o candidato terá acesso ao repositório da prova. O envio é exclusivo pelo GitLab e deve ser durante o período da prova, ressaltando que o avaliado tem o direito de entregar a qualquer momento o código contando que esteja no tempo hábil da prova.

# Passos para entregar a Prova

 - Criar um fork do repositorio
 - adicionar o código no repositorio forkeado
 - fazer um pull request para o repositorio da before
 
 #
 # Passos para se executar os arquivos da aplicação (Resolução)
 
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