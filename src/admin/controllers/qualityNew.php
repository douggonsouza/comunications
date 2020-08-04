<?php

    namespace comunication\admin\controllers;

    use driver\control\action;
    use driver\helper\html;
    use comunication\common\models\comunications;
    use comunication\common\models\qualitys;
    use comunication\common\models\groups;
    use heartwood\common\models\users;

    class qualityNew extends action
    {
        const _LOCAL = __DIR__;

        /**
         * Devolve o slug definido para a area
         */
        public function area(){
            return 'qualitysS';
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

            if(array_key_exists('Y29tdW5pY2F0aW9uTmV3',$_POST)){
                $comunication = new comunications();
                $comunication->populate($_POST);
                if(!$comunication->save()){
                    $error = $comunication->getError();
                }
            }

            // qualitys
            $this->param('qualitys', (new qualitys())->dicionary());
            // groups
            $this->param('groups', (new groups())->dicionary());
            // users
            $this->param('users', (new users())->dicionary());
    
            return $this->view(array(
                'html' => new html()
            ));
        }
    }

?>