<?php

namespace App\Http\Controllers;

use App\Models\News;
use Auth;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function resultados(Request $request)
{
    // Processar a pesquisa aqui
    $termo = $request->input('search');
    $autor = Auth::user()->id;
    $resultados = News::where('title', 'like', '%' . $termo . '%')->where('user_id',$autor)->get();

    return view('resultados', ['resultados' => $resultados]);
}
}
