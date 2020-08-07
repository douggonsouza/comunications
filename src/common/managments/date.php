<?php

namespace comunication\common\managments;

class date
{
    /**
     * Return a textual representation of the time left until specified date
     */
    function receiverDatetime(string $dateTime)
    {
        $date = new \DateTime($dateTime);
        $now  = new \DateTime();

        if($date > $now){
            return 'Recebido a 0 segundos';
        }

        $interval = $now->diff($date);
        if(!isset($interval)){
            return 'Não foi possível verificar o tempo de recebimento.';
        }
        
        $text = array();

        if($interval->y){
            $text[] = $interval->y > 0? $interval->format("%y anos"): $interval->format("%y ano");
        }
        if($interval->m){
            $text[] = $interval->m > 0? $interval->format("%m mêses"): $interval->format("%m mês");
        }
        if($interval->d){
            $text[] = $interval->d > 0? $interval->format("%d dias"): $interval->format("%d dia");
        }
        if($interval->h){
            $text[] = $interval->h > 0? $interval->format("%h horas"): $interval->format("%h hora");
        }
        if($interval->i){
            $text[] = $interval->i > 0? $interval->format("%i minutos"): $interval->format("%i minuto");
        }
        if($interval->s) {
            $text[] = $interval->s > 0? $interval->format("%s segundos"): $interval->format("%s segundo");
        }

        return 'Recebido a: '.implode(', ', $text).'.';
    }  
}

?>