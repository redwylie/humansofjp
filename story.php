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
$set = null;
$set = $_GET['set'];
$hideSetTitles = false;

$file = file_get_contents('./images.json', true);

//var_dump($file);
//var_dump($photoId);

$json = $file;

$obj = json_decode($json);

//print $obj->{'images'};

$setImages = array();

foreach ($obj->{'images'} as &$image) {
    if ($image->set == $set) {
        array_push($setImages, $image);
        if($image->hideTitles == true) {
        	$hideSetTitles = true;
        }
    };
}

//var_dump($photo);

$template = $twig->loadTemplate('story.html');
echo $template->render(array(
		'categoryTitle' => $category,
		'setTitle' => $set,
		'images' => $setImages,
		'id' => $id,
		'hideSetTitles' => $hideSetTitles,
		'view' => 'Set',
		'title' => 'Humans of JP - '.$set,
		'description' => 'Headshots, Portraits, Flowers'
	));

?>