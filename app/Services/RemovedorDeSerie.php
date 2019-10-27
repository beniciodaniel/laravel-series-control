<?php


namespace App\Services;


use App\Episodio;
use App\Serie;
use App\Temporada;
use Illuminate\Support\Facades\DB;

class RemovedorDeSerie
{
    public function removerSerie(int $serieId) : string
    {
        //para excluir uma serie, é necessário antes excluir as suas temporadas e episodios
        $nomeSerie = '';

        //& comercial é para fazer apontar para o endereço da variavel e nao apenas utilizar uma copia
        DB::transaction(function() use (&$nomeSerie, $serieId){
            $serie = Serie::find($serieId);
            $nomeSerie = $serie->nome;
            $this->removerTemporadas($serie); //precisa do $this pra saber que é do mesmo objeto

            $serie->delete(); //Serie::destroy($request->id);
        });
        return $nomeSerie;
    }

    /**
     * @param $serie
     */
    private function removerTemporadas($serie): void
    {
        $serie->temporadas->each(function (Temporada $temporada) {
            $this->removerEpisodios($temporada);

            $temporada->delete();
        });

    }

    /**
     * @param Temporada $temporada
     */
    private function removerEpisodios(Temporada $temporada): void
    {
        $temporada->episodios->each(function (Episodio $episodio) {
            $episodio->delete();
        });
    }

}

