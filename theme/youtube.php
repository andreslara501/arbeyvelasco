<?php
// YouTube video url
$videoURL = 'https://www.youtube.com/watch?v=vw4Zu21a7Cg';
$urlArr = explode(".com/watch?v=",$videoURL);
$urlArrNum = count($urlArr);

// Youtube video ID
$youtubeVideoId = $urlArr[$urlArrNum - 1];

// Generate youtube thumbnail url
$thumbURL = 'http://img.youtube.com/vi/'.$youtubeVideoId.'/0.jpg';

// Display thumbnail image
echo '<img src="'.$thumbURL.'"/>';
?>
