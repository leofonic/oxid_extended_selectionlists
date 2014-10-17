<?php
class extended_selectionlists_oxvarianthandler extends extended_selectionlists_oxvarianthandler_parent
{
    protected function _buildVariantSelectionsList( $aVarSelects, $aSelections )
    {
        // creating selection lists
        foreach ( $aVarSelects as $iKey => $sLabel ) {
            $aVariantSelections[$iKey] = oxNew( "oxVariantSelectList", $sLabel, $iKey );
        }

        // building variant selections
        foreach ( $aSelections as $sVariantId => $aLineSelections ) {
            foreach ( $aLineSelections as $oPos => $aLine ) {
                //EXTENDED SELECTLISTS: add VariantId to line
                $aVariantSelections[$oPos]->addVariant( $aLine['name'], $aLine['hash'], $aLine['disabled'], $aLine['active'], $sVariantId );
            }
        }

        return $aVariantSelections;
    }
}