<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title><?php echo $pagetitle; ?></title>
        <link rel="stylesheet" href="Css/materialize.css">
        <link rel="shortcut icon" type="image/x-icon" href="img/BDD_logo.png" />
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <script type="text/javascript" src="Js/materialize.js"></script>
    </head>
    <body>
       
        <header>
        <nav >
           <!-- <div id="nav-wrapper">
                <img src="img/INRA_logo.jpg" alt="logoInra">
                <img src="img/BDD.png" alt="logoInra" id="BDDPaint">
                <img src="img/BDD_logo.png" alt="logoInra" id="logoBDD">
            </div> -->
            <div class="nav-wrapper" >   
                <a href="index.php?" class="brand-logo left"><i class="material-icons">home</i>Accueil</a>
                <img style="height : 64px;" class="brand-logo center" src="img/INRA_logo.jpg">
            <ul  id="nav-mobile" class="right hide-on-med-and-down">
                <li><a href="index.php?action=readAll&controller=Station">Liste essais </a></li>
                <li><a href="index.php?action=readAll&controller=Stade">Liste des stades</a></li> 
                <li><a href="index.php?action=readAll&controller=Intrant">Liste des Intrants</a></li>
            </ul>
            </div>
        </nav>
        </header> 
        <main>
         <div class="container">
              <h1 id="titrepage"><?php echo "$pagetitle" ?></h1>
        <?php
            $filepath = File::build_path(array("View", $controller, "$view.php"));
            require $filepath; 
         ?>
         </div>
        </main>
        <br></br>
         <footer class="page-footer">
             <div class="container">
             <div class="row">
             <div class="col 16 s6">
                 <h5 class="white-text">Application de base de données</h5>
                 <p class="grey-text text-lighten-4">Cette application permet de consulter, insérer et retirer des données sur
                 une base ayant pour sujet les lignées EPO.</p>
             </div>        
             <div class="col l2 s2">
                <h5 class="white-text">Liens</h5>
                <ul>
                  <li><a class="grey-text text-lighten-3" href="index.php?action=readAll&controller=Stade">Liste des Stades</a></li>
                  <li><a class="grey-text text-lighten-3" href="index.php?action=readAll&controller=Intrant">Liste des Intrants</a></li>
                  <li><a class="grey-text text-lighten-3" href="index.php?action=readAll&controller=Station">Liste des Stations</a></li>
                  <li><a class="grey-text text-lighten-3" href="index.php?action=insertion">Insertion</a></li>
                </ul>
             </div>
                 <div class="col l2 s1"><img style = "height:150px;"src="img/BDD_logo.png"></div>
                 <div class='col l2 s2'><img style="height : 150px; width:345px;"
                                             class="brand-logo center" src="img/INRA_logo.jpg"></div>
             </div>
             </div>
             <div class="footer-copyright">
            <div class="container">
            © 2018 Propulsé par Yann Ros
            </div>
        </footer>
    
    </body>
   


</html>
