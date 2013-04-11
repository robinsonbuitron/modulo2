<!DOCTYPE html>
<html lang="es">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title></title>
        <link href="css/bootstrap.min.css" rel="stylesheet">
        <link href="css/DT_bootstrap.css" rel="stylesheet">
        <script class="include" src="js/jquery-1.9.1.min.js"></script>
        <script class="include" src="js/bootstrap.min.js"></script>
        <script src="js/jquery.validate.min.js"></script>
        <script src="js/messages_es.js"></script>
        <script src="js/jquery.dataTables.min.js"></script>
        <script src="js/DT_bootstrap.js"></script>
        <script src="js/mantenimiento_usuarios.js"></script>
        <style type="text/css">

            html,
            body {
                height: 100%;
            }
            #wrap {
                min-height: 100%;
                height: auto !important;
                height: 100%;
                margin: 0 auto -60px;
            }
            #push,
            #footer {
                height: 60px;
            }
            #footer {
                background-color: #f5f5f5;
            }
            @media (max-width: 767px) {
                #footer {
                    margin-left: -20px;
                    margin-right: -20px;
                    padding-left: 20px;
                    padding-right: 20px;
                }
            }

            .container .credit {
                margin: 20px 0;
            }
        </style>

    </head>
    <body>

        <div class="navbar navbar-fixed-top ">
            <div class="navbar-inner">
                <div class="container">
                    <a class="brand" href="#">Siar-Indicadores</a>
                    <ul class="nav">
                        <li class="active"><a href="#">Inicio</a></li>
                        <li><a href="#about">¿Que es Siar Indicadores?</a></li>
                        <li><a href="#contact">Contacto</a></li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- Part 1: Wrap all page content here -->
        <div id="wrap">
            <!-- Begin page content -->
            <div style="padding-top: 60px" class="container">
                <div class="row-fluid">
                    <div class="span8">    
                        <h2>Bienvenidos al SIAR</h2>
                        <p>
                            Descripción del producto presentado. Descripción del producto presentado. 
                        </p>
                    </div>
                    <div class="span4">

                        <?php include './login.php'; ?>
                    </div>
                </div>
            </div> <!-- /container -->
            <div id="push"></div>
        </div>
        <div id="footer">
            <div class="container">
                <p class="muted credit">SIAR Apurimac <a href="http://siar.regionapurimac.gob.pe/">SIAR Apurimac 2013</a> and <a href="http://ryanfait.com/sticky-footer/">t</a>.</p>
            </div>
        </div>
    </body>
</html> 
