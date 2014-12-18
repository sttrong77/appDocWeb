<?php

use Illuminate\Database\Eloquent\ModelNotFoundException;

class PerguntasController extends BaseController {

	protected $pergunta;

	public function __construct(Pergunta $pergunta)
    {
        parent::__construct();
        $this->pergunta = $pergunta;
		$this->path = public_path() . '/assets/upload/';//salva imgs upadas
	
    }

    public function index()
    {
        $categoria = $nivel = null;

        $fields = array('nome', 'categoria','resposta1','resposta2','resposta3','resposta4','respostaCerta', 'created_at', 'updated_at');
        $sort = in_array(Input::get('sort'), $fields) ? Input::get('sort') : 'nome';
        $order = Input::get('order') === 'desc' ? 'desc' : 'asc';

        $perguntas = $this->pergunta->orderBy($sort, $order)
                         ->join('categorias', 'perguntas.categoria_id', '=', 'categorias.id')
						 ->join('niveis', 'perguntas.nivel_id', '=', 'niveis.id')
						 ;
                        // ->where('usuarios.username', '!=', 'admin');

    
        if(Input::has('categoria')) {
            $perguntas = $perguntas->where('categorias.descricao', 'LIKE', "%". Input::get('categoria') ."%");
            $categoria = '&categoria='. Input::get('categoria');
        }

        if(Input::has('nivel')) {
            $perguntas = $perguntas->where('niveis.tipo', 'LIKE', "%". Input::get('nivel') ."%");
            $nivel = '&nivel='. Input::get('nivel');
        }

        $perguntas = $perguntas->paginate(15, array(	
				'perguntas.id', 
				'perguntas.nome',
				'categorias.descricao AS categoria',		
				'niveis.tipo AS nivel',
				'perguntas.dica',
				'perguntas.created_at', 
				'perguntas.updated_at', 
				
		));

        $pagination = $perguntas->appends(array(
            'categoria' => Input::get('categoria'),
            'nivel' => Input::get('nivel'),
            'sort' => Input::get('sort'),
            'order' => Input::get('order')
        ))->links();

        return View::make('perguntas.index')
            ->with(array(
                'categoria' => Input::get('categoria'),
				'nivel' => Input::get('nivel'),
				'perguntas' => $perguntas,
                'pagination' => $pagination,
                'str' => '&order='.(Input::get('order') == 'asc' || null ? 'desc' : 'asc') . $categoria . $nivel
        ));
    }

    public function create()
    {
        return View::make('perguntas.create');
    }

    public function store()
    {
        $input = Input::all();
        //$validator = $this->pergunta->validate($input);
	 	$validator=Pergunta::validate($input);
			if($validator->fails()) {
				return Redirect::back()
					->withInput()
					->withErrors($validator)
					->with('danger', Util::message('MSG001'));
			} else {
				$poster = Input::file('poster');
				//print_r($poster);
				//die();
				$file_poster= Str::random(20) . '.' . File::extension($poster->getClientOriginalName());
				$up_poster = $poster->move($this->path,$file_poster);
				Image::make($this->path . $file_poster)->resize(120, 120)->save($this->path . $file_poster);
				
			///	$file_poster2= Str::random(20) . '.' . File::extension($poster->getClientOriginalName());
			//	$up_poster2 = $poster->move($this->path2,$file_poster);
			//	Image::make($this->path2 . $file_poster2)->resize(300, 300)->save($this->path2 . $file_poster2);
				//$this->pergunta->create($input);
				if($up_poster){
	
					$pergunta=$this->pergunta->create(array(
						'nome'=>Input::get('nome'),
						'categoria_id'=>Input::get('categoria_id'),
						'nivel_id'=>Input::get('nivel_id'),
						'resposta1'=>Input::get('resposta1'),
						'resposta2'=>Input::get('resposta2'),
						'resposta3'=>Input::get('resposta3'),
						'resposta4'=>Input::get('resposta4'),
						'respostaCerta'=>Input::get('respostaCerta'),
						'poster'=>'assets/upload/'.$file_poster,
						'dica'=>Input::get('dica'),
					//	'posterGrande'=>'assets/upload/grande/'.$file_poster2
					));
				} else{
					return Redirect::back()
					->withInput()
					->withErrors($validator)
					->with('danger', Util::message('MSG009'));
				}
				return Redirect::to('pergunta')
					->with('success', Util::message('MSG015'));
			}
		
	}
    public function edit($id)
    {
        try {
           $pergunta = $this->pergunta->findOrFail($id);
            return View::make('perguntas.edit', compact('pergunta'));
        } catch(ModelNotFoundException $e) {
            return Redirect::to('pergunta')
                ->with('danger', Util::message('MSG003'));
        }
    }

    public function update($id)
    {
        $input = Input::all();
        $validator = $this->pergunta->validate($input);

        if($validator->fails()){
            return Redirect::back()
                ->withInput()
                ->withErrors($validator)
                ->with('danger', Util::message('MSG004'));
        } else {
			$inputs= array(
					'nome'=>Input::get('nome'),
					'categoria_id'=>Input::get('categoria_id'),
					'nivel_id'=>Input::get('nivel_id'),
					'resposta1'=>Input::get('resposta1'),
					'resposta2'=>Input::get('resposta2'),
					'resposta3'=>Input::get('resposta3'),
					'resposta4'=>Input::get('resposta4'),
					'dica'=>Input::get('dica'),
					'respostaCerta'=>Input::get('respostaCerta'),
			);
			if(Input::hasFile('poster')){//se tiver uma imagem
					 $poster = Input::file('poster');
					$file_poster= Str::random(20) . '.' . File::extension($poster->getClientOriginalName());
					$up_poster = $poster->move($this->path,'assets/upload/'.$file_poster);
					File::delete(Input::get('poster_atual'));//atualiza e apaga img antiga
					Image::make($this->path . $file_poster)->resize(120, 120)->save($this->path . $file_poster);
					$inputs=$inputs + array('poster'=>'assets/upload/'.$file_poster);//atualiza nova imga
					
					/* $poster = Input::file('poster');
					$file_poster2= Str::random(20) . '.' . File::extension($poster->getClientOriginalName());
					$up_poster2 = $poster->move($this->path2,$file_poster2);
					File::delete($this->path2 . Input::get('poster_atual'));//atualiza e apaga img antiga
					Image::make($this->path2 . $file_poster2)->resize(300, 300)->save($this->path2 . $file_poster2);
					$inputs=$inputs + array('posterGrande'=>$file_poster2);//atualiza nova imga
				*/
				}
            $this->pergunta->find($id)->update($inputs);

            return Redirect::to('pergunta')
                ->with('success', Util::message('MSG005'));
        }
    }

    public function destroy($id)
    {
        try {
			$pergunta= $this->pergunta->find($id);
			File::delete($pergunta->poster);//apaga a img
           $pergunta->delete();
           
		   return Redirect::to('pergunta')
                ->with('success', Util::message('MSG006'));
        } catch (Exception $e) {
            return Redirect::to('pergunta')
                ->with('warning', Util::message('MSG007'));
        }
    }
	public function show($id){
		 $pergunta=$this->pergunta->find($id);
		 
		 if(is_null($pergunta)){
			return Redirect::to('pergunta')
				->with('error', Util::message('MSG003'));
		 }
		 return View::make('perguntas.show')->with('pergunta',$pergunta);
	}

}