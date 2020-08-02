<?php

namespace comunication\common\models;

use data\model\model;

class groups extends model
{
    public $table = 'groups';
    public $key   = 'group_id';
    public $dicionary = "SELECT group_id as value, label FROM groups;";

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
            'table'   => 'groups',
            'key'     => 'group_id',
            'columns' => array(
                'group_id' => array(
                    'label' => 'Id',
                    'pk'    => true,
                    'type'  => 'integer',
                    'limit' => 11,
                ),
                'label' => array(
                    'label' => 'Etiqueta',
                    'pk'    => false,
                    'type'  => 'varchar',
                    'limit' => 45,
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