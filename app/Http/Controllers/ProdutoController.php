<?php

namespace App\Http\Controllers;

use App\Models\Produto;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use PhpParser\Node\Stmt\Return_;
use Termwind\Components\Dd;

class ProdutoController extends Controller
{
public function index(){

    $produtos  = Produto::all();

    return view('produto.produtos', ['produtos' => $produtos]);

}


public function cadastro(Request $request)
{
     $prod = $request->validate([
        'descricaoProduto' => ['required'],
        'valorProduto' => ['required'],
    ]);




        // $produto = new Produto();
        // // $produto = Produto::create([$validascao]);
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
    $produto->descricao = $request->input('descricaoEditar');
    $produto->valor = $request->input('valorEditar');

    $produto->save();


return redirect()->route('prod')->with(['update'=>'Produto Atualizado com Sucesso.']);

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
}
