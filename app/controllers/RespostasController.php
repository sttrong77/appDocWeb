<?php

use Illuminate\Database\Eloquent\ModelNotFoundException;

class RespostasController extends BaseController {

	protected $resposta;

	public function __construct(Resposta $resposta)
    {
        parent::__construct();
        $this->resposta = $resposta;
	
    }

    public function index()
    {
        $pergunta = $nome = null;

        $fields = array('perguntaID', 'nome', 'resposta');
        $sort = in_array(Input::get('sort'), $fields) ? Input::get('sort') : 'nome';
        $order = Input::get('order') === 'desc' ? 'desc' : 'asc';

        $respostas = $this->resposta->orderBy($sort, $order)
                         ->join('perguntas', 'respostas.perguntaID', '=', 'perguntas.id')
						 
						 ;
                        // ->where('usuarios.username', '!=', 'admin');

    
        if(Input::has('pergunta')) {
            $respostas = $respostas->where('perguntas.nome', 'LIKE', "%". Input::get('pergunta') ."%");
            $pergunta = '&pergunta='. Input::get('pergunta');
        }

        if(Input::has('nome')) {
            $respostas = $respostas->where('respostas.nome', 'LIKE', "%". Input::get('nome') ."%");
            $nome = '&nome='. Input::get('nome');
        }

        $respostas = $respostas->paginate(15, array(	
				'respostas.respostaID', 
				'respostas.perguntaID',
				'perguntas.nome AS pergunta',
				'respostas.nome',
				'respostas.resposta'
		));

        $pagination = $respostas->appends(array(
            'pergunta' => Input::get('pergunta'),
            'nome' => Input::get('nome'),
            'sort' => Input::get('sort'),
            'order' => Input::get('order')
        ))->links();

        return View::make('respostas.index')
            ->with(array(
                'pergunta' => Input::get('pergunta'),
				'nome' => Input::get('nome'),
				'respostas' => $respostas,
                'pagination' => $pagination,
                'str' => '&order='.(Input::get('order') == 'asc' || null ? 'desc' : 'asc') . $pergunta . $nome
        ));
    }

   public function destroy($respostaID)
    {
        try {
            $this->resposta->find($respostaID)->delete();
            return Redirect::to('respostas')
                ->with('success', Util::message('MSG006'));
        } catch (Exception $e) {
            return Redirect::to('respostas')
                ->with('warning', Util::message('MSG007'));
        }
    }
}