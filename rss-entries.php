<?php
require_once('partials/constants.php');
define('MISC', BLOG_URL . '/misc');
define('PROJ_LEO', BLOG_URL . '/project-leo');
function getEntries() {
    return [
        // Most Recent Posts Should go at the Top
        [
            "title" => "ACBLOT: Programming with C",
            "link" => MISC . "/ACBLOT",
            "desc" => "I spent some time making a C script to automate making blog posts. Here's what I learned.",
            "date" => "Apr 09, 2025",
            "author" => "Phantom",
            "category" => "Misc.",
            "thumbnail" => BLOG_IMAGES . "/C_programming.png"
        ],
        [
            "title" => "Play Project Leo v0.45",
            "link" => PROJ_LEO . "/v045",
            "desc" => "Project Leo v0.45 is out! We've prepared a ton of new features.",
            "date" => "Aug 25, 2024",
            "author" => "Kapeepa",
            "category" => "Project Leo",
            "thumbnail" => SS . "/PL_SS_5.png"
        ],
        [
            "title" => "Play Project Leo v0.4",
            "link" => PROJ_LEO . "/v04",
            "desc" => "Project Leo v0.4 is out now. Check out the release notes.",
            "date" => "Apr 08 2024",
            "author" => "Phantom",
            "category" => "Project Leo",
            "thumbnail" => SS . "/PL_SS_3.png"
        ],
        [
            "title" => "My Curiosity Moment",
            "link" => MISC . "/curiosity-moment",
            "desc" => "I believe that video games are the future of storytelling. Here's why.",
            "date" => "Mar 19 2024",
            "author" => "Phantom",
            "category" => "Misc.",
            "thumbnail" => SS . "/Horizon_Skyline_1.png"
        ],
        [
            "title" => "Hello World; An Introduction",
            "link" => MISC . "/hello-world",
            "desc" => "What is LunarFlame Studios? A little bit about us and our goals.",
            "date" => "Feb 04 2024",
            "author" => "Phantom",
            "category" => "Misc.",
            "thumbnail" => DEVS . "/Nordic.jpg"
        ],
    ];
}
?>
