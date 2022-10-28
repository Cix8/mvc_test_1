<h1>Post <?php echo htmlentities($post["title"]) ?></h1>

<h3><?php echo htmlentities($message); ?></h3>

<div class="d-flex align-items-center flex-column">
    <ul class="list-group py-5">
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
    <ul class="list-group flex-row py-3">
        <?php foreach ($comments as $comment) { ?>
            <li class="card m-3" style="width: 10rem;">
                <div class="card-body">
                    <h5 class="card-title text-dark"><?php echo htmlentities($comment["name"]); ?></h5>
                    <h6 class="card-subtitle mb-2 text-muted"><?php echo htmlentities($comment["email"]); ?></h6>
                    <p class="card-text text-dark"><?php echo htmlentities($comment["comment"]); ?></p>
                    <div class="container d-flex justify-content-center">
                        <form class="ms-2" action="/comment/delete/<?php echo intval($comment["id"]); ?>" method="POST">
                            <button type="submit" class="btn btn-danger">Elimina</button>
                        </form>
                    </div>
                </div>
            </li>
        <?php } ?>
        <!-- <li class="card" style="width: 10rem;">
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
                <a href="#" class="card-link">Card link</a>
                        <a href="#" class="card-link">Another link</a>
            </div>
        </li> -->
    </ul>
</div>