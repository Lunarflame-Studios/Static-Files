<?php
    define('OVERLAY', <<<HTML
        <span id="overlay"></span>
        <img id="zoom-in" src="" alt="">
    HTML);

    define('EMPTY_CHAR', '&#8203;');
    define('EMPTY_STRING', '');

    define('BLOG_POST', <<<HTML
        <div class="post">
            <a id="link" href="{link}">
                <div class="thumbnail">
                    <img class="blog-img" src="{thumbnail}" alt="blog img">
                </div>
                <div class="metadata">
                    <h2 id="category">{category}</h2>
                    <h3 id="title">{title}</h3>
                    <p id="description">{description}</p>
                    <div>
                        <strong id="author">{author}</strong>
                        <span id="pubDate">{pubDate}</span>
                    </div>
                </div>
            </a>
        </div>
    HTML);

    // Change this to 'pages/' if necessary.
    define('PAGE_ROOT', '');
    
    define('MAIN_URL', 'https://lunarflame.dev');
    define('STATIC_URL', 'https://static.lunarflame.dev');
    define('ADRI_URL', 'https://adrian.lunarflame.dev');
    define('ASSETS', STATIC_URL);

    define('IMAGE_ROOT', ASSETS . '/images');
    define('VFX', IMAGE_ROOT . '/vfx');
    define('DEVS', IMAGE_ROOT . '/devs');
    define('SS', IMAGE_ROOT . '/screenshots');
    define('JS', ASSETS . '/js');
    define('I_JS', ASSETS . '/importedJS');

    define('H1', 'h1');
    define('H2', 'h2');
    define('H3', 'h3');
    define('H4', 'h4');
    define('P', 'p');

    define('PINK', 'pink');
    define('BLUE', 'blue');
    define('LIGHT_BLUE', 'light-blue');
    define('PURPLE', 'purple');

    define('DEFAULT_PARAGRAPH', P);
    define('DEFAULT_HEADER', H1);
?>
