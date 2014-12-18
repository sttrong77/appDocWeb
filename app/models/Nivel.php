<?php

class Nivel extends BaseModel
{
	protected $table = 'niveis';

    protected $fillable = array('tipo');

	public static $rules = array(
        'tipo' => 'required|max:45'
    );
	
	public function perguntas(){
		return $this->HasMany('Pergunta','nivel_id');
	}	
	
	public static function options()
	{
		$result = static::orderBy('tipo')->lists('tipo', 'id');
		return array('' => 'Selecione uma opção') + $result;
	}

   
}