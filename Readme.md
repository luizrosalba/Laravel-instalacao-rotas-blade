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
- SQLite, MySQL, SQL Server e PostgreSQL.
# estutura de arquivos 

- session por padrao é file (dentro do .env) ( grava em um arquivo ) 


    'driver' => env('SESSION_DRIVER', 'file'),

- podemos alterar  odrive 

CACHE_DRIVER=file

| Supported: "file", "cookie", "database", "apc",
    |            "memcached", "redis", "dynamodb", "array"

- se escolhemos database , precisamos de algumas tabelas no banco 
- podemos manter a sessao viva durante um tempo    'lifetime' => env('SESSION_LIFETIME', 120),

- pasta logs : erros e etc 

- pasta app 
- pasta http arquivos , ciontrolers , api , ... 
- middlewares pequenos utilitarios e funcoes que podem ser chamadas na rota , executados antes de qquer coisa (validação , vericação , etc )
- exceptions 
- console ( comandos criados ) schedule (cron)
- resources (layout)
- mix (gulp) compacta tudo para que o js tenha uma versao mimificada 
- tests  ( testes unitários )
- vendor  biblios do laravel 
- public  ( pasta que aponta quando configura o servidor web )
- a pasta raiz do projeto não deve ser visível , somente a pasta public 

# Rotas e Model  

- Rota : Mapeamento de um endereço para outro endereço físico ou lógico 
- crie o controller inicial para cadastro de usuarios com uma view simples 
- uma rota do tipo get 
- uma rota post para envio de dados 
- podemos usar o artisan par aisso 
- php artisan make:controller Usuario
- Request recebe os dados 
- php artisan serve (inica um server de dev)
- como usei o mesmo container do nginx precisei recriar a configuração da pasta inicial do server 
-  fui em : /etc/nginx/conf.d e editei o default.conf para : 

root /application/public;


``` JS 
server {
    listen 80 default;
    root /laravel/cadastrolaravel/public;
    index index.php;

    if (!-e $request_filename) {
        rewrite ^.*$ /index.php last;
    }

    location ~ \.php$ {
        fastcgi_pass php-fpm:9000;
        fastcgi_index index.php;
        fastcgi_param SCRIPT_FILENAME $document_root$fastcgi_script_name;
        fastcgi_param PHP_VALUE "error_log=/var/log/nginx/application_php_errors.log";
        fastcgi_buffers 16 16k;
        fastcgi_buffer_size 32k;
        include fastcgi_params;
    }
}
```

- erro de permissao 
-  
```
sudo chown -R $USER:www-data storage
sudo chown -R $USER:www-data bootstrap/cache
chmod -R 775 storage
chmod -R 775 bootstrap/cache
```
reiniciei o server  e funcionou :D 

- estamos criando as rotas 
- api.php só é usado se chamamos a rota /user , que nao vamos usar (comentamos em api.php)
- laravel chama as apis por /api 
- verisonamento na propria rota 

``` JS
Route::prefix('v1')->group(function(){
    Route::get('lista', function(){
        return ["a","b","c"];
    });
});

```

- http://localhost:89/api/v1/lista  (retorna em json )

# Models 

Um dos três pilaves do MVC , A camada de interação do usuário(view), a camada de manipulação dos dados(model) e a camada de controle(controller). 

![](https://dkrn4sk0rn31v.cloudfront.net/uploads/2020/06/diagramaMVC.png)

- O Model é responsável pela comunicação com o BD
- vamos criar um model
- Eloquent ORM , um objeto que faz um mapeamento e manipulação entre os dados e a aplicação 
- php artisan make:model 
- conecta ao db e utiliza a tabela para se autanticar 
- o laravel já traz um model user 
- campos ocultos : informações sensíveis 
- php artisan make:model Model/Usuario
- tudo relacionado a bd deve ficar em model 
- 

# Blade Template 

- gerenciador de template do laravel 
- 
- estrutura básica do template, cabeçalho , rodapé .

- php artisan config:cache
-  @yield conteudo em da pagina filha 
- mix- interessante utilizar para mimificar o js o css ... 

-  exemplo : passando argumento para rota : 

no web.php 
Route::post('/salvar/{id}', 'Usuario@salvar')->name('salvar');

no arquivo usando 
 <form action="{{route('salvar',['id' => 5])}}" method="post"></form>


- {{csrf_field()}} para dar segurança e usar um token no cadastro 


# Validação do cadastro 

-pequena validação 
```
 public static function  cadastrar(Request $request){
        $sql = self::insert([
            "nome"=> $request -> input ('nome'), 
            "email"=> $request -> input ('email'), 
            "senha"=> $request -> Hash::make($request->input('senha')), 
            "data_cadastro"=> DB::raw('NOW()')
        ]);
        dd($sql->toSql(), $request->all());
    }
```
- Validação de formulário

- form request classe de validação para usar em vários lugares , com mensagens customizadas ... 


- sudo apt-get install -y sqlite
- sqlite laravel.sqlite
CREATE TABLE usuario (id INTEGER PRIMARY KEY UNIQUE,nome VARCHAR,email VARCHAR,senha VARCHAR,data_cadastro DATETIME);

CREATE TABLE usuario (id INTEGER PRIMARY KEY UNIQUE,nome VARCHAR,email VARCHAR,senha VARCHAR,data_cadastro DATETIME);



# Carbon 

Extende a classe padrão do datetime do php e adiciona outras funcoes interessantes 

5:49 a permissao estava errada (cloquei 777 cuidado! ) e usei o sqlite quando devia ter usado o sqlite3 . 




