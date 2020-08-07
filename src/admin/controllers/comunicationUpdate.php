<?php

    namespace comunication\admin\controllers;

    use driver\control\action;
    use alerts\alerts\alerts;
    use driver\helper\html;
    use comunication\common\models\comunications;
    use comunication\common\models\qualitys;
    use comunication\common\models\groups;
    use heartwood\common\models\users;

    class comunicationUpdate extends action
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

            if(array_key_exists('Y29tdW5pY2F0aW9uVXBkYXRl',$_POST)){
                $comunication = new comunications();
                $comunication->populate($_POST);
                if(!$comunication->save()){
                    alerts::set($comunication->getError(), alerts::BADGE_DANGER);
                    $comunication = (new comunications())->search(
                        array(
                            'comunication_id' => $info['url'][1]
                        )
                    );
                    if(!$comunication->isNew()){
                        $this->param('comunication', $comunication);
                    }
            
                    return $this->view();

                }
                alerts::set('Comunicação salva com sucesso.');
            }

            $comunication = (new comunications())->search(
                array(
                    'comunication_id' => $info['url'][1]
                )
            );
            if(!$comunication->isNew()){
                $this->param('comunication', $comunication);
            }
    
            return $this->view();
        }
    }

?>