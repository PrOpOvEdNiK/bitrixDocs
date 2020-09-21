module.exports = function() {
    var width  = 90;
    var height = 16;

    var cx = 19;
    var cy = 7;

    var $canvas = document.getElementById('slonCanvas');

    var started = false;
    $canvas.addEventListener('mouseover', start);
    $canvas.addEventListener('mouseout', stop);

    var im;
    var ctx = $canvas.getContext('2d');
    loadLogo();

    function loadLogo() {
        im        = new Image();
        im.onload = logoLoaded;
        im.src    = CONST.staticPath + 'images/logo-sibirix.png';
    }

    var imageDataRaw;
    var originalData = [];

    function logoLoaded(data) {
        ctx.drawImage(im, 0, 0, width, height);
        imageDataRaw = ctx.getImageData(0, 0, width, height);
        for (var i = 0; i < imageDataRaw.data.length; i++) {
            originalData.push(imageDataRaw.data[i]);
        }
    }

    var intervalId = false;

    function start() {
        started    = true;
        intervalId = setInterval(frame, 10);
    }

    function stop() {
        started = false;
        clearInterval(intervalId);
        frame();
    }

    var speed = 0.01;
    var step  = 0;

    function frame() {
        if (!started) {
            step = 0;
        } else {
            step += speed;
        }

        for (var i = 0; i < height; i++) {
            for (var j = 0; j < width; j++) {

                var px = i * width + j;

                var hsl = rgbToHsl(originalData[px * 4], originalData[px * 4 + 1], originalData[px * 4 + 2]);

                var dist = getDist(i, j);
                if (step + dist > 0) {
                    hsl[0] = (hsl[0] + step + dist) % 1;
                }

                var rgb = hslToRgb(hsl[0], hsl[1], hsl[2]);

                imageDataRaw.data[px * 4]     = rgb[0];
                imageDataRaw.data[px * 4 + 1] = rgb[1];
                imageDataRaw.data[px * 4 + 2] = rgb[2];
                imageDataRaw.data[px * 4 + 3] = originalData[px * 4 + 3];
            }
        }

        ctx.clearRect(0, 0, width, height);
        ctx.putImageData(imageDataRaw, 0, 0);
    }

    function getDist(i, j) {
        var di   = Math.abs(cy - i);
        var dj   = Math.abs(cx - j);
        var dist = Math.sqrt(di * di + dj * dj);
        return -(dist / height);
    }

    function hslToRgb(h, s, l) {
        var r, g, b;

        if (s == 0) {
            r = g = b = l; // achromatic
        } else {
            function hue2rgb(p, q, t) {
                if (t < 0) t += 1;
                if (t > 1) t -= 1;
                if (t < 1 / 6) return p + (q - p) * 6 * t;
                if (t < 1 / 2) return q;
                if (t < 2 / 3) return p + (q - p) * (2 / 3 - t) * 6;
                return p;
            }

            var q = l < 0.5 ? l * (1 + s) : l + s - l * s;
            var p = 2 * l - q;
            r     = hue2rgb(p, q, h + 1 / 3);
            g     = hue2rgb(p, q, h);
            b     = hue2rgb(p, q, h - 1 / 3);
        }

        return [Math.round(r * 255), Math.round(g * 255), Math.round(b * 255)];
    }

    function rgbToHsl(r, g, b) {
        r /= 255;
        g /= 255;
        b /= 255;
        var max     = Math.max(r, g, b), min = Math.min(r, g, b);
        var h, s, l = (max + min) / 2;

        if (max == min) {
            h = s = 0; // achromatic
        } else {
            var d = max - min;
            s     = l > 0.5 ? d / (2 - max - min) : d / (max + min);
            switch (max) {
                case r:
                    h = (g - b) / d + (g < b ? 6 : 0);
                    break;
                case g:
                    h = (b - r) / d + 2;
                    break;
                case b:
                    h = (r - g) / d + 4;
                    break;
            }
            h /= 6;
        }

        return [h, s, l];
    }
};
