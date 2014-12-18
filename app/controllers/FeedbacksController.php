<?php

use Illuminate\Database\Eloquent\ModelNotFoundException;

class FeedbacksController extends BaseController {

	protected $feedback;

	public function __construct(Feedback $feedback)
    {
        parent::__construct();
        $this->feedback = $feedback;
    }

    public function index()
    {
        $titulo = $descricao = $tipo = null;

        $fields = array('titulo', 'tipo','descricao', 'created_at', 'updated_at');
        $sort = in_array(Input::get('sort'), $fields) ? Input::get('sort') : 'titulo';
        $order = Input::get('order') === 'desc' ? 'desc' : 'asc';

        $feedbacks = $this->feedback->orderBy($sort, $order)
                         ->join('tipos', 'feedbacks.tipo_id', '=', 'tipos.id')
						 ;
                        // ->where('usuarios.username', '!=', 'admin');

    
        if(Input::has('titulo')) {
            $feedbacks = $feedbacks->where('feedbacks.titulo', 'LIKE', "%". Input::get('titulo') ."%");
            $titulo = '&titulo='. Input::get('titulo');
        }

        if(Input::has('tipo')) {
            $feedbacks = $feedbacks->where('tipos.descricao', 'LIKE', "%". Input::get('tipo') ."%");
            $tipo = '&tipo='. Input::get('tipo');
        }

        $feedbacks = $feedbacks->paginate(15, array(	
				'feedbacks.id', 
				'feedbacks.titulo', 
				'feedbacks.created_at', 
				'feedbacks.updated_at', 
				'tipos.descricao AS tipo'
		));

        $pagination = $feedbacks->appends(array(
            'titulo' => Input::get('titulo'),
            'tipo' => Input::get('tipo'),
            'sort' => Input::get('sort'),
            'order' => Input::get('order')
        ))->links();

        return View::make('feedbacks.index')
            ->with(array(
                'titulo' => Input::get('titulo'),
                'tipo' => Input::get('tipo'),
                'feedbacks' => $feedbacks,
                'pagination' => $pagination,
                'str' => '&order='.(Input::get('order') == 'asc' || null ? 'desc' : 'asc') . $titulo . $tipo
        ));
    }

    public function create()
    {
        return View::make('feedbacks.create');
    }

    public function store()
    {
        $input = Input::all();
	//	$usuario = Auth::user()->id; 
        $validator = $this->feedback->validate($input);

        if($validator->fails()) {
            return Redirect::back()
                ->withInput()
				->withErrors($validator)
                ->with('danger', Util::message('MSG001'));
        }
	if(Auth::user()->perfil_id != 1) {
			$feedback=$this->feedback->create(array(
					'titulo'=>Input::get('titulo'),
					'tipo_id'=>Input::get('tipo_id'),
					'usuario_id'=>Auth::user()->id, //pega id do usuario
					'descricao'=>Input::get('descricao')
				));
			
            return Redirect::to('feedback/create')
                ->with('info', Util::message('MSG014'));
		
		}
		/*else if(Auth::user()->perfil_id == 1) {
            //$this->feedback->create($input);
			$feedback=$this->feedback->create(array(
					'titulo'=>Input::get('titulo'),
					'tipo_id'=>Input::get('tipo_id'),
					'usuario_id'=>Auth::user()->id,
					'descricao'=>Input::get('descricao')
				));
			
            return Redirect::to('feedback')
                ->with('success', Util::message('MSG002'));
		
        }
		*/
		
}
    public function edit($id)
    {
        try {
           $feedback = $this->feedback->findOrFail($id);
            return View::make('feedbacks.edit', compact('feedback'));
        } catch(ModelNotFoundException $e) {
            return Redirect::to('feedback')
                ->with('danger', Util::message('MSG003'));
        }
    }

    public function update($id)
    {
        $input = Input::all();
        $validator = $this->feedback->validate($input);

        if($validator->fails()){
            return Redirect::back()
                ->withInput()
                ->withErrors($validator)
                ->with('danger', Util::message('MSG004'));
        } else {
            $this->feedback->find($id)->update($input);

            return Redirect::to('feedback')
                ->with('success', Util::message('MSG005'));
        }
    }

    public function destroy($id)
    {
        try {
            $this->feedback->find($id)->delete();
            return Redirect::to('feedback')
                ->with('success', Util::message('MSG006'));
        } catch (Exception $e) {
            return Redirect::to('feedback')
                ->with('warning', Util::message('MSG007'));
        }
    }
	public function show($id){
		 $feedback=$this->feedback->find($id);
		 
		 if(is_null($feedback)){
			return Redirect::to('feedback')
				->with('error', Util::message('MSG003'));
		 }
		 return View::make('feedbacks.show')->with('feedback',$feedback);
	}

}