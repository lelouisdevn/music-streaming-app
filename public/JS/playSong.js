var list = document.getElementsByClassName('audio');

var songs = [];

for (var i = 0; i < list.length; i++){
  songs.push(list[i].firstElementChild.src);
}

var index = 0;
var song = new Audio();

function playSong(index){
  song.src = songs[index];
  song.play();
}
