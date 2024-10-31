@extends('welcome')
@section('content')

<div style="height: 700px; width: 100%;">
    {{-- <embed src="/public/PDF/Lista_De_Produtos.pdf" type="application/pdf" width="50%" height="50%"> --}}
        <iframe src = "/public/PDF/Lista_De_Produtos.pdf" width='400' height='300' allowfullscreen webkitallowfullscreen></iframe>
</div>


    <div class="content-wrapper">
        <section class="content">
          <div class="container-fluid">
            <!-- /.row -->
            <div class="row">
              <div class="col-12">
                <div class="card">
                  <div class="card-header">


                    {{-- <div class="row ">
                        <div class="col py-3 px-md-5">
                            <a href="{{ route('conta.gerar-pdf') }}" class="btn btn-warning btn-sm">Gerar PDF</a>
                        </div>
                        <div class="col">col</div>
                        <div class="col">col</div>
                        <div class="col">col</div>
                      </div> --}}

                      <h3 class="card-title">Relatorio de produtos</h3>

                    {{-- <div class="card-tools">
                      <div class="input-group input-group-sm" style="width: 300px;">
                        <input type="text" name="table_search" class="form-control float-right" placeholder="Pesquisar produto pelo nome">
                        <div class="input-group-append">
                          <button type="submit" class="btn btn-default">
                            <i class="fas fa-search"></i>
                          </button>
                        </div>
                      </div>
                    </div>
                  </div> --}}


                  <!-- /.card-header -->
                  <div class="card-body p-0 table-responsive " style="height: 750px;">


                    <table class="table table-head-fixed text-nowrap table-hover">
                      <thead>
                        <tr style="background-color: #adb5bd;">
                            <th style="border: 1px solid #ccc;">ID</th>
                            <th style="border: 1px solid #ccc;">Descrição</th>
                            <th style="border: 1px solid #ccc;">Valor</th>
                            {{-- <th style="border: 1px solid #ccc;">Vencimento</th> --}}
                        </tr>
                      </thead>
                      <tbody>

                        @forelse ($produtos as $produto)
                        @csrf
                        <tr>
                            <td style="border: 1px solid #ccc; border-top: none;">{{ $produto->id }}</td>
                            <td style="border: 1px solid #ccc; border-top: none;">{{ $produto->descricao }}</td>
                            <td style="border: 1px solid #ccc; border-top: none;">{{ 'R$ ' . number_format($produto->valor, 2, ',', '.') }}</td>
                            {{-- <td style="border: 1px solid #ccc; border-top: none;">{{ \Carbon\Carbon::parse($produto->vencimento)->tz('America/Sao_Paulo')->format('d/m/Y') }}</td> --}}
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4">Nenhuma conta encontrada!</td>
                        </tr>
                        @endforelse
                      </tbody>
                    </table>

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

                                    <form  method="POST" action="{{ route('cadastro') }}" enctype="multipart/form-data">
                                        @csrf
                                    <div class="card-body">
                                    <div class="form-group">
                                    <label for="descricaoProduto">Descrição</label>
                                    <input type="text" class="form-control" name="descricaoProduto" id="descricaoProduto" placeholder="Descrição do Produto" required >


                                    <div class="form-group">
                                    <label for="valorProduto">Valor</label>
                                    <input type="number" class="form-control" name="valorProduto" id="valorProduto" placeholder="Valor do Produto" required>
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

                                <form   method="POST" action="{{ route('update') }}"  enctype="multipart/form-data">
                                    @csrf
                            <div class="card-body">
                            <div class="form-group">

                                <label for="descricaoProduto">ID</label>
                                <input type="text" class="form-control" name="idProduto" id="idProduto" placeholder=" Descrição do Produto" readonly>


                                <label for="descricaoProduto">Descrição</label>
                                <input type="text" class="form-control" name="descricaoEditar" id="descricaoEditar" placeholder="Descrição do Produto" >



                                <label for="valorProduto">Valor</label>
                                <input type="number" class="form-control" name="valorEditar" id="valorEditar" placeholder="Valor do Produto" >
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
                            <input type="text" class="form-control" name="descricaoProduto" id="visualizarDescricao" placeholder="Descrição do Produto" readonly >
                            </div>

                            <div class="form-group">
                            <label for="valorProduto"><strong>Valor</strong></label>
                            {{-- <p><strong>Detail:</strong> <span class="valor"></span></p> --}}
                            <input type="number" class="form-control" name="valorProduto" id="visualizarvalor" placeholder="Valor do Produto" readonly >
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


    @endsection
