<?php

use Illuminate\Database\Eloquent\ModelNotFoundException;

class UsuariosController2 extends BaseController {

	protected $usuario2;

	public function __construct(Usuario $usuario2)
    {
        parent::__construct();
        $this->usuario2 = $usuario2;
    }


    public function index()
    {
        $nome = null;

        $fields = array('nome', 'username', 'email', 'pontos');
        $sort = in_array(Input::get('sort'), $fields) ? Input::get('sort') : 'pontos';
        $order = Input::get('order') === 'asc' ? 'asc' : 'desc';

        $usuarios2 = $this->usuario2->orderBy($sort, $order);
                         

    
        if(Input::has('nome')) {
            $usuarios2 = $usuarios2->where('usuarios.nome', 'LIKE', "%". Input::get('nome') ."%");
            $nome = '&nome='. Input::get('nome');
        }

       

        $usuarios2 = $usuarios2->paginate(15, array('usuarios.id', 'usuarios.nome', 'usuarios.username', 'usuarios.email', 'usuarios.pontos'));

        $pagination = $usuarios2->appends(array(
            'nome' => Input::get('nome'),
            'sort' => Input::get('sort'),
            'order' => Input::get('order')
        ))->links();

        return View::make('usuarios2.index')
            ->with(array(
                'nome' => Input::get('nome'),
                'usuarios2' => $usuarios2,
                'pagination' => $pagination,
                'str' => '&order='.(Input::get('order') == 'asc' || null ? 'desc' : 'asc') . $nome 
        ));
    }

   

}