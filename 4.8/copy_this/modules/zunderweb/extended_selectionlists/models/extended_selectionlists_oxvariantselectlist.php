<?php
class extended_selectionlists_oxvariantselectlist extends extended_selectionlists_oxvariantselectlist_parent
{
    public function addVariant( $sName, $sValue, $blDisabled, $blActive, $sArticleId = false )
    {
        if ( ( $sName = trim( $sName ) ) ) {
            $sKey = $sValue;
            
            //EXTENDED SELECTLISTS: get only valid articles in current selection
            if ($blDisabled) $sArticleId = false;

            // creating new
            if ( !isset( $this->_aList[$sKey] ) ) {
                $this->_aList[$sKey] = oxNew( "oxSelection", $sName, $sValue, $blDisabled, $blActive, $sArticleId );
            } else {

                // overriding states
                if ( $this->_aList[$sKey]->isDisabled() && !$blDisabled ) {
                    $this->_aList[$sKey]->setDisabled( $blDisabled );
                }

                if ( !$this->_aList[$sKey]->isActive() && $blActive ) {
                    $this->_aList[$sKey]->setActiveState( $blActive );
                }
                
                //EXTENDED SELECTLISTS: add VariantId to array
                $this->_aList[$sKey]->addArticleId( $sArticleId );
            }

            // storing active selection
            if ( $this->_aList[$sKey]->isActive() ) {
                $this->_oActiveSelection = $this->_aList[$sKey];
            }
        }
    }
}