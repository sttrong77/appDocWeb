<?php

use Illuminate\Database\Eloquent\ModelNotFoundException;

class QuestoesController extends BaseController {

	protected $questao;

	public function __construct(Questoes $questao)
    {
        parent::__construct();
        $this->questao = $questao;
    }

    public function index()
    {
        $questao = null;

        $fields = array('nome_questao', 'resposta1','resposta2','resposta3','resposta4','resposta');
        $sort = in_array(Input::get('sort'), $fields) ? Input::get('sort') : 'nome_questao';
        $order = Input::get('order') === 'desc' ? 'desc' : 'asc';

        $questoes = $this->questao->orderBy($sort, $order);
                        // ->where('usuarios.username', '!=', 'admin');

    
        $questoes = $questoes->paginate(15, array(	
				'questoes.id', 
				'questoes.nome_questao',
				'questoes.resposta1',
				'questoes.resposta2',
				'questoes.resposta3',
				'questoes.resposta4',
				'questoes.resposta',
				
				
		));

        $pagination = $questoes->appends(array(
            'sort' => Input::get('sort'),
            'order' => Input::get('order')
        ))->links();

        return View::make('questoes.index')
            ->with(array(
                'questoes' => $questoes,
                'pagination' => $pagination,
                'str' => '&order='.(Input::get('order') == 'asc' || null ? 'desc' : 'asc') 
        ));
    }

    public function create()
    {
        return View::make('questoes.create');
    }

    public function store()
    {
        $input = Input::all();
        $validator = $this->questao->validate($input);

        if($validator->fails()) {
            return Redirect::back()
                ->withInput()
                ->withErrors($validator)
                ->with('danger', Util::message('MSG001'));
        } else {
            $this->questao->create($input);
			
            return Redirect::to('questoes')
                ->with('success', Util::message('MSG002'));
        }
    }

    public function edit($id)
    {
        try {
           $questao = $this->questao->findOrFail($id);
            return View::make('questoes.edit', compact('questao'));
        } catch(ModelNotFoundException $e) {
            return Redirect::to('questoes')
                ->with('danger', Util::message('MSG003'));
        }
    }

    public function update($id)
    {
        $input = Input::all();
        $validator = $this->questao->validate($input);

        if($validator->fails()){
            return Redirect::back()
                ->withInput()
                ->withErrors($validator)
                ->with('danger', Util::message('MSG004'));
        } else {
            $this->questao->find($id)->update($input);

            return Redirect::to('questoes')
                ->with('success', Util::message('MSG005'));
        }
    }

    public function destroy($id)
    {
        try {
            $this->questao->find($id)->delete();
            return Redirect::to('questoes')
                ->with('success', Util::message('MSG006'));
        } catch (Exception $e) {
            return Redirect::to('questoes')
                ->with('warning', Util::message('MSG007'));
        }
    }
	public function show($id){
		 $questao=$this->questao->find($id);
		 
		 if(is_null($questao)){
			return Redirect::to('questoes')
				->with('error', Util::message('MSG003'));
		 }
		 return View::make('questoes.show')->with('questao',$questao);
	}

}