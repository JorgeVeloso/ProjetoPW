<?php

namespace web\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Request;
use web\Patrimonio;
use web\Marca;
use web\Http\Requests\PatrimonioRequest;

class PatrimonioController extends Controller {

    public function listar() {
        $patrimonio = Patrimonio::paginate(10);
        
        return view('patrimonio.listagem')->withPatrimonio($patrimonio);
    }

    public function prepararAdicionar() {
        $marca = Marca::all();
        return view('patrimonio.adicionar')->with('m', $marca);
    }

    public function adicionar(PatrimonioRequest $request) {
        $patrimonio = new Patrimonio();
        $patrimonio->descricao = $request-> descricao;
        $patrimonio->valor = $request->valor;
        $patrimonio->numeroempenho = $request->numeroempenho;
        $patrimonio->numeropatrimonio = $request->numeropatrimonio;
        $patrimonio->numeropregao = $request->numeropregao;
        $patrimonio->numeropantigo = $request->numeropantigo;
        $patrimonio->numeronotafiscal = $request->numeronotafiscal;
        $patrimonio->marca_id = $request->marca_id;
        $patrimonio->save();
        return redirect("patrimonio/");
    }
    
    public function editar(PatrimonioRequest $request){
        $patrimonio = Patrimonio::find($request-> id);
        $marca = Marca::all();
        return view ('patrimonio.editar')->with('p', $patrimonio)->with('m', $marca);
    }
    
    public function atualizar(PatrimonioRequest $request){
        $patrimonio = Patrimonio::find($request -> id);
        $patrimonio->descricao = $request-> descricao;
        $patrimonio->valor = $request->valor;
        $patrimonio->numeroempenho = $request->numeroempenho;
        $patrimonio->numeropatrimonio = $request->numeropatrimonio;
        $patrimonio->numeropregao = $request->numeropregao;
        $patrimonio->numeropantigo = $request->numeropantigo;
        $patrimonio->numeronotafiscal = $request->numeronotafiscal;
        $patrimonio->marca_id = $request->marca_id;
        $patrimonio->update();
        return redirect("patrimonio/");
    }

}