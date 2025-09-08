<?php 
    $allPosts = null;

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

    function getHeader() : void {
        require('header.php');
    }

    function getFooter() : void{
        require('footer.php');
    }

    function endPage() : void {
        require('copyright.php');
        require('javascript.php');
    }

    function getRecentPosts() : void {
        require('recent-posts.php');
    }

    function gradient(int $color, string $content) : void {
        echo Text::gradient($color, DEFAULT_HEADER, $content);
    }

    function typewrite(string $content) : void {
        echo Text::typewrite(DEFAULT_PARAGRAPH, $content);
    }

    function typewriteGradient(int $color, string $content) : void {
        echo Text::typewriteGradient($color, DEFAULT_HEADER, $content);
    }

    function multiTypewriteGradient(int $color, string ...$contents) : void {
        echo Text::multiTypewriteGradient($color, DEFAULT_HEADER, ...$contents);
    }

    function multiTypewrite(string ...$contents) : void {
        echo Text::multiTypewrite(DEFAULT_PARAGRAPH, ...$contents);
    }

    function borderImage(string $src, string $color = EMPTY_STRING) : void {
        echo Image::border($src, $color);
    }

    function pageImage(string $src) : void {
        echo Image::standard($src);
    }

    function carousel(string ...$images) : void {
        echo Image::carousel(...$images);
    }

    function orbs(string ...$colors) : void {
        // Start the wrapper div
        $html = EMPTY_STRING;
        $fileName = EMPTY_STRING;

        // Loop through each color argument
        foreach ($colors as $color) {
            // Skip empty strings or nulls
            if (trim($color) === '')
                continue;

            switch($color) {
                case PINK:
                    $fileName = "Pink";
                    break;
                case BLUE:
                    $fileName = "Blue";
                    break;
                case LIGHT_BLUE:
                    $fileName = "Light-Blue";
                    break;
                case PURPLE:
                    $fileName = "Purple";
                    break;
                default:
                    $fileName = "error";
                    break;
            }

            $color = htmlspecialchars($color);
            $fileName = htmlspecialchars($fileName);
            $vfx = VFX;
            // Append the orb image tag
            $html .= <<<HTML
                <img class="orb" id="$color" src="{$vfx}/{$fileName}-Glow.png" alt="">
            HTML;
        }

        // Close the wrapper div
        echo <<<HTML
            <div id="glow-orbs">
                $html
            </div>
        HTML;
    }

    function circuit(string $version) : void {
        echo <<<HTML
            <div>
                <span class="circuit" id="$version"></span>
            </div>
        HTML;
    }

    //-----------------------------------------------------------------------------------------------------------------

    class BlogPost {
        public string $title;
        public string $description;
        public string $author;
        public string $pubDate;
        public string $category;
        public string $link;
        public string $thumbnail;

        function __construct(string $title, string $description, string $author, string $pubDate, string $category, string $link, string $thumbnail) {
            $this->title = htmlspecialchars($title);
            $this->description = htmlspecialchars($description);
            $this->author = htmlspecialchars($author);
            $this->pubDate = htmlspecialchars($pubDate);
            $this->category = htmlspecialchars($category);
            $this->link = htmlspecialchars($link);
            $this->thumbnail = htmlspecialchars($thumbnail);
        }

        public function createHead() : void {
            $metadata = Head::metadata($this->title . " - Blog");
            $style = Head::stylesheet("blog");
            echo <<<HTML
                $metadata
                $style
            HTML;
        }

        private function createTitle() : void {
            echo <<<HTML
                <div class="blog-title">
                    <h1 id="title">$this->title</h1>
                    <h5 id="category">$this->category</h5>
                    <hr class="blog-begin">
                </div>
            HTML;
        }

        private function createPublishing() : void {
            echo <<<HTML
                <div class="publishing-data">
                    <h3 id="author">$this->author</h3>
                    <h4 id="date">$this->pubDate</h4>
                </div>
            HTML;
        }

        public function createDescription() : void {
            $colors = [PINK, BLUE, LIGHT_BLUE, PURPLE];

            echo <<<HTML
                <p id="description">$this->description</p>
                <img class="page-image interactable offset-border" id="{$colors[array_rand($colors)]}" src="$this->thumbnail" alt="">
            HTML;
        }

        public function createFields() : void {
            echo OVERLAY;
            $this->createTitle();
            $this->createPublishing();
        }
    }

    //-----------------------------------------------------------------------------------------------------------------

    class Blog {

        public static function parseRSS() : array {

            $rss = simplexml_load_file('/var/www/static.lunarflame.dev/rss.xml');
            $domainLength = strlen('https://lunarflame.dev/');

            if (!$rss) {
                throw new Exception('Failed to load RSS feed.');
            }

            $posts = [];
            foreach ($rss->channel->item as $item) {
                $post = new BlogPost(
                    $item->title,
                    $item->description,
                    $item->author,
                    $item->pubDate,
                    $item->category,
                    substr($item->link, $domainLength), // Remove the domain part from the link
                    $item->thumbnail
                    //substr((string) $item->thumbnail, $subDomainLength) // Remove the domain part from the thumbnail URL
                );
                $posts[] = $post;
            }

            return $posts;
        }

        public static function getPost(string $title) : ?BlogPost {
            global $allPosts;
            $allPosts = self::parseRSS();
            // Loop through the posts to find the post with the given title
            foreach ($allPosts as $post) {
                if ($post->title === $title) {
                    return $post; // Return the post if found
                }
            }
            return null; // Return null if not found
        }

        public static function createPostHTML(BlogPost $post) : void {
            // Return the HTML for the recent post
            echo str_replace(
                ['{link}', '{category}', '{title}', '{description}', '{author}', '{pubDate}', '{thumbnail}'],
                [$post->link, $post->category, $post->title, $post->description, $post->author, $post->pubDate, $post->thumbnail],
                BLOG_POST
            );
        }
    }

    //-----------------------------------------------------------------------------------------------------------------

    class Head {

        public static function new(string $title, string ...$stylesheets) : void {

            // Generate the metadata and stylesheets
            $stylesheetsHtml = EMPTY_STRING;
            foreach ($stylesheets as $stylesheet) {
                $stylesheetsHtml .= self::stylesheet($stylesheet);
            }

            echo implode(
                PHP_EOL,
                [
                    self::metadata($title),
                    $stylesheetsHtml
                ]
            );
        }

        static function metadata(string $title) : string {
            $imgRoot = IMAGE_ROOT;
            $assets = ASSETS;
            return <<<HTML
                <base href="/">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <title>$title</title>

                <link rel="stylesheet" href="{$assets}/style.css">
                <link rel="stylesheet" href="{$assets}/boxicons/css/boxicons.min.css">
                <link rel="stylesheet" href="{$assets}/devicon/devicon.min.css">
                <link rel="shortcut icon" href="{$imgRoot}/LunarFlame-Logo-Simplified.ico" type="image/x-icon"/>
            HTML;
        }

        static function stylesheet(string $path) : string {
            $root = PAGE_ROOT;
            if ($path == "blog") {
                return <<<HTML
                    <link rel="stylesheet" href="blog/blog-page.css">
                    <link rel="stylesheet" href="blog/blog-main.css">
                HTML;
            }
            else {
                return <<<HTML
                    <link rel="stylesheet" href="{$root}{$path}">
                HTML;
            }
        }
    }

    //-----------------------------------------------------------------------------------------------------------------

    class Text {

        public static function typewrite(string $textVer, string $content) : string {
            $empty = EMPTY_CHAR; 
            return <<<HTML
                <$textVer class="typewriter-v2">$empty
                    <span>$content</span>
                </$textVer>
            HTML;
        }

        public static function gradient(string $color, string $headerVer, string $content) : string {
            $color = $color == -1 ? rand(1, 5) : $color;
            return <<<HTML
                <$headerVer class="gradient" id="v{$color}">$content</$headerVer>
            HTML;
        }

        public static function typewriteGradient(string $color, string $headerVer, string $content) : string {
            $empty = EMPTY_CHAR; 
            $color = $color == -1 ? rand(1, 5) : $color;
            return <<<HTML
                <$headerVer class="typewriter-v2 gradient" id="v{$color}">$empty
                    <span>$content</span>
                </$headerVer>
            HTML;
        }

        public static function multiTypewriteGradient(string $color, string $headerVer, string ...$contents) : string {
            $empty = EMPTY_CHAR;
            $color = $color == -1 ? rand(1, 5) : $color;
            
            $dataType = '[';
            $numContents = func_num_args() - 2; // Exclude the first two arguments (color and headerVer)

            $i = 1;
            foreach ($contents as $content) {
                $end = $i == $numContents ? '"]' : '", ';
                $dataType .= '"' . $content . $end ;
                $i++;
            }

            return <<<HTML
                <$headerVer class="typewrite gradient" id="v{$color}" data-type='$dataType' data-period="2000">
                    <span class="wrap">$empty</span>
                </$headerVer>
            HTML;
        }

        public static function multiTypewrite(string $textVer, string ...$contents) : string {
            $empty = EMPTY_CHAR;
            $dataType = '[';
            $numContents = func_num_args() - 1; // Exclude the first argument (textVer)

            $i = 1;
            foreach ($contents as $content) {
                $end = $i == $numContents ? '"]' : '", ';
                $dataType .= '"' . $content . $end ;
                $i++;
            }

            return <<<HTML
                <$textVer class="typewrite" data-type='$dataType' data-period="2000">
                    <span class="wrap">$empty</span>
                </$textVer>
            HTML;
        }
    }

    //-----------------------------------------------------------------------------------------------------------------

    class Image {

        public static function border(string $src, string $color = EMPTY_STRING) : string {
            $colors = [PINK, BLUE, LIGHT_BLUE, PURPLE];
            $color = $color == EMPTY_STRING ? $colors[array_rand($colors)] : $color;
            return <<<HTML
                <img class="page-image interactable offset-border" id="$color" src="$src" alt="">
            HTML;
        }

        public static function standard(string $src) : string{
            return <<<HTML
                <div class="image-container">
                    <img class="page-image interactable" src="$src" alt="">
                </div>
            HTML;
        }

        public static function carousel(string ...$images) : string {
            $html = '<div class="carousel">' . PHP_EOL;
            foreach ($images as $src) {
                $html .= '    <img class="interactable" src="' . $src . '" alt="">';
            }
            $html .= '</div>';
            return $html;
        }
    }

    //-----------------------------------------------------------------------------------------------------------------
    
    function googleDrive(string $id) : string {
        return "https://drive.google.com/thumbnail?id=" . $id . "&sz=w1000";
    }

    function screenshots(string $img) : string {
        return SS . "/" . $img;
    }
?>
