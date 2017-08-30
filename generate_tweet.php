<?php
function getTweet(){
    $tweet = 'Hot Take: ';
    //set of perameters
    //
    $options = array(
        $noun = array(
            $politician = array(
                "Donald J Trump",
                "Hillary Clinton",
                "Ted Cruz",
                "David Cameron",
                "Davey Cameron",
                "Nicola Sturgeon",
                "Boris Johnson",
                "Micheal Gove",
                "Nick Clegg",
                "Paul Nuttel",
                "Nigel Farage",
                "Vladimir Putin",
                "Francioise Holland",
                "Damian Hinds",
                "Angela Merkel",
                "Malcolm Turnbull",
                "Jeremy Corbyn",
                "Bernie Sanders"
            ),

            $things = array(
                "Jaffa cakes",
                "Baseball bats",
                "Video Games",
                "Computers",
                "Frogs",
                "Music songs that are too loud",
                "???",
                "Pens"

            )
        ),

        $is_a_thing = array(
            "unfit for office",
            "a liberal cuck ball",
            "the zodiac killer",
            "going to kill us all",
            "secretly a lizard",
            "bad",
            "a fruit",
            "???",
            "coming",
            "a sandwich",
            "the Minecraft of sex",
            "good actually",
            "actually hozier",
            "the real president"
        )
        
    );

    $polit_or_thing = rand(0,1);
    $first_part_index = $options[0][$polit_or_thing];
    $first_part_text = $first_part_index[rand(0,sizeof($first_part_index) - 1)];

    $second_part_text = $options[1][rand(0,sizeof($options[1]) - 1)];

    $connective = ' is ';
    if($polit_or_thing == 1){
        $connective = ' are ';
    }

    $tweet = print_r("Hot Take: ", true) . print_r($first_part_text, true) . print_r($connective, true) . print_r($second_part_text, true) . print_r(" #HotTakeBot http://dev.colinroitt.uk/spicytake", true);

    return print_r($tweet, true);
}
?>