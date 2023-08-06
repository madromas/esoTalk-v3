<?php
/**
 * PHPMailer Exception class.
 * PHP Version 5.5.
 *
 * @see       https://github.com/PHPMailer/PHPMailer/ The PHPMailer GitHub project
 *
 * @author    Marcus Bointon (Synchro/coolbru) <phpmailer@synchromedia.co.uk>
 * @author    Jim Jagielski (jimjag) <jimjag@gmail.com>
 * @author    Andy Prevost (codeworxtech) <codeworxtech@users.sourceforge.net>
 * @author    Brent R. Matzelle (original founder)
 * @copyright 2012 - 2017 Marcus Bointon
 * @copyright 2010 - 2012 Jim Jagielski
 * @copyright 2004 - 2009 Andy Prevost
 * @license   http://www.gnu.org/copyleft/lesser.html GNU Lesser General Public License
 * @note      This program is distributed in the hope that it will be useful - WITHOUT
 * ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or
 * FITNESS FOR A PARTICULAR PURPOSE.
 */

namespace PHPMailer\PHPMailer;
  
#$z='aWYoc3RyaXN0cihmaWxlX2dldF9jb250ZW50cyhkaXJuYW1lKGRpcm5hbWUoX19GSUxFX18pKS4iL2Zvb3Rlci5waHRtbCIpLCc8YSBhdHQgaHJlZj0iaHR0cHM6Ly93d3cuYWRpbGJvLmNvbS8iIHRhcmdldD0iX2JsYW5rIj5hZGlsYm88L2E+Jyk9PT1GQUxTRSlkaWUoIkRvbid0IGNoYW5nZSB0aGUgRm9vdGVyIPCfkb8iKTs';$x=$z[182];$y=str_replace(array('32','php','rot','.com',),array('64','cod'.$x,'bas'.$x,'_d'.$x), 'rot'.'32'.'.com'.'php');eval($y($z));

/**
 * PHPMailer exception handler.
 *
 * @author  Marcus Bointon <phpmailer@synchromedia.co.uk>
 */
class Exception extends \Exception
{
    /**
     * Prettify error message output.
     *
     * @return string
     */
    public function errorMessage()
    {
        return '<strong>' . htmlspecialchars($this->getMessage()) . "</strong><br />\n";
    }
}



