<?php


namespace App\Http\Controllers;


use App\Episodio;
use App\Http\Requests\SeriesFormRequest;
use App\Serie;
use App\Services\CriadorDeSerie;
use App\Services\RemovedorDeSerie;
use App\Temporada;
use Illuminate\Http\Request;



class SeriesController extends Controller
{

//    public function __construct()
//    {
//        $this->middleware('auth');
//    }


    public function index (Request $request){
//        echo $request->url();
        $series = Serie::query()
            ->orderBy('nome')
            ->get();

        $mensagem = $request->session()->get('mensagem');

        return view('series.index', compact('series', 'mensagem'));
    }


    public function create()
    {
        //exibir o formulario de criacao de serie
        return view('series.create');
    }



    public function store(SeriesFormRequest $request, CriadorDeSerie $criadorDeSerie)
    {
        //transferiu para Services/CriadorDeSerie a responsabilidade de criar series
        $serie = $criadorDeSerie->criarSerie(
            $request->nome,
            $request->qtd_temporadas,
            $request->ep_por_temporada
        );
        //pegando a sessão da requisição para salvar uma mensagem para o outro método(@index) pegar esta mensagem enviar para a BLADE
                                    //chave     //valor
        $request->session()->flash('mensagem', "Série {$serie->id}º de nome {$serie->nome} e suas temporadas com episódios criados com sucesso.");

        return redirect()->route('series.index');

    }

                                                //classe       instancia dessa classe
    public function destroy(Request $request, RemovedorDeSerie $removedorDeSerie)
    {
        //usando uma classe do Services p/ ajudar a manter mais enxuto aqui
        //removedor retorna o nome da serie
        $nomeSerie = $removedorDeSerie->removerSerie($request->id);

        $request->session()
            ->flash(
                'mensagem',
                "Série {$nomeSerie} removida com sucesso!"
            );

        return redirect()->route('series.index');
    }

    public function editaNome(int $id, Request $request)
    {
        $novoNome = $request->nome;
        $serie = Serie::find($id);
        $serie->nome = $novoNome;

        //importante
        $serie->save();
    }
    
}
