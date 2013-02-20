<?php
function formulaires_region_charger_dist() {
	$contexte = array(
		'' => '',
		);
	return $contexte;
}

function formulaires_region_verifier_dist() {
	$erreurs = array();

	if (!_request('ville') or _request('ville') === 'none') {
		$erreurs['message_erreur'] = 'Vous devez choisir une ville';
		$erreurs['NomErreur'] = 'Vous devez choisir une ville';
	}
	return $erreurs;
}

function formulaires_region_traiter_dist() {
	/* On récupère la ville et on renvoie dessus.*/
	$ville = _request('ville');

    /*message*/
	return array(
		'editable' => true,
		'message_ok' => '',
		'redirect' => $ville
		);
}
?>