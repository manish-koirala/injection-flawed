<main>
    <?php
    if (filter_has_var(INPUT_GET, "id")) {
        include("../home/detailed-view.php");
    } else {
        include("../home/list-view.php");
    }
    ?>
</main>