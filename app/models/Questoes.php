<?php

class Questoes extends BaseModel
{
	protected $table = 'questoes';

    protected $fillable = array('nome_questao','resposta1','resposta2','resposta3','resposta4','resposta',);

	public static $rules = array(
        'nome_questao' => 'required',
		'resposta1' => 'required',
		'resposta2' => 'required',
		'resposta3' => 'required',
		'resposta4' => 'required',
		'resposta' => 'required',
	);
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
}