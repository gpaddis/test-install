<?php
/**
 * This example is a refactor of an example on devdocs.magento.com.
 *
 * @see http://devdocs.magento.com/guides/m1x/magefordev/mage-for-dev-2.html
 */

class Magentotutorial_Configviewer_Model_Observer
{
    const FLAG_SHOW_CONFIG = 'showConfig';
    const FLAG_SHOW_CONFIG_FORMAT = 'showConfigFormat';

    private $request;

    // $observer is passed automatically (see config.xml) and contains the event to look for
    public function checkForConfigRequest($observer)
    {
        $this->request = $observer->getEvent()->getData('front')->getRequest();
        if ($this->request->{self::FLAG_SHOW_CONFIG} === 'true') {
            $this->setHeader();
            $this->outputConfig();
        }
    }

    protected function setHeader()
    {
        $this->checkFormat() == 'text' ? header("Content-Type: text/plain") : header("Content-Type: text/xml");
    }

    /**
     * Return the config format from the request or a default.
     *
     * @return string
     */
    protected function checkFormat()
    {
        return $this->request->{self::FLAG_SHOW_CONFIG_FORMAT} ?? 'xml';
    }

    /**
     * Output the the state of the Magento system: it lists all modules, models, classes, event listeners etc.
     *
     * @return string
     */
    protected function outputConfig()
    {
        die(Mage::app()->getConfig()->getNode()->asXML());
    }
}
