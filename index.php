<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');
// ==========================================
// Welcome to hash4 - a conventional flat-file blogging system
// Licensed under The MIT License
// http://opensource.org/licenses/MIT
// ==========================================

define("ROOT_URL", "localhost/hash4/");
define("SITE_TAG", "And did I say you look amazing?"); 
?>
<html>
<head>
	<title><?php get_bloginfo('title'); ?> by <?php get_bloginfo('author'); ?></title>
	<style>
	
		body { 
			font-family: Perpetua, Baskerville, "Big Caslon", "Palatino Linotype", Palatino, "URW Palladio L", "Nimbus Roman No9 L", serif;
		} 
		
		.h1, h2, h3, h4, h5, h6, p, ul, li { 
			margin: 0; 
			padding: 3px 0; 
		} 	
		
		li { 
			list-style: none; 
		} 
		
		a { 
			text-decoration: none !important; 
		}
		
		a:visited {
			color:#e0e0e0; 
		}
		
		a:hover {
			color:#c0c0c0;
		}
		
		.content { 
			padding: 20px; 
			width: 660px; 
			margin: 0 auto; 
		} 
		
		.heading { 
			font-size: 48px; 
		} 
		
		.big-up { 
			font-size: 19px; 
		} 
		
		ul.posts { 
			margin-top:20px; 
		} 
		
		.post-content { 
			margin: 20px 0; 
		}
	</style>
</head>
<body> 
	<div class="page">
		<div class="content">
			<h2 class="heading"><a href="http://<?php echo ROOT_URL; ?>"><?php get_bloginfo('title'); ?></a></h3>
			<p class="big-up"><?php get_bloginfo('tag'); ?><p>
			<p>Updated daily by <?php get_bloginfo('author'); ?></p>
			<ul class="posts">
				<?php
				$posts = get_posts(); /* returns 10 posts by default */ 
				if ($posts){ 
					foreach($posts as $id => $post){ 
						$postdata = set_postdata($post);
						?>
						<li class="post"> 
							<h3>
							<a href="<?php the_permalink($id); ?>">
							<?php echo $postdata['title'] ?> 
							</a>
							</h3>
							<em><?php echo $postdata['date']; ?></a></em>
							<?php if (is_single() ) {
								echo "<div class='post-content'>"; 
								the_content($postdata); 
								echo "</div>"; 
							}
							?>
							</p>
						</li>
						<?php
					} ?> 
				<?php } ?> 
			</ul>
		</div><!-- content --> 
	</div><!-- page --> 
</body>
</html>

<?php
function get_bloginfo($setting)
{
	if ($setting) {
		get_settings($setting);
	} else {
		return false; 
	}
}

function get_settings($setting)
{ 
	$filename = "posts.txt"; 
	if (is_file($filename)){
		$fh = fopen($filename, 'r');
		$data = fread($fh, filesize($filename));
		fclose($fh); 
		$data_arr = explode("\n", $data); 
		switch($setting){
			case "title":
				echo trim(str_replace("Site Name", "", $data_arr[0])); 
				break;
			case "author":
				echo trim(str_replace("Author", "", $data_arr[1])); 
				break; 
			case "tag":
				if (defined('SITE_TAG')){
					echo SITE_TAG; 
				} else { 
					echo "Just another dream."; 
				} 
				break; 
			default:
				echo $data_arr[0]; 
				break; 
		} 
	}else{
		die("Settings file not found."); 
	}
}

function get_posts($number_of_posts = 10)
{ 
	$filename = "posts.txt"; 
	if (is_file($filename)){
		$fh = fopen($filename, 'r');
		$data = fread($fh, filesize($filename));
		fclose($fh);
		$data_arr = explode("####", $data);
		unset($data_arr[0]);// dump the settings 
		if (isset($_REQUEST['p'])){ 
			$requestId = $_REQUEST['p']; 
			if (isset( $data_arr[$requestId])){
				$post = $data_arr[$requestId];
				$returnData = array($requestId => $post); 
				return $returnData; 
			} else {
				die("<strong>Post <em>" . $_REQUEST['p'] . "</em> not found</strong>");	
			} 
		
		} else { 
			return array_slice($data_arr, 0, $number_of_posts); 
		}
	}
} 

function set_postdata($post)
{ 
	$data = explode("\n", trim($post)); 
	$postdata['title'] = $data[0]; 
	$postdata['date'] = $data[1]; 
	// thanks to http://stackoverflow.com/questions/758488/
	$postdata['content'] = putLineBreaks(implode("\n", array_slice(explode("\n", $post), 3)));
	return $postdata; 
} 

function is_single() 
{ 
	if (isset($_REQUEST['p'])){
		return true; 
	}else { 
		return false; 
	} 
} 

function the_content($post)
{ 
	echo $post['content']; 
} 

function the_permalink($id)
{ 
	 if (is_single()){ 
	 	echo $_SERVER['REQUEST_URI']; 
	 } else { 
	 	$uri = $_SERVER['REQUEST_URI'] . "?p=" . ($id+1); 
	 	echo $uri; 
	 } 
}

function putLineBreaks($strData){ 
	$strReplaced = ""; 
	$newString = preg_replace("/\n/", "<br />", $strData);
	return $newString; 
} 


function d($var){
	echo "<pre>"; 
	print_r($var);
	echo "</pre>"; 
}
?>