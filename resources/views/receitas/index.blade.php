<!DOCTYPE html>
<html>

<head>

    <title>Receitaz</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">

</head>

<body>

<div class="container mt-4">

    <div class="d-flex justify-content-between mb-3">

        <h2>Receitas</h2>

        <form action="/logout" method="POST">

            @csrf

            <button class="btn btn-danger">
                Sair
            </button>

        </form>

    </div>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="card mb-3">

        <div class="card-body">

            <form method="GET" action="/receitas">

                <div class="row">

                    <div class="col-md-4">
                        <input
                            type="text"
                            name="busca"
                            class="form-control"
                            placeholder="Pesquisar">
                    </div>

                    <div class="col-md-3">
                        <input
                            type="date"
                            name="data"
                            class="form-control">
                    </div>

                    <div class="col-md-3">
                        <input
                            type="text"
                            name="tipo"
                            class="form-control"
                            placeholder="Tipo">
                    </div>

                    <div class="col-md-2">
                        <button class="btn btn-primary w-100">
                            Filtrar
                        </button>
                    </div>

                </div>

            </form>

        </div>

    </div>

    <a href="/receitas/create" class="btn btn-success mb-3">
        Nova Receita
    </a>

    <table class="table table-bordered">

        <thead>

        <tr>
            <th>ID</th>
            <th>Nome</th>
            <th>Tipo</th>
            <th>Data</th>
            <th>Custo</th>
            <th width="180">Ações</th>
        </tr>

        </thead>

        <tbody>

        @foreach($receitas as $receita)

            <tr>

                <td>{{ $receita->id }}</td>

                <td>{{ $receita->nome }}</td>

                <td>{{ $receita->tipo_receita }}</td>

                <td>{{ $receita->data_registro }}</td>

                <td>R$ {{ $receita->custo }}</td>

                <td>

                    <a
                        href="/receitas/{{ $receita->id }}/edit"
                        class="btn btn-warning btn-sm">
                        Editar
                    </a>

                    <form
                        method="POST"
                        action="/receitas/{{ $receita->id }}"
                        style="display:inline">

                        @csrf
                        @method('DELETE')

                        <button
                            class="btn btn-danger btn-sm">
                            Excluir
                        </button>

                    </form>

                </td>

            </tr>

        @endforeach

        </tbody>

    </table>

</div>

</body>
</html>