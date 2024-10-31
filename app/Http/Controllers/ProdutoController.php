<?php

namespace App\Http\Controllers;

use App\Models\Produto;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ProdutoController extends Controller
{
public function index(){

    //$produtos  = Produto::all()->sortByDesc('desc');

    $produtos  = Produto::orderBy('id')->get();
    return view('produto.produtos', ['produtos' => $produtos]);

}

public function cadastro(Request $request)
{
     $prod = $request->validate([
        'descricaoProduto' => ['required'],
       'valorProduto' => ['required'],
    ]);
        $produto = Produto::create([
            'descricao' =>$prod['descricaoProduto'] ,
            'valor' => $prod['valorProduto'],

        ]);

        if($produto->save()){
            return redirect()->route('prod')->with(['cadastro'=>'Produto Cadastrado com sucesso.']);
        }else
            return redirect()->route('prod')->with(['cadastro'=>'Erro ao cadastrar o produto.']);
}

public function edit($id): JsonResponse
{
   $prod = Produto::find($id);
    return response()->json($prod);

}

public function update(Request $request){

    $id = $request->input('idProduto');
    $produto = Produto::find($id);
    $prod = $request->validate([
        'descricaoEditar' => ['required'],
        'valorEditar' => ['required'],
    ]);
    $produto->descricao = $prod['descricaoEditar'];
    $produto->valor = $prod['valorEditar'];

    if($produto->save()){
        return redirect()->route('prod')->with(['update'=>'Produto Atualizado com Sucesso.']);
    }else
         return redirect()->route('prod')->with(['update'=>'Erro ao Atualizar Produto.']);

}
public function show($id): JsonResponse
{
    $produto = Produto::find($id);
    return response()->json($produto);
}
public function deleteProduto($id)
    {
        Produto::find($id)->delete();
        return redirect()->route('prod')->with(['delete'=>'Produto Excluído com Sucesso.']);
    }

    //  Relatorio de todos os produtos
public function ReProdutos(){
        //$produto = Produto::orderBy('id')->get();
        //return view('relatorios.Lista_Produtos', ['produtos' => $produto]);
        return view('relatorios.visualizar');
    }

    public function visualizar(){

        return view('relatorios.visualizar');
    }

      // Gerar PDF
public function gerarPdf(Request $request)
{

        // Recuperar os registros do banco dados
         $produto = Produto::orderBy('id')->get();

        // Recuperar e pesquisar os registros do banco dados
        // $contas = Conta::when($request->has('nome'), function ($whenQuery) use ($request){
        //     $whenQuery->where('nome', 'like', '%' . $request->nome . '%');
        // })
        // ->when($request->filled('data_inicio'), function ($whenQuery) use ($request){
        //     $whenQuery->where('vencimento', '>=', \Carbon\Carbon::parse($request->data_inicio)->format('Y-m-d'));
        // })
        // ->when($request->filled('data_fim'), function ($whenQuery) use ($request){
        //     $whenQuery->where('vencimento', '<=', \Carbon\Carbon::parse($request->data_fim)->format('Y-m-d'));
        // })
        // ->orderByDesc('created_at')
        // ->get();

        // Carregar a string com o HTML/conteúdo e determinar a orientação e o tamanho do arquivo
        // $pdf = PDF::loadView('produto.gerar-pdf', ['produtos' => $produto])->setPaper('a4', 'portrait');
        // $pdf->stream("pdf/", array("Attachment" =>true));

        // Fazer o download do arquivo
        // return $pdf->download('Lista_De_Produtos.pdf');

           $pdf = PDF::loadView('produto.gerar-pdf', ['produtos' => $produto])->setPaper('a4', 'portrait');
            return $pdf->stream('Lista_pdf.pdf', ['Attachment' => false]);

    }




}
