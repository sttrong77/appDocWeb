<?php

use Illuminate\Database\Eloquent\ModelNotFoundException;//namespace

class NiveisController extends BaseController {

	protected $nivel;

	public function __construct(Nivel $nivel)
    {
        parent::__construct();
        $this->nivel = $nivel;
    }

    public function index()
    {
        $tipo = null;

        $fields = array('tipo');
        $sort = in_array(Input::get('sort'), $fields) ? Input::get('sort') : 'tipo';
        $order = Input::get('order') === 'desc' ? 'desc' : 'asc';

        $niveis = $this->nivel->orderBy($sort, $order);

        if(Input::has('tipo')) {
            $niveis = $niveis->where('tipo', 'LIKE', "%". Input::get('tipo') ."%");
            $tipo = '&tipo='. Input::get('tipo');
        }

        $niveis = $niveis->paginate(15);

        $pagination = $niveis->appends(array(
            'tipo' => Input::get('tipo'),
            'sort' => Input::get('sort'),
            'order' => Input::get('order')
        ))->links();

        return View::make('niveis.index')
            ->with(array(
                'tipo' => Input::get('tipo'),
                'niveis' => $niveis,
                'pagination' => $pagination,
                'str' => '&order='.(Input::get('order') == 'asc' || null ? 'desc' : 'asc') . $tipo
        ));
    }

    public function show($id)
    {
        try {
            $nivel = $this->nivel->findOrFail($id);
            return View::make('niveis.show', compact('nivel'));
        } catch(ModelNotFoundException $e) {
            return Redirect::to('nivel')
                ->with('danger', Util::message('MSG003'));
        }
    }

    public function create()
    {
        return View::make('niveis.create');
    }

    public function store()
    {
        $input = Input::all();
        $validator = $this->nivel->validate($input);

        if($validator->fails()) {
            return Redirect::back()
                ->withInput()
                ->withErrors($validator)
                ->with('danger', Util::message('MSG001'));
        } else {
            $this->nivel->create($input);

            return Redirect::to('nivel')
                ->with('success', Util::message('MSG002'));
        }
    }

    public function edit($id)
    {
        try {
            $nivel = $this->nivel->findOrFail($id);
            return View::make('niveis.edit', compact('nivel'));
        } catch(ModelNotFoundException $e) {
            return Redirect::to('nivel')
                ->with('danger', Util::message('MSG003'));
        }
    }

    public function update($id)
    {
        $input = Input::all();
        $validator = $this->nivel->validate($input);

        if($validator->fails()){
            return Redirect::back()
                ->withInput()
                ->withErrors($validator)
                ->with('danger', Util::message('MSG004'));
        } else {
            $this->nivel->find($id)->update($input);

            return Redirect::to('nivel')
                ->with('success', Util::message('MSG005'));
        }
    }

    public function destroy($id)
    {
        try {
            $this->nivel->find($id)->delete();
            return Redirect::to('nivel')
                ->with('success', Util::message('MSG006'));
        } catch (Exception $e) {
            return Redirect::to('nivel')
                ->with('warning', Util::message('MSG007'));
        }
    }

}