document.getElementById('tweet').onclick = function(){
    tweetBody = document.getElementById('tweetContent').value;
    if(tweetBody.length <= 140){
        alert('Please type your rant and ensure it is greater than 140 characters.')
    }else{
        alert('tweet tweet')
    }

};