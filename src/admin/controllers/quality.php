<?php

    namespace comunication\admin\controllers;

    use driver\control\action;
    use driver\helper\html;
    use data\resource\resource;
    use comunication\common\models\qualitys;

    class quality extends action
    {
        const _LOCAL = __DIR__;

        /**
         * Devolve o slug definido para a area
         */
        public function area(){
            return 'qualitys';
        }

        /**
         * Função a ser executada no contexto da action
         *
         * @param array $info
         * @return void
         */
        public function main(array $info)
        {
            self::setLayout(self::getHeartwoodLayouts().'/cooladmin1.phtml');

            $search = array('active = 1');
            if(array_key_exists('cHJvZmlsZVVwZGF0ZQ==',$_POST)){
                $search = $this->search($_POST);
            }
    
            $this->param('registros', new qualitys());
            $quality = (new qualitys())->seek(implode(' AND ',$search));
            if(!$quality->isNew()){
                $this->param('registros', $quality);
            }
    
            return $this->view(array(
                'html' => new html()
            ));
        }

        /**
         * Cria o array de busca
         *
         * @param array $post
         * @return void
         */
        protected function search(array $post)
        {
            $search = array('cmn.active = 1');

            if(!isset($post) || empty($post)){
                return $search;
            }

            if(isset($_POST['label']) && !empty($_POST['label'])){
                $search['label'] = "label like '%".$_POST['quality_id']."%'";
            }

            if(isset($_POST['description']) && !empty($_POST['description'])){
                $search['description'] = "description like '%".$_POST['description']."%'";
            }

            return $search;
        }

    }

?>