<?php

include("generate_tweet.php");

require 'twitteroauth/autoload.php';
use Abraham\TwitterOAuth\TwitterOAuth;

session_start();

$config = require_once 'config.php';

// get and filter oauth verifier
$oauth_verifier = filter_input(INPUT_GET, 'oauth_verifier');

// check tokens
if (empty($oauth_verifier) || empty($_SESSION['oauth_token']) || empty($_SESSION['oauth_token_secret'])) {
    // something's missing, go and login again
    header('Location: ' . $config['url_login']);
}

// connect with application token
$connection = new TwitterOAuth(
    $config['consumer_key'],
    $config['consumer_secret'],
    $_SESSION['oauth_token'],
    $_SESSION['oauth_token_secret']
);

// request user token
$token = $connection->oauth(
    'oauth/access_token', [
        'oauth_verifier' => $oauth_verifier
    ]
);

// connect with user token
$twitter = new TwitterOAuth(
    $config['consumer_key'],
    $config['consumer_secret'],
    $token['oauth_token'],
    $token['oauth_token_secret']
);

$user = $twitter->get('account/verify_credentials');

// if something's wrong, go and log in again
if(isset($user->error)) {
    header('Location: ' . $config['url_login']);
}

$tweet_to_post = getTweet();

// post a tweet
$status = $twitter->post(
    "statuses/update", [
        "status" => $tweet_to_post
    ]
);

// echo ('Created new status successfully <br/>' . $tweet_to_post);
// echo("<br/><a href = 'http://dev.colinroitt.uk/spicytake'><h3>Link Home</h3></a>");

?>
<html>
    <head>
        <link type="text/css" href="./style.css" rel="stylesheet">
    </head>
    <body>
        <div class='center-post-tweet'>
            <h1>Here is your <em>SPICY</em> hot take</h1>
            <h3>It's been posted to your Twitter for you so you don't have to</h3>
            <div id="tweet" tweetID=<?php echo($status->id) ?>  ></div>

            <script sync src="https://platform.twitter.com/widgets.js"></script>

            <script>

            window.onload = (function(){

                var tweet = document.getElementById("tweet");
                var id = tweet.getAttribute("tweetID");
                console.log(id);

                twttr.widgets.createTweet(
                id, tweet, 
                {
                    conversation : 'none',    // or all
                    cards        : 'hidden',  // or visible 
                    linkColor    : '#cc0000', // default is blue
                    theme        : 'light'    // or dark
                })
                .then (function (el) {
                el.contentDocument.querySelector(".footer").style.display = "none";
                });

            });

            </script>

            <a href="http://dev.colinroitt.uk/spicytake"><h2 id='try-again'>Try Aagin</h2></a>
            <a href="http://colinroitt.uk/">ColinRoitt.uk</a> &nbsp; <a href="http://blog.colinroitt.uk/2017/08/12/today-i-brought-to-life-the-stupidest-web-thing-ive-ever-made-spicytake/#more-186">About This</a>
        </div>
        
    </body>
</html>