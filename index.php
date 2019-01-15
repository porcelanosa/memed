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
        <? if ($_POST['setvalue'] == 'true' && $_POST['sv-value'] != '' && $_POST['sv-key'] != ''): ?>
            <? if ($mem->set($_POST['sv-key'], $_POST['sv-value'])):
                $value = $mem->get($_POST['sv-key']); ?>
                <div class="notification is-success">
                    <button class="delete"></button>
                    The key <b><?= $_POST['sv-key'] ?></b> with value <b><?= $value ?></b> is set
                </div>
            <? endif; ?>
        <? endif; ?>
        <? if ($_POST['getvalue'] == 'true' && $_POST['gv-key']): ?>
            <? $gv_value = $mem->get($_POST['gv-key']); ?>
            <? if ($gv_value != ''): ?>
                <div class="notification is-success">
                    <button class="delete"></button>
                    The <b><?= $_POST['gv-key'] ?></b> key is <b><?= $gv_value ?></b>
                </div>
            <? else: ?>
                <div class="notification is-danger">
                    <button class="delete"></button>
                    The <b><?= $_POST['gv-key'] ?></b> not found in <b><i>memcached</i></b>
                </div>
            <? endif; ?>
        <? endif; ?>
        <div class="columns">
            <!-- Left side -->
            <div class="column">
                <div class="box">
                    <form action="" method="post">
                        <h4>Set value</h4>
                        <input type="hidden" name="setvalue" value="true">
                        <div class="field">
                            <div class="control">
                                <input class="input is-primary" type="text" name="sv-key" placeholder="Key">
                            </div>
                        </div>
                        <div class="field has-addons">
                            <div class="control">
                                <input class="input is-primary" type="text" name="sv-value" placeholder="Value">
                            </div>
                            <div class="control">
                                <button class="button is-link">Set Value</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="column">
                <div class="box">
                    <form action="" method="post">
                        <h4>Get value by key</h4>
                        <input type="hidden" name="getvalue" value="true">
                        <div class="field has-addons">
                            <div class="control">
                                <input class="input is-primary" type="text" name="gv-key" placeholder="Key">
                            </div>
                            <div class="control">
                                <button class="button is-link">Get Value</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="section">
    <div class="container">
        <? if ($_POST['delvalue'] == 'true' && $_POST['del-key']): ?>
            <?$delvalue = $mem->get($_POST['del-key']);
            if ($mem->delete($_POST['del-key'])):?>
                <div class="notification is-warning">
                    <button class="delete"></button>
                    The value with <b><?= $_POST['del-key'] ?></b> is deleted. The value of the key that was deleted is
                    <b><?= $delvalue ?></b>
                </div>
            <? endif; ?>
        <? endif; ?>
        <? if ($_POST['flushall'] == 'true'): ?>
            <? $gv_value = $mem->flushAll(); ?>
            <div class="notification is-warning">
                <button class="delete"></button>
                All keys was delete
            </div>
        <? endif; ?>
        <div class="columns">
            <!-- Left side -->
            <div class="column">
                <div class="box">
                    <form action="" method="post">
                        <h4>Delete value by key</h4>
                        <input type="hidden" name="delvalue" value="true">
                        <div class="field has-addons">
                            <div class="control">
                                <input class="input is-primary" type="text" name="del-key" placeholder="Key">
                            </div>
                            <div class="control">
                                <button class="button is-link is-danger">Delete value</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="column">
                <div class="box">
                    <form action="" method="post">
                        <h4>Flush all keys</h4>
                        <input type="hidden" name="flushall" value="true">
                        <div class="field">
                            <div class="control">
                                <button class="button is-link is-danger">Flush all</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
</body>
</html>
