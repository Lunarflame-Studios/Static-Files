<?php typewriteGradient(1, "Recent Posts") ?>

<div class="recent">
    <?php
        $allPosts = Blog::parseRSS();
        for ($i = 0; $i < 3; $i++) {
            Blog::createPostHTML($allPosts[$i]);
        }
    ?>
    <script src="<?=JS?>/blog.js"></script>
</div>
