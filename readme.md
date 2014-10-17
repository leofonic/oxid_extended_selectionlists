
OXID-Modul "Extended Selectionlists"
-----------------------------------------------
Displays Information about articles in variant selectionslists
Version 1.0 OXID 4.8
Licence: MIT

Installation:
Copy the contents of the folder "copy_this" to the root folder of your shop and activate the module

Usage:
Use custom getters of extended_selectionlists_oxselection.php in your template.

Sample code for displaying article price in selectionlists (selectbox.tpl):

    [{foreach from=$oSelections item=oSelection}]
        <li class="[{if $oSelection->isDisabled()}]js-disabled disabled[{/if}]">
            <a data-selection-id="[{$oSelection->getValue()}]" href="[{$oSelection->getLink()}]" class="[{if $oSelection->isActive()}]selected[{/if}]">
                [{$oSelection->getName()}]
                <span style="float: right">[{$oSelection->getFPrice()}]</span>
            </a>
        </li>
    [{/foreach}]