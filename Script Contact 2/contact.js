const setari_script_contact = {
	"adresa_fisier_contact":"http://exemplu.ro/contact/contact.php"
};

const creare_alert_status = (clasa_status,mesaj,selector,timeout_secunde) => {
	var identificator_element = Math.floor(Math.random() * 10000000000);
	var mesaj_alert = '<div class="alert alert-'+clasa_status+'" id="alerta_'+identificator_element+'" role="alert">\
		<button type="button" class="close" onclick="jQuery(\'#alerta_'+identificator_element+'\').hide();" aria-label="Close">\
		<span aria-hidden="true">&times;</span>\
		</button>\
		'+mesaj+'\
		<script>\
		jQuery(\'html, body\').animate({ scrollTop: jQuery("'+selector+'").offset().top-100 }, \'slow\');\
		setTimeout(() => {\
		jQuery("#alerta_'+identificator_element+'").remove();\
		}, '+timeout_secunde+'*1000);\
		</script>\
		</div>';
	jQuery(selector).prepend(mesaj_alert);
}

function trimite_formular_contact(cod_recaptcha) {
	jQuery.ajax({
		type: "POST",
		data: {
			recaptcha: cod_recaptcha,
			nume: jQuery("#formular_contact_baxandreiro_nume").val(),
			email: jQuery("#formular_contact_baxandreiro_email").val(),
			departament: jQuery("#formular_contact_baxandreiro_departament").val(),
			subiect: jQuery("#formular_contact_baxandreiro_subiect").val(),
			mesaj: jQuery("#formular_contact_baxandreiro_mesaj").val()
		},
		url: setari_script_contact.adresa_fisier_contact,
		dataType: "json",
		success: raspuns => {
			grecaptcha.reset();
			jQuery("#formular_contact_baxandreiro_submit").html('<i class="fa fa-paper-plane-o" aria-hidden="true"></i> Trimite');
			jQuery('#formular_contact_baxandreiro_nume').attr('readonly', false);
			jQuery('#formular_contact_baxandreiro_email').attr('readonly', false);
			jQuery('#formular_contact_baxandreiro_departament').attr('disabled', false);
			jQuery('#formular_contact_baxandreiro_subiect').attr('readonly', false);
			jQuery('#formular_contact_baxandreiro_mesaj').attr('readonly', false);
			if (raspuns.eroare == false) {
				window.setTimeout(() => {
					creare_alert_status('success','Mesajul a fost trimis cu succes!','#formular_contact_baxandreiro_alert',10);
					document.getElementById("formular_contact_baxandreiro_form").reset();
				}, 1000);
			} else {
				window.setTimeout(() => {
					creare_alert_status('warning','Eroare: '+raspuns.mesaj_eroare,'#formular_contact_baxandreiro_alert',10);
					if(raspuns.campuri_necesare != undefined && raspuns.campuri_necesare.length) {
						raspuns.campuri_necesare.forEach(element => {
							jQuery('#'+element).attr('style','border-color:#E91E63');
						});
						jQuery('html, body').animate({ scrollTop: jQuery("#formular_contact_baxandreiro_form").offset().top-100 }, 'slow');
					}
				}, 1000);
			}
		},
		beforeSend: () => {
			jQuery("#formular_contact_baxandreiro_alert").html('');
			creare_alert_status('info','Mesaj in curs de trimitere...','#formular_contact_baxandreiro_alert',5);
			jQuery("#formular_contact_baxandreiro_submit").html('<i class="fas fa-circle-notch fa-spin"></i>');
			jQuery('#formular_contact_baxandreiro_nume').attr('readonly', true);
			jQuery('#formular_contact_baxandreiro_email').attr('readonly', true);
			jQuery('#formular_contact_baxandreiro_departament').attr('disabled', true);
			jQuery('#formular_contact_baxandreiro_subiect').attr('readonly', true);
			jQuery('#formular_contact_baxandreiro_mesaj').attr('readonly', true);
			jQuery('#formular_contact_baxandreiro_nume').attr('style','border-color:#ddd');
			jQuery('#formular_contact_baxandreiro_email').attr('style','border-color:#ddd');
			jQuery('#formular_contact_baxandreiro_departament').attr('style','border-color:#ddd');
			jQuery('#formular_contact_baxandreiro_subiect').attr('style','border-color:#ddd');
			jQuery('#formular_contact_baxandreiro_mesaj').attr('style','border-color:#ddd');
		},
		error: () => {
			jQuery("#formular_contact_baxandreiro_submit").html('<i class="fa fa-paper-plane-o" aria-hidden="true"></i> Trimite');
			creare_alert_status('danger','Se pare ca a aparut o eroare temporara. Te rugam sa incerci din nou mai tarziu!','#formular_contact_baxandreiro_alert',10);
			jQuery('#formular_contact_baxandreiro_submit').attr('type', 'disabled');
			jQuery('#formular_contact_baxandreiro_submit').attr('data-sitekey', null);
			jQuery('#formular_contact_baxandreiro_submit').attr('data-callback', null);
			jQuery('#formular_contact_baxandreiro_submit').attr('style', "background:#444;cursor:not-allowed;");
		}
	});
}