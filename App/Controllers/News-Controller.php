<?php
/**
* NoticiasController - Controller de exemplo
*
* @package TutsupMVC
* @since 0.1
*/
class NewsController extends MainController
{

/**
* $login_required
*
* Se a página precisa de login
*
* @access public
*/
public $login_required = false;

/**
* $permission_required
*
* Permissão necessária
*
* @access public
*/
public $permission_required;

/**
* INDEX
*
* Carrega a página "/views/noticias/index.php"
*/
public function index() {
    /* Título da página */
    $this->title = 'Notícias';

    /* Carrega o modelo para este view */
    $modelo = $this->load_model('News/News-Adm-Model');

    /** Carrega os arquivos do view **/
    require ABSPATH . '/App/Views/_includes/_layout/Header.php';
    require ABSPATH . '/App/Views/_includes/_layout/Menu.php';
    require ABSPATH . '/App/Views/News/News-View.php';
    require ABSPATH . '/App/Views/_includes/_layout/Footer.php';

} /* index */

/**
* ADM
*
* Carrega a página "/views/noticias/noticias-adm-view.php"
*/
public function adm() {
    /* Page title */
    $this->title = 'Gerenciar notícias';
    $this->permission_required = 'gerenciar-noticias';

    /* Verifica se o usuário está logado */
    if ( ! $this->logged_in ) {

        /* Se não; garante o logout */
        $this->logout();

        /* Redireciona para a página de login */
        $this->goto_login();

        /* Garante que o script não vai passar daqui */
        return;

    }

    /* Verifica se o usuário tem a permissão para acessar essa página */
    if (!$this->check_permissions($this->permission_required, $this->userdata['user_permissions'])) {

        /* Exibe uma mensagem */
        echo 'Você não tem permissões para acessar essa página.';

        /* Finaliza aqui */
        return;
    }

    /* Carrega o modelo para este view */
    $modelo = $this->load_model('News/News-Adm-Model');

    /** Carrega os arquivos do view **/

    /* /views/_includes/header.php */
    require ABSPATH . '/App/Views/_includes/_layout/Header.php';
    require ABSPATH . '/App/Views/_includes/_layout/Menu.php';
    require ABSPATH . '/App/Views/News/News-Adm-View.php';
    require ABSPATH . '/App/Views/_includes/_layout/Footer.php';

} /* adm */

} /* class NoticiasController */