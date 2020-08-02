<?php

namespace comunication\common\models;

use data\model\model;
use heartwood\common\models\users;
use comunication\common\models\qualitys;
use comunication\common\models\groups;

class comunications extends model
{
    public $table = 'comunications';
    public $key   = 'comunication_id';
    public $dicionary = "SELECT comunication_id as value, title as label FROM comunications;";

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
            'table'   => 'comunications',
            'key'     => 'comunication_id',
            'columns' => array(
                'comunication_id' => array(
                    'label' => 'Id',
                    'pk'    => true,
                    'type'  => 'integer',
                    'limit' => 11,
                ),
                'quality_id' => array(
                    'label' => 'Qualidade',
                    'pk'    => false,
                    'type'  => 'integer',
                    'limit' => 11,
                ),
                'user_id' => array(
                    'label' => 'Destinatário',
                    'pk'    => false,
                    'type'  => 'integer',
                    'limit' => 11,
                ),
                'group' => array(
                    'label' => 'Grupo',
                    'pk'    => false,
                    'type'  => 'integer',
                    'limit' => 11,
                ),
                'title' => array(
                    'label' => 'Título',
                    'pk'    => false,
                    'type'  => 'varchar',
                    'limit' => 45,
                ),
                'message' => array(
                    'label' => 'Mensagem',
                    'pk'    => false,
                    'type'  => 'varchar',
                    'limit' => 120,
                ),
                'href' => array(
                    'label' => 'Link',
                    'pk'    => false,
                    'type'  => 'varchar',
                    'limit' => 255,
                ),
                'read' => array(
                    'label' => 'Lido',
                    'pk'    => false,
                    'type'  => 'integer',
                    'limit' => 1,
                )
            ),
        );
    }

    /**
     * Devolve sql para a realização da busca
     *
     * @param string $where
     * @return string
     */
    public function getSeek(string $where = 'cmn.active = 1')
    {
        return sprintf("SELECT 
                cmn.comunication_id,
                cmn.title,
                cmn.quality_id,
                qul.label quality_label,
                cmn.group_id,
                grp.label group_label,
                cmn.user_id,
                usr.name 'user_name'
            FROM comunications AS cmn
            JOIN qualitys AS qul ON qul.quality_id = cmn.quality_id AND qul.active = 1
            LEFT JOIN groups AS grp ON grp.group_id = cmn.group_id AND grp.active = 1
            LEFT JOIN users AS usr ON usr.user_id = cmn.user_id AND usr.active = 1
            WHERE
                %s;",
            $where
        );
    }

    public function group()
    {
        if(empty($this->getField('group_id'))){
            return null;
        }

        return $this->manyForOne(new groups(), 'group_id');
    }

    public function user()
    {
        if(empty($this->getField('user_id'))){
            return null;
        }

        return $this->manyForOne(new users(), 'user_id');
    }

    public function quality()
    {
        if(empty($this->getField('quality_id'))){
            return null;
        }

        return $this->manyForOne(new qualitus(), 'quality_id');
    }
}


?>