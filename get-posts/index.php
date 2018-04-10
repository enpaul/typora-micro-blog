<?php

// Set the post data directory, and the name of the meta file to look for. If
// you change either of these, you'll need to modify the corresponding settings
// in /read/index.php otherwise display won't work
$POST_DIR = __DIR__.'/../data/';
$META_NAME = 'meta.json';

// Make sure that the data directory actually exists
if (is_dir($POST_DIR)) {
  // Read contents of the post directory
  $contents = scandir($POST_DIR);
  // Create the empty data array
  $properties = [];
  // Loop through the contents of the post directory
  foreach ($contents as $content) {
    // If the content is a directory, operate; otherwise continue
    if (is_dir($POST_DIR.$content)) {
      // Scan the contents of the subdirectory
      $subcontents = scandir($POST_DIR.$content);
      // If there is a meta file in the subdirectory, operate, otherwise continue
      if (in_array($META_NAME, $subcontents)) {
        // Idiot check, make sure the file is actually file and not just a dir
        if (is_file($POST_DIR.$content.'/'.$META_NAME)) {
          // Get the meta data from the meta file
          $meta = json_decode(file_get_contents($POST_DIR.$content.'/'.$META_NAME), true);
          // Last idiot check, make sure that there is actually a content file in
          // the directory. If there isn't, skip it. Otherwise add the meta to the
          // array listing of posts
          if (is_file($POST_DIR.$content.'/content.html')) {
            array_push($properties, $meta);
          }
          else {
            continue;
          }
        }
        else {
          continue;
        }
      }
      else {
        continue;
      }
    }
    else {
      continue;
    }
  }
}
// If the post directory doesn't exist, return empty
else {
  $properties = [];
}

// This conditional determins whether this is a raw request for JSON data or
// a request from the homepage datatable. It determins whether the output is
// formatted in raw JSON or JSON with HTML to be formatted into the table
// NOTE: by default, raw JSON is exported. To export the formatted variant, use
// the query parameter "process" set to "format"
if (!empty($_GET['process']) && $_GET['process'] == 'format') {
  // Create the empty data array; this will be returned to the table in JSON format
  $data = [];
  // For each of the entries in the properties array, assembled from the posts directory,
  // iterate through it for processing
  foreach ($properties as $input) {
    // Format the title cell with the title and link to post, as well as the micro
    // details used on small screens
    $title = '<a href="read/?e='.$input['slug'].'">'.$input['title'].'</a><span class="post-micro-details"><br>'.$input['words'].' words, by <a target="_blank" href="'.$input['author']['social']['url'].'">@'.$input['author']['social']['handle'].'</a>&nbsp;&nbsp;&nbsp;('.$input['timestamp']['update'].')</span>';
    // Format the details cell used on large screens
    // NOTE: this cell must start with the timestamp for chronological ordering to
    // work properly
    $details = $input['timestamp']['update'].'<br>'.$input['words'].' words, by <a target="_blank" href="'.$input['author']['social']['url'].'">@'.$input['author']['social']['handle'].'</a><br>';
    // Cycle through the tags and append them to the details cell string
    foreach ($input['tags'] as $tag) {
      $details = $details.'<span class="tag">+'.$tag.'</span>';
    }
    // Push the formatted strings into the data array as an entry
    array_push($data, ["Title" => $title, "Details" => $details]);
  }

  // Output the JSON data
  header('Content-Type: application/json');
  echo json_encode(["data" => $data]);
  exit();
}
// Raw JSON data export
else {
  // Create the empty output array
  $data = [];
  // Iterate through the generated properties for assembly
  foreach ($properties as $input) {
    $item = [
      "title" => $input['title'], // Post title
      // This doozy of a command parses out the URL to use for the post
      "url" => (isset($_SERVER['HTTPS']) ? "https" : "http")."://".$_SERVER['HTTP_HOST'].substr(strtok($_SERVER["REQUEST_URI"],'?'), 0, -18)."/read/?e=".$input['slug'],
      "words" => $input['words'], // Word count
      "date" => $input['timestamp']['update'], // Publishing date
      "author" => [ // Author information
        "handle" => $input['author']['social']['handle'],
        "url" => $input['author']['social']['url'],
        "contact" => $input['author']['email']
      ],
      "tags" => $input['tags'] // The tag array is perserved
    ];
    array_push($data, $item); // Push the item into the output array
  }

  // Output the JSON data
  header('Content-Type: application/json');
  echo json_encode($data);
  exit();
}

?>
