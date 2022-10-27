<div>
    <h1>Post: </h1>
    <p><?php echo htmlentities($message); ?></p>

    <ul class="list-group">
        <?php foreach ($data as $post) { ?>
            <li class="card" style="width: 18rem;">
                <div class="card-body">
                    <h5 class="card-title text-dark"><?php echo htmlentities($post["title"]); ?></h5>
                    <h6 class="card-subtitle mb-2 text-muted"><?php echo htmlentities($post["email"]); ?></h6>
                    <p class="card-text text-dark"><?php echo htmlentities($post["message"]); ?></p>
                    <!-- <a href="#" class="card-link">Card link</a>
                    <a href="#" class="card-link">Another link</a> -->
                </div>
            </li>
        <?php } ?>
    </ul>
</div>