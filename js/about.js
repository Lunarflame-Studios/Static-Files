async function loadAllDevs() {
    try {
        const RESPONSE = await fetch("/about/devs.json");
        if (!RESPONSE.ok) {
            throw new Error(`HTTP error. Status: ${RESPONSE.ok}`);
        }

        const JSON_DATA = await RESPONSE.json();

        if (!Array.isArray(JSON_DATA) || typeof JSON_DATA[0] !== 'object') {
            throw new Error("Invalid JSON structure: expected an array of objects");
        }

        const KEYS = Object.keys(JSON_DATA[0]);
        const RESULT = [];

        for (const ITEM of JSON_DATA) {
            const ROW = KEYS.map(key => String(ITEM[key] ?? ""));
            RESULT.push(ROW);
        }

        return RESULT;
    } catch (error) {
        console.log(`Error fetching or processing JSON: ${error}`);
        return [];
    }
}

const aboutPageInstance = function(devInfo) {
    const FRAME_INSIDE = document.querySelector('#frame-inside');
    const UI_FRAME = document.querySelector('#ui-frame-2');

    const DEV_BOX_ELEMENTS = [
        UI_FRAME.querySelector('h2'),               /*   Title  */
        UI_FRAME.querySelector('h4'),               /* Nickname */
        UI_FRAME.querySelector('h3'),               /*   Role   */
        UI_FRAME.querySelector('p'),                /*   Quote  */
        UI_FRAME.querySelector('.profile-pic img'), /*    PFP   */
        UI_FRAME.querySelector('a')                 /*  Button  */
    ];

    let devIndex = 0;

    function nextDev(direction) {
        /* Direction should either be 1 or -1.*/
        devIndex = (devIndex + direction) == -1 ?
            devInfo.length - 1 :
            (devIndex + direction) % devInfo.length;

        changeDev();
    }

    function changeDev() {
        for (let i = 0; i < DEV_BOX_ELEMENTS.length - 2; i++) {
            cancelTypewriterEffect(DEV_BOX_ELEMENTS[i]);
            applyTypewriterEffect(DEV_BOX_ELEMENTS[i], devInfo[devIndex][i], 40);
        }

        DEV_BOX_ELEMENTS[4].src = DEVS + devInfo[devIndex][4];
        FRAME_INSIDE.src = DEVS + devInfo[devIndex][5];
        DEV_BOX_ELEMENTS[5].className = "hero-btn button " + devInfo[devIndex][6];

        for (let j = 0; j < 3; j++) {
            DEV_BOX_ELEMENTS[j].style.color = devInfo[devIndex][8 + j];        
        }

        // Uncomment after dev pages have been created !!
        DEV_BOX_ELEMENTS[5].href = devInfo[devIndex][7];
    }

    return {
        nextDev : nextDev,
    }
};

let aboutPage;

loadAllDevs().then(devs => {
    aboutPage = aboutPageInstance(devs);
});
