let blogPageInstance = function() {
    
    const BOX_SHADOW_COLORS = ['#0b54fe', '#fc0fc0', '#a129d7', '#633be7'];
    const RECENT_BOXES = document.querySelectorAll(".recent .post, .catalog .post");

    RECENT_BOXES.forEach(function(box) { colorShadow(box) });

    /**
     * @function colorShadow
     * @description Adds a randomly colored box shadow to an element when it is hovered over.
     * @param {HTMLElement} box - The element to add the box shadow to.
     */
    function colorShadow(box) {
        /**
         * @function getRandomIndex
         * @description Returns a random index within a given range.
         * @param {number} min - The minimum value of the range.
         * @param {number} max - The maximum value of the range.
         * @returns {number} A random index within the range.
         */
        const getRandomIndex = (min, max) => Math.floor(Math.random() * (max - min + 1)) + min;

        /**
         * @function getRandomColor
         * @description Returns a random color from the colors array.
         * @returns {string} A random color in the format "#xxxxxx".
         */
        const getRandomColor = () => BOX_SHADOW_COLORS[getRandomIndex(0, BOX_SHADOW_COLORS.length - 1)];

        /**
         * @listens box#mouseenter
         * @description Sets the box shadow of the element to a random color when it is hovered over.
         */
        box.addEventListener("mouseenter", () => {
            box.style.boxShadow = `0px 0px 50px ${getRandomColor()}`;
        });

        /**
         * @listens box#mouseleave
         * @description Resets the box shadow of the element when it is no longer hovered over.
         */
        box.addEventListener("mouseleave", () => {
            box.style.boxShadow = "0px 0px 50px #00000000";
        });
    }
}

let blogPage = blogPageInstance();
