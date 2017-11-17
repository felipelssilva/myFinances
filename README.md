# My Finances

test project, creating my own finances

### Database to create


```
CREATE DATABASE IF NOT EXISTS `myFinancesDB` CHARACTER SET utf8;
```

``` 
CREATE TABLE IF NOT EXISTS `myFinancesDB`.`noticias` (
	`noticia_id` INT (11) NOT NULL AUTO_INCREMENT,
	`noticia_data` DATETIME DEFAULT '0000-00-00 00:00:00',
	`noticia_autor` VARCHAR (255),
	`noticia_titulo` VARCHAR (255),
	`noticia_texto` TEXT,
	`noticia_imagem` VARCHAR (255),
PRIMARY KEY (`noticia_id`)
) ENGINE = MYISAM CHARSET = utf8 ;
  ```

```
CREATE TABLE IF NOT EXISTS `myFinancesDB`.`users` (
	`user_id` INT(11) NOT NULL AUTO_INCREMENT,
	`user` VARCHAR(255) COLLATE utf8_bin NOT NULL,
	`user_password` VARCHAR(255) COLLATE utf8_bin NOT NULL,
	`user_name` VARCHAR(255) COLLATE utf8_bin DEFAULT NULL,
	`user_session_id` VARCHAR(255) COLLATE utf8_bin DEFAULT NULL,
	`user_permissions` LONGTEXT COLLATE utf8_bin,
PRIMARY KEY (`user_id`)
) ENGINE=MYISAM AUTO_INCREMENT=0 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
```


```
INSERT INTO `myFinancesDB`.`users` (
	`user_id`,
	`user`,
	`user_password`,
	`user_name`,
	`user_session_id`,
	`user_permissions`
) 
VALUES
(
	NULL,
	'Admin',
	'$2a$08$2sGQinTFe3GF/YqAYQ66auL9o6HeFCQryHdqUDvuEVN0J1vdhimii',
	'Admin',
	'ljfp99gvqm2hg2bj6jjpu4ol64',
	'a:2:{i:0;s:13:"user-register";i:1;s:18:"gerenciar-noticias";}'
) ;
```

## htaccess

```
	RewriteEngine On
	 
	RewriteCond %{REQUEST_FILENAME} !-d
	RewriteCond %{REQUEST_FILENAME} !-f
	RewriteCond %{REQUEST_FILENAME} !-l
	 
	RewriteRule ^(.+)$ index.php?path=$1 [QSA,L]
```



## This is a examples for querys

```php
<?php
/* Objeto */
$db = new myFinancesDB();

/* Insere */
$db->insert(
	'tabela', 

	/* Insere uma linha */
	array('campo_tabela' => 'valor', 'outro_campo'  => 'outro_valor'),

	/* Insere outra linha */
	array('campo_tabela' => 'valor', 'outro_campo'  => 'outro_valor'),

	/* Insere outra linha */
	array('campo_tabela' => 'valor', 'outro_campo'  => 'outro_valor')
);

/* Atualiza */
$db->update(
	'tabela', 'campo_where', 'valor_where',

	/* Atualiza a linha */
	array('campo_tabela' => 'valor', 'outro_campo'  => 'outro_valor')
);

/* Apaga */
$db->delete(
	'tabela', 'campo_where', 'valor_where'
);

/* Seleciona */
$db->query(
	'SELECT * FROM tabela WHERE campo = ? AND outro_campo = ?',
	array( 'valor', 'valor' )
);
```

## This is a examples for querys inside the models

```php
<?php
/* Objeto */
$modelo->db = new myFinancesDB();

/* Insere */
$modelo->db->insert(
	'tabela', 

	/* Insere uma linha */
	array('campo_tabela' => 'valor', 'outro_campo'  => 'outro_valor'),

	/* Insere outra linha */
	array('campo_tabela' => 'valor', 'outro_campo'  => 'outro_valor'),

	/* Insere outra linha */
	array('campo_tabela' => 'valor', 'outro_campo'  => 'outro_valor')
);

/* Atualiza */
$modelo->db->update(
	'tabela', 'campo_where', 'valor_where',

	/* Atualiza a linha */
	array('campo_tabela' => 'valor', 'outro_campo'  => 'outro_valor')
);

/* Apaga */
$modelo->db->delete(
	'tabela', 'campo_where', 'valor_where'
);

/* Seleciona */
$modelo->db->query(
	'SELECT * FROM tabela WHERE campo = ? AND outro_campo = ?',
	array( 'valor', 'valor' )
);
```

## Creating a Controller

The controllers must be inserted in the "App/Controllers" folder with the following name format:

* Example-Controller.php

Always keep the first letter of each word in capital letters!

```php
<?php
class ExampleController extends MainController
{
	/* Here comes our actions */
}
```


Just creating our class will not make the application work, we have to have at least one action (method):

```php
<?php
class ExampleController extends MainController
{
	/* URL: dominio.com/example/ */
	public function index() {

		/* Load the model */
		$modelo = $this->load_model('Example/Example-Model');

		/* Load the view */
		require_once ABSPATH . 'App/Views/Example/Example-View.php';
	}
}
```

## Creating a Model

The templates are inside the "App/Models" folder.

Just by name naming, I'll create my templates in the following format:

* Model-Model.php

Always with the same name as your controller.

E Keeping the first letter of each word in capital letters!

For our example, my model has the following note:

* Example-Model.php

```php
<?php
class ExampleModel extends MainModel
{
/**
* Constructor for this class
*
* Configures the DB, controller, parameters and user data.
*
* @since 0.1
* @access public
* @param object $db Object of our PDO connection
* @param object $controller Controller Object
*/
public function __construct( $db = false, $controller = null ) {
	/* Configure the DB (PDO) */
	$this->db = $db;

	/* Set the controller */
	$this->controller = $controller;

	/* Configure the parameters */
	$this->parametros = $this->controller->parametros;

	/* Configures user data */
	$this->userdata = $this->controller->userdata;

	echo 'Model load... <br>';
}

/* Create your own methods from now on */
}
```

## Creating a View

Now that we have a controller and a model, we need a view to display the data.

The views are in the "App/Views" folder. Usually separated into their own folders.

```php
<?php
echo '<h2>Model data.</h2>';
echo '<pre>';
print_r( $modelo );
echo '</pre>';
?>

<h2>Ready</h2>

<p>Include your site or data in this view...</p>
```


## Como funcionam as permissões?

Na verdade, você é quem escolhe como funcionam as permissões.

O formulário de cadastro terá um campo onde você separa as permissões por vírgula, por exemplo:

* acessar-home, gerenciar-noticias, abrir-modelo-adm, e assim por diante...

Em seguida, é só verificar no controller se o usuário tem aquela permissão, por exemplo:

```php
/* Verifica se o usuário tem a permissão para acessar essa página */
if (!$this->check_permissions('permissao-necessaria', $this->userdata['user_permissions'])) {
 
 /* Exibe uma mensagem */
 echo 'Você não tem permissões para acessar essa página.';
 
 /* Finaliza aqui */
 return;
}
```

Simples assim!













---

> ### Restricting direct access to files
> It is important that you keep in mind that more knowledgeable users about PHP and HTML can understand how the system works and try to execute files directly. To restrict direct access to any content in your MVC system, add the following line in the header of your code:
>
> Restrict direct access to files
> ```<?php if ( ! defined('ABSPATH')) exit; ?> ```



