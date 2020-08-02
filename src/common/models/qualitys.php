<?php

namespace comunication\common\models;

use data\model\model;

class qualitys extends model
{
    public $table = 'qualitys';
    public $key   = 'quality_id';
    public $dicionary = "SELECT quality_id as value, label FROM qualitys;";

    /**
     * Evento construtor da classe
     */
    public function __construct()
    {
        parent::__construct($this->visibleColumns()['table'], $this->visibleColumns()['key']);
    }

    /**
     * Informações das colunas visíveis
     *
     * @return void
     */
    public function visibleColumns()
    {
        return array(
            'table'   => 'qualitys',
            'key'     => 'quality_id',
            'columns' => array(
                'quality_id' => array(
                    'label' => 'Id',
                    'pk'    => true,
                    'type'  => 'integer',
                    'limit' => 11,
                ),
                'label' => array(
                    'label' => 'Etiqueta',
                    'pk'    => false,
                    'type'  => 'varchar',
                    'limit' => 15,
                ),
                'description' => array(
                    'label' => 'Descrição',
                    'pk'    => false,
                    'type'  => 'varchar',
                    'limit' => 255,
                )
            ),
        );
    }
}
?>