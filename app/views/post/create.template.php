<h1>Crea post</h1>
<h3><?php echo htmlentities($message); ?></h3>

<form class="w-50 mx-auto py-3">
    <div class="mb-3">
        <label for="title" class="form-label">Email address</label>
        <input type="text" class="form-control" id="title" aria-describedby="titleHelp">
        <div id="titleHelp" class="form-text">Inserisci il titolo del tuo post</div>
    </div>
    <div class="mb-3">
        <label for="message" class="form-label">Inserisci il testo del tuo post</label>
        <textarea class="form-control" id="message" rows="3"></textarea>
    </div>
    <div class="mb-3">
        <label for="email" class="form-label">Email</label>
        <input type="email" class="form-control" id="email" placeholder="name@example.com">
    </div>
    <div class="pt-3">
        <button type="submit" class="btn btn-success">Crea</button>
    </div>
</form>