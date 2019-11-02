<?php


namespace App\Services;


use App\Http\Requests\SeriesFormRequest;
use App\Serie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CriadorDeSerie
{
    public function criarSerie(
        string $nomeSerie,
        int $qtdTemporadas,
        int $epPorTemporada
    ) : Serie // metodo retorna uma Serie
    {
        //a validação da requisição de adicionar séries (campos), foi para o Requests/SeriesFormRequest
        //inserindo no banco de dados
        //pegando id do user p/ preencher o campo user_id da serie e com isso poder pegar serie de cada usuario
        $userId = Auth::id();
        DB::beginTransaction();
            $serie = Serie::create(['nome' => $nomeSerie, 'user_id' => $userId]);
            $this->criaTemporadas($qtdTemporadas, $epPorTemporada, $serie); //cria temporadas E OS EPISÓDIOS
        DB::commit();

        return $serie;
    }

    /**
     * @param int $qtdTemporadas
     * @param int $epPorTemporada
     * @param $serie
     */
    public function criaTemporadas(int $qtdTemporadas, int $epPorTemporada, $serie): void
    {
        for ($i = 1; $i <= $qtdTemporadas; $i++) {
            $temporada = $serie->temporadas()->create(['numero' => $i]);

            $this->criaEpisodios($epPorTemporada, $temporada);
        }
    }

    /**
     * @param int $epPorTemporada
     * @param $temporada
     */
    public function criaEpisodios(int $epPorTemporada, $temporada): void
    {
        for ($j = 1; $j <= $epPorTemporada; $j++) {
            $temporada->episodios()->create(['numero' => $j]);
        }
    }
}
