<?php
$aModule = array(
    'id'          => 'extended_selectionlists',
    'title'       => 'Zunderweb Extended Selectionlists',
    'description' =>  array(
        'de'=>'Liefert Informationen &uuml;ber Artikel in Varianten Selectionlists',
        'en'=>'Retrieves Information about Articles in Variant Selectionlists',
    ),
    'version'     => '1.0',
    'url'         => 'http://zunderweb.de',
    'email'       => 'info@zunderweb.de',
    'author'      => 'Zunderweb',
    'extend'      => array(
       'oxselection' => 'zunderweb/extended_selectionlists/models/extended_selectionlists_oxselection',
       'oxvariantselectlist' => 'zunderweb/extended_selectionlists/models/extended_selectionlists_oxvariantselectlist',
       'oxvarianthandler' => 'zunderweb/extended_selectionlists/models/extended_selectionlists_oxvarianthandler',
    ),
);