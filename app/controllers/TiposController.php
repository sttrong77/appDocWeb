<?php

use Illuminate\Database\Eloquent\ModelNotFoundException;//namespace

class TiposController extends BaseController {

	protected $tipo;

	public function __construct(Tipo $tipo)
    {
        parent::__construct();
        $this->tipo = $tipo;
    }

    public function index()
    {
        $descricao = null;

        $fields = array('descricao');
        $sort = in_array(Input::get('sort'), $fields) ? Input::get('sort') : 'descricao';
        $order = Input::get('order') === 'desc' ? 'desc' : 'asc';

        $tipos = $this->tipo->orderBy($sort, $order);

        if(Input::has('descricao')) {
            $tipos = $tipos->where('descricao', 'LIKE', "%". Input::get('descricao') ."%");
            $descricao = '&descricao='. Input::get('descricao');
        }

        $tipos = $tipos->paginate(15);

        $pagination = $tipos->appends(array(
            'descricao' => Input::get('descricao'),
            'sort' => Input::get('sort'),
            'order' => Input::get('order')
        ))->links();

        return View::make('tipos.index')
            ->with(array(
                'descricao' => Input::get('descricao'),
                'tipos' => $tipos,
                'pagination' => $pagination,
                'str' => '&order='.(Input::get('order') == 'asc' || null ? 'desc' : 'asc') . $descricao
        ));
    }

    public function show($id)
    {
        try {
            $tipo = $this->tipo->findOrFail($id);
            return View::make('tipos.show', compact('tipo'));
        } catch(ModelNotFoundException $e) {
            return Redirect::to('tipo')
                ->with('danger', Util::message('MSG003'));
        }
    }

    public function create()
    {
        return View::make('tipos.create');
    }

    public function store()
    {
        $input = Input::all();
        $validator = $this->tipo->validate($input);

        if($validator->fails()) {
            return Redirect::back()
                ->withInput()
                ->withErrors($validator)
                ->with('danger', Util::message('MSG001'));
        } else {
            $this->tipo->create($input);

            return Redirect::to('tipo')
                ->with('success', Util::message('MSG002'));
        }
    }

    public function edit($id)
    {
        try {
            $tipo = $this->tipo->findOrFail($id);
            return View::make('tipos.edit', compact('tipo'));
        } catch(ModelNotFoundException $e) {
            return Redirect::to('tipo')
                ->with('danger', Util::message('MSG003'));
        }
    }

    public function update($id)
    {
        $input = Input::all();
        $validator = $this->tipo->validate($input);

        if($validator->fails()){
            return Redirect::back()
                ->withInput()
                ->withErrors($validator)
                ->with('danger', Util::message('MSG004'));
        } else {
            $this->tipo->find($id)->update($input);

            return Redirect::to('tipo')
                ->with('success', Util::message('MSG005'));
        }
    }

    public function destroy($id)
    {
        try {
            $this->tipo->find($id)->delete();
            return Redirect::to('tipo')
                ->with('success', Util::message('MSG006'));
        } catch (Exception $e) {
            return Redirect::to('tipo')
                ->with('warning', Util::message('MSG007'));
        }
    }

}