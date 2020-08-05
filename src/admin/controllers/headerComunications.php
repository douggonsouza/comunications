<?php

    namespace comunication\admin\controllers;

    use driver\control\action;
    use comunication\common\models\comunications;

    class headerComunications extends action
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
            $layout = __DIR__.'../responses/headerComunications.phtml';
            self::setLayout($layout);

            if(empty(new comunications())){
                return $this->view(array('isModule' => false));
            }

            // comments
            $this->param('comments', (new comunications())->comunicationByQuality(1, 1));
            // e-mails
            $this->param('emails', (new comunications())->comunicationByQuality(2, 1));
            // notifications
            $this->param('notifications',(new comunications())->comunicationByQuality(3, 1));

            return $this->view(array('isModule' => true));
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