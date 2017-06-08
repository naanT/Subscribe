<?php

\Codebird\Codebird::setConsumerKey('S6YYwVp9WhwgegDBePrdZigei', 'xC5tPKj8XUcDshxTXZL7bJqPcVtBVTYepW7JDOBy18FxlgfmvD'); // static, see README


$cb = \Codebird\Codebird::getInstance();

$cb->setToken('2762909502-dCNbDCUBQNpTf2S3ms7HpkCOLv7Cys8q2UleBL4', '2gDnrYBIuO1jONRoWh6ox0BdzwtahP1da93FKYU8aHdVu');


// $reply = (array) $cb->statuses_homeTimeline();

$media_files = [
  '/home/naan/Pictures/join.png'
];
// will hold the uploaded IDs
$media_ids = [];

foreach ($media_files as $file) {
  // upload all media files
  $reply = $cb->media_upload([
    'media' => $file
  ]);
  // and collect their IDs
  $media_ids[] = $reply->media_id_string;
}


$media_ids = implode(',', $media_ids);

// send Tweet with these medias
$reply = $cb->statuses_update([
  'status' => 'hi! finally images is uploaded',
  'media_ids' => $media_ids
]);
print_r($reply);
