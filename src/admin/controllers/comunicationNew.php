<?php

    namespace comunication\admin\controllers;

    use driver\control\action;
    use driver\helper\html;
    use alerts\alerts\alerts;
    use comunication\common\models\comunications;
    use comunication\common\models\qualitys;
    use comunication\common\models\groups;
    use heartwood\common\models\users;

    class comunicationNew extends action
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

            if(array_key_exists('Y29tdW5pY2F0aW9uTmV3',$_POST)){
                $comunication = new comunications();
                $comunication->populate($_POST);
                if(!$comunication->save()){
                    alerts::set($comunication->getError(), alerts::BADGE_DANGER);
                    return $this->view();
                }
                alerts::set('Comunicação salva com sucesso.');
            }

            return $this->view();
        }
    }

?>