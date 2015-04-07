<?php
class extended_selectionlists_oxselection extends extended_selectionlists_oxselection_parent
{    
    protected $_aArticleIds = array();
    
    public function __construct( $sName, $sValue, $blDisabled, $blActive, $sArticleId = false )
    {
        $this->_sName      = $sName;
        $this->_sValue     = $sValue;
        $this->_blDisabled = $blDisabled;
        $this->_blActive   = $blActive;
        
        $this->addArticleId( $sArticleId );
    }
    //EXTENDED SELECTLISTS: add VariantId to array
    public function addArticleId( $sArticleId )
    {
        if ($sArticleId){
            $this->_aArticleIds[] = $sArticleId;
        }
    }
    
    /*
    //EXTENDED SELECTLISTS: Custom getters:
    Here getters can be created that derive information from the array _aArticleIds
    This array represents all active ArticleIds that currently hide behind a Variantselection (e.g. "blue")
    If the product is a single dimension variant, this array will contain a single element
    */
    
    //Returns one matching article of the selection
    public function getArticle( $sKey = 0 )
    {
        $oArticle = oxnew( 'oxarticle' );
        if ( $oArticle->load( $this->_aArticleIds[$sKey] ) ){
            return $oArticle;
        }
    }
    
    //Returns true is at least one article of the selection is buyable
    public function getIsBuyable(){
        $blIsBuyable = 0;
        foreach ( $this->_aArticleIds as $sKey => $sArticleId ){
            if ( $oArticle = $this->getArticle( $sKey ) ){
                if ( $oArticle->isBuyable() ){
                    $blIsBuyable = 1;
                }
            }
        }
        return $blIsBuyable;
    }
    
    //Returns price of selection
    public function getFPrice(){
        $aPrices = array();
        foreach ( $this->_aArticleIds as $sKey => $sArticleId ){
            if ( $oArticle = $this->getArticle( $sKey ) ){
                $dPrice = $oArticle->getPrice()->getPrice();
                $aPrices[$dPrice] = $dPrice;
            }
        }
        if (count($aPrices)){
            $sPrice = '';
            $sPricePrefix = oxRegistry::getLang()->translateString('PRICE_FROM').' ';
            if (count($aPrices) > 1) $sPrice = $sPricePrefix.' ';
            $sPrice .= oxRegistry::getLang()->formatCurrency(min($aPrices));
            $sPrice .= ' '.oxRegistry::getConfig()->getActShopCurrencyObject()->sign;
            return $sPrice;
        }
    }
    
    //Returns Stock Status if single article
    public function getStockStatus(){
        if (count($this->_aArticleIds) == 1){
            foreach ( $this->_aArticleIds as $sKey => $sArticleId ){
                if ( $oArticle = $this->getArticle( $sKey ) ){
                    return $oArticle->getStockStatus();
                }
            }            
        }
    }
}