<?php

class Resposta extends BaseModel
{
	protected $table = 'respostas';

    protected $fillable = array('respostaID', 'perguntaID', 'nome', 'resposta');

	public static $rules = array(
        'respostaID' => 'required',
		'perguntaID'=>'required',
		'nome'=>'required',
		'resposta'=>'required',
	);

    public function perguntas()
	{
		return $this->belongsTo('Pergunta','perguntaID');//model e campo id
	}
	/*
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