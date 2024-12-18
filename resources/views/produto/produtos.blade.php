@extends('welcome')
@section('content')
    <script>
        $(document).ready(function() {
            let timeout;
            var routeProdSearch = "{{ route('prod') }}";

            jQuery.noConflict();

            $('#descricao').on('input', function(e) {
                jQuery.noConflict();
                e.preventDefault();

                clearTimeout(timeout);
                const query = $(this).val();
                console.log("Descrição digitada:", query);

                timeout = setTimeout(() => {
                    $.ajax({
                        url: routeProdSearch , // Endpoint que irá receber a descrição
                        method: 'GET',
                        data: {
                            descricao: query
                        },
                        success: function(data) {
                            console.log("Produtos retornados:", data);
                            renderProdutos(data);
                        }
                    });
                }, 300); // 300 ms de delay
            });

            //atualizar a tabela

            function renderProdutos(produtos) {
            const tableBody = $('#produtos-table-body');
            tableBody.empty(); // Limpa o corpo da tabela existente

            if (produtos.data.length) {
                produtos.data.forEach(produto => {
                    tableBody.append(`
            <tr>
                <td>${produto.id}</td>
                <td>${produto.descricao}</td>
                <td>${produto.valor}</td> <!-- Adicione mais colunas conforme necessário -->
                <td><span class="tag tag-success">${produto.valor}</span></td>
                <td class="text-right py-0 align-middle ">
                    <div class="btn-group btn-group-sm">
                        <a href="" data-id="${produto.id}"
                        data-toggle="tooltip" data-original-title="Edit"
                        class="btn btn-secondary editarProduto"><i
                        class="fas fa-edit"></i></a>
                        <a href="" data-id="${produto.id}"
                        data-toggle="tooltip" data-original-title="visualizar"
                        class="btn btn-info visualizarPrdoduto"><i
                        class="fas fa-eye"></i></a>
                        <a href="produtoDelete/${produto.id}" type="submit"
                        data-id="${produto.id}" data-toggle="tooltip"
                        data-original-title="excluir"
                        class="btn btn-danger excluirPrdoduto"><i
                        class="fas fa-trash"></i></a>
                        </div>
                </td>
            </tr>
        `);
                });
            } else {
                tableBody.append(
                    '<tr><td colspan="3">Nenhum produto encontrado.</td></tr>'
                    ); // Ajuste o colspan conforme o número de colunas
            }
        }

        });

        // codigo ajax jQuery para puxar as informações para a modal "visualizarPrdoduto"

        $('body').on('click', '.visualizarPrdoduto', function(e) {
            var product_id = $(this).data('id');

            // console.log(product_id);
            var laravel_token = $('meta[name="csrf-token"]').attr('content');
            e.preventDefault();
            jQuery.noConflict();

            $.ajax({
                url: 'produtoShow/' + product_id,
                type: 'GET',
                //data: { product_id},
                dataType: 'JSON',
                headers: {
                    'X-CSRF-Token': laravel_token
                },
                success: function(data) {
                    //console.log(data);

                    $('#ModalVisualizar').modal('show');
                    // $('#idProduto').val(data.id);
                    $('#visualizarDescricao').val(data.descricao);
                    $('#visualizarvalor').val(data.valor);

                }
            });
        });


        // codigo ajax jQuery para puxar as informações para a modal "ModalEditar"

        $('body').on('click', '.editarProduto', function(e) {
            var product_id = $(this).data('id');
            var laravel_token = $('meta[name="csrf-token"]').attr('content');
            e.preventDefault();
            jQuery.noConflict();

            $.ajax({
                url: 'produtoEdit/' + product_id,
                type: 'GET',
                //data: { product_id},
                dataType: 'JSON',
                headers: {
                    'X-CSRF-Token': laravel_token
                },

                success: function(data) {
                    $('#ModalEditar').modal('show');
                    $('#idProduto').val(data.id);
                    $('#descricaoEditar').val(data.descricao);
                    $('#valorEditar').val(data.valor);

                }
            });

        });


        // Fechar um alert automaticamente
        $(document).ready(function() {
            jQuery.noConflict()
            setTimeout(function() {
                $(".alert").fadeOut("slow", function() {
                    //se quiser usar a mensagem direto no navegador
                    //window.alert("Mensagem aqui")
                    $(this).alert('close');
                });
            }, 2000);
        });
    </script>

    <div class="container pt-3 ">
        <div class=".col-6 .col-sm-4 ">
            @if (session('cadastro'))
                <div class="alert alert alert-success alert-dismissible fade show " role="alert">
                    <h4 class="alert-heading">{{ session('cadastro') }}</h4>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @elseif(session('update'))
                <div class="alert alert-warning alert-dismissible fade show " role="alert">
                    <h4 class="alert-heading">{{ session('update') }}</h4>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @elseif(session('delete'))
                <div class="alert alert-danger alert-dismissible fade show " role="alert">
                    <h4 class="alert-heading">{{ session('delete') }}</h4>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif
        </div>
    </div>

    <div class="content-wrapper">
        <section class="content">
            <div class="container-fluid">
                <!-- /.row -->
                <div class="row">
                    <div class="col-12">
                        <div class="card">

                            {{--  --}}
                            <div class="card mt-3 mb-4 border-light shadow">
                                <div class="card-header d-flex justify-content-between">
                                    <span>Produtos</span>
                                </div>


                                {{-- psicionado os botoes  --}}
                                <div class="col-12">
                                    {{-- <form method="GET" action="{{ route('prod') }}" enctype="multipart/form-data"> --}}

                                    <a href="{{ route('conta.gera-pdf') }}" class="btn btn-default" role="button"><i
                                            class="fas fa-download"></i> Gerar PDF</a>

                                    <div class="input-group input-group-sm float-right" style="width: 300px;">

                                        <input type="text" name="descricao" id="descricao" class="form-control" placeholder="Nome Do Produto" />

                                        <div class="input-group-append">
                                            {{-- <button type="submit" class="btn btn-default">
                                                <i class="fas fa-search"></i>
                                            </button> --}}
                                            <a class="btn btn-default float-right" href="{{ route('prod') }}"
                                                role="button"><i class="fas fa-trash"></i></a>
                                        </div>
                                    </div>

                                    {{-- </form> --}}

                                </div>


                                {{--  --}}

                            </div>

                            {{--  --}}


                            <!-- /.card-header -->
                            {{-- <div class="card-body p-0 table-responsive " style="height: 750px;"> --}}
                            <div class="card-body p-0 table-responsive ">
                                <table class="table text-nowrap table-hover">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>descrição</th>
                                            <th>Data</th>
                                            <th>Valor</th>
                                            <th class="text-right py-0 align-middle">
                                                <div class="btn-group btn-group-sm">
                                                    <button type="button" class="btn btn-primary" data-toggle="modal"
                                                        data-target="#NovoProduto">Novo Produto</button>
                                                </div>
                                            </th>
                                            </th>
                                        </tr>
                                    </thead>

                                    <tbody id="produtos-table-body">
                                        @foreach ($produtos as $produto)
                                            @csrf
                                            <tr>
                                                <td>{{ $produto->id }}</td>
                                                <td>{{ $produto->descricao }}</td>
                                                <td>{{ $produto->valor }}</td>
                                                <td><span class="tag tag-success">{{ $produto->valor }}</span></td>
                                                <td class="text-right py-0 align-middle ">
                                                    <div class="btn-group btn-group-sm">
                                                        <a href="" data-id="{{ $produto->id }}"
                                                            data-toggle="tooltip" data-original-title="Edit"
                                                            class="btn btn-secondary editarProduto"><i
                                                                class="fas fa-edit"></i></a>
                                                        <a href="" data-id="{{ $produto->id }}"
                                                            data-toggle="tooltip" data-original-title="visualizar"
                                                            class="btn btn-info visualizarPrdoduto"><i
                                                                class="fas fa-eye"></i></a>
                                                        <a href="produtoDelete/{{ $produto->id }}" type="submit"
                                                            data-id="{{ $produto->id }}" data-toggle="tooltip"
                                                            data-original-title="excluir"
                                                            class="btn btn-danger excluirPrdoduto"><i
                                                                class="fas fa-trash"></i></a>

                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>



                                </table>

                                {{-- <nav role="navigation" aria-label="Pagination Navigation"
                                    class="flex items-center justify-between">
                                    <div class="flex justify-between flex-1 sm:hidden">
                                        {{ $produtos->onEachSide(1)->links('vendor.pagination.bootstrap-4') }}
                                    </div>
                                </nav> --}}
                                {{-- {{ $produtos->onEachSide(1)->links('vendor.pagination.bootstrap-4') }} --}}
                                {{ $produtos->onEachSide(1)->links('vendor.pagination.bootstrap-5') }}
        </section>

        {{-- Modal novo produto --}}
        <div class="modal fade" data-backdrop="static" id="NovoProduto">
            <div class="modal-dialog modal-xl">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">Novo Produto</h3>
                            </div>

                            <form method="POST" action="{{ route('cadastro') }}" enctype="multipart/form-data">
                                @csrf
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="descricaoProduto">Descrição</label>
                                        <input type="text" class="form-control" name="descricaoProduto"
                                            id="descricaoProduto" placeholder="Descrição do Produto" required>


                                        <div class="form-group">
                                            <label for="valorProduto">Valor</label>
                                            <input type="number" class="form-control" name="valorProduto" id="valorProduto"
                                                placeholder="Valor do Produto" required>
                                        </div>
                                    </div>

                                    <div class="modal-footer justify-content-between">
                                        <button type="button" class="btn btn-default"
                                            data-dismiss="modal">Fechar</button>
                                        <button type="submit" class="btn btn-primary">Salvar</button>
                                    </div>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    {{-- Modal Editar  --}}
    <div class="modal fade" data-backdrop="static" id="ModalEditar">
        <div class="modal-dialog modal-dialog-scrollable modal-xl">
            <div class="modal-content">
                <div class="modal-header">

                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Editar Produto</h3>
                        </div>

                        <form method="POST" action="{{ route('update') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="card-body">
                                <div class="form-group">

                                    <label for="descricaoProduto">ID</label>
                                    <input type="text" class="form-control" name="idProduto" id="idProduto"
                                        placeholder=" Descrição do Produto" readonly>


                                    <label for="descricaoProduto">Descrição</label>
                                    <input type="text" class="form-control" name="descricaoEditar"
                                        id="descricaoEditar" placeholder="Descrição do Produto">



                                    <label for="valorProduto">Valor</label>
                                    <input type="number" class="form-control" name="valorEditar" id="valorEditar"
                                        placeholder="Valor do Produto">
                                </div>
                            </div>

                            <div class="modal-footer justify-content-between">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
                                <button type="submit" class="btn btn-primary">Salvar</button>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>


    {{-- Modal Visualizar --}}
    <div class="modal fade" data-backdrop="static" id="ModalVisualizar">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Visualizar Produto</h3>
                        </div>
                        @csrf
                        <div class="card-body">
                            <div class="form-group">
                                <label for="descricaoProduto"><strong>Descrição</strong></label>
                                {{-- <p><strong>Name:</strong> <span class="descricao"></span></p> --}}
                                <input type="text" class="form-control" name="descricaoProduto"
                                    id="visualizarDescricao" placeholder="Descrição do Produto" readonly>
                            </div>

                            <div class="form-group">
                                <label for="valorProduto"><strong>Valor</strong></label>
                                {{-- <p><strong>Detail:</strong> <span class="valor"></span></p> --}}
                                <input type="number" class="form-control" name="valorProduto" id="visualizarvalor"
                                    placeholder="Valor do Produto" readonly>
                            </div>

                            <div class="modal-footer justify-content-between">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
                                {{-- <button type="submit" class="btn btn-primary">Salvar</button> --}}
                            </div>

                        </div>


                    </div>

                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
    </div>

    {{-- Modal Excluir --}}
    <div class="modal fade" data-backdrop="static" id="ModalExcluir">
        <div class="modal-dialog">
            <div class="modal-content bg-danger">
                <div class="modal-header">
                    <h4 class="modal-title">Excluir Produto</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Deseja excluir esse produto&hellip;</p>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-outline-light" data-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-outline-light">Excluir</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    </div>
    </div>

    </div>
    </div>
    <!-- /.row -->
    </div><!-- /.container-fluid -->

    </div>
    <aside class="control-sidebar control-sidebar-dark">
    </aside>
    @include('pagina.footer')
    </div>
@endsection
