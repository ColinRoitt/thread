document.getElementById('tweetContent').onkeyup = function(){
    document.getElementById('charCount').innerHTML = "Characters: " + this.value.length;
}