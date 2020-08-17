<?php

    namespace comunication\admin\controllers;

    use driver\control\action;
    use comunication\common\models\comunications;
    use comunication\common\managments\date;

    class headerMobileComunications extends action
    {
        const _LOCAL = __DIR__;

        /**
         * Função a ser executada no contexto da action
         *
         * @param array $info
         * @return void
         */
        public function main(array $info)
        {
            self::setLayout(__DIR__.'/../responses/headerMobileComunications.phtml');

            if(empty(new comunications())){
                return $this->view(array('isModule' => false));
            }

            // notifications
            $this->param('notifications',(new comunications())->comunicationByQuality(3, 1));

            return $this->view(array(
                'isModule'   => true,
                'helperDate' => new date()
            ));
        }

        /**
         * Para ser disparado antes
         *
         * @return void
         */
        public function _before()
        {

        }

        /**
         * Para ser disparado depois
         *
         * @return void
         */
        public function _after()
        {

        }
    }

?>