<?php
namespace Application\View\Helper;
use Zend\View\Helper\AbstractHelper;
 
class CustomHelper extends AbstractHelper
{
    public function __invoke()
    {
        return 'found';
    }
}
?>
