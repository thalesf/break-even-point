<?php

function revenue($price,$unt) {
    if (is_numeric($price) && ($price > 0)):
       $revenue = $price * $unt;
       return $revenue;
    else:
        return false;
    endif;
    
}

function totalCosts	($variableCosts,$unt, $fixedCost) {
    if (is_numeric($variableCosts) && is_numeric($fixedCost) && ($fixedCost > 0)):
       $custoTotal = ($variableCosts * $unt) + $fixedCost;
       return $custoTotal;
    else:
        return false;
    endif;
    
}


function unt($fixedCost,$price,$variableCosts) {

    if (is_numeric($fixedCost) && ($fixedCost > 0) && is_numeric($price) && ($price > 0) && is_numeric($variableCosts) && ($variableCosts > 0)):
       $unt = $fixedCost / ($price - $variableCosts);
       return $unt;
    else:
        return false;
    endif;
}

?>