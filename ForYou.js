setTimeout(changeheart,500);
window.onload = function() {
    document.getElementById('video').setAttribute("src", "movie2.mp4"); 
  };

const videos = ["movie.mp4", "movie1.mp4", "movie2.mp4"]

function changeheart() {
    let heart = document.getElementById('heart');
    heart.addEventListener('click', () => {
        if (heart.classList.contains('red')) {
            heart.classList.remove('red');
            heart.classList.add('white');
            heart.src = 'favorite_24dp_000000_FILL0_wght400_GRAD0_opsz24.png';
        } else {
            heart.classList.remove('white');
            heart.classList.add('red');
            heart.src = 'favorite_24dp_000000_FILL0_wght400_GRAD0_opsz24red.png';
        }
    });
}
var videocounter = 0;

function changevideodown() {
    if(videocounter == videos.length){
        videocounter = 0;
    }
    document.getElementById('video').setAttribute("src",videos[videocounter]);
    videocounter++;
}

function changevideoup(){
    if(videocounter < 0){
        videocounter = videos.length-1;
    }
    document.getElementById('video').setAttribute("src",videos[videocounter]);
    videocounter--;
}
