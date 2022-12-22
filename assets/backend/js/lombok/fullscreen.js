function getFullscreenElement() {
    return document.fullscreenElement 
    || document.webkitFullscreenElement 
    || document.mozFullscreenElement 
    || document.msFullscreenElement;
}

function toggleFullscreen() {
    if (getFullscreenElement()){
        document.exitFullscreen();
    }else {
        document.getElementById('view_fullscreen').requestFullscreen().catch(console.log);
    }
}
