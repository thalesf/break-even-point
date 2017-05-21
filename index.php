<?php
    require_once 'manipulacao.php';
?>
<!DOCTYPE html>
<html lang="pt-BR" dir="ltr">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Break Even Point</title>
        <!-- Bootstrap -->

        <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" href="css/style.css">
        <script type="text/javascript" src="js/jsxgraphcore.js"></script>
    </head>

    <body>
    
    
    <div class="container-fluid">
    
    <div class="row">

    <div class="col-md-3 col-sm-7 col-xs-8 center">
    
    <section id="dados" class="dados">
    <?php
    
        if(isset($_POST['send']) && !empty($_POST['price']) && !empty($_POST['fixedCost']) && !empty($_POST['variableCosts'])):
           
           $vCosts = (float) $_POST['variableCosts'];
           $price = (float) $_POST['price'];
           
           
           if($vCosts < $price):
               
    ?>        
            <input type="hidden" id="unt" value="<?php echo $unt = unt($_POST['fixedCost'], $_POST['price'],$_POST['variableCosts']);?>">
            <input type="hidden" id="fixedCost" value="<?php echo $fixedCost = $_POST['fixedCost'];?>">
            <input type="hidden" id="totalCostsNeg" value="<?php echo $totalCosts = '-'.totalCosts($_POST['variableCosts'],$unt, $_POST['fixedCost']);?>">
            <input type="hidden" id="totalCosts" value="<?php echo $totalCosts = totalCosts($_POST['variableCosts'],$unt, $_POST['fixedCost']);?>">
            <input type="hidden" id="revenue" value="<?php echo $revenue = revenue($_POST['price'],$unt);?>">
    <?php  
        endif;
         else:
            $error = '<div class="alert alert-danger" role="error">
                    <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
                    <span class="sr-only">Error:</span>
                    All fields are required.
                    </div>';
        endif;

     ?>
            <form action="index.php" method="POST" class="form-horizontal">
                
                 <?php 
                    if(isset($_POST['send'])):
                        if(isset($error)):
                            echo $error;
                        endif;
                    endif;
                 ?>
                <div class="form-group">				
                    <label for="price">Price of an unit</label>
                    <input type="text" class="form-control" name="price">
                </div>

                <div class="form-group">
                    <label for="fixedCost">Fixed Cost</label>
                    <input type="text" class="form-control" name="fixedCost">
                </div>

                <div class="form-group">
                    <label for="variableCosts">Variable Costs</label>
                    <input type="text" class="form-control" name="variableCosts">
                </div>


                <div class="form-group">
                    <button type="submit" class="btn btn-block btn-primary" name="send">Send</button>
                </div>

            </form>

        </section>


    </div>
    
    </div>
        
    <div id="jxgbox" class="jxgbox col-md-8"></div>
</div>
<script>
	
var revenue = document.getElementById('revenue').value;
var totalCosts = document.getElementById('totalCosts').value;
var fixedCost = document.getElementById('fixedCost').value;
var lucroTotal = document.getElementById('totalCostsNeg').value;
var pontoEquilibrio = document.getElementById('unt').value;
var brd = JXG.JSXGraph.initBoard('jxgbox',{boundingbox:[-revenue,revenue,revenue,-revenue],keepaspectratio:true,axis:true,showCopyright:false});
var p1 = brd.create('point',[-0,0], {name:'A',size:4});
var p2 = brd.create('point',[0,revenue], {name:'B',size:4});
var p7 = brd.create('point',[0,lucroTotal], {name:'Total Revenue',size:4});
var p3 = brd.create('point',[pontoEquilibrio,revenue], {name:'Break Even Point',size:4,strokeColor:'#000000'});
var p4 = brd.create('point',[pontoEquilibrio,0], {name:'C',size:4});
var p6 = brd.create('point',[0,fixedCost], {name:'Total Cost',size:4});
var li = brd.create('line',["C","Break Even Point"],{straightFirst:false,straightLast:false,strokeColor:'#ff0000',dash:2});
var li2 = brd.create('line',["B","Break Even Point"],{straightFirst:false,straightLast:false,strokeColor:'#ff0000',dash:2});
var li3 = brd.create('line',["A","Break Even Point"],{straightFirst:false});
var li5 = brd.create('line',["Total Cost","Break Even Point"],{straightFirst:false,strokeColor:'#ff0000'});
var li6 = brd.create('line',["Total Revenue","Break Even Point"],{straightFirst:false,strokeColor:'#2ea030'});
</script>

</body>
</html>