<?php

namespace App\Http\Controllers;

use App\Episodio;
use App\Temporada;
use Illuminate\Http\Request;

class EpisodiosController extends Controller
{
    public function index(Temporada $temporada, Request $request)
    {

        $episodios = $temporada->episodios;
        $temporadaId = $temporada->id;
        $mensagem = $request->session()->get('mensagem');

        return view('episodios.index', compact('episodios', 'temporadaId', 'mensagem'));

    }

    public function assistidos(Temporada $temporada, Request $request)
    {
        $episodiosAssistidos = $request->episodios; //array com todos os episódios assistidos
        $temporada->episodios->each (function (Episodio $episodio) use ($episodiosAssistidos) {
            $episodio->assistido = in_array(
                $episodio->id,
                $episodiosAssistidos
            );
        });
        $temporada->push(); //salva as relações editadas no banco de uma vez sõ

        $request->session()->flash('mensagem', 'episódios marcados como assistidos com sucesso!');

        return redirect()->back();
    }

}
