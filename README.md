# Instalação

1. git clone https://github.com/kotocrm/kotocrm.git
2. cd kotocrm
3. composer install
4. Configure a conexão ao banco de dados no arquivo config/autoload/local.php
    ```
    <?php
    
    return array(
        'doctrine' => array(
            'connection' => array(
                'orm_default' => array(
                    'driverClass' => 'Doctrine\DBAL\Driver\PDOMySql\Driver',
                    'params' => array(
                        'host'     => 'localhost',
                        'port'     => '3306',
                        'user'     => 'USUARIO',
                        'password' => 'SENHA',
                        'dbname'   => 'BD',
                    )
                )
            )
        )
    );
    ```
5. ./vendor/bin/doctrine-module orm:schema-tool:update --force
