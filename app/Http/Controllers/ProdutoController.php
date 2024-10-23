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
    //$produtos = Produto::paginate(5);


    //response($produtos);
    return view('produto.produtos', ['produtos' => $produtos]);

}

public function filtro(Request $request){
    $query = Produto::query();

        // Filtros
        // if ($request->has('descricao')) {
        //     $query->where('descricao', $request->input('categoria'));
        // }

        // if ($request->has('preco_min')) {
        //     $query->where('preco', '>=', $request->input('preco_min'));
        // }

        // if ($request->has('preco_max')) {
        //     $query->where('preco', '<=', $request->input('preco_max'));
        // }

        if ($request->has('descricao')) {
            $query->where('descricao', 'LIKE', '%' . $request->input('nome') . '%');
        }

        // Obter resultados filtrados
        $produtos = $query->get();

        return view('produto.produto', compact('produtos'));
}

public function cadastro(Request $request ){

        $produto = new Produto();
        $produto = Produto::create([
            'descricao' => $request->input('descricaoProduto'),
            'valor' => $request->input('valorProduto'),

        ]);

        if ($produto->save()) {

           // Produto::commit();

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
