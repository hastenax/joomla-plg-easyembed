<?php
defined('_JEXEC') or die;

jimport('joomla.plugin.plugin');

require_once dirname(__FILE__).'/helper.php';

class plgContentEasyembed extends JPlugin
{
	public function onContentPrepare($context, &$article, &$params, $limitstart)
	{ 
		$oldtext = $article->text;
		
		if (strpos($article->text, '{noembedvideo}') !== FALSE)
		{
			$article->text = str_ireplace('{noembedvideo}', '', $article->text);
			return;
		}
                
                $fpwidth = $this->params->get('fpwidth');
		$fpheight = $this->params->get('fpheight');
		$width = $this->params->get('width');
		$height = $this->params->get('height');
                
                EasyEmbedVideoHelper::setFPWidth($fpwidth);
		EasyEmbedVideoHelper::setFPHeight($fpheight);
                EasyEmbedVideoHelper::setWidth($width);
                EasyEmbedVideoHelper::setHeight($height);
                
		if ($this->params->get('youtube') == "YES") 
		{
			$article->text = EasyEmbedVideoHelper::easiertube_content(  $article->text, $context);
		}
		
		if ($this->params->get('google') == "YES") 
		{
			$article->text = EasyEmbedVideoHelper::easiergoogle_content( $article->text, $context);
		}
		
		if ($this->params->get('ustream') == "YES") 
		{
			$article->text = EasyEmbedVideoHelper::easierustream_content( $article->text, $context);
		}
		
		if ($this->params->get('myspace') == "YES") 
		{
			$article->text = EasyEmbedVideoHelper::easiermyspace_content( $article->text, $context);
		}
		
		if ($this->params->get('vimeo') == "YES") 
		{
			$article->text = EasyEmbedVideoHelper::easiervimeo_content(  $article->text, $context);
		}
		
		if ($this->params->get('mybreak') == "YES") 
		{
			$article->text = EasyEmbedVideoHelper::easierbreak_content(  $article->text, $context);
		}
		
		if ($this->params->get('mpora') == "YES") 
		{
			$article->text = EasyEmbedVideoHelper::easiermpora_content(  $article->text, $context);
		}
		
		if ($this->params->get('youku') == "YES") 
		{
			$article->text = EasyEmbedVideoHelper::easieryouku_content(  $article->text, $context);
		}
		
		if ($this->params->get('fivtysix') == "YES") 
		{
			$article->text = EasyEmbedVideoHelper::easierfivtysix_content(  $article->text, $context);
		}
		
		if ($this->params->get('kusix') == "YES") 
		{
			$article->text = EasyEmbedVideoHelper::easierkusix_content(  $article->text, $context);
		}
                
                if ($this->params->get('kick') == "YES") 
		{
			$article->text = EasyEmbedVideoHelper::easierkick_content(  $article->text, $context);
		}
                
                if ($this->params->get('daily') == "YES") 
		{
			$article->text = EasyEmbedVideoHelper::easierdaily_content(  $article->text, $context);
		}
                
                if ($this->params->get('meta') == "YES") 
		{
			$article->text = EasyEmbedVideoHelper::easiermeta_content(  $article->text, $context);
		}
		
                if ($this->params->get('veoh') == "YES") 
		{
			$article->text = EasyEmbedVideoHelper::easierveoh_content(  $article->text, $context);
		}
                
                if ($this->params->get('video123') == "YES") 
		{
			$article->text = EasyEmbedVideoHelper::easiervideo123_content(  $article->text, $context);
		}
                
		if ($article->text != $oldtext && $this->params->get('copyrights') != 'no') 
		{
			$article->text .= '<div style="color:gray;font-size:small;margin-top:1em;">embed video plugin powered by <a href="http://union-d.ru">Union Development</a></div>';
		}
	}
}

?>

