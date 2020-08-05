<?php

    namespace comunication\admin\controllers;

    use driver\control\action;
    use driver\helper\html;
    use comunication\common\models\qualitys;

    class qualityNew extends action
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

            if(array_key_exists('Y29tdW5pY2F0aW9uTmV3',$_POST)){
                $quality = new qualitys();
                $quality->populate($_POST);
                if(!$quality->save()){
                    $error = $quality->getError();
                }
            }
    
            return $this->view(array(
                'html' => new html()
            ));
        }
    }

?>