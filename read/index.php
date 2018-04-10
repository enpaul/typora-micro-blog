<?php

$POST_DIR = __DIR__.'/../data/';
$META_NAME = 'meta.json';

if (empty($_GET['e'])) {
  header("Location: ..");
}
else {
  if (file_exists($POST_DIR.$_GET['e']) && file_exists($POST_DIR.$_GET['e'].'/'.$META_NAME) && file_exists($POST_DIR.$_GET['e'].'/content.html')) {
    $meta = json_decode(file_get_contents($POST_DIR.$_GET['e'].'/'.$META_NAME), true);
  }
  else {
    http_response_code(404);
    echo file_get_contents(__DIR__.'/../_error/404.html');
    exit();
  }
}

?>

<!DOCTYPE HTML>
<html>
  <head>
    <meta charset="utf-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <meta name="author" content="<?php echo $meta['author']['email']; ?>"/>
    <meta name="description" content="Writing about topics, reflections on things"/>
    <meta name="keywords" content="reflection, writing, blog, philosophy"/>
    <meta name="robots" content="index,follow"/>

    <!-- Facebook integration meta -->
    <meta property="og:title" content="<?php echo $meta['title']; ?>"/>
    <meta property="og:url" content="https://unobtrusive-rumination.enpaul.net/read/?e=<?php echo $meta['slug']; ?>"/>
    <meta property='og:site_name' content="Unobtrusive Rumination"/>
    <meta property="og:type" content="article"/>
    <meta property='og:locale' content="en_US"/>
    <meta property="og:image" content="https://download.enpaul.net/img/blog-ur-banner.jpg"/>
    <meta property='og:description' content="<?php echo $meta['description']; ?>"/>

    <!-- Twitter integration meta -->
    <meta name="twitter:card" content="summary">
    <meta name="twitter:title" content="<?php echo $meta['title']; ?>">
    <meta name="twitter:description" content="<?php echo $meta['description']; ?>">
    <meta name="twitter:image" content="https://download.enpaul.net/img/blog-ur-banner.jpg">
    <meta name="twitter:image:alt" content="Unobtrusive Rumination">

    <!-- Page title and favicon definition -->
    <title><?php echo $meta['title']; ?></title>
    <link rel="shortcut icon" href="../img/icon-black.png">
    <link rel="apple-touch-icon" sizes="180x180" href="img/icon-black.png">
    <link rel="icon" type="image/png" href="../img/icon-black.png" sizes="32x32">
    <link rel="icon" type="image/png" href="../img/icon-black.png" sizes="16x16">

    <!-- CSS Links -->
    <link href='../css/typora.css' rel='stylesheet' type='text/css'/>
    <link href="../css/style.css" rel="stylesheet" type="text/css"/>
  </head>

  <body class='typora-export os-windows' >
    <?php
      $content = file_get_contents($POST_DIR.$_GET['e'].'/content.html');
      preg_match("/<body[^>]*>(.*?)<\/body>/is", $content, $output);
      echo $output[1];
    ?>
    <div  id='write'  class = 'is-node'><div class="nav-menu"><a href="../">Home</a>&nbsp;&nbsp;/&nbsp;&nbsp;<a href="../about">About</a></div>
      <div class="copyright"><?php echo "<a target='_blank' href='".$meta['author']['social']['url']."'>@".$meta['author']['social']['handle']."</a><br>".$meta['timestamp']['update']."<br>".$meta['words']." words"; ?></div></div>
  </body>
</html>
