<?php

namespace App\Http\Controllers; 

use App\Models\Cargo;
use Illuminate\Http\Request;

class TesteController extends Controller
{
    public function index()
    {
        $cargos = Cargo::all();
        
        return view('epi.Epi', compact('cargos'));

    }

    public function store(Request $r){

        Cargo::create([ 
            'nome' => $r->nome,
            'slug' => $r->slug,
            'permissao' =>$r->permissao,
            'cor' => $r->cor
        ]);

        return redirect ('/cargo');
        // return resource


    }


    public function show ($id){
        $cargos = Cargo::findOrFail($id);

        return view ('epi.Epi',compact('cargos'));
    }


    public function update(Request $r, $id){
        $cargos = Cargo::findOrFail($id);

        $cargos->update([
            'nome' => $r->nome,
            'slug' => $r->slug,
            'permissao' =>$r->permissao,
            'cor' => $r->cor
        ]);
        return redirect ('/cargo');
    }

    public function destroy ($id){
        $cargos = Cargo::findOrFail($id);
        $cargos->delete();


        return redirect ('/cargo');
    }



}

?>