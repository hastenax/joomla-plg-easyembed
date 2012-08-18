<?php
abstract class EasyEmbedVideoHelper
{
	public static $fpwidth = 400;
        public static $fpheight = 400;
        
        public static $width = 425;
        public static $height = 350;
	
	public static function str_replace_once($needle, $replace, $haystack)
	{
	    $pos = strpos($haystack,$needle);
	    if ($pos !== false) {
		return substr_replace($haystack,$replace,$pos,strlen($needle));
	    }
	    return $haystack;
	}
        
        public static function setFPWidth($value) 
	{
		EasyEmbedVideoHelper::$fpwidth = $value;
        }
	
	public static function setFPHeight($value) 
	{
		EasyEmbedVideoHelper::$fpheight = $value;
        }
	
	public static function setWidth($value) 
	{
		EasyEmbedVideoHelper::$width = $value;
        }
	
	public static function setHeight($value) 
	{
		EasyEmbedVideoHelper::$height = $value;
        }
        
        public static function easiertube_content( $text, $context = 'com_content.article') 
	{
                $regex = '/(<[^a]*a[^h]*href\s*=\s*"|\')?http:\/\/(www\.)?youtu\.?be(.com)?\/(watch\\?v=)?([^\t\s"\\\$<>#&:\]\[!@]+)[^\n\s\'"<>\[\]\\\$]*([^<]+<\/a>)?/i';
		preg_match_all( $regex, $text, $matches);
		
		for($x = 0; $x < count($matches[0]); $x++)
		{
			$vid = $matches[5][$x];
			if ($context == 'com_content.featured' || $context == 'text') 
			{
				$replace = '<iframe width="'.EasyEmbedVideoHelper::$fpwidth.'" height="'.EasyEmbedVideoHelper::$fpheight.'" src="http://www.youtube.com/embed/'.$vid.'" frameborder="0" allowfullscreen></iframe>';
			}
			else
			{
				$replace = '<iframe width="'.EasyEmbedVideoHelper::$width.'" height="'.EasyEmbedVideoHelper::$height.'" src="http://www.youtube.com/embed/'.$vid.'" frameborder="0" allowfullscreen></iframe>';
			}
			$text = EasyEmbedVideoHelper::str_replace_once($matches[0][$x], $replace, $text);
                        
                        //JCE doubles link fix
                        $text = str_replace($replace.$replace, $replace, $text);
		}
		return $text;
	}
	
	public static function easiergoogle_content( $text, $context = 'com_content.article' ) 
	{
                $regex = '/(<[^a]*a[^h]*href\s*=\s*"|\')?http:\/\/(www\.)?video.google.[^\/]*?\/videoplay\\?docid=([^\t\s"\\\$<>#&:\]\[!@]+)[^\n\s\'"<>\[\]\\\$]*([^<]+<\/a>)?/i';
		
		preg_match_all( $regex, $text, $matches );
		for($x = 0; $x < count($matches[0]); $x++)
		{
                        $vid= $matches[3][$x];
			if ($context == 'com_content.featured' || $context == 'text') 
			{
				$replace = "<object class=\"embed\" width=\"" . EasyEmbedVideoHelper::$fpwidth . "\" height=\"" . EasyEmbedVideoHelper::$fpheight . "\" type=\"application/x-shockwave-flash\" data=\"http://video.google.com/googleplayer.swf?docId=".$vid."\"><param name=\"movie\" value=\"http://video.google.com/googleplayer.swf?docId=".$vid."\" /><param name=\"wmode\" value=\"transparent\"><em>You need to a flashplayer enabled browser to view this YouTube video</em></object>";

			}
			else
			{
				$replace = "<object class=\"embed\" width=\"" . EasyEmbedVideoHelper::$width . "\" height=\"" . EasyEmbedVideoHelper::$height . "\" type=\"application/x-shockwave-flash\" data=\"http://video.google.com/googleplayer.swf?docId=".$vid."\"><param name=\"movie\" value=\"http://video.google.com/googleplayer.swf?docId=".$vid."\" /><param name=\"wmode\" value=\"transparent\"><em>You need to a flashplayer enabled browser to view this YouTube video</em></object>";
			}
			$text = EasyEmbedVideoHelper::str_replace_once($matches[0][$x], $replace, $text);
                                                
                        //JCE doubles link fix
                        $text = str_replace($replace.$replace, $replace, $text);
		}
		return $text;
	}
	
	public static function easierustream_content( $text, $context = 'com_content.article') 
	{
		$regex = '/(<[^a]*a[^h]*href\s*=\s*"|\')?http:\/\/(www\.)?ustream.tv\/recorded\/([\d]+)[^\n\s\'"<>\[\]\\\$]*([^<]+<\/a>)?/i';
                
		preg_match_all( $regex, $text, $matches );
		
		for($x = 0; $x < count($matches[0]); $x++)
		{
                        $vid = $matches[3][$x];
                        
			if ($context == 'com_content.featured' || $context == 'text') 
			{
				$replace = '<iframe width="'.EasyEmbedVideoHelper::$fpwidth.'" height="'.EasyEmbedVideoHelper::$fpheight.'" src="http://www.ustream.tv/embed/recorded/'.$vid.'?wmode=direct" scrolling="no" frameborder="0" style="border: 0px none transparent;"></iframe>';

			}
			else
			{
				$replace = '<iframe width="'.EasyEmbedVideoHelper::$width.'" height="'.EasyEmbedVideoHelper::$height.'" src="http://www.ustream.tv/embed/recorded/'.$vid.'?wmode=direct" scrolling="no" frameborder="0" style="border: 0px none transparent;"></iframe>';
			}
			$text = EasyEmbedVideoHelper::str_replace_once($matches[0][$x], $replace, $text);
			
                        //JCE doubles link fix
                        $text = str_replace($replace.$replace, $replace, $text);
		}
		return $text;
	}
	
	public static function easiermyspace_content( $text, $context = 'com_content.article' ) 
	{
		$regex = '/(<[^a]*a[^h]*href\s*=\s*"|\')?http:\/\/(www\.)?myspace.com\/video\/[0-9a-z\-\/]*\/([\d]+)[^\n\s\'"<>\[\]\\\$\/]*([^<]+<\/a>)?/i';
		
		preg_match_all( $regex, $text, $matches );

		for($x = 0; $x < count($matches[0]); $x++)
		{
			$vid= $matches[3][$x];

			if ($context == 'com_content.featured' || $context == 'text') 
			{
				$replace = '<object width="'.EasyEmbedVideoHelper::$fpwidth.'px" height="'.EasyEmbedVideoHelper::$fpheight.'px" ><param name="allowFullScreen" value="true"/><param name="wmode" value="transparent"/><param name="movie" value="http://mediaservices.myspace.com/services/media/embed.aspx/m='.$vid.',t=1,mt=video"/><embed src="http://mediaservices.myspace.com/services/media/embed.aspx/m='.$vid.',t=1,mt=video" width="'.EasyEmbedVideoHelper::$fpwidth.'" height="'.EasyEmbedVideoHelper::$fpheight.'" allowFullScreen="true" type="application/x-shockwave-flash" wmode="transparent"></embed></object>';
			}
			else
			{
				$replace = '<object width="'.EasyEmbedVideoHelper::$width.'px" height="'.EasyEmbedVideoHelper::$height.'px" ><param name="allowFullScreen" value="true"/><param name="wmode" value="transparent"/><param name="movie" value="http://mediaservices.myspace.com/services/media/embed.aspx/m='.$vid.',t=1,mt=video"/><embed src="http://mediaservices.myspace.com/services/media/embed.aspx/m='.$vid.',t=1,mt=video" width="'.EasyEmbedVideoHelper::$width.'" height="'.EasyEmbedVideoHelper::$height.'" allowFullScreen="true" type="application/x-shockwave-flash" wmode="transparent"></embed></object>';
			}
			$text = EasyEmbedVideoHelper::str_replace_once($matches[0][$x], $replace, $text);
			
                        //JCE doubles link fix
                        $text = str_replace($replace.$replace, $replace, $text);
		}
		return $text;
	}
	
	public static function easiervimeo_content( $text, $context = 'com_content.article' ) 
	{
		$regex = '/(<[^a]*a[^h]*href\s*=\s*"|\')?http:\/\/(www\.)?vimeo.com\/([\d]+)[^\n\s\'"<>\[\]\\\$\/]*([^<]+<\/a>)?/i';
		
		preg_match_all( $regex, $text, $matches );

		for($x = 0; $x < count($matches[0]); $x++)
		{
			$vid= $matches[3][$x];

			if ($context == 'com_content.featured' || $context == 'text') 
			{
				$replace = '<iframe src="http://player.vimeo.com/video/'.$vid.'" width="'.EasyEmbedVideoHelper::$fpwidth.'" height="'.EasyEmbedVideoHelper::$fpheight.'" frameborder="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe>';
			}
			else
			{
				$replace = '<iframe src="http://player.vimeo.com/video/'.$vid.'" width="'.EasyEmbedVideoHelper::$width.'" height="'.EasyEmbedVideoHelper::$height.'" frameborder="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe>';
			}
			$text = EasyEmbedVideoHelper::str_replace_once($matches[0][$x], $replace, $text);
			
                        //JCE doubles link fix
                        $text = str_replace($replace.$replace, $replace, $text);
		}
		return $text;		
	}
	
	public static function easierbreak_content( $text, $context = 'com_content.article' ) 
	{
                $regex = '/(<[^a]*a[^h]*href\s*=\s*"|\')?http:\/\/(www\.)?break.com\/[0-9a-z\/-]*-([\d]+)[^\n\s\'"<>\[\]\\\$\/]*([^<]+<\/a>)?/i';
		
		preg_match_all( $regex, $text, $matches );
		
		for($x=0; $x<count($matches[0]); $x++)
		{
			$vid= $matches[3][$x];
			
			if ($context == 'com_content.featured' || $context == 'text') 
			{
				$replace = "<object width=\"" . EasyEmbedVideoHelper::$fpwidth . "\" height=\"" . EasyEmbedVideoHelper::$fpheight . "\"><param name=\"movie\" value=\"http://embed.break.com/".$vid."\"></param><embed src=\"http://embed.break.com/".$vid."\" type=\"application/x-shockwave-flash\" width=\"" . EasyEmbedVideoHelper::$fpwidth . "\" height=\"" . EasyEmbedVideoHelper::$fpheight . "\"></embed></object>";
			}
			else
			{
				$replace = "<object width=\"" . EasyEmbedVideoHelper::$width . "\" height=\"" . EasyEmbedVideoHelper::$height . "\"><param name=\"movie\" value=\"http://embed.break.com/".$vid."\"></param><embed src=\"http://embed.break.com/".$vid."\" type=\"application/x-shockwave-flash\" width=\"" . EasyEmbedVideoHelper::$width . "\" height=\"" . EasyEmbedVideoHelper::$height . "\"></embed></object>";
			}
			$text = EasyEmbedVideoHelper::str_replace_once($matches[0][$x], $replace, $text);
			
                        //JCE doubles link fix
                        $text = str_replace($replace.$replace, $replace, $text);
		}
		return $text;		
	}
	
	public static function easiermpora_content( $text, $context = 'com_content.article' ) 
	{
                $regex = '/(<[^a]*a[^h]*href\s*=\s*"|\')?http:\/\/(www\.)?mpora.com\/videos\/([0-9a-z]+)[^\n\s\'"<>\[\]\\\$\/]*([^<]+<\/a>)?/i';

		preg_match_all($regex, $text, $matches );
		
		for($x=0; $x<count($matches[0]); $x++)
		{
			$vid= $matches[3][$x];
			
			if ($context == 'com_content.featured' || $context == 'text') 
			{
				$replace = '<iframe width="' . EasyEmbedVideoHelper::$fpwidth . '" height="' . EasyEmbedVideoHelper::$fpheight . '" src="http://mpora.com/videos/'.$vid.'/embed" frameborder="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe>';
			}
			else
			{
				$replace = '<iframe width="' . EasyEmbedVideoHelper::$width . '" height="' . EasyEmbedVideoHelper::$height . '" src="http://mpora.com/videos/'.$vid.'/embed" frameborder="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe>';
			}
			$text = EasyEmbedVideoHelper::str_replace_once($matches[0][$x], $replace, $text);
			
                        //JCE doubles link fix
                        $text = str_replace($replace.$replace, $replace, $text);
		}
		return $text;		
	}
	
	public static function easieryouku_content( $text, $context = 'com_content.article') 
	{
		$regex = '/(<[^a]*a[^h]*href\s*=\s*"|\')?http:\/\/(www\.|v\.)?youku.com\/v_show\/id_([0-9a-z]+)\.html[^\n\s\'"<>\[\]\\\$\/]*([^<]+<\/a>)?/i';

		preg_match_all( $regex, $text, $matches );
		
		for($x = 0; $x < count($matches[0]); $x++)
		{
			$vid= $matches[3][$x];
			if ($context == 'com_content.featured' || $context == 'text') 
			{
				$replace = '<embed src="http://player.youku.com/player.php/sid/'.$vid.'/v.swf" quality="high" width="'.EasyEmbedVideoHelper::$fpwidth.'" height="'.EasyEmbedVideoHelper::$fpheight.'" align="middle" allowScriptAccess="always" allowFullScreen="true" type="application/x-shockwave-flash"></embed>';

			}
			else
			{
				$replace = '<embed src="http://player.youku.com/player.php/sid/'.$vid.'/v.swf" quality="high" width="'.EasyEmbedVideoHelper::$width.'" height="'.EasyEmbedVideoHelper::$height.'" align="middle" allowScriptAccess="always" allowFullScreen="true" type="application/x-shockwave-flash"></embed>';
			}
			$text = EasyEmbedVideoHelper::str_replace_once($matches[0][$x], $replace, $text);
			
                        //JCE doubles link fix
                        $text = str_replace($replace.$replace, $replace, $text);
		}
		return $text;		
	}
	
	public static function easierfivtysix_content( $text, $context = 'com_content.article') 
	{
		$regex = '/(<[^a]*a[^h]*href\s*=\s*"|\')?http:\/\/(www\.)?56.com\/[a-z0-9_\-\/]+(-|_)([^_-]+)\.html[^\n\s\'"<>\[\]\\\$\/]*([^<]+<\/a>)?/i';
		preg_match_all( $regex, $text, $matches);
		
		for($x = 0; $x < count($matches[0]); $x++)
		{
			$vid= $matches[4][$x];
			if ($context == 'com_content.featured' || $context == 'text') 
			{
				$replace = '<embed src="http://player.56.com/v_'.$vid.'.swf" type="application/x-shockwave-flash" allowFullScreen="true" width="'.EasyEmbedVideoHelper::$fpwidth.'" height="'.EasyEmbedVideoHelper::$fpheight.'" allowNetworking="all" allowScriptAccess="always"></embed>';

			}
			else
			{
				$replace = '<embed src="http://player.56.com/v_'.$vid.'.swf" type="application/x-shockwave-flash" allowFullScreen="true" width="'.EasyEmbedVideoHelper::$width.'" height="'.EasyEmbedVideoHelper::$height.'" allowNetworking="all" allowScriptAccess="always"></embed>';
			}
			$text = EasyEmbedVideoHelper::str_replace_once($matches[0][$x], $replace, $text);
			
                        //JCE doubles link fix
                        $text = str_replace($replace.$replace, $replace, $text);
		}
		return $text;		
	}
	
	public static function easierkusix_content( $text, $context = 'com_content.article') 
	{
		$regex = '/(<[^a]*a[^h]*href\s*=\s*"|\')?http:\/\/(www\.|v\.)?ku6.com\/[a-z0-9_\-\/]+\/([^\/]+)\.html[^\n\s\'"<>\[\]\\\$\/]*([^<]+<\/a>)?/i';
		preg_match_all( $regex, $text, $matches );

		for($x = 0; $x < count($matches[0]); $x++)
		{
			$vid= $matches[3][$x];

			if ($context == 'com_content.featured' || $context == 'text') 
			{
				$replace = '<script data-height="'.EasyEmbedVideoHelper::$fpheight.'" data-width="'.EasyEmbedVideoHelper::$fpwidth.'" data-vid="'.$vid.'" src="http://player.ku6.com/out/v.js"></script>';
			}
			else
			{
				$replace = '<script data-height="'.EasyEmbedVideoHelper::$height.'" data-width="'.EasyEmbedVideoHelper::$width.'" data-vid="'.$vid.'" src="http://player.ku6.com/out/v.js"></script>';
			}
			$text = EasyEmbedVideoHelper::str_replace_once($matches[0][$x], $replace, $text);
			
                        //JCE doubles link fix
                        $text = str_replace($replace.$replace, $replace, $text);
		}
		return $text;		
	}
        
        public static function easierkick_content( $text, $context = 'com_content.article') 
	{
		$regex = '/(<[^a]*a[^h]*href\s*=\s*"|\')?http:\/\/(www\.|v\.)?kickstarter.com\/projects\/([0-9a-z\-_\/]+)[^\n\s\'"<>\[\]\\\$\/]*([^<]+<\/a>)?/i';
		preg_match_all( $regex, $text, $matches );

		for($x = 0; $x < count($matches[0]); $x++)
		{
			$vid= $matches[3][$x];

			if ($context == 'com_content.featured' || $context == 'text') 
			{
				$replace = '<iframe width="'.EasyEmbedVideoHelper::$fpwidth.'" height="'.EasyEmbedVideoHelper::$fpheight.'" src="http://www.kickstarter.com/projects/'.$vid.'/widget/video.html" frameborder="0"> </iframe>';
			}
			else
			{
				$replace = '<iframe width="'.EasyEmbedVideoHelper::$width.'" height="'.EasyEmbedVideoHelper::$height.'" src="http://www.kickstarter.com/projects/'.$vid.'/widget/video.html" frameborder="0"> </iframe>';
			}
			$text = EasyEmbedVideoHelper::str_replace_once($matches[0][$x], $replace, $text);
			
                        //JCE doubles link fix
                        $text = str_replace($replace.$replace, $replace, $text);
		}
		return $text;		
	}
        
        public static function easierdaily_content( $text, $context = 'com_content.article') 
	{
		$regex = '/(<[^a]*a[^h]*href\s*=\s*"|\')?http:\/\/(www\.|v\.)?dailymotion.com\/(video|hub)\/([0-9a-z=#\-_\/]+)[^\n\s\'"<>\[\]\\\$\/]*([^<]+<\/a>)?/i';
		preg_match_all( $regex, $text, $matches );

		for($x = 0; $x < count($matches[0]); $x++)
		{
			$vid= $matches[4][$x];
                        
                        $pos = strpos($vid, '#');
                        if ($pos > 0)
                        {
                            $vid = substr($vid, $pos);
                        }
                        $vid = str_ireplace('#video=', '', $vid);

			if ($context == 'com_content.featured' || $context == 'text') 
			{
				$replace = '<iframe frameborder="0" width="'.EasyEmbedVideoHelper::$fpwidth.'" height="'.EasyEmbedVideoHelper::$fpheight.'" src="http://www.dailymotion.com/embed/video/'.$vid.'"></iframe>';
			}
			else
			{
				$replace = '<iframe frameborder="0" width="'.EasyEmbedVideoHelper::$width.'" height="'.EasyEmbedVideoHelper::$height.'" src="http://www.dailymotion.com/embed/video/'.$vid.'"></iframe>';
			}
			$text = EasyEmbedVideoHelper::str_replace_once($matches[0][$x], $replace, $text);
			
                        //JCE doubles link fix
                        $text = str_replace($replace.$replace, $replace, $text);
		}
		return $text;		
	}
        
        public static function easiermeta_content( $text, $context = 'com_content.article') 
	{
		$regex = '/(<[^a]*a[^h]*href\s*=\s*"|\')?http:\/\/(www\.|v\.)?metacafe.com\/watch\/([0-9]+)\/([0-9a-z\-_]+)[^\n\s\'"<>\[\]\\\$]*([^<]+<\/a>)?/i';
		preg_match_all( $regex, $text, $matches );

		for($x = 0; $x < count($matches[0]); $x++)
		{
			$num= $matches[3][$x];
                        $vid= $matches[4][$x];

			if ($context == 'com_content.featured' || $context == 'text') 
			{
				$replace = '<embed flashVars="playerVars=autoPlay=no" src="http://www.metacafe.com/fplayer/'.$num.'/'.$vid.'.swf" width="'.EasyEmbedVideoHelper::$fpwidth.'" height="'.EasyEmbedVideoHelper::$fpheight.'" wmode="transparent" allowFullScreen="true" allowScriptAccess="always" name="Metacafe_'.$num.'" pluginspage="http://www.macromedia.com/go/getflashplayer" type="application/x-shockwave-flash"></embed>';
			}
			else
			{
				$replace = '<embed flashVars="playerVars=autoPlay=no" src="http://www.metacafe.com/fplayer/'.$num.'/'.$vid.'.swf" width="'.EasyEmbedVideoHelper::$width.'" height="'.EasyEmbedVideoHelper::$height.'" wmode="transparent" allowFullScreen="true" allowScriptAccess="always" name="Metacafe_'.$num.'" pluginspage="http://www.macromedia.com/go/getflashplayer" type="application/x-shockwave-flash"></embed>';
			}
			$text = EasyEmbedVideoHelper::str_replace_once($matches[0][$x], $replace, $text);
			
                        //JCE doubles link fix
                        $text = str_replace($replace.$replace, $replace, $text);
		}
		return $text;		
	}
        
        public static function easierveoh_content( $text, $context = 'com_content.article') 
	{
		$regex = '/(<[^a]*a[^h]*href\s*=\s*"|\')?http:\/\/(www\.|v\.)?veoh.com\/watch\/([0-9a-z\-_]+)[^\n\s\'"<>\[\]\\\$]*([^<]+<\/a>)?/i';
		preg_match_all( $regex, $text, $matches );

		for($x = 0; $x < count($matches[0]); $x++)
		{
			$vid= $matches[3][$x];
                        
			if ($context == 'com_content.featured' || $context == 'text') 
			{
				$replace = '<object width="'.EasyEmbedVideoHelper::$fpwidth.'" height="'.EasyEmbedVideoHelper::$fpheight.'" id="veohFlashPlayer" name="veohFlashPlayer"><param name="movie" value="http://www.veoh.com/swf/webplayer/WebPlayer.swf?version=AFrontend.5.7.0.1377&permalinkId='.$vid.'&player=videodetailsembedded&videoAutoPlay=0&id=anonymous"></param><param name="allowFullScreen" value="true"></param><param name="allowscriptaccess" value="always"></param><embed src="http://www.veoh.com/swf/webplayer/WebPlayer.swf?version=AFrontend.5.7.0.1377&permalinkId='.$vid.'&player=videodetailsembedded&videoAutoPlay=0&id=anonymous" type="application/x-shockwave-flash" allowscriptaccess="always" allowfullscreen="true" width="'.EasyEmbedVideoHelper::$fpwidth.'" height="'.EasyEmbedVideoHelper::$fpheight.'" id="veohFlashPlayerEmbed" name="veohFlashPlayerEmbed"></embed></object>';
			}
			else
			{
				$replace = '<object width="'.EasyEmbedVideoHelper::$width.'" height="'.EasyEmbedVideoHelper::$height.'" id="veohFlashPlayer" name="veohFlashPlayer"><param name="movie" value="http://www.veoh.com/swf/webplayer/WebPlayer.swf?version=AFrontend.5.7.0.1377&permalinkId='.$vid.'&player=videodetailsembedded&videoAutoPlay=0&id=anonymous"></param><param name="allowFullScreen" value="true"></param><param name="allowscriptaccess" value="always"></param><embed src="http://www.veoh.com/swf/webplayer/WebPlayer.swf?version=AFrontend.5.7.0.1377&permalinkId='.$vid.'&player=videodetailsembedded&videoAutoPlay=0&id=anonymous" type="application/x-shockwave-flash" allowscriptaccess="always" allowfullscreen="true" width="'.EasyEmbedVideoHelper::$width.'" height="'.EasyEmbedVideoHelper::$height.'" id="veohFlashPlayerEmbed" name="veohFlashPlayerEmbed"></embed></object>';
			}
			$text = EasyEmbedVideoHelper::str_replace_once($matches[0][$x], $replace, $text);
			
                        //JCE doubles link fix
                        $text = str_replace($replace.$replace, $replace, $text);
		}
		return $text;		
	}
        
        public static function easiervideo123_content( $text, $context = 'com_content.article') 
	{
		$regex = '/(<[^a]*a[^h]*href\s*=\s*"|\')?http:\/\/(www\.|v\.)?123video.nl\/playvideos.asp\?MovieID=([0-9]+)[^\n\s\'"<>\[\]\\\$]*([^<]+<\/a>)?/i';
		preg_match_all( $regex, $text, $matches );
                
		for($x = 0; $x < count($matches[0]); $x++)
		{
			$vid= $matches[3][$x];

			if ($context == 'com_content.featured' || $context == 'text') 
			{
				$replace = '<object classid="clsid:d27cdb6e-ae6d-11cf-96b8-444553540000" codebase="http://fpdownload.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=7,0,0,0" id="123movie_'.$vid.'" width="'.EasyEmbedVideoHelper::$fpwidth.'" height="'.EasyEmbedVideoHelper::$fpheight.'"><param name="movie" value="http://www.123video.nl/123video_emb.swf?mediaSrc='.$vid.'" /><param name="quality" value="high" /><param name="allowScriptAccess" value="always"/> <param name="allowFullScreen" value="true"></param><embed src="http://www.123video.nl/123video_emb.swf?mediaSrc='.$vid.'" quality="high" width="'.EasyEmbedVideoHelper::$fpwidth.'" height="'.EasyEmbedVideoHelper::$fpheight.'" allowfullscreen="true" type="application/x-shockwave-flash"  allowscriptaccess="always" pluginspage="http://www.macromedia.com/go/getflashplayer" /></object>';
			}
			else
			{
				$replace = '<object classid="clsid:d27cdb6e-ae6d-11cf-96b8-444553540000" codebase="http://fpdownload.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=7,0,0,0" id="123movie_'.$vid.'" width="'.EasyEmbedVideoHelper::$width.'" height="'.EasyEmbedVideoHelper::$height.'"><param name="movie" value="http://www.123video.nl/123video_emb.swf?mediaSrc='.$vid.'" /><param name="quality" value="high" /><param name="allowScriptAccess" value="always"/> <param name="allowFullScreen" value="true"></param><embed src="http://www.123video.nl/123video_emb.swf?mediaSrc='.$vid.'" quality="high" width="'.EasyEmbedVideoHelper::$width.'" height="'.EasyEmbedVideoHelper::$height.'" allowfullscreen="true" type="application/x-shockwave-flash"  allowscriptaccess="always" pluginspage="http://www.macromedia.com/go/getflashplayer" /></object>';
			}
			$text = EasyEmbedVideoHelper::str_replace_once($matches[0][$x], $replace, $text);
			
                        //JCE doubles link fix
                        $text = str_replace($replace.$replace, $replace, $text);
		}
		return $text;		
	}        
}
?>
