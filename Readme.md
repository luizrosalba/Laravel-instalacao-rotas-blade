# Laravel-instalacao-rotas-blade

- vamos usar o composer 
- composer create-project laravel/laravel cadastrolaravel 6
- .env não deve ser versionado , só serve para uma máquina (autenticação , chave ... nao deve ser versionado )
- .env.example deve ser versionado 
# .env (environment)
- pode ocorrer de ter varios bancos , o nome da conexão (chave ex:DB-Connection )deve ser unico 
- tudo que é relacionado a sessão o laravel usa criptografia para gravar 
- não devemos perder a APP_KEY
-  mkdir banco 
-  cd banco/
- touch laravel.sqlite
- dentro de config temos as configurações padrões para cada tipo de banco (mysql ,sqllite... )
- ao alterar um arquivo da pasta config precisamos limpar o cache 
- na raiz do projeto vamos usar o artisan 
- php artisan config:clear
