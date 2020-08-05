<?php

    namespace comunication\admin\controllers;

    use driver\control\action;
    use driver\helper\html;
    use comunication\common\models\qualitys;

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
                $quality = new qualitys();
                $quality->populate($_POST);
                if(!$quality->save()){
                    $error = $quality->getError();
                }
            }

            $quality = (new qualitys())->search(
                array(
                    'comunication_id' => $info['url'][1]
                )
            );
            if(!$quality->isNew()){
                $this->param('quality', $$quality);
            }
    
            return $this->view(array(
                'html' => new html()
            ));
        }
    }

?>