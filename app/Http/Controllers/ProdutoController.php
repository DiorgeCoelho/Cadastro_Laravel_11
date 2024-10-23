<?php

namespace App\Http\Controllers;

use App\Models\Produto;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Termwind\Components\Dd;

class ProdutoController extends Controller
{
public function index(){

    $produtos  = Produto::all();

    return view('produto.produtos', ['produtos' => $produtos]);

}



public function cadastro(Request $request ){

        $produto = new Produto();
        $produto = Produto::create([
            'descricao' => $request->input('descricaoProduto'),
            'valor' => $request->input('valorProduto'),

        ]);

        if ($produto->save()) {

            $notification = [
                'title' => 'Sucesso',
                'messageSystem' => 'Produto cadastrado com sucesso!',
                'type' => 'bg-success',
            ];
            return back()->with($notification);
        }


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


return redirect()->route('prod');

}
public function show($id): JsonResponse
{
    $produto = Produto::find($id);

    return response()->json($produto);
}
public function deleteProduto($id): JsonResponse
    {
        Produto::find($id)->delete();

        return redirect()->route('prod')->response()->json(['success'=>'Produto excluído com sucesso.']);
    }
}
