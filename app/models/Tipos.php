<?php

class Tipo extends BaseModel
{
	protected $table = 'tipos';

    protected $fillable = array('descricao');

	public static $rules = array(
        'descricao' => 'required|max:60'
    );

   public function feedbacks(){
		return $this->HasMany('Feedback','feedback_id');
	}
	
	public static function options()
	{
		$result = static::orderBy('descricao')->lists('descricao', 'id');
		return array('' => 'Selecione uma opção') + $result;
	}
}