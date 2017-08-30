<?php
include('secret_keys.php');
return [

    // key and secret of your application
    'consumer_key'      => $consumer_key,
    'consumer_secret'   => $consumer_secret,

    // callbacks for your application
    'url_login'         => 'http://dev.colinroitt.uk/spicytake/twitter_login.php',
    'url_callback'      => 'http://dev.colinroitt.uk/spicytake/twitter_callback.php',
    'url_tweet'     => 'http://dev.colinroitt.uk/spicytake/twitter_tweet.php'
];

?>
