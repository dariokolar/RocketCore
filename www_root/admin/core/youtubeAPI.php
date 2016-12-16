<?php

class YTapi {

// function to parse a video <entry>
    function singleVideo($data) {
	$xml = new stdClass;

// author name
	$xml->author = $data->author->name;

	$media = $data->children('http://search.yahoo.com/mrss/');

// title
	$xml->title = $media->group->title;

// description
	$xml->description = $media->group->description;

// URL
	$attrs = $media->group->player->attributes();
	$xml->watchURL = $attrs['url'];

// default thumbnail
	$xml->thumbnail_0 = $media->group->thumbnail[0]->attributes(); // Normal Quality Default Thumbnail
// category
	$xml->category = $media->group->category;

	$yt = $media->children('http://gdata.youtube.com/schemas/2007');
	$attrs = $yt->duration->attributes();

// duration
	$xml->duration = $attrs['seconds'];

// published
	$xml->published = strtotime($data->updated);

	$yt = $data->children('http://gdata.youtube.com/schemas/2007');
	$attrs = $yt->statistics->attributes();

// view count
//$xml->viewCount = $attrs['viewCount'];
// favourite count
//$xml->favCount = $attrs['favoriteCount'];

	$yt = $data->children('http://gdata.youtube.com/schemas/2007');

	if ($yt->rating) {
	    $attrs = $yt->rating->attributes();

// likes count
	    $xml->likeCount = $attrs['numLikes'];

// dislikes count
	    $xml->disLikeCount = $attrs['numDislikes'];
	} else {
	    $xml->likeCount = 0;
	    $xml->disLikeCount = 0;
	}

	$gd = $data->children('http://schemas.google.com/g/2005');
	if ($gd->rating) {
	    $attrs = $gd->rating->attributes();

// average rating
	    $xml->avgRating = $attrs['average'];

// maximum accept rating
	    $xml->maxRating = $attrs['max'];

// number of rates
	    $xml->numRaters = $attrs['numRaters'];
	} else {
	    $xml->avgRating = 0;
	    $xml->maxRating = 0;
	}

	$gd = $data->children('http://schemas.google.com/g/2005');
	if ($gd->comments->feedLink) {
	    $attrs = $gd->comments->feedLink->attributes();

// comments count
	    $xml->commentsCount = $attrs['countHint'];
	}

// related videos
	$data->registerXPathNamespace('feed', 'http://www.w3.org/2005/Atom');
	$relatedV = $data->xpath("feed:link[@rel='http://gdata.youtube.com/schemas/2007#video.related']");
	if (count($relatedV) > 0) {
	    $xml->relatedURL = $relatedV[0]['href'];
	}

	return $xml;
    }

    function getData($link) {
	$link = html_entity_decode($link, ENT_COMPAT, 'UTF-8');
// default Video ID
	$defaultID = "";

// GET submitted video ID or url
	if (isset($link) && $link != "") {
	    $submitID = preg_replace('/[^\w-_:?=.\/\\\\]|\s$/', '', $link);
	}

// default video ID
	else {
	    $submitID = $defaultID;
	}

// if video ID submitted


	if (strpos($submitID, '/') === false) {
	    return "err";
	}
// if video url submitted
	else {
	    preg_match("/^(?:http(?:s)?:\/\/)?(?:www\.)?(?:youtu\.be\/|youtube\.com\/(?:(?:watch)?\?(?:.*&)?v(?:i)?=|(?:embed|v|vi|user)\/))([^\?&\"'>]+)/", $submitID, $matches);
	 
	    if (isset($matches[1])) {
		$videoID = $matches[1];
	    } else {
		$videoID = '';
	    }
	}

// clean video id
	$videoID = preg_replace('/[^\w-_]+/', '', $videoID);

	$out["id"] = $videoID;
	
	if ($videoID != '') {

	    $id = $videoID;
	    $out["player"] = "<object width=\"376\" height=\"100\"><param name=\"movie\" value=\"https://www.youtube.com/v/" . $id . "?version=3&rel=0&modestbranding=1\"></param><param name=\"allowFullScreen\" value=\"true\"></param><param name=\"allowscriptaccess\" value=\"always\"><param name=\"allownetworking\" value=\"internal\"></param><embed src=\"https://www.youtube.com/v/" . $id . "?version=3&rel=0&modestbranding=1&hl=en_US\" type=\"application/x-shockwave-flash\" width=\"356\" height=\"232\" allowscriptaccess=\"always\" allowfullscreen=\"true\" allownetworking=\"internal\"></embed></object>";
	    $thumbnail_1 = ('http://i1.ytimg.com/vi/' . $id . '/1.jpg'); // Start Thumbnail
	    $thumbnail_2 = "http://i1.ytimg.com/vi/" . $id . "/2.jpg"; // Middle Thumbnail
	    $thumbnail_3 = "http://i1.ytimg.com/vi/" . $id . "/3.jpg"; // End Thumbnail
	    $thumbnail_4 = "http://i1.ytimg.com/vi/" . $id . "/0.jpg"; // Player Background Thumbnail
	    $thumbnail_5 = "http://i1.ytimg.com/vi/" . $id . "/mqdefault.jpg"; // Medium Quality Thumbnail
	    $thumbnail_6 = "http://i1.ytimg.com/vi/" . $id . "/hqdefault.jpg"; // High Quality Thumbnail
	    $thumbnail_7 = "http://i1.ytimg.com/vi/" . $id . "/sddefault.jpg"; // Standard Definition Thumbnail
	    $thumbnail_8 = "http://i1.ytimg.com/vi/" . $id . "/maxresdefault.jpg"; // Maximum Resolution Thumbnail


	    $out["thumb"][0] = $thumbnail_1;
	    $out["thumb"][1] = $thumbnail_2;
	    $out["thumb"][2] = $thumbnail_3;

	    $out["thumb"]["cover"] = $thumbnail_4;
	    $out["thumb"]["big"] = $thumbnail_8;

	    return $out;
	}else{
	    return "err";
	    
	}
    }

}
