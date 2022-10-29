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
    <div class="container text-center text-white">
        <h2>Commenti</h2>
    </div>
    <ul class="list-group flex-row py-3">
        <?php foreach ($comments as $comment) { ?>
            <li class="card m-3" style="width: 15rem;">
                <div class="card-body">
                    <h5 class="card-title text-dark"><?php echo htmlentities($comment["name"]); ?></h5>
                    <h6 class="card-subtitle mb-2 text-muted"><?php echo htmlentities($comment["email"]); ?></h6>
                    <p class="card-text text-dark"><?php echo htmlentities($comment["comment"]); ?></p>
                    <p class="card-text text-dark">Creato: <?php echo htmlentities($comment["created_at"]); ?></p>
                    <div class="container d-flex justify-content-center">
                        <form class="ms-2" action="/comment/delete/<?php echo intval($comment["id"]); ?>" method="POST">
                            <button type="submit" class="btn btn-danger">Elimina</button>
                        </form>
                    </div>
                </div>
            </li>
        <?php } ?>
    </ul>
    <div class="container d-flex justify-content-center py-5">
        <form class="w-50 mx-auto py-3" action="/comment/create" method="POST">
            <input type="hidden" value="<?php echo $post["id"]; ?>" name="_post_id">
            <div class="container text-white">
                <h3>Commenta</h3>
            </div>
            <div class="mb-3">
                <label for="name" class="form-label">Nome</label>
                <input type="text" class="form-control" id="name" name="name" aria-describedby="titleHelp" require>
                <div id="titleHelp" class="form-text">Inserisci il tuo nome</div>
            </div>
            <div class="mb-3">
                <label for="comment" class="form-label">Inserisci il testo del tuo commento</label>
                <textarea class="form-control" id="comment" name="comment" rows="3" require></textarea>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" placeholder="name@example.com" require>
            </div>
            <div class="pt-3">
                <button type="submit" class="btn btn-success">Commenta</button>
            </div>
        </form>
    </div>
</div>