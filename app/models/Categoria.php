<?php

class Categoria extends BaseModel
{
	protected $table = 'categorias';

    protected $fillable = array('descricao');

	public static $rules = array(
        'descricao' => 'required|max:45'
    );
	
	public function perguntas(){
		return $this->HasMany('Pergunta','categoria_id');
	}	

   public static function options()
	{
		$result = static::orderBy('descricao')->lists('descricao', 'id');
		return array('' => 'Selecione uma opção') + $result;
	}
}