<h1>Modifica post</h1>
<h3><?php echo htmlentities($message); ?></h3>

<form class="w-50 mx-auto py-3" action="/post/update/<?php echo $post["id"]; ?>" method="POST">
    <input type="hidden" name="_csrf" value="<?php echo $csrf ?>">
    <div class="mb-3">
        <label for="title" class="form-label">Titolo</label>
        <input type="text" class="form-control" id="title" name="title" aria-describedby="titleHelp" value="<?php echo $post["title"]; ?>" require>
        <div id="titleHelp" class="form-text">Inserisci il titolo del tuo post</div>
    </div>
    <div class="mb-3">
        <label for="message" class="form-label">Inserisci il testo del tuo post</label>
        <textarea class="form-control" id="message" name="message" rows="3" require><?php echo $post["message"]; ?></textarea>
    </div>
    <div class="mb-3">
        <label for="email" class="form-label">Email</label>
        <input type="email" class="form-control" id="email" name="email" placeholder="name@example.com" require value="<?php echo $post["email"]; ?>">
    </div>
    <div class="pt-3">
        <button type="submit" class="btn btn-success">Modifica</button>
    </div>
</form>