<?
require 'twitteroauth/autoload.php';
use Abraham\TwitterOAuth\TwitterOAuth;
session_start(); 
?>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>thread</title>
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Bitter:400,700">
    <link rel="stylesheet" href="assets/css/Header-Dark.css">
    <link rel="stylesheet" href="assets/css/styles.css">
</head>

<body>
    <div>
        <div class="header-dark">
            <nav class="navbar navbar-default navigation-clean-search">
                <div class="container">
                    <div class="navbar-header">
                        <a class="navbar-brand navbar-link" href="http://dev.colinroitt.uk/thread/index.php">thread - for Twitter</a>
                        <button class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navcol-1"><span class="sr-only">Toggle navigation</span><span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span></button>
                    </div>
                    <div class="collapse navbar-collapse" id="navcol-1">
                        <ul class="nav navbar-nav">
                            <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false" href="#">Go to <span class="caret"></span></a>
                                <ul class="dropdown-menu" role="menu">
                                    <li role="presentation"><a href="https://github.com/cooltennis01/thread">Git Repo</a></li>
                                    <li role="presentation"><a href="http://blog.colinroitt.uk/">The Blog Post</a></li>
                                    <li role="presentation"><a href="http://colinroitt.uk/">My Website</a></li>
                                </ul>
                            </li>
                        </ul>
                        <form class="navbar-form navbar-left" target="_self">
                            <div class="form-group">
                                <label class="control-label" for="search-field"></label>
                            </div>
                        </form>
                        <p class="navbar-text navbar-right">

<?
try{    
    $config = require_once 'config.php';
    
    // get and filter oauth verifier
    $oauth_verifier = filter_input(INPUT_GET, 'oauth_verifier');
    
    // check tokens
    if (empty($oauth_verifier) || empty($_SESSION['oauth_token']) || empty($_SESSION['oauth_token_secret'])) {
        // something's missing, go and login again
        //header('Location: ' . $config['url_login']);
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
    echo 'Logged in as <a class="navbar-link login" href="#">' . $user->name . ' - @' . $user->screen_name . ' |<a class="navbar-link login" href="http://dev.colinroitt.uk/thread/index.php">Log out</a>';
    $msgToShow = "'Type your rant here'";
}catch (Exception $e) {
    echo '<a class="navbar-link login" href="twitter_login.php">Log In';
    $msgToShow = "'Please log in before typing' disabled";
}
?>

                        </a></p>
                    </div>
                </div>
            </nav>
            <div class="container hero">
                <div class="row">
                    <div class="col-md-8 col-md-offset-2">
                        <h1 class="text-center">A new way to rant on Twitter</h1>
                        <textarea id='tweetContent' placeholder= <? echo $msgToShow ?> style="width:100%;height:346.8px;"></textarea>
                        <a id='tweet' class="btn btn-default action-button" role="button" href="#">tweet </a>
                        <a id='charCount'>Characters: 0</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="assets/js/tweet.js"></script>
    <script src="assets/js/updateCharCount.js"></script>
</body>

</html>