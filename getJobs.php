<?php

// ini_set('display_errors', '1');
// ini_set('display_startup_errors', '1');
// error_reporting(E_ALL);




function find($champs, $cle) {
	foreach ($champs as $champ){
		if ($champ['val'] == $cle) {
			return $champ['content'];
		}
	}
	return '';
}

function map($r) {
	// if (find($r['FL'], 'Publish') == 'true') {
		return [
			'titre' => find($r['FL'], 'Posting Title'),
			'description' => find($r['FL'], 'Job Description'),
			'descriptionCourte' => '',
			'industrie' => find($r['FL'], 'Industry'),
			'ville' => find($r['FL'], 'City'),
			'codePostal' => find($r['FL'], 'Zip Code'),
			'province' => find($r['FL'], 'State'),
			'experienceRequise' => find($r['FL'], 'Work Experience'),
			'salaire' => find($r['FL'], 'Salary'),
			'jobId' => find($r['FL'], 'JOBOPENINGID'),
			'jobStatus' =>  find($r['FL'], 'Job Opening Status'),

			'langue' => ((find($r['FL'], 'Created By') == 'Philippe Mercure')?'en':'fr'),
			'dateCreation' => find($r['FL'], 'Created Time'),
			'dateModification' => find($r['FL'], 'Modified Time'),
			// 'urlView' => 'https://optalent.zohorecruit.com/recruit/PortalDetail.na?iframe=true&digest=PUdcCcZtRHqzIUa6RUO8znGAUnkE7bVo.a85bxdBEmQ-&widgetid=494954000000072311&embedsource=CareerSite&jobid='.find($r['FL'], 'JOBOPENINGID'),
			// 'urlApply' => 'https://optalent.zohorecruit.com/recruit/Apply.na?digest=PUdcCcZtRHqzIUa6RUO8zl8ijrajlU%409EgqSzsIv2fs-&embedsource=CareerSite&jobid='.find($r['FL'], 'JOBOPENINGID'),
		];
	// }
}

function filtre($r) {
	$langue = (isset($_GET['lang'])?$_GET['lang']:null);
	return $r != null 
		&& ($r['langue'] == $langue || $langue == null) 
		&& ($r['jobStatus'] == 'In-progress' || $r['jobStatus'] == 'Filled');
}

function ordre($a, $b) {
	if ($a['dateModification'] == $b['dateModification']) {
		return 0;
	}
	return ($a['dateModification'] < $b['dateModification']) ? 1 : -1;
}


function slugify($text)
{
	  $text = preg_replace('~[^\pL\d]+~u', '-', $text);
	    $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);
	    $text = preg_replace('~[^-\w]+~', '', $text);
	      $text = trim($text, '-');
	      $text = preg_replace('~-+~', '-', $text);
	        $text = strtolower($text);
	        if (empty($text)) {
			    return 'n-a';
			      }
		  return $text;
}



function traiterDB($donnees) {
//	include_once(dirname(__FILE__).'/../../../wp-config.php');
//	$conn = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
	$conn = new mysqli('service-database.wordpress', 'wordpress', 'uXiB05m6TKuuMCgx', 'optalent');

	$LANGUE_FR=3;
	$LANGUE_EN=6;
	$CATEGORIE_POSTE_FR=19;
	$CATEGORIE_POSTE_EN=21;

	if (!$conn->connect_error) {

		// Changé tous les status pour le mettre en attente
		$sql = $conn->prepare("UPDATE wp_postmeta SET meta_value='X' WHERE meta_key='estcomble'");
		$sql->execute();
		$sql->close();

		foreach ($donnees as $cle => $donnee) {
		// $donnee = $donnees[4];

			//Vérifier si existe déjà
			$sql = $conn->prepare("select post_id from wp_postmeta where meta_key = 'idJob' and meta_value =?");
			$sql->bind_param('s', $donnee['jobId']);
			$sql->execute();
			$resultatPostId = $sql->get_result();
			if (($resultatPostId->num_rows <= 0) && ($donnee['jobId'] > 0)) {
				$sqlDeux = $conn->prepare("INSERT INTO wp_posts (post_author, post_date, post_date_gmt, post_content, post_title, post_excerpt, post_status, comment_status, ping_status, post_password, post_name, to_ping, pinged, post_modified, post_modified_gmt, post_content_filtered, post_parent, guid, menu_order, post_type, post_mime_type, comment_count) VALUES (1, CURRENT_TIMESTAMP(), CURRENT_TIMESTAMP(), ?, ?, '', 'publish', 'open', 'open', '', ?, '', '', CURRENT_TIMESTAMP(), CURRENT_TIMESTAMP(), '', 0, ?, 0, 'post', '', 0)");

				$description = $donnee['description'];
				$description = preg_replace('/<\/{0,1}span.*?>/','',$description);
				$description = preg_replace('/ class=".*?"/','',$description);
				$description = preg_replace('/ style=".*?"/','',$description);
				$description = preg_replace('/<\/{0,1}div.*?>/','',$description);
				$description = preg_replace('/&nbsp;/',' ',$description);
				$description = preg_replace('/(<\/{0,1}h).>/','${1}3>',$description);
				
				// $sqlDeux->bind_param('ssss', $description, $donnee['titre'], sanitize_title($donnee['titre']), uniqid());
				$sqlDeux->bind_param('ssss', $description, $donnee['titre'], slugify($donnee['titre']), uniqid());
				$sqlDeux->execute();
				$sqlDeux->close();

				$postId = $conn->insert_id;

				$sqlDeux = $conn->prepare(
					"INSERT INTO wp_postmeta (post_id, meta_key, meta_value) VALUES
						($postId, '_yoast_wpseo_primary_category', '19'),
						($postId, 'description_courte', ?),
						($postId, '_description_courte', 'field_5df006182f3a5'),
						($postId, 'industrie', ?),
						($postId, '_industrie', 'field_5df0054b30690'),
						($postId, 'ville', ?),
						($postId, '_ville', 'field_5df0059620bce'),
						($postId, 'code_postal', ?),
						($postId, '_code_postal', 'field_5df005d620bcf'),
						($postId, 'province', ?),
						($postId, '_province', 'field_5df005e620bd0'),
						($postId, 'experience_requise', ?),
						($postId, '_experience_requise', 'field_5df005f120bd1'),
						($postId, 'salaire', ?),
						($postId, '_salaire', 'field_5df0060b20bd2'),
						($postId, '_yoast_wpseo_content_score', '60'),
						($postId, 'idJob', ?),
						($postId, '_idJob', 'field_5df0204ecb5f4'),
						($postId, 'estcomble', '0'),
						($postId, '_estcomble', 'field_60381cdcbb2c7')");
				$sqlDeux->bind_param('ssssssss', $donnee['descriptionCourte'], $donnee['industrie'], $donnee['ville'], $donnee['codePostal'], $donnee['province'], $donnee['experienceRequise'], $donnee['salaire'], $donnee['jobId']);
				$sqlDeux->execute();
				$sqlDeux->close();

				$sqlDeux = $conn->prepare(
					"INSERT INTO wp_term_relationships (object_id, term_taxonomy_id, term_order) VALUES
						($postId, ?, 0),
						($postId, ?, 0)");
				if ($donnee['langue']=='fr') {
					$sqlDeux->bind_param('ii', $LANGUE_FR, $CATEGORIE_POSTE_FR);
				} else {
					$sqlDeux->bind_param('ii', $LANGUE_EN, $CATEGORIE_POSTE_EN);
				}
				$sqlDeux->execute();
				$sqlDeux->close();
				

				// var_dump($donnee);
				echo 'CREE : '.$donnee['jobId'].' - '.$postId."\n";
			
			} else {
				// Mise a jour du status
				$postId = '-1';
				if ($row = $resultatPostId->fetch_assoc()) {
					$postId = $row['post_id'];
				}
				$sqlDeux = $conn->prepare("UPDATE wp_postmeta SET meta_value=? WHERE post_id=? AND meta_key='estcomble'");
				$estComble = (($donnee['jobStatus'] == 'Filled') ? '1' : '0');
				$sqlDeux->bind_param('ss', $estComble, $postId);
				$sqlDeux->execute();
				$sqlDeux->close();

				$sqlDeux = $conn->prepare("UPDATE wp_posts SET post_status='publish' WHERE id=?");
				$sqlDeux->bind_param('s', $postId);
				$sqlDeux->execute();
				$sqlDeux->close();

				echo 'MAJ : '.$donnee['jobId'].' - '.$postId.' - '.$estComble."\n";
				//---------------
			}

			$sql->close();
		}

		// Suppimer les enregistrement encore en attente
		$sql = $conn->prepare("UPDATE wp_posts SET post_status='trash' WHERE id IN (SELECT post_id FROM wp_postmeta WHERE meta_value='X' AND meta_key='estcomble')");
		$sql->execute();
		$sql->close();


		$conn->close();
	}
}

function obtenirContenu($nomFichier) {
	$fichier = fopen($nomFichier,'r');
	$d = json_decode(fread($fichier, filesize($nomFichier)), true);
	fclose($fichier);

	$rows = $d['response']['result']['JobOpenings']['row'];
	if (array_keys($rows)[0] != '0') {
		$rows = [$rows];
	}

	return $rows;
} 

$rows = array_merge(
	obtenirContenu(dirname(__FILE__).'/jobs-open.json'),
	obtenirContenu(dirname(__FILE__).'/jobs-filled.json')
);


$dt = array_map('map', $rows);
$dt = array_filter($dt,'filtre');

usort($dt, 'ordre');

// header('Access-Control-Allow-Origin: *');
// header('Content-Type: Application/Json');
// header('Cache-Control: no-store');
// echo json_encode($dt);

traiterDB($dt);


// insert into wp_postmeta (post_id,meta_key,meta_value) SELECT post_id,'_estcomble','field_60381cdcbb2c7' FROM `wp_postmeta` where meta_key='_idJob';
// insert into wp_postmeta (post_id,meta_key,meta_value) SELECT post_id,'estcomble','0' FROM `wp_postmeta` where meta_key='idJob';

?>

