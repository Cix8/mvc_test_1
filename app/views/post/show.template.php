<h1>Post <?php echo htmlentities($post["title"]) ?></h1>

<h3><?php echo htmlentities($message); ?></h3>

<ul class="list-group">
    <li class="card" style="width: 18rem;">
        <div class="card-body">
            <h5 class="card-title text-dark"><?php echo htmlentities($post["title"]); ?></h5>
            <h6 class="card-subtitle mb-2 text-muted"><?php echo htmlentities($post["email"]); ?></h6>
            <p class="card-text text-dark"><?php echo htmlentities($post["message"]); ?></p>
            <div class="container d-flex justify-content-center">
                <a href="/post/update/<?php echo $post["id"]; ?>" class="btn btn-warning">Modifica</a>
                <form class="ms-2" action="/post/delete/<?php echo intval($post["id"]); ?>" method="POST">
                    <button type="submit" class="btn btn-danger">Elimina</button>
                </form>
            </div>
            <!-- <a href="#" class="card-link">Card link</a>
                    <a href="#" class="card-link">Another link</a> -->
        </div>
    </li>
</ul>