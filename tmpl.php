<?php
$types = array(
        'tinyint(4)',
        'smallint(2)',
        'mediumint(3)',
        'int(9)',
        'bigint(11)',
        'float',
        'double',
        'char(256)',
        'varchar',
        'tinytext',
        'text',
   );
?>
<!DOCTYPE html>
<html>
<head>
    <title></title>
</head>

<body>
<h4>Список таблиц базы данных: <?= $objDb->dbname ?></h4>
<ul>
    <?php foreach ($tableList as $value): ?>
    <li><a href="?name=<?php echo $value ?>"><?= $value ?></a></li>
        <?php if (isset($_GET['name']) && ($_GET['name'] === $value)): ?>
            <table border ='1'>
                <thead>
                   <tr>
                        <th>Имя поля</th>
                        <th>Тип поля</th>
                        <th>Удалить</th>
                    </tr>
                </thead>
            
            <?php foreach ($objDb->infoTable($value) as $fields): ?>
                <tr>
                    <td  align="right" width="250">
                   
                    <?php if (($action === 'editName') && ($_GET['field'] === $fields['Field'])): ?>
                        <form method="GET" action="manager.php" >
                            <input type="text" name="rename" value="<?= $fields['Field'] ?>">
                            <input type="hidden" name="name" value="<?= $value ?>">
                            <input type="hidden" name="field" value="<?= $fields['Field'] ?>">
                            <input type="hidden" name="type" value="<?= $fields['Type'] ?>">
                            <button style="vertical-align: middle" type="submit" name="action" value="renameColumn">
                            <img  src='images/ok.png' width='16' height='16' alt='Изменить'>
                            </button>
                            <button style="vertical-align: middle"  type="cancel" name="action" value="">
                            <img valign='center' src='images/cancel.png' width='16' height='16' alt='Отменить'>
                            </button>
                        </form>
                    <?php else: ?>
                        <?=$fields['Field']?>
                        <a href="?name=<?= $value ?>&field=<?= $fields['Field']?>&action=editName">
                        <img src='images/edit.png' width='16' height='16' alt='Изменить'></a>
                    <?php endif; ?>
                
                    </td>

                    <td align='right' width='150'>
                    <?php if (($action === 'editType') && ($_GET['field'] === $fields['Field'])): ?>
                        <form method="GET" action="manager.php">
                            <select name="newType">
                            <?php foreach ($types as $val): ?>
                            <option value="<?= $val ?>"><?= $val ?></option>
                               <?php endforeach; ?>
                            </select>
                            <input type="hidden" name="name" value="<?= $value ?>">
                            <input type="hidden" name="field" value="<?= $fields['Field'] ?>">
                            <input type="hidden" name="type" value="<?= $fields['Type'] ?>">
                            <button style="vertical-align: middle" type="submit" name="action" value="editColumnType">
                            <img  src='images/ok.png' width='16' height='16' alt='Изменить'>
                            </button>
                        </form>
                    <?php else: ?>
                        <?= $fields['Type'] ?>
                        <a href="?name=<?= $value ?>&field=<?= $fields['Field'] ?>&action=editType"><img src='images/edit.png' width='16' height='16' alt='Изменить'></a>
                    </td>
                    <?php endif; ?>
                    
                    <td align='center'>
                        <a href="?name=<?= $value ?>&field=<?= $fields['Field'] ?>&action=dropColumn">
                        <img src='images/delete.png' width='16' height='16' alt='Удалить поле'></a>
                    </td>

                </tr>
            <?php endforeach; ?>
            </table>
        <?php endif; ?>
    <?php endforeach; ?>
</ul>
<form method="POST" action="manager.php" >
    <label>Новая таблица:</label>
    <input type="text" name="name" value="" placeholder="Имя таблицы">
    <input type="submit" name="action" value="Создать">
</form>
</body>
</html>    
