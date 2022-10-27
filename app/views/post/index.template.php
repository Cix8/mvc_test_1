<div>
    <h1>Tutti i Post: </h1>
    <p><?php echo htmlentities($message); ?></p>

    <ul class="list-group flex-row pt-5">
        <?php foreach ($posts as $post) { ?>
            <li class="card mx-2" style="width: 18rem;">
                <div class="card-body">
                    <h5 class="card-title text-dark"><?php echo htmlentities($post["title"]); ?></h5>
                    <h6 class="card-subtitle mb-2 text-muted"><?php echo htmlentities($post["email"]); ?></h6>
                    <p class="card-text text-dark"><?php echo htmlentities($post["message"]); ?></p>
                    <a href="/post/<?php echo $post["id"]; ?>" class="card-link">Show</a>
                    <!-- <a href="#" class="card-link">Another link</a> -->
                </div>
            </li>
        <?php } ?>
    </ul>
</div>