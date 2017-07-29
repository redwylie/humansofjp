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
$story = null;

$file = file_get_contents('./images.json', true);

//var_dump($file);
//var_dump($photoId);

$json = $file;

$obj = json_decode($json);

//print $obj->{'images'};

$categoryImages = array();

foreach ($obj->{'images'} as &$image) {
    
      if ($image->viewOnCategories == true) {
          array_push($categoryImages, $image);
      }
        $partOfSet = $image->viewOnSets;
        $story = $images->story;
    
}

//var_dump($photo);

$template = $twig->loadTemplate('category.html');
echo $template->render(array(
    'categoryTitle' => $category,
    'images' => $categoryImages,
    'id' => $id,
    'view' => 'Full',
    'story' => $story,
    'partOfSet' => $partOfSet,
    'title' => 'Connected Stories - '.$category,
    'description' => 'Headshots, Portraits, Flowers'
  ));

?>