/* This typewriter effect queries all elements with the class "typewrite" and examines its properties.
 * - data-type is a list of content to be iterated through
 * - data-period is a delay in milliseconds.
 * 
 * This typewriter should be used for titles and important text.
 */

var TxtType = function (el, toRotate, period) {
    this.toRotate = toRotate;
    this.el = el;
    this.loopNum = 0;
    this.period = parseInt(period, 10) || 2000;
    this.txt = '';
    this.tick();
    this.isDeleting = false;
};

TxtType.prototype.tick = function () {
    var i = this.loopNum % this.toRotate.length;
    var fullTxt = this.toRotate[i];

    this.txt = fullTxt.substring(0, this.isDeleting ? this.txt.length - 1 : this.txt.length + 1);

    this.el.innerHTML = '<span class="wrap">' + this.txt + '</span>';

    var that = this;
    var delta = 200 - Math.random() * 100;

    if (this.isDeleting) { 
        delta /= 2; 
    }

    if (!this.isDeleting && this.txt === fullTxt) {
        delta = this.period;
        this.isDeleting = true;
    } 
    else if (this.isDeleting && this.txt === '') {
        this.isDeleting = false;
        this.loopNum++;
        delta = 500;
    }

    setTimeout(function () {
        that.tick();
    }, delta);
};

const TYPEWRITER_COLOR = 'white';

window.onload = setTimeout(
    function () {
        var elements = document.getElementsByClassName('typewrite');
        for (var i = 0; i < elements.length; i++) {
            var toRotate = elements[i].getAttribute('data-type');
            var period = elements[i].getAttribute('data-period');
            if (toRotate) {
                new TxtType(elements[i], JSON.parse(toRotate), period);
            }
        }
        // INJECT CSS
        var css = document.createElement("style");
        css.type = "text/css";
        css.innerHTML = `.typewrite > .wrap { border-right: 0.08em solid ${TYPEWRITER_COLOR}; }`;
        document.body.appendChild(css);
    }, 500);

/* This typewriter should be used for static text or paragraphs. */

const TYPEWRITER_V2S = document.querySelectorAll('.typewriter-v2');

let typeWriterValues = [];
let timeoutId;

function cancelTypewriterEffect(element) {
    if (element.timeoutId) {
        clearTimeout(element.timeoutId);
    }
}

function applyTypewriterEffect(element, text, delay) {
    element.textContent = "";
    let i = 0;

    function typeCharacter() {
        if (i < text.length) {
            element.textContent += text.charAt(i);
            i++;
            element.timeoutId = setTimeout(typeCharacter, delay);
        }
    }

    typeCharacter();
}

function observeTypewriterElements(delay) {
    const observer = new IntersectionObserver((entries, observer) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                const element = entry.target;
                const originalText = element.children[0].textContent.trim();
                applyTypewriterEffect(element, originalText, element.nodeName === 'P' ? delay : (delay * 5));
                observer.unobserve(element);
            }
        });
    });

    TYPEWRITER_V2S.forEach(element => {
        observer.observe(element);
    });
}

setTimeout(() => {
    observeTypewriterElements(35);
}, 1000);
