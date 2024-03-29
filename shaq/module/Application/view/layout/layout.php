<?php echo $this->doctype() ?>

<html lang="en">
    <head>
        <meta charset="utf-8">
        <?php echo $this->headTitle('ZF Skeleton Application')->setSeparator(' - ')->setAutoEscape(false) ?>

        <?php echo $this->headMeta()
            ->appendName('viewport', 'width=device-width, initial-scale=1.0')
            ->appendHttpEquiv('X-UA-Compatible', 'IE=edge')
        ?>

        <!-- Le styles -->
        <?php echo $this->headLink(['rel' => 'shortcut icon', 'type' => 'image/vnd.microsoft.icon', 'href' => $this->basePath() . '/img/favicon.ico'])
            ->prependStylesheet($this->basePath('public/css/style.css'))
            ->prependStylesheet($this->basePath('public/css/bootstrap-theme.min.css'))
            ->prependStylesheet($this->basePath('public/css/bootstrap.min.css'))
        ?>

        <!-- Scripts -->
        <?php echo $this->headScript()
            ->prependFile($this->basePath('public/js/bootstrap.min.js'))
            ->prependFile($this->basePath('public/js/jquery-3.1.0.min.js'))
        ?>
    </head>
    <body>
        <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
            <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="<?php echo $this->url('home') ?>">
                        <img src="<?php echo $this->basePath('public/img/zf-logo-mark.svg') ?>" height="28" alt="Zend Framework <?php echo \Aula_Application\Module::VERSION ?>"/>&nbsp;Skeleton Application
                    </a>
                </div>
                <div class="collapse navbar-collapse">
                    <ul class="nav navbar-nav">
                        <li class="active"><a href="<?php echo $this->url('home') ?>">Home</a></li>
                    </ul>
                </div>
            </div>
        </nav>
        <div class="container">
            <?php echo $this->content ?>
            <hr>
            <footer>
                <p>&copy; 2005 - <?php echo date('Y') ?> by Zend Technologies Ltd. All rights reserved.</p>
            </footer>
        </div>
        <?php echo $this->inlineScript() ?>
    </body>
</html>
