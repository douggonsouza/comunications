<?php

    namespace comunication\admin\controllers;

    use driver\control\action;
    use driver\helper\html;
    use comunication\common\models\comunications;
    use comunication\common\models\qualitys;
    use comunication\common\models\groups;
    use heartwood\common\models\users;

    class qualityUpdate extends action
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

            if(array_key_exists('Y29tdW5pY2F0aW9uVXBkYXRl',$_POST)){
                $comunication = new comunications();
                $comunication->populate($_POST);
                if(!$comunication->save()){
                    $error = $comunication->getError();
                }
            }

            $comunication = (new comunications())->search(
                array(
                    'comunication_id' => $info['url'][1]
                )
            );
            if(!$comunication->isNew()){
                $this->param('comunication', $comunication);
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