&& function_exists ('imagefilter') && defined ('IMG_FILTER_NEGATE')) {
        // apply filters to image
        $filterList = explode ('|', $filters);
        foreach ($filterList as $fl) {
            $filterSettings = explode (',', $fl);
            if (isset ($imageFilters[$filterSettings[0]])) {
                for ($i = 0; $i < 4; $i ++) {
                    if (!isset ($filterSettings[$i])) {
						$filterSettings[$i] = null;
                    } else {
						$filterSettings[$i] = (int) $filterSettings[$i];
					}
                }
                switch ($imageFilters[$filterSettings[0]][1]) {
                    case 1:
                        imagefilter ($canvas, $imageFilters[$filterSettings[0]][0], $filterSettings[1]);
                        break;
                    case 2:
                        imagefilter ($canvas, $imageFilters[$filterSettings[0]][0], $filterSettings[1], $filterSettings[2]);
                        break;
                    case 3:
                        imagefilter ($canvas, $imageFilters[$filterSettings[0]][0], $filterSettings[1], $filterSettings[2], $filterSettings[3]);
                        break;
                    case 4:
                        imagefilter ($canvas, $imageFilters[$filterSettings[0]][0], $filterSettings[1], $filterSettings[2], $filterSettings[3], $filterSettings[4]);
                        break;
                    default:
                        imagefilter ($canvas, $imageFilters[$filterSettings[0]][0]);
                        break;
                }
            }
        }
    }
	// sharpen image
	if ($sharpen && function_exists ('imageconvolution')) {
		$sharpenMatrix = array (
			array (-1,-1,-1),
			array (-1,16,-1),
			array (-1,-1,-1),
		);
		$divisor = 8;
		$offset = 0;
		imageconvolution ($canvas, $sharpenMatrix, $divisor, $offset);
	}
    // output image to browser based on mime type
    show_image ($mime_type, $canvas);
    // remove image from memory
    imagedestroy ($canvas);
	// if not in cache then clear some space and generate a new file
	clean_cache ();
	die ();
} else {
    if (strlen ($src)) {
        display_error ('image ' . $src . ' not found');
    } else {
        display_error ('no source specified');
    }
}
/**
 *
 * @global <type> $quality
 * @param <type> $mime_type
 * @param <type> $image_resized 
 */
function show_image ($mime_type, $image_resized) {
    global $quality;
    // check to see if we can write to the cache directory
    $cache_file = get_cache_file ($mime_type);
	if (stristr ($mime_type, 'jpeg')) {
		imagejpeg ($image_resized, $cache_file, $quality);
	} else {
		imagepng ($image_resized, $cache_file, floor ($quality * 0.09));
	}
	show_cache_file ($mime_type);
}
/**
 *
 * @param <type> $property
 * @param <type> $default
 * @return <type> 
 */
function get_request ($property, $default = 0) {
    if (isset($_GET[$property])) {
        return $_GET[$property];
    } else {
        return $default;
    }
}
/**
 *
 * @param <type> $mime_type
 * @param <type> $src
 * @return <type>
 */
function open_image ($mime_type, $src) {
	$mime_type = strtolower ($mime_type);
	if (stristr ($mime_type, 'gif')) {
        $image = imagecreatefromgif($src);
    } elseif (stristr ($mime_type, 'jpeg')) {
        $image = imagecreatefromjpeg($src);
    } elseif (stristr ($mime_type, 'png')) {
        $image = imagecreatefrompng($src);
    }
    return $image;
}
/**
 * clean out old files from the cache
 * you can change the number of files to store and to delete per loop in the defines at the top of the code
 *
 * @return <type>
 */
function clean_cache () {
	// add an escape
	// Reduces the amount of cache clearing to save some processor speed
	if (rand (1, 100) > 10) {
		return true;
	}
	flush ();
    $files = glob (DIRECTORY_CACHE . '/*', GLOB_BRACE);
	if (count($files) > CACHE_SIZE) {
		
        $yesterday = time () - (24 * 60 * 60);
        usort ($files, 'filemtime_compare');
        $i = 0;
		foreach ($files as $file) {
			$i ++;
			if ($i >= CACHE_CLEAR) {
				return;
			}
			if (@filemtime ($file) > $yesterday) {
				return;
			}
			if (file_exists ($file)) {
				unlink ($file);
			}
		}
    }
}
/**
 * compare the file time of two files
 *
 * @param <type> $a
 * @param <type> $b
 * @return <type>
 */
function filemtime_compare ($a, $b) {
	$break = explode ('/', $_SERVER['SCRIPT_FILENAME']);
	$filename = $break[count($break) - 1];
	$filepath = str_replace ($filename, '', $_SERVER['SCRIPT_FILENAME']);
	$file_a = realpath ($filepath . $a);
	$file_b = realpath ($filepath . $b);
    return filemtime ($file_a) - filemtime ($file_b);
}
/**
 * determine the file mime type
 *
 * @param <type> $file
 * @return <type>
 */
function mime_type ($file) {
	$file_infos = getimagesize ($file);
	$mime_type = $file_infos['mime'];
    // use mime_type to determine mime type
    if (!preg_match ("/jpg|jpeg|gif|png/i", $mime_type)) {
		display_error ('Invalid src mime type: ' . $mime_type);
    }
    return $mime_type;
}
/**
 *
 * @param <type> $mime_type
 */
function check_cache ($mime_type) {
	if (CACHE_USE) {
		if (!show_cache_file ($mime_type)) {
			// make sure cache dir exists
			if (!file_exists (DIRECTORY_CACHE)) {
				// give 777 permissions so that developer can overwrite
				// files created by web server user
				mkdir (DIRECTORY_CACHE);
				chmod (DIRECTORY_CACHE, 0777);
			}
		}
	}
}
/**
 *
 * @param <type> $mime_type
 * @return <type> 
 */
function show_cache_file ($mime_type) {
	// use browser cache if available to speed up page load
	if (isset ($_SERVER['HTTP_IF_MODIFIED_SINCE'])) {
		if (strtotime($_SERVER['HTTP_IF_MODIFIED_SINCE']) < strtotime('now')) {
			header ('HTTP/1.1 304 Not Modified');
			die ();
		}
	}
	$cache_file = get_cache_file ($mime_type);
	if (file_exists ($cache_file)) {
		// change the modified headers
		$gmdate_expires = gmdate ('D, d M Y H:i:s', strtotime ('now +10 days')) . ' GMT';
		$gmdate_modified = gmdate ('D, d M Y H:i:s') . ' GMT';
		// send content headers then display image
		header ('Content-Type: ' . $mime_type);
		header ('Accept-Ranges: bytes');
		header ('Last-Modified: ' . $gmdate_modified);
		header ('Content-Length: ' . filesize ($cache_file));
		header ('Cache-Control: max-age=864000, must-revalidate');
		header ('Expires: ' . $gmdate_expires);
		if (!@readfile ($cache_file)) {
			$content = file_get_contents ($cache_file);
			if ($content != FALSE) {
				echo $content;
			} else {
				display_error ('cache file could not be loaded');
			}
		}
		die ();
    }
	return FALSE;
}
/**
 *
 * @staticvar string $cache_file
 * @param <type> $mime_type
 * @return string
 */
function get_cache_file ($mime_type) {
    static $cache_file;
	global $src;
	$file_type = '.png';
	if (stristr ($mime_type, 'jpeg')) {
		$file_type = '.jpg';
    }
    if (!$cache_file) {
		// filemtime is used to make sure updated files get recached
        $cache_file = DIRECTORY_CACHE . '/' . md5 ($_SERVER ['QUERY_STRING'] . VERSION . filemtime ($src)) . $file_type;
    }
    return $cache_file;
}
/**
 *
 * @global array $allowedSites
 * @param string $src
 * @return string
 */
function check_external ($src) {
	global $allowedSites;
    if (preg_match ('/http:\/\//', $src) == true) {
        $url_info = parse_url ($src);
		// convert youtube video urls
		// need to tidy up the code
		
		if ($url_info['host'] == 'www.youtube.com' || $url_info['host'] == 'youtube.com') {
			parse_str ($url_info['query']);
			if (isset($v)) {
				$src = 'http://img.youtube.com/vi/' . $v . '/0.jpg';
				$url_info['host'] = 'img.youtube.com';
			}
		}
		// check allowed sites (if required)
		if (ALLOW_EXTERNAL) {
			$isAllowedSite = true;
		} else {
			$isAllowedSite = false;
			foreach ($allowedSites as $site) {
				$site = '/' . addslashes ($site) . '/';
				if (preg_match ($site, $url_info['host']) == true) {
					$isAllowedSite = true;
				}
			}
			
		}
		// if allowed
		if ($isAllowedSite) {
			$fileDetails = pathinfo ($src);
			$ext = strtolower ($fileDetails['extension']);
			$filename = md5 ($src);
			$local_filepath = DIRECTORY_TEMP . '/' . $filename . '.' . $ext;
			if (!file_exists ($local_filepath)) {
				if (function_exists ('curl_init')) {
					$fh = fopen ($local_filepath, 'w');
					$ch = curl_init ($src);
					curl_setopt ($ch, CURLOPT_URL, $src);
					curl_setopt ($ch, CURLOPT_RETURNTRANSFER, TRUE);
					curl_setopt ($ch, CURLOPT_FOLLOWLOCATION, 1);
					curl_setopt ($ch, CURLOPT_HEADER, 0);
					curl_setopt ($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
					curl_setopt ($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.7.5) Gecko/20041107 Firefox/1.0');
					curl_setopt ($ch, CURLOPT_FILE, $fh);
					if (curl_exec ($ch) === FALSE) {
						if (file_exists ($local_filepath)) {
							unlink ($local_filepath);
						}
						display_error ('error reading file ' . $src . ' from remote host: ' . curl_error($ch));
					}
					curl_close ($ch);
					fclose ($fh);
                } else {
					if (!$img = file_get_contents($src)) {
						display_error ('remote file for ' . $src . ' can not be accessed. It is likely that the file permissions are restricted');
					}
					if (file_put_contents ($local_filepath, $img) == FALSE) {
						display_error ('error writing temporary file');
					}
				}
				if (!file_exists ($local_filepath)) {
					display_error ('local file for ' . $src . ' can not be created');
				}
			}
			$src = $local_filepath;
		} else {
			display_error ('remote host "' . $url_info['host'] . '" not allowed');
		}
    }
    return $src;
}
/**
 * tidy up the image source url
 *
 * @param <type> $src
 * @return string
 */
function clean_source ($src) {
	$host = str_replace ('www.', '', $_SERVER['HTTP_HOST']);
	$regex = "/^((ht|f)tp(s|):\/\/)(www\.|)" . $host . "/i";
	$src = preg_replace ($regex, '', $src);
	$src = strip_tags ($src);
	$src = str_replace (' ', '%20', $src);
    $src = check_external ($src);
    // remove slash from start of string
    if (strpos ($src, '/') === 0) {
        $src = substr ($src, -(strlen ($src) - 1));
    }
    // don't allow users the ability to use '../'
    // in order to gain access to files below document root
    $src = preg_replace ("/\.\.+\//", "", $src);
    // get path to image on file system
    $src = get_document_root ($src) . '/' . $src;
    return $src;
}
/**
 *
 * @param <type> $src
 * @return string
 */
function get_document_root ($src) {
    // check for unix servers
    if (file_exists ($_SERVER['DOCUMENT_ROOT'] . '/' . $src)) {
        return $_SERVER['DOCUMENT_ROOT'];
    }
    // check from script filename (to get all directories to timthumb location)
    $parts = array_diff (explode ('/', $_SERVER['SCRIPT_FILENAME']), explode ('/', $_SERVER['DOCUMENT_ROOT']));
    $path = $_SERVER['DOCUMENT_ROOT'];
    foreach ($parts as $part) {
        $path .= '/' . $part;
        if (file_exists ($path . '/' . $src)) {
            return $path;
        }
    }
    // the relative paths below are useful if timthumb is moved outside of document root
    // specifically if installed in wordpress themes like mimbo pro:
    // /wp-content/themes/mimbopro/scripts/timthumb.php
    $paths = array (
        "./",
        "../",
        "../../",
        "../../../",
        "../../../../",
        "../../../../../"
    );
    foreach ($paths as $path) {
        if (file_exists ($path . $src)) {
            return $path;
        }
    }
    // special check for microsoft servers
    if (!isset ($_SERVER['DOCUMENT_ROOT'])) {
        $path = str_replace ("/", "\\", $_SERVER['ORIG_PATH_INFO']);
        $path = str_replace ($path, '', $_SERVER['SCRIPT_FILENAME']);
        if (file_exists ($path . '/' . $src)) {
            return $path;
        }
    }
    display_error ('file not found ' . $src, ENT_QUOTES);
}
/**
 * generic error message
 *
 * @param <type> $errorString
 */
function display_error ($errorString = '') {
    header ('HTTP/1.1 400 Bad Request');
	echo '<pre>' . htmlentities ($errorString);
	echo '<br />Query String : ' . htmlentities ($_SERVER['QUERY_STRING']);
	echo '<br />TimThumb version : ' . VERSION . '</pre>';
    die ();
}
?>