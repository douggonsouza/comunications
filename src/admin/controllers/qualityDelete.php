<?php

    namespace comunication\admin\controllers;

    use driver\control\action;
    use driver\helper\html;
    use comunication\common\models\qualitys;

    class qualityDelete extends action
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

            if(array_key_exists('cHJvZmlsZVVwZGF0ZQ==',$_POST)){
                $search = $this->search($_POST);
            }
    
            return $this->view(array(
                'html' => new html()
            ));
        }
    }

?>