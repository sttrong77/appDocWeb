<?php

class Feedback extends BaseModel
{
	protected $table = 'feedbacks';

    protected $fillable = array('titulo', 'descricao','tipo_id','usuario_id');

	public static $rules = array(
        'titulo' => 'required|max:70',
		'descricao'=>'required',
		'tipo_id'=>'required',
		'usuario_id'
    );

    public function tipos()
	{
		return $this->belongsTo('Tipo','tipo_id');//model e campo id
	}
	
	public function usuarios()
	{
		return $this->belongsTo('Usuario','usuario_id');//model e campo id
	}
	
}