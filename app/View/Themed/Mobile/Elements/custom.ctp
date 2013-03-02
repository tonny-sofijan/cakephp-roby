<p class="msg <?php echo $class; ?>">
    <?php
        if (!empty($params)) {
            echo vsprintf($message, explode(',', implode(',', $params)));
        } else {
            echo $message;
        }
    ?>
</p>