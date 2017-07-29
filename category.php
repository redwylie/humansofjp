<?php

require_once('vendor/twig/twig/lib/Twig/Autoloader.php');
Twig_Autoloader::register();

$loader = new Twig_Loader_Filesystem('views');

$twig = new Twig_Environment($loader, array(
  'cache' => false,
  'auto_reload' => true,
));

$category = null;
$category = $_GET['category'];
$partOfSet = null;

$file = file_get_contents('./images.json', true);

$json = $file;

$obj = json_decode($json);

$categoryImages = array();

foreach ($obj->{'images'} as &$image) {
    array_push($categoryImages, $image);
    $partOfSet = $image->viewOnSets;
}

$template = $twig->loadTemplate('category.html');
echo $template->render(array(
		'categoryTitle' => $category,
		'images' => $categoryImages,
		'id' => $id,
		'view' => 'Full',
		'partOfSet' => $partOfSet,
		'title' => 'Connected Stories - '.$category,
		'description' => 'Headshots, Portraits, Flowers'
	));

?>