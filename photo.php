<?php
header("Access-Control-Allow-Origin: *");
require_once('vendor/twig/twig/lib/Twig/Autoloader.php');
Twig_Autoloader::register();

$loader = new Twig_Loader_Filesystem('views');

$twig = new Twig_Environment($loader, array(
  'cache' => false,
  'auto_reload' => true,
));

$photo = null;
$photoTitle = null;
$photoId = $_GET['photo'];

$file = file_get_contents('./images.json', true);

//var_dump($file);
//var_dump($photoId);

$json = $file;

$obj = json_decode($json);

//print $obj->{'images'};

$photoIdPrevious = null;
$photoIdNext = null;
$category = null;
$set = null;

foreach ($obj->{'images'} as &$image) {
    if ($image->_id == $photoId) {
        $category = $image->category;
        $set = $image->set;
        break;
    };
}

$urlCategory = 'set.php?set=' . $set .'&category=' . $category;
$urlPrevious = 'set.php?set=' . $set .'&category=' . $category;
$urlNext = 'set.php?set=' . $set .'&category=' . $category;

$urlSet = null;
if (!is_null($set)) {
    $urlSet = 'set.php?category=' . $category . '&set=' .$set;
}

foreach ($obj->{'images'} as &$image) {
    if (!is_null($photo) && is_null($photoIdNext) && $category == $image->category) {
        $photoIdNext = $image->_id;
        $urlNext = 'photo.php?photo=' . $photoIdNext;
        break;
    }
    if ($image->_id == $photoId) {
        $photo = $image;
        $photoTitle = $image->title;
    };
    if (is_null($photo) && $image->category == $category) {
        $photoIdPrevious = $image->_id;
        $urlPrevious = 'photo.php?photo=' . $photoIdPrevious;
    }
}

//var_dump($photo);

$template = $twig->loadTemplate('photo.html');
echo $template->render(array(
		'photo' => $photo,
		'id' => $id,
		'title' => 'Humans of JP - ' .$photoTitle,
        'shortTitle' => $photoTitle,
        'photoIdPrevious' => $photoIdPrevious,
        'photoIdNext' => $photoIdNext,
        'urlCategory' => $urlCategory,
        'urlPrevious' => $urlPrevious,
        'urlNext' => $urlNext,
        'category' => $category,
        'set' => $set,
        'urlSet'=> $urlSet,
	));

?>