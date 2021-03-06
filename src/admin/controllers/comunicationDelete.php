<?php

    namespace comunication\admin\controllers;

    use driver\control\action;
    use driver\helper\html;
    use comunication\common\models\comunications;
    use comunication\common\models\qualitys;
    use comunication\common\models\groups;
    use heartwood\common\models\users;

    class comunicationDelete extends action
    {
        const _LOCAL = __DIR__;

        /**
         * Devolve o slug definido para a area
         */
        public function area(){
            return 'comunications';
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

            $search = array();
            if(array_key_exists('cHJvZmlsZVVwZGF0ZQ==',$_POST)){
                $search = $this->search($_POST);
            }
    
            $this->param('registros', null);
            $comunications = (new comunications())->seek($search);
            if(!$comunications->isNew()){
                $this->param('registros', $comunications);
            }

            // qualitys
            $this->params('qualitys', (new qualitys())->dicionary());
            // groups
            $this->params('groups', (new groups())->dicionary());
            // users
            $this->params('users', (new users())->dicionary());
    
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

            if(isset($_POST['quality_id']) && !empty($_POST['quality_id'])){
                $search['quality_id'] = "quality_id = ".$_POST['quality_id'];
            }

            if(isset($_POST['group_id']) && !empty($_POST['group_id'])){
                $search['group_id'] = "group_id = ".$_POST['group_id'];
            }

            if(isset($_POST['user_id']) && !empty($_POST['user_id'])){
                $search['user_id'] = "user_id = ".$_POST['user_id'];
            }

            if(isset($_POST['title']) && !empty($_POST['title'])){
                $search['title'] = "title like '%".$_POST['title']."%'";
            }

            return $search;
        }

    }

?>