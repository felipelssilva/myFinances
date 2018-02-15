<?php
/**
* Home - Controller de exemplo
*
* @package myFinances
* @since 0.1
*/
class HomeController extends MainController
{

/**
* Carrega a página "App/Views/Home/Home-View.php"
*/
public function index() {
	/* Título da página */
	$this->title = 'Home';

	/* Parametros da função */
	$parametros = ( func_num_args() >= 1 ) ? func_get_arg(0) : array();

	/* Essa página não precisa de modelo (model) */
	/** Carrega os arquivos do view **/
	require ABSPATH . '/App/Views/_includes/_layout/Header.php';
	require ABSPATH . '/App/Views/_includes/_layout/Menu.php';
	require ABSPATH . '/App/Views/Home/Home-View.php';
	require ABSPATH . '/App/Views/_includes/_layout/Footer.php';

} /* index */

} /* class HomeController */