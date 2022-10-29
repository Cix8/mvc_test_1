<h1>Login</h1>
<h3><?php echo htmlentities($message); ?></h3>

<form class="w-50 mx-auto py-3" action="/auth/login" method="POST">
    <div class="mb-3">
        <label for="email" class="form-label">Email</label>
        <input type="email" class="form-control" id="email" name="email" placeholder="name@example.com" require>
    </div>
    <div class="mb-3">
        <label for="password" class="form-label">Password</label>
        <input type="password" class="form-control" id="password" name="password" placeholder="" require>
    </div>
    <div class="pt-3">
        <button type="submit" class="btn btn-success">Crea</button>
    </div>
</form>