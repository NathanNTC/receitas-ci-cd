<!DOCTYPE html>
<html>

<head>
    <title>Login</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

<div class="container">

    <div class="row justify-content-center mt-5">

        <div class="col-md-4">

            <div class="card">

                <div class="card-header text-center">
                    <h4>Login</h4>
                </div>

                <div class="card-body">

                    @if(session('erro'))
                        <div class="alert alert-danger">
                            {{ session('erro') }}
                        </div>
                    @endif

                    <form method="POST" action="/login">

    @csrf

                    <div class="mb-3">
                        <label>Login</label>
                        <input type="text" name="login" class="form-control">
                    </div>

                    <div class="mb-3">
                        <label>Senha</label>
                        <input type="password" name="senha" class="form-control">
                    </div>

                    <button class="btn btn-primary">
                        Entrar
                    </button>

                </form>

                </div>

            </div>

        </div>

    </div>

</div>

</body>
</html>