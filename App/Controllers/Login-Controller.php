<?php
/**
* LoginController - Controller de exemplo
*
* @package TutsupMVC
* @since 0.1
*/
class LoginController extends MainController
{

/**
* Carrega a página "App/Views/Login/index.php"
*/
public function index() {
	/*  Título da página */
	$this->title = 'Login';

	/*  Parametros da função */
	$parametros = ( func_num_args() >= 1 ) ? func_get_arg(0) : array();

	/*  Login não tem Model */
	/** Carrega os arquivos do view **/
	require ABSPATH . '/App/Views/_includes/_layout/Header.php';
	require ABSPATH . '/App/Views/_includes/_layout/Menu.php';
	require ABSPATH . '/App/Views/Login/Login-View.php';
	require ABSPATH . '/App/Views/_includes/_layout/Footer.php';

} /*  index */

} /*  class LoginController */