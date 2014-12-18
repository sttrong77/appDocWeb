<?php

class Pergunta extends BaseModel
{
	protected $table = 'perguntas';

    protected $fillable = array('nome','categoria_id','nivel_id','resposta1','resposta2','resposta3','resposta4','respostaCerta','poster','dica');

	public static $rules = array(
        'nome' => 'required|max:255',
		'categoria_id'=>'required',
		'nivel_id'=>'required',
		'resposta1'=>'required',
		'resposta2'=>'required',
		'resposta3'=>'required',
		'resposta4'=>'required',
		'respostaCerta'=>'required',
		'poster'=>'required',
		'dica'=>'required'
		//'posterGrande'=>'required'
		
		
    );

    public function categorias()
	{
		return $this->belongsTo('Categoria','categoria_id');//model e campo id
	}
	
	public function niveis()
	{
		return $this->belongsTo('Nivel','nivel_id');//model e campo id
	}
	
	 public static function opcoes()
    {
    	return array(
    		'' => 'Selecione uma opção',
    		'1' => 'A',
    		'2' => 'B',
    		'3' => 'C',
			'4' => 'D',
		);
	}
	public static function validate($data){
		if(Request::getMethod() == 'PUT'){//se o método for editar, desconsidera validação
			if($data['poster']==''){
				unset(self::$rules['poster']);
			}
			
		}
		return Validator::make($data,self::$rules);
	}
	
/*	public static function options()
	{
		return static::orderBy('id')->lists('nome', 'id');
	}
*/
}