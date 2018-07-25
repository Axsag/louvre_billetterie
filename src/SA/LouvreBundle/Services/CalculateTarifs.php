<?php 

namespace SA\LouvreBundle\Services;

class calculateTarifs
{
    public function calculateTarif($orders)
    {
        
        $dateNow = new \DateTime('now');
        $diff = $dateNow->diff($ticket->getBirthday());
        $age = $diff->format('%y');
        $tarif = 0;
        
        foreach ($orders->getTickets() as $ticket) 
        {
            
            //tarifs reduits
            
            if ($ticket->getReduction() == true)
            {
                if ($age >= 4 && $age < 12) 
                {                
                    if ($ticket->getTypeOrder == 1) 
                    {
                        $tarif =+ 8;
                    } 
                    else 
                    {
                        $tarif =+ 4;
                    }
                }
                elseif ($age < 4)
                {
                    $tarif =+ 0;
                }                
                elseif ($ticket->getTypeOrder == 1) 
                {
                    $tarif =+ 10;
                } 
                else 
                {
                    $tarif =+ 5;
                }
            }
            
            // tarif normaux
            elseif ($age < 4)
            {               
               $tarif =+ 0; 
            }
            elseif ($age >= 4 && $age < 12)
            {                
                if ($ticket->getTypeOrder == 1) 
                {                
                    $tarif =+ 8;
                } 
                else 
                {
                    $tarif =+ 4;
                }
            } 
            elseif ($age >= 12 && $age < 60)
            {             
                if ($ticket->getTypeOrder == 1) 
                {
                    $tarif =+ 16;            
                } 
                else 
                {
                    $tarif =+ 8;
                }
            } 
            elseif ($age >= 60)
            {
                if ($ticket->getTypeOrder == 1) 
                {
                    $tarif =+ 12;
                } 
                else 
                {
                    $tarif =+ 6;
                }
            }
        
        $orders->setPrice($tarif);
        }
    
    }
}