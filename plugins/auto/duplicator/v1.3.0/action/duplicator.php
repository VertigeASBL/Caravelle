<?php

/***************************************************************************\
 *  SPIP, Systeme de publication pour l'internet                           *
 *                                                                         *
 *  Copyright (c) 2001-2012                                                *
 *  Arnaud Martin, Antoine Pitrou, Philippe Riviere, Emmanuel Saint-James  *
 *                                                                         *
 *  Ce programme est un logiciel libre distribue sous licence GNU/GPL.     *
 *  Pour plus de details voir le fichier COPYING.txt ou l'aide en ligne.   *
\***************************************************************************/

if (!defined('_ECRIRE_INC_VERSION')) return;

include_spip('inc/charsets');	# pour le nom de fichier

/**
 * Dupliquer le contenu d'un objet
 *
 * @param null $id_objet
 * @return void
 */
function action_duplicator_dist($args=null) {

	if (is_null($args)){
		$securiser_action = charger_fonction('securiser_action', 'inc');
		$args = $securiser_action();
	}
	list($objet,$id_objet) = explode(':',$args);
	
	if ( ($objet=="rubrique") && ($id=intval($id_objet)) ){
		// On duplique la rubrique
		spip_log("Duplication de la rubrique : $id.",'duplicator');
		$nouvelle_rubrique = dupliquer_rubrique($id);
		spip_log("Nouvelle rubrique créée : id_rubrique $nouvelle_rubrique.",'duplicator');
		include_spip('inc/header');
		if ($redirect = _request('redirect'))
			redirige_par_entete(str_replace('&amp;','&',$redirect));
		redirige_par_entete(generer_url_ecrire("rubriques","id_rubrique=".$nouvelle_rubrique, "&"));
	}

	if ( ($objet=="article") && ($id=intval($id_objet)) ){
		// On duplique l article
		$rub = sql_getfetsel('id_rubrique', 'spip_articles', 'id_article='. $id);
		spip_log("Duplication de l'article : $id dans la rubrique $rub.",'duplicator');
		$nouvel_article = dupliquer_article(intval($id),intval($rub));
		spip_log("Nouvel article créé dans la rubrique $rub : id_article $nouvel_article.",'duplicator');
		include_spip('inc/headers');
		if ($redirect = _request('redirect'))
			redirige_par_entete(str_replace('&amp;','&',$redirect));
		redirige_par_entete(generer_url_ecrire("articles","id_article=".$nouvel_article, "&"));
	}

}