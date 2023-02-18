<?php
if ($url[0] === 'inicio') {
    ?>
    <div id="banner">
        <?php
        $banner = require (SYSTEM_DIR . 'config/banner.php');
        foreach ($banner as $value) {
            echo ("<div class=\"slide-item\">
                <div data-img=\"\" style=\"background-image: url('lib/images/{$value['img']}.jpg')\"></div>
                <div data-str=\"\" class=\"pos-center\">{$value['str']}</div>
            </div>");
        }
        ?>
    </div>
    <script>smLib.SlideCarousel.init('banner', {autoPlay: 5});</script>
    <?php
} else {
    
}
