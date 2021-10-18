<?php
/**
 * Load view file dari folder app/views
 * template engine yang digunakan adalah twig
 * @param mixed $path
 * @param array $args
 * 
 * @return [file buffer]
 */
function view($path, $args = []) {
	$filepath = explode(".", $path)[0];
	$template_dir = __DIR__ . "/app/views/";

	$loader = new \Twig\Loader\FilesystemLoader($template_dir);
	$twig = new \Twig\Environment($loader);

	echo $twig->render($filepath . ".php", $args);
}
