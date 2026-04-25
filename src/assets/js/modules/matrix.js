// Initialising the canvas
var canvas = document.querySelector('#matrix-dark'),
    ctx = canvas.getContext('2d');

// Setting the width and height of the canvas
canvas.width = window.innerWidth;
canvas.height = window.innerHeight;

// Setting up the letters
var letters = 'ABCDEFGHIJKLMNOPQRSTUVXYZABCDEFGHIJKLMNOPQRSTUVXYZABCDEFGHIJKLMNOPQRSTUVXYZABCDEFGHIJKLMNOPQRSTUVXYZABCDEFGHIJKLMNOPQRSTUVXYZABCDEFGHIJKLMNOPQRSTUVXYZ';
letters = letters.split('');

// Setting up the columns
var fontSize = 10,
    columns = canvas.width / fontSize;

// Setting up the drops
var drops = [];
for (var i = 0; i < columns; i++) {
  drops[i] = 1;
}

// Setting up the draw function
function draw() {
  ctx.fillStyle = 'rgba(21,21,21, .1)';
  ctx.fillRect(0, 0, canvas.width, canvas.height);
  for (var i = 0; i < drops.length; i++) {
    var text = letters[Math.floor(Math.random() * letters.length)];
    ctx.fillStyle = '#0f0';
    ctx.fillText(text, i * fontSize, drops[i] * fontSize);
    drops[i]++;
    if (drops[i] * fontSize > canvas.height && Math.random() > .95) {
      drops[i] = 0;
    }
  }
}

// Loop the animation
setInterval(draw, 33);

// Initialising the second canvas
var canvasLight = document.querySelector('#matrix-light'),
    ctxLight = canvasLight.getContext('2d');

// Setting the width and height of the second canvas
canvasLight.width = window.innerWidth;
canvasLight.height = window.innerHeight;

// Setting up the letters for the second canvas
var lettersLight = 'ABCDEFGHIJKLMNOPQRSTUVXYZABCDEFGHIJKLMNOPQRSTUVXYZABCDEFGHIJKLMNOPQRSTUVXYZABCDEFGHIJKLMNOPQRSTUVXYZABCDEFGHIJKLMNOPQRSTUVXYZABCDEFGHIJKLMNOPQRSTUVXYZ';
lettersLight = lettersLight.split('');

// Setting up the columns for the second canvas
var columnsLight = canvasLight.width / fontSize;

// Setting up the drops for the second canvas
var dropsLight = [];
for (var i = 0; i < columnsLight; i++) {
  dropsLight[i] = 1;
}

// Setting up the draw function for the second canvas
function drawLight() {
  ctxLight.fillStyle = 'rgba(221, 221, 221, .1)';
  ctxLight.fillRect(0, 0, canvasLight.width, canvasLight.height);
  for (var i = 0; i < dropsLight.length; i++) {
    var textLight = lettersLight[Math.floor(Math.random() * lettersLight.length)];
    ctxLight.fillStyle = '#000';  // Set the color for the second canvas
    ctxLight.fillText(textLight, i * fontSize, dropsLight[i] * fontSize);
    dropsLight[i]++;
    if (dropsLight[i] * fontSize > canvasLight.height && Math.random() > .95) {
      dropsLight[i] = 0;
    }
  }
}

// Loop the animation for the second canvas
setInterval(drawLight, 33);