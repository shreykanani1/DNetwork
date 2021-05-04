<div class="card-comment">
<!-- User image -->
<img class="img-circle img-sm" src="<?php if ($row5['profile_picture'] != null) {
                                    echo $row5['profile_picture'];
                                    } else {
                                    echo "../dist/img/avatar5.png";
                                    } ?>" alt="User Image">
    <div class="comment-text">
        <span class="username">
            <?php
                echo $row5['fname'] . ' ' . $row5['lname'];
            ?>
            <span class="text-muted float-right"><?php echo $row5['created_on']; ?></span>
        </span><!-- /.username -->
    <?php
        // echo $sql5;
        echo $row5['description'];
    ?>

    </div>
<!-- /.comment-text -->
</div>