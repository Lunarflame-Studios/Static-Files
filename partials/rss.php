<?php 
    header("Content-Type: application/rss+xml; charset=UTF-8");
    require("server.php");
    require("../rss-entries.php");
?>

<?xml version="1.0" encoding="utf-8"?>
<rss version="2.0">
    <channel>
        <title>LunarFlame Blog</title>
        <link><?= MAIN_URL ?></link>
        <description>Articles, Opinions, and Updates from LunarFlame Studios</description>
        <language>en-us</language>

        <?php foreach ($posts as $post): ?>
            <item>
                <title><?= htmlspecialchars($post['title']); ?></title>
                <link><?= htmlspecialchars($post['link']); ?></link>
                <description><?= htmlspecialchars($post['desc']); ?></description>
                <pubDate><?= htmlspecialchars($post['date']); ?></pubDate>
                <author><?= htmlspecialchars($post['author']); ?></author>
                <category><?= htmlspecialchars($post['category']); ?></category>
                <thumbnail><?= htmlspecialchars($post['thumbnail']); ?></thumbnail>
            </item>
        <?php endforeach; ?>
    </channel>
</rss>
