<?php
	/**
	 * Gestionale WinterTour - Pagina di amministrazione
	 *
	 * Plugin per gestire i tornei e l'anagrafica e le iscrizioni dei membri
	 * @author Comunico S.r.l. <info@comunico.info>
	 * @version 1.0
	 * @package wintertour
	 */
	
	// Make sure we don't expose any info if called directly
	if ( !function_exists( 'plugins_url' ) ) {
		exit;
	}
	
	if(isset($_POST['submit0'])) {
		wintertour_addTipologiaSoci();
	} else if(isset($_POST['submit1'])) {
		wintertour_addSocio();
	}
?>
<div class="wgest_page wgest_soci">
	<h1>Gestionale WinterTour</h1>
	<h2>Gestione Soci</h2>
	
	<noscript>
		Per avere a disposizione tutte le funzionalità di questo sito è necessario abilitare Javascript. Qui ci sono tutte le <a href="http://www.enable-javascript.com/it/" target="_blank"> istruzioni su come abilitare JavaScript nel tuo browser</a>.
	</noscript>
	
	<p>
		<a href="<?php echo admin_url('admin.php?page=wintertour_soci&action=add'); ?>">Aggiungi Socio o tipologia socio</a><br />
		<a href="<?php echo admin_url('admin.php?page=wintertour_soci&action=view'); ?>">Consulta tipologie e anagrafica dei soci</a><br />
		<a href="<?php echo admin_url('admin.php?page=wintertour_soci&action=search'); ?>">Ricerca tipologie e anagrafica dei soci</a>
	</p>
	
	<?php if(isset($_REQUEST['action']) && $_REQUEST['action'] === 'add') { ?>
		<form action="<?php echo admin_url('admin.php?page=wintertour_soci&action=add'); ?>" method="post">
			<table cellpadding="2" cellspacing="0" border="0">
				<thead>
					<tr>
						<th colspan="2">
							<h3>Aggiungi nuova tipologia</h3>
						</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td>
							<label for="nometipologia">Nome tipologia:</label>
						</td>
						<td>
							<input name="nometipologia" id="nometipologia" type="text" placeholder="Nome tipologia" />
						</td>
					</tr>
					<tr>
						<td>
							<label for="descrizionetipologia">Descrizione tipologia:</label>
						</td>
						<td>
							<input name="descrizionetipologia" id="descrizionetipologia" type="text" placeholder="Descrizione tipologia" />
						</td>
					</tr>
				</tbody>
				<tfoot>
					<td colspan="2" align="center">
						<input name="submit0" id="submit0" type="submit" value="Aggiungi" />
					</td>
				</tfoot>
			</table>
		</form>
		
		<form action="<?php echo admin_url('admin.php?page=wintertour_soci&action=add'); ?>" method="post">
			<table cellpadding="2" cellspacing="0" border="0">
				<thead>
					<tr>
						<th colspan="2">
							<h3>Aggiungi nuovo socio</h3>
						</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td>
							<label for="nome">Nome:</label>
						</td>
						<td>
							<input name="nome" id="nome" type="text" placeholder="Nome" />
						</td>
					</tr>
					<tr>
						<td>
							<label for="cognome">Cognome:</label>
						</td>
						<td>
							<input name="cognome" id="cognome" type="text" placeholder="Cognome" />
						</td>
					</tr>
					<tr>
						<td>
							<label for="email">Email:</label>
						</td>
						<td>
							<input name="email" id="email" type="email" placeholder="Email" />
						</td>
					</tr>
					<tr>
						<td>
							<label for="tipologia">Tipologia:</label>
						</td>
						<td>
							<select name="tipologia" id="tipologia">
								<?php
									$res = wintertour_elencatipi();
									
									if(!$res) {
								?>
									<option disabled="disabled" selected="selected" value="">--Non esiste nessuna tipologia--</option>
								<?php
									} else {
								?>
									<option disabled="disabled" selected="selected" value="">--Selezionare una tipologia--</option>
								<?php
									}
									
									foreach ($res as $x) {
										echo "<option value=\"$x->ID\">$x->nome</option>";
									}
								?>
							</select>
						</td>
					</tr>
					<tr>
						<td>
							<label for="saldo">Saldo (&euro;):</label>
						</td>
						<td>
							<input name="saldo" id="saldo" type="text" pattern="([+-]?[0-9]+)?([.,][0-9]+)?" placeholder="Saldo" />
						</td>
					</tr>
					<tr>
						<td>
							<label for="indirizzo">Indirizzo:</label>
						</td>
						<td>
							<input name="indirizzo" id="indirizzo" type="text" placeholder="Indirizzo" />
						</td>
					</tr>
					<tr>
						<td>
							<label for="citta">Città:</label>
						</td>
						<td>
							<input name="citta" id="citta" type="text" placeholder="Città" />
						</td>
					</tr>
					<tr>
						<td>
							<label for="cap">CAP:</label>
						</td>
						<td>
							<input name="cap" id="cap" type="text" pattern="^[0-9]{5}$" placeholder="CAP" />
						</td>
					</tr>
					<tr>
						<td>
							<label for="provincia">Provincia:</label>
						</td>
						<td>
							<?=selectProvincia('provincia')?>
						</td>
					</tr>
					<tr>
						<td>
							<label for="telefono">Telefono:</label>
						</td>
						<td>
							<input name="telefono" id="telefono" type="tel" pattern="^[0-9]{10}$" placeholder="Telefono" />
						</td>
					</tr>
					<tr>
						<td>
							<label for="cellulare">Cellulare:</label>
						</td>
						<td>
							<input name="cellulare" id="cellulare" type="tel" pattern="^[0-9]{10}$" placeholder="Cellulare" />
						</td>
					</tr>
					<tr>
						<td>
							<label for="attivo">Stato Attivo:</label>
						</td>
						<td>
							<table>
								<tr>
									<td>
										<input name="attivo" id="attivo1" type="radio" value="1" checked="checked" />Attivo
									</td>
									<td>
										<input name="attivo" id="attivo0" type="radio" value="0" />Inattivo
									</td>
								</tr>
							</table>
						</td>
					</tr>
					<tr>
						<td>
							<label for="datanascita">Data di Nascita:</label>
						</td>
						<td>
							<input name="datanascita" id="datanascita" type="text" class="date" placeholder="gg/mm/aaaa" />
						</td>
					</tr>
					<tr>
						<td>
							<label for="cittanascita">Citt&agrave; di Nascita:</label>
						</td>
						<td>
							<input name="cittanascita" id="cittanascita" type="text" placeholder="Citt&agrave; di Nascita" />
						</td>
					</tr>
					<tr>
						<td>
							<label for="dataiscrizione">Data di Iscrizione:</label>
						</td>
						<td>
							<input name="dataiscrizione" id="dataiscrizione" type="text" class="date" placeholder="gg/mm/aaaa" />
						</td>
					</tr>
					<tr>
						<td>
							<label for="codicefiscale">Codice Fiscale:</label>
						</td>
						<td>
							<input name="codicefiscale" id="codicefiscale" type="text" placeholder="Codice Fiscale" />
						</td>
					</tr>
					<tr>
						<td>
							<label for="dataimmissione">Data Immissione:</label>
						</td>
						<td>
							<input name="dataimmissione" id="dataimmissione" type="text" class="datetime" placeholder="gg/mm/aaaa - hh:mm" />
						</td>
					</tr>
					<tr>
						<td>
							<label for="numerotessera">Numero Tessera:</label>
						</td>
						<td>
							<input name="numerotessera" id="numerotessera" type="text" placeholder="Numero Tessera" />
						</td>
					</tr>
					<tr>
						<td>
							<label for="certificatomedico">Certificato Medico:</label>
						</td>
						<td>
							<table style="min-width: 246px; width: 246px;">
								<tr>
									<td>
										<input name="certificatomedico" id="certificatomedico1" type="radio" value="1" checked="checked" />Pervenuto
									</td>
									<td>
										<input name="certificatomedico" id="certificatomedico0" type="radio" value="0" />Non Pervenuto
									</td>
								</tr>
							</table>
						</td>
					</tr>
					<tr>
						<td>
							<label for="domandaassociazione">Domanda di Associazione:</label>
						</td>
						<td>
							<input name="domandaassociazione" id="domandaassociazione" type="text" class="date" placeholder="gg/mm/aaaa" />
						</td>
					</tr>
					<tr>
						<td>
							<label for="circolo">Circolo:</label>
						</td>
						<td>
							<select name="circolo" id="circolo">
								<?php
								$res = wintertour_elencacircoli();
								
								if(count($res) <= 0) { ?>
									<option value="" disabled="disabled" selected="selected">--Non esistono circoli--</option>
								<?php } else { ?>
									<option value="" disabled="disabled" selected="selected">--Selezionare un circolo--</option>
								<?php } foreach(wintertour_elencacircoli() as $row) { ?>
									<option value="<?=$row->ID?>"><?=$row->nome?></option>
								<?php } ?>
							</select>
						</td>
					</tr>
				</tbody>
				<tfoot>
					<td colspan="2" align="center">
						<input name="submit1" id="submit1"  type="submit" value="Aggiungi" />
					</td>
				</tfoot>
			</table>
		</form>
	<?php } else if(isset($_REQUEST['action']) && $_REQUEST['action'] === 'view') {
		$tipologie = wintertour_elencatipi();
		$soci = wintertour_elencaSoci();
	?>
	<?php if(count($tipologie) > 0) { ?>
		<div class="editor">
			<h3>Elenco tipologie</h3>
			<table class="output-table">
				<thead>
					<tr>
						<th>
							Azione
						</th>
						<?php foreach($tipologie[0] as $colonna => $valore) {?>
							<th style="padding:3px"><?=ucfirst($colonna)?></th>
						<?php } ?>
					</tr>
				</thead>
				<tbody>
					<?php foreach($tipologie as $index => $riga) { ?>
						<tr>
							<td>
								<a href="<?php echo admin_url('admin.php?page=wintertour_soci&action=tipologiaedit&tipologia=' . $riga->ID); ?>">Modifica</a>
							</td>
							<?php foreach($riga as $colonna => $valore) { ?>
								<td>
									<?=$valore?>
								</td>
							<?php } ?>
						</tr>
					<?php } ?>
				</tbody>
			</table>
			</div>
		</div>
	<?php } else { ?>
		<h3>Nessuna Tipologia</h3>
	<?php } ?>
	<?php if(count($soci) > 0) { ?>
		<div class="scrollable-view">
			<h3>Elenco soci</h3>
			<div class="scrolling">
				<table class="output-table">
					<thead>
						<tr>
						<th>
							Azione
						</th>
							<th>ID</th>
							<th>Nome</th>
							<th>Cognome</th>
							<th>Email</th>
							<th>Tipologia</th>
							<th>Saldo</th>
							<th>Indirizzo</th>
							<th>Città</th>
							<th>CAP</th>
							<th>Provincia</th>
							<th>Telefono</th>
							<th>Cellulare</th>
							<th>Stato Attivo</th>
							<th>Data Nascita</th>
							<th>Città Nascita</th>
							<th>Codice Fiscale</th>
							<th>Data Immissione</th>
							<th>Numero Tessera</th>
							<th>Certificato Medico</th>
							<th>Domanda Associazione</th>
							<th>Circolo</th>
						</tr>
					</thead>
					<tbody>
						<?php foreach($soci as $index => $riga) { ?>
							<tr>
								<td>
									<a href="<?php echo admin_url('admin.php?page=wintertour_soci&action=sociedit&socio=' . $riga->ID); ?>">Modifica</a>
								</td>
								<?php foreach($riga as $colonna => $valore) { ?>
									<td>
										<?=$valore?>
									</td>
								<?php } ?>
							</tr>
						<?php } ?>
					</tbody>
				</table>
				<div class="scrollbar"></div>
			</div>
		</div>
	<?php } else { ?>
		<h3>Nessun Socio</h3>
	<?php } ?>
	<?php } else if(isset($_REQUEST['action']) && $_REQUEST['action'] === 'search') { ?>
		<h3>Ricerca Tipologie</h3>
		<form action="<?php echo admin_url('admin.php'); ?>" method="get">
			<?php foreach ($_GET as $key => $value) { ?>
			<input name="<?=$key?>" type="hidden" value="<?=$value?>" />
			<?php } ?>
			<input name="wt_nonce" type="hidden" value="<?php echo wp_create_nonce(wt_nonce); ?>" />
			<table>
				<tbody>
					<tr>
						<td>
							<input data-autocompname="tipologia" type="text" placeholder="Cerca una tipologia" class="searchbox autocompletion" />
						</td>
						<td>
							<select data-autocomptype="tipologie_soci" name="tipologia" class="searchbox autocompletion">
								<option disabled="disabled" selected="selected" value="">--Cerca una tipologia--</option>
							</select>
						</td>
					</tr>
				</tbody>
				<tfoot>
					<tr>
						<td>
							<input data-autocompname="tipologia" class="autocompletion" type="submit" value="Modifica" />
						</td>
					</tr>
				</tfoot>
			</table>
		</form>
		<h3>Ricerca Soci</h3>
		<form action="<?php echo admin_url('admin.php'); ?>" method="get">
			<?php foreach ($_GET as $key => $value) { ?>
			<input name="<?=$key?>" type="hidden" value="<?=$value?>" />
			<?php } ?>
			<input name="wt_nonce" type="hidden" value="<?php echo wp_create_nonce(wt_nonce); ?>" />
			<table>
				<tbody>
					<tr>
						<td>
							<input data-autocompname="socio" type="text" placeholder="Cerca un socio" class="searchbox autocompletion" />
						</td>
						<td>
							<select data-autocomptype="soci" name="socio" class="searchbox autocompletion">
								<option disabled="disabled" selected="selected" value="">--Cerca un socio--</option>
							</select>
						</td>
					</tr>
				</tbody>
				<tfoot>
					<tr>
						<td>
							<input data-autocompname="socio" class="autocompletion" type="submit" value="Modifica" />
						</td>
					</tr>
				</tfoot>
			</table>
		</form>
	<?php } else if(isset($_REQUEST['action']) && $_REQUEST['action'] === 'tipologiaedit' && isset($_REQUEST['tipologia'])) { ?>
		<?php
			if(isset($_POST['soci_tipo']) && isset($_POST['ID']) && isset($_POST['nome']) && isset($_POST['descrizione'])) {
				if(wintertour_edit_tipologia_soci($_REQUEST['tipologia'], $_POST['ID'], $_POST['nome'], $_POST['descrizione'])) {
					echo 'Operazione effettuata correttamente';
				} else {
					echo "Impossibile completare l'operazione richiesta";
				}
			}
			
			$obj_tipo = wintertour_get_tipologia_soci($_REQUEST['tipologia']);
		?>
		<h3>Modifica Tipologia</h3>
		<form class="editor" action="<?php echo admin_url('admin.php?page=wintertour_soci&action=tipologiaedit&tipologia=' . $_REQUEST['tipologia']); ?>" method="post">
			<input name="wt_nonce" type="hidden" value="<?php echo wp_create_nonce(wt_nonce); ?>" />
			<table>
				<tbody>
					<tr>
						<td>
							<label for="ID">ID</label>
						</td>
						<td>
							<input name="ID" readonly="readonly" type="text" value="<?=$obj_tipo->ID?>" />
						</td>
					</tr>
					<tr>
						<td>
							<label for="nome">Nome</label>
						</td>
						<td>
							<input name="nome" type="text" value="<?=$obj_tipo->nome?>" />
						</td>
					</tr>
					<tr>
						<td>
							<label for="descrizione">Descrizione</label>
						</td>
						<td>
							<input name="descrizione" type="text" value="<?=$obj_tipo->descrizione?>" />
						</td>
					</tr>
				</tbody>
				<tfoot>
					<tr>
						<td>
							<input data-autocompname="tipologia" name="soci_tipo" type="submit" value="Salva" />
						</td>
					</tr>
				</tfoot>
			</table>
		</form>
	<?php } else if(isset($_REQUEST['action']) && $_REQUEST['action'] === 'sociedit' && isset($_REQUEST['socio'])) { ?>
		<?php
			if(isset($_POST['savesocio'])) {
				if(wintertour_edit_socio($_REQUEST['socio'], $_POST)) {
					echo 'Operazione effettuata correttamente';
				} else {
					global $wpdb;
					
					echo "Impossibile completare l'operazione richiesta";
					echo $wpdb->last_query;
				}
			}
			
			$obj_socio = wintertour_get_socio($_REQUEST['socio']);
		?>
		<h3>Modifica Socio</h3>
		<form class="editor" action="<?php echo admin_url('admin.php?page=wintertour_soci&action=sociedit&socio=' . $_REQUEST['socio']); ?>" method="post">
			<input name="wt_nonce" type="hidden" value="<?php echo wp_create_nonce(wt_nonce); ?>" />
			<table>
				<tbody>
					<tr>
						<td>
							<label for="ID">ID</label>
						</td>
						<td>
							<input name="ID" readonly="readonly" type="text" value="<?=$obj_socio->ID?>" />
						</td>
					</tr>
					<tr>
						<td>
							<label for="nome">Nome:</label>
						</td>
						<td>
							<input name="nome" id="nome" type="text" placeholder="Nome" value="<?=$obj_socio->nome?>" />
						</td>
					</tr>
					<tr>
						<td>
							<label for="cognome">Cognome:</label>
						</td>
						<td>
							<input name="cognome" id="cognome" type="text" placeholder="Cognome" value="<?=$obj_socio->cognome?>" />
						</td>
					</tr>
					<tr>
						<td>
							<label for="email">Email:</label>
						</td>
						<td>
							<input name="email" id="email" type="email" placeholder="Email" value="<?=$obj_socio->email?>" />
						</td>
					</tr>
					<tr>
						<td>
							<label for="tipologia">Tipologia:</label>
						</td>
						<td>
							<select name="tipologia" id="tipologia">
								<?php
									$res = wintertour_elencatipi();
									
									if(!$res) {
								?>
									<option disabled="disabled" selected="selected" value="">--Non esiste nessuna tipologia--</option>
								<?php } else { ?>
									<option disabled="disabled" value="">--Selezionare una tipologia--</option>
								<?php }
									
									foreach ($res as $x) {
										echo "<option " . (($x->ID == $obj_socio->tipologia) ? "selected=\"selected\"" : "" ) . " value=\"$x->ID\">$x->nome</option>";
									}
								?>
							</select>
						</td>
					</tr>
					<tr>
						<td>
							<label for="saldo">Saldo (&euro;):</label>
						</td>
						<td>
							<input name="saldo" id="saldo" type="text" pattern="([+-]?[0-9]+)?([.,][0-9]+)?" placeholder="Saldo" value="<?=$obj_socio->saldo?>" />
						</td>
					</tr>
					<tr>
						<td>
							<label for="indirizzo">Indirizzo:</label>
						</td>
						<td>
							<input name="indirizzo" id="indirizzo" type="text" placeholder="Indirizzo" value="<?=$obj_socio->indirizzo?>" />
						</td>
					</tr>
					<tr>
						<td>
							<label for="citta">Città:</label>
						</td>
						<td>
							<input name="citta" id="citta" type="text" placeholder="Città" value="<?=$obj_socio->citta?>" />
						</td>
					</tr>
					<tr>
						<td>
							<label for="cap">CAP:</label>
						</td>
						<td>
							<input name="cap" id="cap" type="text" pattern="^[0-9]{5}$" placeholder="CAP" value="<?=$obj_socio->cap?>" />
						</td>
					</tr>
					<tr>
						<td>
							<label for="provincia">Provincia:</label>
						</td>
						<td>
							<?=selectProvincia('provincia', $obj_socio->provincia)?>
						</td>
					</tr>
					<tr>
						<td>
							<label for="telefono">Telefono:</label>
						</td>
						<td>
							<input name="telefono" id="telefono" type="tel" pattern="^[0-9]{10}$" placeholder="Telefono" value="<?=$obj_socio->telefono?>" />
						</td>
					</tr>
					<tr>
						<td>
							<label for="cellulare">Cellulare:</label>
						</td>
						<td>
							<input name="cellulare" id="cellulare" type="tel" pattern="^[0-9]{10}$" placeholder="Cellulare" value="<?=$obj_socio->cellulare?>" />
						</td>
					</tr>
					<tr>
						<td>
							<label for="attivo">Stato Attivo:</label>
						</td>
						<td>
							<table>
								<tr>
									<td>
										<input name="attivo" id="attivo1" type="radio" value="1"<?php if($obj_socio->statoattivo) { ?> checked="checked"<?php } ?> />Attivo
									</td>
									<td>
										<input name="attivo" id="attivo0" type="radio" value="0"<?php if(!$obj_socio->statoattivo) { ?> checked="checked"<?php } ?> />Inattivo
									</td>
								</tr>
							</table>
						</td>
					</tr>
					<tr>
						<td>
							<label for="datanascita">Data di Nascita:</label>
						</td>
						<td>
							<input name="datanascita" id="datanascita" type="text" class="date" placeholder="gg/mm/aaaa" value="<?=wintertour_localdate($obj_socio->datanascita)?>" />
						</td>
					</tr>
					<tr>
						<td>
							<label for="cittanascita">Citt&agrave; di Nascita:</label>
						</td>
						<td>
							<input name="cittanascita" id="cittanascita" type="text" placeholder="Citt&agrave; di Nascita" value="<?=$obj_socio->cittanascita?>" />
						</td>
					</tr>
					<tr>
						<td>
							<label for="dataiscrizione">Data di Iscrizione:</label>
						</td>
						<td>
							<input name="dataiscrizione" id="dataiscrizione" type="text" class="date" placeholder="gg/mm/aaaa" value="<?=wintertour_localdate($obj_socio->dataiscrizione)?>" />
						</td>
					</tr>
					<tr>
						<td>
							<label for="codicefiscale">Codice Fiscale:</label>
						</td>
						<td>
							<input name="codicefiscale" id="codicefiscale" type="text" placeholder="Codice Fiscale" value="<?=$obj_socio->codicefiscale?>" />
						</td>
					</tr>
					<tr>
						<td>
							<label for="dataimmissione">Data Immissione:</label>
						</td>
						<td>
							<input name="dataimmissione" id="dataimmissione" type="text" readonly="readonly" placeholder="gg/mm/aaaa - hh:mm" value="<?=wintertour_localdatetime($obj_socio->dataimmissione)?>" />
						</td>
					</tr>
					<tr>
						<td>
							<label for="numerotessera">Numero Tessera:</label>
						</td>
						<td>
							<input name="numerotessera" id="numerotessera" type="text" placeholder="Numero Tessera" value="<?=$obj_socio->numerotessera?>" />
						</td>
					</tr>
					<tr>
						<td>
							<label for="certificatomedico">Certificato Medico:</label>
						</td>
						<td>
							<table style="min-width: 246px; width: 246px;">
								<tr>
									<td>
										<input name="certificatomedico" id="certificatomedico1" type="radio" value="1"<?php if($obj_socio->certificatomedico) { ?> checked="checked"<?php } ?> />Pervenuto
									</td>
									<td>
										<input name="certificatomedico" id="certificatomedico0" type="radio" value="0"<?php if(!$obj_socio->certificatomedico) { ?> checked="checked"<?php } ?> />Non Pervenuto
									</td>
								</tr>
							</table>
						</td>
					</tr>
					<tr>
						<td>
							<label for="domandaassociazione">Domanda di Associazione:</label>
						</td>
						<td>
							<input name="domandaassociazione" id="domandaassociazione" type="text" class="date" placeholder="gg/mm/aaaa" value="<?=wintertour_localdate($obj_socio->domandaassociazione)?>" />
						</td>
					</tr>
					<tr>
						<td>
							<label for="circolo">Circolo:</label>
						</td>
						<td>
							<select name="circolo" id="circolo">
								<?php
									$res = wintertour_elencacircoli();
									
									if(!$res) {
								?>
									<option disabled="disabled" selected="selected" value="">--Non esiste nessun circolo--</option>
								<?php } else { ?>
									<option disabled="disabled" selected="selected" value="">--Selezionare una circolo--</option>
								<?php }
									
									foreach ($res as $x) {
										echo "<option " . ((intval($x->ID) === intval($obj_socio->circolo)) ? "selected=\"selected\"" : "" ) . " value=\"$x->ID\">$x->nome</option>";
									}
								?>
							</select>
						</td>
					</tr>
				</tbody>
				<tfoot>
					<tr>
						<td>
							<input name="savesocio" data-autocompname="tipologia" type="submit" value="Salva" />
						</td>
					</tr>
				</tfoot>
			</table>
		</form>
	<?php } ?>
</div>
