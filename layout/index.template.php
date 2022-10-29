<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

    <link rel="stylesheet" href="/css/style.css">
</head>

<body>
    <div class="vh-100 text-center text-white bg-dark">

        <div class="cover-container d-flex w-100 p-3 mx-auto flex-column ms_cont">
            <header class="mb-auto">
                <div>
                    <a class="text-white" href="/" style="text-decoration: none;">
                        <h3 class="float-md-start mb-0">MiniMVC</h3>
                    </a>
                    <nav class="nav nav-masthead justify-content-center float-md-end">
                        <a class="nav-link active" aria-current="page" href="/">Home</a>
                        <a class="nav-link" href="/post/create">Nuovo Post</a>
                        <a class="nav-link" href="/auth/login">Login</a>
                        <a class="nav-link" href="/auth/register">Registrati</a>
                    </nav>
                </div>
            </header>
        </div>

        <div class="container text-white" id="ms_main">
            <?php echo $this->content; ?>
        </div>

    </div>

    <script type="text/javascript" src="/js/script.js"></script>
</body>

</html>