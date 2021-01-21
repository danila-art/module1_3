let buttonModule = document.getElementById('buttonModule');
let boxAddBox = document.getElementById('themeAddBox')
buttonModule.onclick = () => {
    if (getComputedStyle(boxAddBox).display == 'none') {
        boxAddBox.style.display = 'block';
    } else {
        boxAddBox.style.display = 'none';
    }
}