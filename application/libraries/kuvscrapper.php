<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * phpQuery is a server-side, chainable, CSS3 selector driven
 * Document Object Model (DOM) API based on jQuery JavaScript Library.
 *
 * @version 1.0.0
 * @author Oluwaseye Ogunkoya <seyz4all@gmail.com>
 * @license http://www.opensource.org/licenses/mit-license.php MIT License
 * @package phpQuery
 */

include APPPATH . 'libraries/Phpquery_onefile.php';

class Kuvscrapper {

    public function first_image($htmldata)
    {
    	$pq = phpQuery::newDocumentHTML($htmldata);
		$img = $pq->find('img:first');
		$src = $img->attr('src');

		return $src;
    }

    public function content($htmldata)
    {
    	//scrapping the content. extracting the content, leaving out the images
    	$content  = preg_replace('/<a href="[^"]*">[^<]*<img src="[^"]*"[^>]*>[^<]*<\/a>/sim', '', $htmldata);
    	return $content;
    }

    public function description($htmldata, $num)
    {
    	$content  = preg_replace('/<a href="[^"]*">[^<]*<img src="[^"]*"[^>]*>[^<]*<\/a>/sim', '', $htmldata);
    	//using codeigniter's word limiter helper that accepts the string and the integer of number or count
    	$content = word_limiter($content, $num);
    	return $content;
    }
}

