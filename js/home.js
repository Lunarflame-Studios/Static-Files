const homePageInstance = function() {
    const HEADER = document.querySelector('.main-content');
    const DEFAULT_BACKGROUND = VFX + 'Background.png'
    const FADE_OUT_MAIN = document.querySelector('#fade-out-all');

    let backgroundOpacity = 0.8;

    const IMAGE_PATHS = [
        SS + 'PL_SS_1.png', 
        SS + 'PL_SS_4.png', 
        DEFAULT_BACKGROUND,
        SS + 'Horizon_Skyline_1.png', 
        SS + 'PL_SS_5.png', 
        DEFAULT_BACKGROUND
    ];

    const PRELOADED_IMAGES = [];
    IMAGE_PATHS.forEach((path) => {
        const IMG = new Image();
        IMG.src = path;
        PRELOADED_IMAGES.push(IMG);
    });

    let currentIndex = 0;

    const FADE_INTERVAL = 8000;
    const FADE_PAUSE = 50;
    const OPACITY_DELTA = 0.05;

    const fadeOutSub = document.querySelector('#fade-out-sub');

    let elementOpacity = 0;

    function changeBackground() {
        const BLUE = IMAGE_PATHS[currentIndex] === DEFAULT_BACKGROUND ?  `0, 0, 0, 0` : `5, 18, 70, 0.7`;
        const PURPLE = IMAGE_PATHS[currentIndex] === DEFAULT_BACKGROUND ?  `0, 0, 0, 0` : `59, 4, 70, 0.7`;

        HEADER.style.backgroundImage = `linear-gradient(rgba(${BLUE}), rgba(${PURPLE})), url(${IMAGE_PATHS[currentIndex]})`;
    }

    function nextSlide() {
        currentIndex = (currentIndex + 1) % IMAGE_PATHS.length;
        changeBackground();
    }

    let fadeOutTriggered = false;

    function fadeBackground(element, delay, targetOpacity) {
        element.style.backgroundColor = `rgba(0, 0, 0, ${elementOpacity})`;

        if (targetOpacity == 0 && elementOpacity > 0) {
            setTimeout(() => {
                elementOpacity -= OPACITY_DELTA;
                fadeBackground(element, delay, targetOpacity);
            }, delay);
        }

        if (targetOpacity == 1 && elementOpacity < 1) {
            setTimeout(() => {
                elementOpacity += OPACITY_DELTA;
                fadeBackground(element, delay, targetOpacity);
            }, delay);
        }

        if (elementOpacity >= 1 && targetOpacity == 1 && !fadeOutTriggered) {
            fadeOutTriggered = true;
            setTimeout(nextSlide, delay);
            setTimeout(() => {
                fadeBackground(element, delay, 0); // Trigger fade-out animation
            }, delay);
        }

        if (elementOpacity <= 0 && targetOpacity == 0) {
            fadeOutTriggered = false; // Reset flag
        }
    }

    function fadeOut(element, delay) {
        element.style.backgroundColor = `rgba(0, 0, 0, ${backgroundOpacity})`;

        if (backgroundOpacity > 0) {
            setTimeout(() => {
                backgroundOpacity -= 0.05;
                fadeOut(element, delay);
            }, delay);
        }
    }

    if (FADE_OUT_MAIN !== null) {
        setTimeout(() => {
            fadeOut(FADE_OUT_MAIN, 50);
            HEADER.style.backgroundImage = `url(${VFX}Background.png)`;
        }, 500)
    }

    /* direction = 1: Fade Out. direction = -1: Fade In.  */
    setTimeout(() => {
        setInterval(() => {
            fadeBackground(fadeOutSub, FADE_PAUSE, 1);
        }, FADE_INTERVAL);
    }, FADE_INTERVAL);
}

const HOME_PAGE = homePageInstance();
