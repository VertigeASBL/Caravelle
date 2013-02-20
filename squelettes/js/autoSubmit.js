/*
*	Script d'autosoumission de formulaire
* 	Didier - Vertige ASBL
*/
jQuery(document).ready(function($) {
	// Si un statut change
	$(".autosubmit select").live("change", function () {
		$(this).parents(".autosubmit").submit();
	});
});