<?php

require_once __DIR__ . '/vendor/autoload.php';

$mem = new Memed\Memed();
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bulma/0.7.2/css/bulma.min.css">
    <title>Memed</title>
</head>
<body>
<section class="section">
    <div class="container">
        <?
        if($mem->set('mykey', 'very good')){
            $key = $mem->get('mykey');
        }
        ?>
        <?$key = $mem->get('mykey');?>
        <?= $key ?>
            <? var_dump($mem->getItemsStats())?>
            <? var_dump($mem->getSlabsStats())?>
        <div class="level">
            <!-- Left side -->
            <div class="level-left">
                <div class="level-item">
                    <form action="" method="post">
                        <input type="hidden" name="setvalue" value="true">
                        <div class="field has-addons">
                            <div class="control">
                                <input class="input is-primary" type="text" name="value" placeholder="Value">
                            </div>
                            <div class="control">
                                <button class="button is-link">Set Value</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="level-right">
                <div class="level-item">
                    <p>right</p>
                </div>
            </div>
        </div>
    </div>
</section>
</body>
</html>
