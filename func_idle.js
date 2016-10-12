function idle() {
    var t;
    window.onload = resetTimer;
    window.onmousemove = resetTimer;
    window.onmousedown = resetTimer; // catches touchscreen presses
    window.onclick = resetTimer;     // catches touchpad clicks
    window.onscroll = resetTimer;    // catches scrolling with arrow keys
    window.onkeypress = resetTimer;

    function logout() {
        window.location.href = 'index.php';
    }

    function resetTimer() {
        clearTimeout(t);
        t = setTimeout(logout, 600000);  // time is in milliseconds
    }
}
idle();