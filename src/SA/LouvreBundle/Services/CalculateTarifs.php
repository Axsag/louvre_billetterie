<?php 

namespace SA\LouvreBundle\Services;

class CalculateTarifs
{
    public function calculateTarif($order)
    {
        $tarifTot = 0;
        
        foreach ($order->getTickets() as $ticket) 
        {
            $dateNow = new \DateTime('now');
            //$diff = $dateNow->diff($ticket->getBirthday());
            //$age = $diff->format('%y');
            $age = 15;
            $tarif = 0;
            $ticket->setBirthday('2018-05-05');
            
            //tarifs reduits
            //typeorder 1 = journée
            if ($ticket->getReduction() == true)
            {
                if ($age >= 4 && $age < 12) 
                {                
                    if ($order->getTypeOrder() == 1) 
                    {
                        $tarif = 8;
                    } 
                    else 
                    {
                        $tarif = 4;
                    }
                }
                elseif ($age < 4)
                {
                    $tarif = 0;
                }                
                elseif ($order->getTypeOrder() == 1) 
                {
                    $tarif = 10;
                } 
                else 
                {
                    $tarif = 5;
                }
            }
            
            // tarif normaux
            elseif ($age < 4)
            {               
               $tarif = 0; 
            }
            elseif ($age >= 4 && $age < 12)
            {                
                if ($order->getTypeOrder() == 1) 
                {                
                    $tarif = 8;
                } 
                else 
                {
                    $tarif = 4;
                }
            } 
            elseif ($age >= 12 && $age < 60)
            {             
                if ($order->getTypeOrder() == 1) 
                {
                    $tarif = 16;            
                } 
                else 
                {
                    $tarif = 8;
                }
            } 
            elseif ($age >= 60)
            {
                if ($order->getTypeOrder() == 1) 
                {
                    $tarif = 12;
                } 
                else 
                {
                    $tarif = 6;
                }
            }
            //dump($tarif);
            $ticket->setAge($age);
            $ticket->setPrice($tarif);
            $tarifTot += $tarif;
        }
        $order->setPrice($tarifTot);
    }
}