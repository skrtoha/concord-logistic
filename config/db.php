<?php
const TEST=false;
if(TEST===true){
    return [
        'class' => 'yii\db\Connection',
        'dsn' => 'mysql:host=localhost;dbname=concord_p',
        'username' => 'root',
        'password' => '',
        'charset' => 'utf8',
    ];
}else {
    return [
        'class' => 'yii\db\Connection',
        'dsn' => 'mysql:host=localhost;dbname=concordp_p',
        //'username' => 'root',
        //'password' => '',
        'username' => 'concordp_p',
        'password' => 'UYGyugY2345gygyGYG45YTFGtvt4gvtvTFVTFTy645TYytfytgvYF46TftfvTCTtfct',
        'charset' => 'utf8',

        // Schema cache options (for production environment)
        //'enableSchemaCache' => true,
        //'schemaCacheDuration' => 60,
        //'schemaCache' => 'cache',
    ];
}
