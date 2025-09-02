<?php
    function social($social) {
        $link = EMPTY_STRING;
        $bx = $social;

        switch ($social) {
            case "github":
                $link = "https://github.com/Lunarflame-Studios";
                break;
            case "discord":
                $link = "https://discord.gg/khKCJyjKSm";
                $bx = "discord-alt";
                break;
            case "instagram":
                $link = "https://www.instagram.com/phantomforce26/";
                break;
            case "soundcloud":
                $link = "https://soundcloud.com/k4p33p4";
                break;
            default:
                $link = "#";
                $bx = "error";
                break;
        }

        echo <<<HTML
            <li>
                <a class="icon $social" href="$link" target="_blank">
                    <i class="bx bxl-$bx"></i>
                </a>
            </li>
        HTML;
    }
?>

<section class="copyright">
    <nav>
        <div class="social-links">
            <ul>
                <?php
                    social("github");
                    social("discord");
                    social("instagram");
                    social("soundcloud");
                ?>
            </ul>
        </div>
        <h1 onclick="changeCursorColor()">Copyright © 2024 LunarFlame Studios</h1>
    </nav>
</section>
