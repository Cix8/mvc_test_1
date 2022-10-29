<h1>Register</h1>
<h3><?php echo htmlentities($message); ?></h3>

<form class="w-50 mx-auto py-3" action="/auth/register" method="POST">
    <input type="hidden" value="<?php echo $token ?>" name="_csrf">
    <div class="mb-3">
        <label for="username" class="form-label">Username</label>
        <input type="text" class="form-control" id="username" name="username" placeholder="user_name" require>
    </div>
    <div class="mb-3">
        <label for="email" class="form-label">Email</label>
        <input type="email" class="form-control" id="email" name="email" placeholder="name@example.com" require>
    </div>
    <div class="mb-3">
        <label for="password" class="form-label">Password</label>
        <input type="password" class="form-control" id="password" name="password" placeholder="" require>
    </div>
    <div class="mb-3 text-center">
        <span class="d-inline-block mb-2">Ruolo</span>
        <select class="form-select" aria-label="Default select example" name="roletype">
            <option selected>Scegli un ruolo</option>
            <option value="user">User</option>
            <option value="editor">Editor</option>
            <option value="admin">Admin</option>
        </select>
    </div>
    <div class="pt-3">
        <button type="submit" class="btn btn-success">Crea</button>
    </div>
</form>