<?php
/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */

/**
 * Pure-PHP implementation of AES.
 *
 * Uses mcrypt, if available, and an internal implementation, otherwise.
 *
 * PHP versions 4 and 5
 *
 * If {@link Crypt_AES::setKeyLength() setKeyLength()} isn't called, it'll be calculated from
 * {@link Crypt_AES::setKey() setKey()}.  ie. if the key is 128-bits, the key length will be 128-bits.  If it's 136-bits
 * it'll be null-padded to 160-bits and 160 bits will be the key length until {@link Crypt_Rijndael::setKey() setKey()}
 * is called, again, at which point, it'll be recalculated.
 *
 * Since Crypt_AES extends Crypt_Rijndael, some functions are available to be called that, in the context of AES, don't
 * make a whole lot of sense.  {@link Crypt_AES::setBlockLength() setBlockLength()}, for instance.  Calling that function,
 * however possible, won't do anything (AES has a fixed block length whereas Rijndael has a variable one).
 *
 * Here's a short example of how to use this library:
 * <code>
 * <?php
 *    include('Crypt/AES.php');
 *
 *    $aes = new Crypt_AES();
 *
 *    $aes->setKey('abcdefghijklmnop');
 *
 *    $size = 10 * 1024;
 *    $plaintext = '';
 *    for ($i = 0; $i < $size; $i++) {
 *        $plaintext.= 'a';
 *    }
 *
 *    echo $aes->decrypt($aes->encrypt($plaintext));
 * ?>
 * </code>
 *
 * LICENSE: Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 *
 * @category   Crypt
 * @package    Crypt_AES
 * @author     Jim Wigginton <terrafrost@php.net>
 * @copyright  MMVIII Jim Wigginton
 * @license    http://www.opensource.org/licenses/mit-license.html  MIT License
 * @link       http://phpseclib.sourceforge.net
 */

/**
 * Include Crypt_Rijndael
 */
if (!class_exists('Crypt_Rijndael')) {
    require_once __DIR__ . '/Rijndael.php';
}

/**#@+
 * @access public
 * @see Crypt_AES::encrypt()
 * @see Crypt_AES::decrypt()
 */
/**
 * Encrypt / decrypt using the Counter mode.
 *
 * Set to -1 since that's what Crypt/Random.php uses to index the CTR mode.
 *
 * @link http://en.wikipedia.org/wiki/Block_cipher_modes_of_operation#Counter_.28CTR.29
 */
define('CRYPT_AES_MODE_CTR', -1);
/**
 * Encrypt / decrypt using the Electronic Code Book mode.
 *
 * @link http://en.wikipedia.org/wiki/Block_cipher_modes_of_operation#Electronic_codebook_.28ECB.29
 */
define('CRYPT_AES_MODE_ECB', 1);
/**
 * Encrypt / decrypt using the Code Book Chaining mode.
 *
 * @link http://en.wikipedia.org/wiki/Block_cipher_modes_of_operation#Cipher-block_chaining_.28CBC.29
 */
define('CRYPT_AES_MODE_CBC', 2);
/**
 * Encrypt / decrypt using the Cipher Feedback mode.
 *
 * @link http://en.wikipedia.org/wiki/Block_cipher_modes_of_operation#Cipher_feedback_.28CFB.29
 */
define('CRYPT_AES_MODE_CFB', 3);
/**
 * Encrypt / decrypt using the Cipher Feedback mode.
 *
 * @link http://en.wikipedia.org/wiki/Block_cipher_modes_of_operation#Output_feedback_.28OFB.29
 */
define('CRYPT_AES_MODE_OFB', 4);
/**#@-*/

/**#@+
 * @access private
 * @see Crypt_AES::Crypt_AES()
 */
/**
 * Toggles the internal implementation
 */
define('CRYPT_AES_MODE_INTERNAL', 1);
/**
 * Toggles the mcrypt implementation
 */
define('CRYPT_AES_MODE_MCRYPT', 2);
/**#@-*/

/**
 * Pure-PHP implementation of AES.
 *
 * @author  Jim Wigginton <terrafrost@php.net>
 * @version 0.1.0
 * @access  public
 * @package Crypt_AES
 */
class Crypt_AES extends Crypt_Rijndael
{
    /**
     * mcrypt resource for encryption
     *
     * The mcrypt resource can be recreated every time something needs to be created or it can be created just once.
     * Since mcrypt operates in continuous mode, by default, it'll need to be recreated when in non-continuous mode.
     *
     * @see Crypt_AES::encrypt()
     * @var string
     * @access private
     */
    public $enmcrypt;

    /**
     * mcrypt resource for decryption
     *
     * The mcrypt resource can be recreated every time something needs to be created or it can be created just once.
     * Since mcrypt operates in continuous mode, by default, it'll need to be recreated when in non-continuous mode.
     *
     * @see Crypt_AES::decrypt()
     * @var string
     * @access private
     */
    public $demcrypt;

    /**
     * mcrypt resource for CFB mode
     *
     * @see Crypt_AES::encrypt()
     * @see Crypt_AES::decrypt()
     * @var string
     * @access private
     */
    public $ecb;

    /**
     * Default Constructor.
     *
     * Determines whether or not the mcrypt extension should be used.  $mode should only, at present, be
     * CRYPT_AES_MODE_ECB or CRYPT_AES_MODE_CBC.  If not explictly set, CRYPT_AES_MODE_CBC will be used.
     *
     * @param optional Integer $mode
     * @return Crypt_AES
     * @access public
     */
    public function __construct($mode = CRYPT_AES_MODE_CBC)
    {
        if (!defined('CRYPT_AES_MODE')) {
            switch (true) {
                case extension_loaded('mcrypt') && in_array('rijndael-128', mcrypt_list_algorithms()):
                    define('CRYPT_AES_MODE', CRYPT_AES_MODE_MCRYPT);
                    break;
                default:
                    define('CRYPT_AES_MODE', CRYPT_AES_MODE_INTERNAL);
            }
        }

        switch (CRYPT_AES_MODE) {
            case CRYPT_AES_MODE_MCRYPT:
                switch ($mode) {
                    case CRYPT_AES_MODE_ECB:
                        $this->paddable = true;
                        $this->mode = MCRYPT_MODE_ECB;
                        break;
                    case CRYPT_AES_MODE_CTR:
                        // ctr doesn't have a constant associated with it even though it appears to be fairly widely
                        // supported.  in lieu of knowing just how widely supported it is, i've, for now, opted not to
                        // include a compatibility layer.  the layer has been implemented but, for now, is commented out.
                        $this->mode = 'ctr';
                        //$this->mode = in_array('ctr', mcrypt_list_modes()) ? 'ctr' : CRYPT_AES_MODE_CTR;
                        break;
                    case CRYPT_AES_MODE_CFB:
                        $this->mode = 'ncfb';
                        break;
                    case CRYPT_AES_MODE_OFB:
                        $this->mode = MCRYPT_MODE_NOFB;
                        break;
                    case CRYPT_AES_MODE_CBC:
                    default:
                        $this->paddable = true;
                        $this->mode = MCRYPT_MODE_CBC;
                }

                break;
            default:
                switch ($mode) {
                    case CRYPT_AES_MODE_ECB:
                        $this->paddable = true;
                        $this->mode = CRYPT_RIJNDAEL_MODE_ECB;
                        break;
                    case CRYPT_AES_MODE_CTR:
                        $this->mode = CRYPT_RIJNDAEL_MODE_CTR;
                        break;
                    case CRYPT_AES_MODE_CFB:
                        $this->mode = CRYPT_RIJNDAEL_MODE_CFB;
                        break;
                    case CRYPT_AES_MODE_OFB:
                        $this->mode = CRYPT_RIJNDAEL_MODE_OFB;
                        break;
                    case CRYPT_AES_MODE_CBC:
                    default:
                        $this->paddable = true;
                        $this->mode = CRYPT_RIJNDAEL_MODE_CBC;
                }
        }

        if (CRYPT_AES_MODE == CRYPT_AES_MODE_INTERNAL) {
            parent::__construct($this->mode);
        }
    }

    /**
     * Dummy function
     *
     * Since Crypt_AES extends Crypt_Rijndael, this function is, technically, available, but it doesn't do anything.
     *
     * @access public
     * @param int $length
     */
    public function setBlockLength($length)
    {
    }

    /**
     * Sets the initialization vector. (optional)
     *
     * SetIV is not required when CRYPT_RIJNDAEL_MODE_ECB is being used.  If not explictly set, it'll be assumed
     * to be all zero's.
     *
     * @access public
     * @param string $iv
     */
    public function setIV($iv)
    {
        parent::setIV($iv);
        if (CRYPT_AES_MODE == CRYPT_AES_MODE_MCRYPT) {
            $this->changed = true;
        }
    }

    /**
     * Encrypts a message.
     *
     * $plaintext will be padded with up to 16 additional bytes.  Other AES implementations may or may not pad in the
     * same manner.  Other common approaches to padding and the reasons why it's necessary are discussed in the following
     * URL:
     *
     * {@link http://www.di-mgt.com.au/cryptopad.html http://www.di-mgt.com.au/cryptopad.html}
     *
     * An alternative to padding is to, separately, send the length of the file.  This is what SSH, in fact, does.
     * strlen($plaintext) will still need to be a multiple of 16, however, arbitrary values can be added to make it that
     * length.
     *
     * @see Crypt_AES::decrypt()
     * @access public
     * @param string $plaintext
     */
    public function encrypt($plaintext)
    {
        if (CRYPT_AES_MODE == CRYPT_AES_MODE_MCRYPT) {
            $this->_mcryptSetup();

            // re: http://phpseclib.sourceforge.net/cfb-demo.phps
            // using mcrypt's default handing of CFB the above would output two different things.  using phpseclib's
            // rewritten CFB implementation the above outputs the same thing twice.
            if ('ncfb' === $this->mode && $this->continuousBuffer) {
                $iv = &$this->encryptIV;
                $pos = &$this->enbuffer['pos'];
                $len = mb_strlen($plaintext);
                $ciphertext = '';
                $i = 0;
                if ($pos) {
                    $orig_pos = $pos;
                    $max = 16 - $pos;
                    if ($len >= $max) {
                        $i = $max;
                        $len -= $max;
                        $pos = 0;
                    } else {
                        $i = $len;
                        $pos += $len;
                        $len = 0;
                    }
                    $ciphertext = mb_substr($iv, $orig_pos) ^ $plaintext;
                    $iv = substr_replace($iv, $ciphertext, $orig_pos, $i);
                    $this->enbuffer['enmcrypt_init'] = true;
                }
                if ($len >= 16) {
                    if (false === $this->enbuffer['enmcrypt_init'] || $len > 280) {
                        if (true === $this->enbuffer['enmcrypt_init']) {
                            mcrypt_generic_init($this->enmcrypt, $this->key, $iv);
                            $this->enbuffer['enmcrypt_init'] = false;
                        }
                        $ciphertext .= mcrypt_generic($this->enmcrypt, mb_substr($plaintext, $i, $len - $len % 16));
                        $iv = mb_substr($ciphertext, -16);
                        $len %= 16;
                    } else {
                        while ($len >= 16) {
                            $iv = mcrypt_generic($this->ecb, $iv) ^ mb_substr($plaintext, $i, 16);
                            $ciphertext .= $iv;
                            $len -= 16;
                            $i += 16;
                        }
                    }
                }

                if ($len) {
                    $iv = mcrypt_generic($this->ecb, $iv);
                    $block = $iv ^ mb_substr($plaintext, -$len);
                    $iv = substr_replace($iv, $block, 0, $len);
                    $ciphertext .= $block;
                    $pos = $len;
                }

                return $ciphertext;
            }

            if ($this->paddable) {
                $plaintext = $this->_pad($plaintext);
            }

            $ciphertext = mcrypt_generic($this->enmcrypt, $plaintext);

            if (!$this->continuousBuffer) {
                mcrypt_generic_init($this->enmcrypt, $this->key, $this->iv);
            }

            return $ciphertext;
        }

        return parent::encrypt($plaintext);
    }

    /**
     * Decrypts a message.
     *
     * If strlen($ciphertext) is not a multiple of 16, null bytes will be added to the end of the string until it is.
     *
     * @see Crypt_AES::encrypt()
     * @access public
     * @param string $ciphertext
     */
    public function decrypt($ciphertext)
    {
        if (CRYPT_AES_MODE == CRYPT_AES_MODE_MCRYPT) {
            $this->_mcryptSetup();

            if ('ncfb' === $this->mode && $this->continuousBuffer) {
                $iv = &$this->decryptIV;
                $pos = &$this->debuffer['pos'];
                $len = mb_strlen($ciphertext);
                $plaintext = '';
                $i = 0;
                if ($pos) {
                    $orig_pos = $pos;
                    $max = 16 - $pos;
                    if ($len >= $max) {
                        $i = $max;
                        $len -= $max;
                        $pos = 0;
                    } else {
                        $i = $len;
                        $pos += $len;
                        $len = 0;
                    }
                    // ie. $i = min($max, $len), $len-= $i, $pos+= $i, $pos%= $blocksize
                    $plaintext = mb_substr($iv, $orig_pos) ^ $ciphertext;
                    $iv = substr_replace($iv, mb_substr($ciphertext, 0, $i), $orig_pos, $i);
                }
                if ($len >= 16) {
                    $cb = mb_substr($ciphertext, $i, $len - $len % 16);
                    $plaintext .= mcrypt_generic($this->ecb, $iv . $cb) ^ $cb;
                    $iv = mb_substr($cb, -16);
                    $len %= 16;
                }
                if ($len) {
                    $iv = mcrypt_generic($this->ecb, $iv);
                    $plaintext .= $iv ^ mb_substr($ciphertext, -$len);
                    $iv = substr_replace($iv, mb_substr($ciphertext, -$len), 0, $len);
                    $pos = $len;
                }

                return $plaintext;
            }

            if ($this->paddable) {
                // we pad with chr(0) since that's what mcrypt_generic does.  to quote from http://php.net/function.mcrypt-generic :
                // "The data is padded with "\0" to make sure the length of the data is n * blocksize."
                $ciphertext = str_pad($ciphertext, (mb_strlen($ciphertext) + 15) & 0xFFFFFFF0, chr(0));
            }

            $plaintext = mdecrypt_generic($this->demcrypt, $ciphertext);

            if (!$this->continuousBuffer) {
                mcrypt_generic_init($this->demcrypt, $this->key, $this->iv);
            }

            return $this->paddable ? $this->_unpad($plaintext) : $plaintext;
        }

        return parent::decrypt($ciphertext);
    }

    /**
     * Setup mcrypt
     *
     * Validates all the variables.
     *
     * @access private
     */
    public function _mcryptSetup()
    {
        if (!$this->changed) {
            return;
        }

        if (!$this->explicit_key_length) {
            // this just copied from Crypt_Rijndael::_setup()
            $length = mb_strlen($this->key) >> 2;
            if ($length > 8) {
                $length = 8;
            } elseif ($length < 4) {
                $length = 4;
            }
            $this->Nk = $length;
            $this->key_size = $length << 2;
        }

        switch ($this->Nk) {
            case 4: // 128
                $this->key_size = 16;
                break;
            case 5: // 160
            case 6: // 192
                $this->key_size = 24;
                break;
            case 7: // 224
            case 8: // 256
                $this->key_size = 32;
        }

        $this->key = str_pad(mb_substr($this->key, 0, $this->key_size), $this->key_size, chr(0));
        $this->encryptIV = $this->decryptIV = $this->iv = str_pad(mb_substr($this->iv, 0, 16), 16, chr(0));

        if (!isset($this->enmcrypt)) {
            $mode = $this->mode;
            //$mode = $this->mode == CRYPT_AES_MODE_CTR ? MCRYPT_MODE_ECB : $this->mode;

            $this->demcrypt = mcrypt_module_open(MCRYPT_RIJNDAEL_128, '', $mode, '');
            $this->enmcrypt = mcrypt_module_open(MCRYPT_RIJNDAEL_128, '', $mode, '');

            if ('ncfb' === $mode) {
                $this->ecb = mcrypt_module_open(MCRYPT_RIJNDAEL_128, '', MCRYPT_MODE_ECB, '');
            }
        } // else should mcrypt_generic_deinit be called?

        mcrypt_generic_init($this->demcrypt, $this->key, $this->iv);
        mcrypt_generic_init($this->enmcrypt, $this->key, $this->iv);

        if ('ncfb' === $this->mode) {
            mcrypt_generic_init($this->ecb, $this->key, "\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0");
        }

        $this->changed = false;
    }

    /**
     * Treat consecutive "packets" as if they are a continuous buffer.
     *
     * The default behavior.
     *
     * @see Crypt_Rijndael::disableContinuousBuffer()
     * @access public
     */
    public function enableContinuousBuffer()
    {
        parent::enableContinuousBuffer();

        if (CRYPT_AES_MODE == CRYPT_AES_MODE_MCRYPT) {
            $this->enbuffer['enmcrypt_init'] = true;
            $this->debuffer['demcrypt_init'] = true;
        }
    }

    /**
     * Treat consecutive packets as if they are a discontinuous buffer.
     *
     * The default behavior.
     *
     * @see Crypt_Rijndael::enableContinuousBuffer()
     * @access public
     */
    public function disableContinuousBuffer()
    {
        parent::disableContinuousBuffer();

        if (CRYPT_AES_MODE == CRYPT_AES_MODE_MCRYPT) {
            mcrypt_generic_init($this->enmcrypt, $this->key, $this->iv);
            mcrypt_generic_init($this->demcrypt, $this->key, $this->iv);
        }
    }
}

// vim: ts=4:sw=4:et:
// vim6: fdl=1: