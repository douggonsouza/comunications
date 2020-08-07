<?php

    namespace comunication\admin\controllers;

    use driver\control\action;
    use driver\helper\html;
    use alerts\alerts\alerts;
    use data\resource\resource;
    use comunication\common\models\comunications;
    use comunication\common\models\qualitys;
    use comunication\common\models\groups;
    use heartwood\common\models\users;

    class comunication extends action
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

            $this->param('html', new html());
            $this->param('qualitys', (new qualitys())->dicionary());
            $this->param('users', (new users())->dicionary());

            $search = $this->where();
            if(array_key_exists('c2VhcmNoQ29tdW5pY2F0aW9ucw==',$_POST)){
                $search = $this->where($_POST);
            }
    
            $this->param('registros', new comunications());
            $comunications = (new comunications())->seek($search);
            if(!$comunications->isNew()){
                $this->param('registros', $comunications);
            }

            return $this->view();
        }

        /**
         * Cria o array de busca
         *
         * @param array $post
         * @return void
         */
        protected function where(array $post = null)
        {
            $search = array('cmn.active = 1');

            if(!isset($post) || empty($post)){
                return $search;
            }

            if(isset($post['quality_id']) && !empty($post['quality_id'])){
                $search['quality_id'] = "quality_id = ".$post['quality_id'];
            }

            if(isset($post['user_id']) && !empty($post['user_id'])){
                $search['user_id'] = "user_id = ".$post['user_id'];
            }

            if(isset($post['title']) && !empty($post['title'])){
                $search['title'] = "title like '%".$post['title']."%'";
            }

            return $search;
        }

    }

?>